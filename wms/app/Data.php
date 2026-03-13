<?php

namespace Admin;

use App\Query;
use App\Register;
use App\Setting;

/**
 * Class NewModel
 *
 * @package Admin
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
        $this->c = Register::get('container');
        $this->db = $this->c['db'];
        $this->query = new Query();
        $this->table = $table;
        $this->idField = $idField;
    }

    /**
     * @param $data
     * @param $id
     */
    public function save($data, $id = 0)
    {
        foreach ($data as $langId => $_data) {
            $_data = Helper::cleanFroala($_data);
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
        if (!$this->exists($id, $lang)) {
            $data = array_merge($data, ['lang' => $lang, $this->idField => $id]);

            return $this->query->create($this->table, $data);
        }
        $where = "{$this->idField}=$id AND lang='{$lang}'";

        return $this->query->update($this->table, $data, $where);
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
        $field = $this->idField;
        $where = "{$field}=:{$field}";
        $params = ["$field" => $id];

        if ($lang) {
            $where .= " AND lang=:lang";
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
        $field = $this->idField;
        $where = "{$field}=:{$field}";
        $params = [$field => $id];

        if ($lang) {
            $where .= " AND lang=:lang";
            $params = array_merge($params, ['lang' => $lang]);
        }

        return $this->query->delete($this->table, $where, $params);
    }

    /**
     * @param $id
     */
    public function findRows($id)
    {
        $rows = [];
        foreach (LANGUAGES as $langId => $language) {
            $row = [];
            if ($find = $this->find($id, $langId)) {
                unset($find['lang']);
                unset($find[$this->idField]);
                $row = $find;
            }
            $rows[$langId] = new DataObject($row);
        }

        return $rows;
    }

    public function findWmsRows($id)
    {
        $rows = [];
        foreach (LANGUAGES as $langId => $label) {
            $row = [];
            if ($find = $this->find($id, $langId)) {
                unset($find['lang']);
                unset($find[$this->idField]);
                $row = $find;
            }
            $rows[$langId] = new DataObject($row);
        }

        return $rows;
    }

    /**
     * @param $key
     *
     * @return array
     */
    public function search($lang, $key, $order = '')
    {
        $keys = $this->getKeys($key);
        $where = '';
        $params = [];

        $allWhere = [];
        if (!empty($keys)) {
            $titleWhere = [];
            foreach ($keys as $key) {
                if ($this->checkStr($key) == 1) {
                    $titleWhere[] = "title LIKE '%{$key}%'";
                } else {
                    $_keys = $this->ch2arr($key);
                    foreach ($_keys as $_key) {
                        $titleWhere[] = "title LIKE '%{$_key}%'";
                    }
                }
            }

            if ($titleWhere) {
                $allWhere[] = implode(' AND ', $titleWhere);
            }

            $summaryWhere = [];
            foreach ($keys as $key) {
                if ($this->checkStr($key) == 1) {
                    $summaryWhere[] = "summary LIKE '%{$key}%'";
                } else {
                    $_keys = $this->ch2arr($key);
                    foreach ($_keys as $_key) {
                        $summaryWhere[] = "summary LIKE '%{$_key}%'";
                    }
                }
            }

            if ($summaryWhere) {
                $allWhere[] = implode(' AND ', $summaryWhere);
            }

            $contentWhere = [];
            foreach ($keys as $key) {
                if ($this->checkStr($key) == 1) {
                    $contentWhere[] = "content LIKE '%{$key}%'";
                } else {
                    $_keys = $this->ch2arr($key);
                    foreach ($_keys as $_key) {
                        $contentWhere[] = "content LIKE '%{$_key}%'";
                    }
                }
            }

            if ($contentWhere) {
                $allWhere[] = implode(' AND ', $contentWhere);
            }
        }

        if ($allWhere) {
            $where = implode(' OR ', $allWhere);
        }

        return $this->query->columns($this->table, $this->idField, 0, $where, $params, $order);
    }

    public function checkStr($key)
    {
        $len = strlen($key);
        $len2 = mb_strlen($key);
        if ($len == $len2) {
            return 1;
        } elseif ($len % $len2) {
            return 2;
        } else {
            return 3;
        }
    }

    public function ch2arr($str)
    {
        $length = mb_strlen($str, 'utf-8');
        $array = [];
        for ($i = 0; $i < $length; $i++) {
            $array[] = mb_substr($str, $i, 1, 'utf-8');
        }

        return $array;
    }

    public function getKeys($key)
    {
        $keys = explode(' ', trim($key));
        $keys = array_filter(
            $keys,
            function ($v) {
                return trim($v);
            }
        );

        return $keys;
    }

}
