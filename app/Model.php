<?php

namespace Site;

use App\Query;
use App\Register;
use Pimple\Container;

/**
 * Class NewModel
 *
 * @package Site
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
    public function __construct($table, $idField)
    {
        $this->c       = Register::get('container');
        $this->db      = $this->c['db'];
        $this->query   = new Query();
        $this->table   = $table;
        $this->idField = $idField;
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
    public function findPage($page, $size, $where = '', $params = [], $order = '')
    {
        $order = $order ?: "sort DESC, {$this->idField} DESC";

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
    public function findAll($where = '', $params = [], $order = '')
    {
        $order = $order ?: "{$this->idField} DESC";

        return $this->query->findAll($this->table, $where, $params, $order);
    }

    protected static function normalize($data)
    {
        if ($data) {
            $c      = Register::get('container');
            $langId = $c['currentLang'];
            if (isset($data['__data'])) {
                $langData = $data['__data'][$langId];
                unset($data['__data']);
                foreach ($langData as $key => $item) {
                    if (array_key_exists($key, $data) && ! $item) {
                        unset($langData[$key]);
                    }
                }
                if (is_array($langData)) {
                    $data = array_merge($data, $langData);
                }
            }

            if (isset($data['__profile'])) {
                $allProfile  = $data['__profile']['all'] ?? [];
                $langProfile = $data['__profile'][$langId] ?? [];
                unset($data['__profile']);
                foreach ($allProfile as $key => $item) {
                    if (array_key_exists($key, $data) && ! $item) {
                        unset($allProfile[$key]);
                    }
                }
                if (is_array($allProfile)) {
                    $data = array_merge($data, $allProfile);
                }

                if (is_array($langProfile)) {
                    foreach ($langProfile as $key => $item) {
                        if (array_key_exists($key, $data) && ! $item) {
                            unset($langProfile[$key]);
                        }
                    }
                    $data = array_merge($data, $langProfile);
                }
            }

            return new DataObject($data);
        }

        return null;
    }

    /**
     * @param      $id
     * @param null $data
     *
     * @return false|int|mixed
     */
    public function cache($id, $data = null)
    {
        $cachePath = $this->c['config']['site']['cache'];
        $filename  = $cachePath . '/' . $id . '.json';
        if ($data === null) {
            return json_decode(file_get_contents($filename), true);
        } else {
            return file_put_contents($filename, json_encode($data));
        }
    }
}
