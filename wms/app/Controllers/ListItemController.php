<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Field;
use Admin\Models\ListItem;
use Admin\Models\Model;

/**
 * Class PageController
 *
 * @package Admin\Controllers
 */
class ListItemController extends BaseController
{
    public function index($lid)
    {
        $content_id = Helper::get('contentId', 0);

        $fieldModel = new Field();

        $contentModel = $this->model(Model::class)->findOne(
            "type='list' AND parent_id=0 AND content_id={$lid}"
        );
        $contentSubModels = $this->model(Model::class)->findAll(
            "type='list' AND parent_id={$contentModel->id} AND content_id={$lid}"
        );

        $fields = [];
        foreach ($contentSubModels as $contentSubModel) {
            $fields[$contentSubModel->tab] = $fieldModel->findAll(
                'model_id=:model_id',
                ['model_id' => $contentSubModel->id]
            );
        }

        $model = new ListItem();
        $where = 'field_id=:field_id AND content_id=:content_id';
        $params =  ['field_id' => $lid, 'content_id' => $content_id];
        $items = $model->findAll($where, $params, SORT_ORDER_DESC);

        $this->assign(['items' => $items, 'fields' => $fields, 'fid' => $lid]);
        $data = $this->render('list-item/index');
        $this->success($data);
    }

    public function edit($fid = 0, $iid = 0)
    {
        $model = new ListItem();
        $row = $model->findOne('field_id=:field_id AND id=:id', ['field_id' => $fid, 'id' => $iid]);
        $contentModel = $this->model(Model::class)->findOne(
            "type='list' AND parent_id=0 AND content_id={$fid}"
        );
        $data = [
            'model_id' => $contentModel ? $contentModel['id'] : 0,
            'row' => $row,
            'fid' => $fid,
            'iid' => $iid
        ];
        $this->assign($data);
        $data = $this->render('list-item/edit');
        $this->success($data);
    }

    public function save()
    {
        $id = Helper::post('id');
        $model = new ListItem();
        if ($id) {
            $ret = $model->update($_POST, $id);
        } else {
            $ret = $model->create($_POST);
        }

        $this->success($ret);
    }

    public function delete($id)
    {
        $model = new ListItem();
        $ret = $model->remove($id, true);
        $this->action('Delete');
        $this->success($ret);
    }

    public function sort()
    {
        $sorts = Helper::post('sorts');
        $model = new ListItem();
        foreach ($sorts as $id => $sort) {
            $model->update(['sort' => $sort], $id);
        }

        $this->success($sorts);
    }
}
