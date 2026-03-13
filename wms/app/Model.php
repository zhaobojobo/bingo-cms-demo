<?php

namespace Admin;

use App\Query;
use App\Register;

/**
 * Class NewModel
 *
 * @package Admin
 */
class Model
{
    public $db;

    public $table;

    public $idField;

    public $c;

    public $query;

    /**
     * Model constructor.
     *
     */
    public function __construct()
    {
        $this->c     = Register::get('container');
        $this->db    = $this->c['db'];
        $this->query = new Query();
    }

    /**
     * @param $data
     *
     * @return int
     */
    public function create($data)
    {
        return $this->query->create($this->table, $data);
    }


    /**
     * @param $data
     * @param $id
     *
     * @return int
     */
    public function update($data, $id)
    {
        $field  = $this->idField;
        $where  = "{$field}=:{$field}";
        $params = [$field => $id];

        return $this->query->update($this->table, $data, $where, $params);
    }

    /**
     * @param       $data
     * @param       $where
     * @param array $params
     *
     * @return int
     */
    public function updateMore($data, $where, $params = [])
    {
        return $this->query->update($this->table, $data, $where, $params);
    }

    /**
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id)
    {
        $field  = $this->idField;
        $where  = "{$field}=:{$field}";
        $params = [$field => $id];

        return $this->query->delete($this->table, $where, $params);
    }

    /**
     * @param $where
     * @param $params
     *
     * @return int
     */
    public function deleteMore($where, $params = [])
    {
        return $this->query->delete($this->table, $where, $params);
    }

    /**
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return mixed
     */
    public function column($where = '', $params = [], $order = '')
    {
        return $this->query->column($this->table, $where, $params, $order);
    }

    /**
     * @param        $field
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function columns($field, $where = '', $params = [], $order = '')
    {
        return $this->query->columns($this->table, $field, 0, $where, $params, $order);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function find($id)
    {
        $field  = $this->idField;
        $where  = "{$field}=:{$field}";
        $params = [$field => $id];

        return $this->query->find($this->table, $where, $params);
    }

    /**
     * @param string $where
     * @param array  $params
     *
     * @return mixed
     */
    public function findOne($where = '', $params = [])
    {
        return $this->query->find($this->table, $where, $params);
    }

    /**
     * @param string $where
     * @param array  $params
     * @param string $order
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function findSome($where = '', $params = [], $order = '', $limit = 0, $offset = 0)
    {
        $order = $order ?: "{$this->idField} DESC";

        return $this->query->findSome($this->table, $where, $params, $order, $limit, $offset);
    }

    /**
     * @param int    $page
     * @param int    $size
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function findPage($page, $size, $where = '', $params = [], $order = SORT_ORDER_DESC)
    {
        $order = $order ?: "{$this->idField} DESC";

        return $this->query->findPage($this->table, $page, $size, $where, $params, $order);
    }


    /**
     * @param string $where
     * @param array  $params
     *
     * @return mixed
     */
    public function count($where = '', $params = [])
    {
        return $this->query->count($this->table, $where, $params);
    }

    /**
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function findAll($where = '', $params = [], $order = SORT_ORDER_DESC)
    {
        $order = $order ?: "{$this->idField} DESC";
        return $this->query->findAll($this->table, $where, $params, $order);
    }

    public function max($field, $where = '', $params = [])
    {
        return $this->query->max($this->table, $field, $where, $params);
    }
}
