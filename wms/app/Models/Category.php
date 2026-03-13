<?php

namespace Admin\Models;

/**
 * Class Category
 *
 * @package Admin\Models
 */
class Category extends Catalog
{
    /**
     * Model constructor.
     *
     * @param $cType
     */
    public function __construct()
    {
        parent::__construct();
        $this->type = 'category';
    }

    /**
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function findAll($where = '', $params = [], $order = '')
    {
        $_where = "type='{$this->type}'";
        if ($where) {
            $_where = $where . ' AND ' . $_where;
        }

        return parent::findAll($_where, $params, $order);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data         = $this->validate($data, 'create');
        $data         = $this->inputFilter($data);
        $data['type'] = $this->type;

        return parent::create($data);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateTitle($data, $id)
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
    public function updateSlug($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }
}
