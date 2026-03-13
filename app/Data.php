<?php

namespace Site;

use App\Query;
use App\Register;
use Pimple\Container;

/**
 * Class Data
 *
 * @package Site
 */
class Data
{
    public $db;

    public $table;

    public $idField;

    public $c;

    public $query;

    public $languages;

    /**
     * Model constructor.
     *
     * @param string $table
     * @param string $idField
     */
    public function __construct($table, $idField)
    {
        $this->c         = Register::get('container');
        $this->db        = $this->c['db'];
        $this->query     = new Query();
        $this->table     = $table;
        $this->idField   = $idField;
        $this->languages = $this->c['languages'];
    }

    /**
     * @param $data
     * @param $id
     */
    public function save($data, $id = 0)
    {
        foreach ($data as $langId => $_data) {
            $this->_save($_data, $id, $langId);
        }
    }

    /**
     * @param $data
     *
     * @return int
     */
    private function _save($data, $id, $lang)
    {
        if (! $this->exists($id, $lang)) {
            $data = array_merge($data, ['lang' => $lang, $this->idField => $id]);

            return $this->query->create($this->table, $data);
        }
        $where  = "{$this->idField}=:{$this->idField} AND lang=':lang";
        $params = [$this->idField => $id, 'lang' => $lang];

        return $this->query->update($this->table, $data, $where, $params);
    }

    /**
     * @param $id
     * @param $lang
     *
     * @return array
     */
    public function exists($id, $lang)
    {
        return $this->find($id, $lang);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function find($id, $lang = '')
    {
        $field  = $this->idField;
        $where  = "{$field}=:{$field}";
        $params = ["$field" => $id];

        if ($lang) {
            $where  .= " AND lang=:lang";
            $params = array_merge($params, ['lang' => $lang]);

            return $this->query->find($this->table, $where, $params);
        }

        return $this->query->findAll($this->table, $where, $params);
    }

    /**
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id, $lang = '')
    {
        $field  = $this->idField;
        $where  = "{$field}=:{$field}";
        $params = [$field => $id];

        if ($lang) {
            $where  .= " AND lang=:lang";
            $params = array_merge($params, ['lang' => $lang]);
        }

        return $this->query->delete($this->table, $where, $params);
    }

    /**
     * @param $id
     */
    public function findRows($id, $lang = null)
    {
        $rows = [];
        foreach ($this->languages as $langId => $language) {
            $row = [];
            if ($find = $this->find($id, $langId)) {
                unset($find['lang']);
                unset($find[$this->idField]);
                $row = $find;
            }
            // $rows[$langId] = new DataObject($row);
            $rows[$langId] = $row;
        }

        if (isset($rows[$lang])) {
            return $rows[$lang];
        }

        return $rows;
    }
}
