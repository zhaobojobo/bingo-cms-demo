<?php

namespace App;

use App\Exceptions\NormalException;
use App\Exceptions\QueryException;
use PDO;

/**
 * Class Query
 *
 * @package Admin
 */
class Query
{
    protected $db;

    protected $c;

    public function __construct()
    {
        $this->c  = Register::get('container');
        $this->db = $this->c['db'];
    }

    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param $table
     * @param $data
     *
     * @return int
     */
    public function create($table, $data)
    {
        $params = SQL::params($data);
        $sql    = SQL::getInstance()->table($table)->insert($data);
        $this->db->query($sql, $params);

        return $this->db->pdo->lastInsertId();
    }

    /**
     *
     * @param        $table
     * @param        $data
     * @param string $where
     * @param array  $params
     *
     * @return int
     */
    public function update($table, $data, $where = '', $params = [])
    {
        $params = array_merge(SQL::params($data), SQL::params($params, $where));

        $sql  = SQL::getInstance()->table($table)->where($where)->update($data);
        $stmt = $this->db->query($sql, $params);

        return $stmt->rowCount();
    }

    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     *
     * @return int
     */
    public function delete($table, $where = '', $params = [])
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->delete();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->rowCount();
    }


    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     *
     * @return mixed
     */
    public function find($table, $where = '', $params = [])
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function findAll($table, $where = '', $params = [], $order = '')
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->order($order)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     * @param string $order
     * @param int    $limit
     * @param int    $offset
     *
     * @return array
     */
    public function findSome(
        $table,
        $where = '',
        $params = [],
        $order = '',
        $limit = 0,
        $offset = 0
    ) {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->order($order)->limit($limit)->offset($offset)->find(
        );
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return mixed
     */
    public function column(
        $table,
        $where = '',
        $params = [],
        $order = ''
    ) {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->order($order)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchColumn();
    }

    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     * @param string $order
     *
     * @return array
     */
    public function columns(
        $table,
        $fields = '*',
        $cn = 0,
        $where = '',
        $params = [],
        $order = ''
    ) {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->fields($fields)->where($where)->order($order)->find();
        $stmt   = $this->db->query($sql, $params);

        $columns = [];
        while ($column = $stmt->fetchColumn($cn)) {
            $columns[] = $column;
        }

        return $columns;
    }

    /**
     * @param     $table
     * @param int $page
     * @param int $size
     * @param     $where
     * @param     $params
     * @param     $order
     *
     * @return array
     */
    public function findPage(
        $table,
        int $page,
        int $size,
        $where,
        $params,
        $order
    ) {
        $total      = $this->count($table, $where, $params);
        $totalPages = ceil($total / $size);

        if (! $total > 0) {
            return [
                'rows'       => [],
                'page'       => 1,
                'size'       => $size,
                'total'      => 0,
                'totalPages' => 0,
            ];
        }

        if ($page < 1) {
            throw new QueryException(sprintf('Page Numbers must be integers greater than 1'));
        }
        if ($size < 0) {
            throw new QueryException(sprintf('Page size must be an integer greater than 0'));
        }
        if ($page > $totalPages) {
            throw new NormalException(sprintf('No data'));
        }

        $offset   = ($page - 1) * $size;
        $startRow = $offset;
        $endRow   = $offset + ($size - 1);
        if ($page == $totalPages) {
            $endRow = $total - 1;
        }

        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->where($where)->order($order)->limit($size)->offset($offset)->find(
        );
        $stmt   = $this->db->query($sql, $params);
        $rows   = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'rows'       => $rows,
            'page'       => $page,
            'size'       => $size,
            'total'      => $total,
            'totalPages' => $totalPages,
            'startRow'   => $startRow,
            'endRow'     => $endRow,
        ];
    }

    /**
     * @param        $table
     * @param string $where
     * @param array  $params
     *
     * @return mixed
     */
    public function count($table, $where = '', $params = [])
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->fields('COUNT(*)')->where($where)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchColumn();
    }

    /**
     * @param        $table
     * @param        $field
     * @param string $where
     * @param array  $params
     *
     * @return mixed
     */
    public function sum($table, $field, $where = '', $params = [])
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->fields("SUM({$field})")->where($where)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchColumn();
    }

    public function max($table, $field, $where = '', $params = [])
    {
        $params = SQL::params($params, $where);
        $sql    = SQL::getInstance()->table($table)->fields("MAX({$field})")->where($where)->find();
        $stmt   = $this->db->query($sql, $params);

        return $stmt->fetchColumn();
    }
}
