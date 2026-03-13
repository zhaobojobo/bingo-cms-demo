<?php

namespace Admin\Models;

use Admin\Data;
use Admin\Helper;
use Admin\Profile;

/**
 * Class Page
 *
 * @package Admin\Models
 */
class Page extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'page';
        $this->idField = 'id';
        $this->data = new Data('page_data', 'page_id');
        $this->profile = new Profile('page_profile', 'page_id');
    }

    /**
     * @return array
     */
    public function shortcuts()
    {
        $pages = $this->findAll('shortcut=1');

        return $pages;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data = $this->validate($data, 'create');
        $data = $this->inputFilter($data);
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = $data['create_time'];

        return parent::create($data);
    }

    /**
     * @param        $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        if (isset($data['hidden'])) {
            $data['hidden'] = intval($data['hidden']);
        }
        if (isset($data['review'])) {
            $data['review'] = intval($data['review']);
        }
        if (isset($data['shortcut'])) {
            $data['shortcut'] = intval($data['shortcut']);
        }
        if (isset($data['ban_delete'])) {
            $data['ban_delete'] = intval($data['ban_delete']);
        }
        if (isset($data['ban_children'])) {
            $data['ban_children'] = intval($data['ban_children']);
        }
        if (isset($data['parent_id'])) {
            $data['parent_id'] = intval($data['parent_id']);
        }
        if (isset($data['model_id'])) {
            $data['model_id'] = intval($data['model_id']);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        $data = $this->validate($data, 'update');
        $data = $this->inputFilter($data);
        $data['update_time'] = date('Y-m-d H:i:s');

        return parent::update($data, $id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateStatus($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    public function copy($id)
    {
        $data = $this->find($id);
        $data = Helper::objectToArray($data);
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = date('Y-m-d H:i:s');
        $data['publish_time'] = date('Y-m-d H:i:s');
        $data['review'] = 0;
        $data['slug'] = '';
        foreach ($data['__data'] as $langId => $_data) {
            $data['__data'][$langId]['title'] = $_data['title'] . '[copy]';
        }

        $page = parent::create($data);

        $Model = new Model();
        $srcModel = $Model->findOne("type='page' AND content_id={$id} AND parent_id=0");
        if ($srcModel) {
            $destModel = $Model->create(
                [
                    'cname' => 'page-' . $page->id,
                    'group' => 'page',
                    'type' => 'page',
                    'content_id' => $page->id,
                ]
            );
            $Model->createDefaultModel($destModel['id']);
            $Field = new Field();
            $tabs = $Model->children($srcModel['id']);
            foreach ($tabs as $tab) {
                $fields = $Field->findAll("model_id={$tab['id']}");
                $destTab = $Model->findOne("parent_id={$destModel['id']} AND tab='{$tab['tab']}'");
                foreach ($fields as $field) {
                    $field['__data'] = Helper::objectToArray($field['__data']);
                    $Field->create(
                        [
                            'name' => $field['name'],
                            'type' => $field['type'],
                            'label' => $field['label'],
                            'default' => $field['default'],
                            'sort' => $field['sort'],
                            'parent_id' => $field['parent_id'],
                            'model_id' => $destTab['id'],
                            '__data' => $field['__data'],
                        ]
                    );
                }
            }
        }

        return $page;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateTitle($data, $id)
    {
        $data['update_time'] = date('Y-m-d H:i:s');
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateSlug($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     */
    public function setCache($data)
    {
        parent::cache(md5('page-' . $data['id']), $data);
    }

    public function updateAuthorizeUsers($id, $users)
    {
        $data = ['authorize_users' => json_encode($users)];

        return $this->update($data, $id);
    }
}
