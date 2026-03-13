<?php

namespace Site\Models;

use Site\Profile;

class ListItem extends Base
{
    public function __construct()
    {
        parent::__construct('list_item', 'id');
        $this->profile = new Profile('list_item_profile', 'list_item_id');
    }

    public function getFieldData($contentId, $postId)
    {
        $fieldModel = new Field();
        $modelModel = new Model();

        $contentModel = $modelModel->findOne(
            "type='list' AND parent_id=0 AND content_id={$contentId}"
        );
        $contentSubModels = $modelModel->findAll(
            "type='list' AND parent_id={$contentModel->id} AND content_id={$contentId}"
        );

        $_fields = [];
        foreach ($contentSubModels as $contentSubModel) {
            $_fields = array_merge(
                $_fields,
                $fieldModel->findAll(
                    'model_id=:model_id',
                    ['model_id' => $contentSubModel->id]
                )
            );
        }

        $fields = [];
        foreach ($_fields as $_field) {
            $fields[] = ['name' => $_field->name, 'label' => $_field->label];
        }

        $where = 'field_id=:field_id AND content_id=:content_id';
        $params = ['field_id' => $contentId, 'content_id' => $postId];
        $_data = $this->findAll($where, $params, SORT_ORDER_DESC);
        $data = [];
        foreach ($_data as $_item) {
            $item = [];
            foreach ($fields as $field) {
                $item['id'] = $_item['id'];
                $item[$field['name']] = $_item[$field['name']];
            }
            $data[] = $item;
        }

        return ['fields' => $fields, 'data' => $data];
    }
}
