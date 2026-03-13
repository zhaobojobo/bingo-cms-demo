<?php

namespace Admin\Models;

use Admin\Data;
use Admin\Helper;
use Admin\Profile;
use App\Exceptions\BannedException;

/**
 * Class Catalog
 *
 * @package Admin\Models
 */
class Catalog extends Base
{
    public $type;

    /**
     * Model constructor.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->idField = 'id';
        $this->table = 'catalog';
        $this->type = 'catalog';
        $this->data = new Data('catalog_data', 'catalog_id');
        $this->profile = new Profile('catalog_profile', 'catalog_id');
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
        if (isset($data['parent_id'])) {
            $data['parent_id'] = intval($data['parent_id']);
        }
        if (isset($data['model_id'])) {
            $data['model_id'] = intval($data['model_id']);
        }
        if (isset($data['content_model_id'])) {
            $data['content_model_id'] = intval($data['content_model_id']);
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

        return parent::update($data, $id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function root($id)
    {
        $catalog = $this->find($id);
        if (!$catalog['parent_id']) {
            return $catalog;
        } else {
            return $this->root($catalog['parent_id']);
        }
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function allCatIds($id)
    {
        $ids = [];
        $cat = $this->find($id);
        if ($cat) {
            $ids[] = $id;
            $list = $this->findAll("parent_id={$id}");
            foreach ($list as $item) {
                $children = $this->allCatIds($item['id']);
                if ($children) {
                    $ids = array_merge($ids, $children);
                }
            }
        }

        return $ids;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function children($id)
    {
        $children = [];


        return $children;
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function ancestors($id)
    {
        $ancestors = [];
        if ($parent = $this->parent($id)) {
            $ancestors[] = $parent;
            $ancestors = array_merge($ancestors, $this->ancestors($parent['id']));
        }

        return $ancestors;
    }

    /**
     * @param $id
     *
     * @return mixed|null
     */
    public function parent($id)
    {
        $find = $this->find($id);
        if ($find && $find['parent_id']) {
            return $this->find($find->parent_id);
        }

        return null;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateBanDelete($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $id
     */
    public function checkBanDelete($id)
    {
        $catalog = $this->find($id);
        if ($catalog) {
            if ($catalog['ban_delete']) {
                throw new BannedException(Helper::_('Operation has been disabled'));
            }
        }
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateBanChildren($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    public function updateSlug($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

}
