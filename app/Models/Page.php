<?php

namespace Site\Models;

use Site\Data;
use Site\Profile;

/**
 * Class Page
 *
 * @package Site\Models
 */
class Page extends Base
{
    public function __construct()
    {
        parent::__construct('page', 'id');
        $this->data = new Data('page_data', 'page_id');
        $this->profile = new Profile('page_profile', 'page_id');
    }

    /**
     * @return array
     */
    public function shortcuts()
    {
        return $this->findAll('shortcut=1');
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
     * @param $data
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
        if (isset($data['slug'])) {
            if ($data['slug'] = strtolower($data['slug'])) {
                $exist = $this->findSlug($data['slug']);
                if ($exist && $exist['id'] != $data['id']) {
                    $data['slug'] = $data['slug'] . '-' . $data['id'];
                }
            }
        }
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


    public function children($id, $sort = 'sort, id'): array
    {
        return $this->findAll("parent_id=:parent_id", ['parent_id' => $id], $sort);
    }

    /**
     * @param $data
     */
    public function setCache($data)
    {
        parent::cache(md5('page-' . $data['id']), $data);
    }

    public function getCache($id)
    {
        $cache = parent::cache(md5('page-' . $id));
        if ($cache) {
            return \Site\Model::normalize($cache);
        }
        return false;
    }
}
