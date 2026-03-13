<?php

namespace Admin;

use Admin\Models\Field;
use App\Query;
use App\Register;

/**
 * Class NewModel
 *
 * @package Admin
 */
class Profile
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
        $data = $this->parallel($data);
        foreach ($data as $langId => $_data) {
            $_data = Helper::cleanFroala($_data);
            $this->_save($_data['profile_value'], $_data['profile_key'], $_data['lang'], $id);
        }
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function parallel($data)
    {
        $rows = [];
        foreach ($data as $langId => $_data) {
            $lang = null;
            if ($langId == 'all') {
                $lang = '';
            } elseif (array_key_exists($langId, LANGUAGES)) {
                $lang = $langId;
            }
            if (!is_null($lang)) {
                foreach ($_data as $key => $value) {
                    $rows[] = ['lang' => $lang, 'profile_key' => $key, 'profile_value' => $value];
                }
            }
        }

        return $rows;
    }

    /**
     * @param $profile_value
     * @param $profile_key
     * @param $lang
     * @param $id
     *
     * @return int
     */
    private function _save($profile_value, $profile_key, $lang, $id)
    {
        $find = $this->exists($id, $lang, $profile_key);
        if ($find) {
            $data = ['profile_value' => $profile_value];
            $where = "{$this->idField}=:{$this->idField} AND lang=:lang AND profile_key=:profile_key";
            $params = [$this->idField => $id, 'lang' => $lang, 'profile_key' => $profile_key,];

            return $this->query->update($this->table, $data, $where, $params);
        }

        $data = $data = [
            'profile_value' => $profile_value,
            'profile_key' => $profile_key,
            'lang' => $lang,
            $this->idField => $id,
        ];

        return $this->query->create($this->table, $data);
    }

    /**
     * @param $id
     * @param $lang
     * @param $profile_key
     *
     * @return mixed
     */
    public function exists($id, $lang, $profile_key)
    {
        $where = "{$this->idField}=:{$this->idField} AND lang=:lang AND profile_key=:profile_key";
        $params = [$this->idField => $id, 'lang' => $lang, 'profile_key' => $profile_key];

        return $this->query->find($this->table, $where, $params);
    }

    /**
     *
     * @param        $id
     *
     * @param string $lang
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
     * @param     $id
     * @param int $model_id
     *
     * @return array
     */
    public function findRows($id, $model_id = 0)
    {
        $rows = [];
        $rows['all'] = $this->findLang($id, '', $model_id);
        foreach (LANGUAGES as $langId => $language) {
            $rows[$langId] = $this->findLang($id, $langId, $model_id);
        }

        return $rows;
    }


    /**
     * @param     $id
     * @param     $lang
     * @param int $model_id
     *
     * @return array
     */
    public function findLang($id, $lang, $model_id = 0)
    {
        $field = $this->idField;
        $where = "{$field}=:{$field} AND lang=:lang";
        $params = [$field => $id, 'lang' => $lang];
        $profiles = $this->query->findAll($this->table, $where, $params);
        $row = $this->serial($profiles, $this->fields($model_id));

        // return new DataObject($row);
        return $row;
    }

    /**
     * @param $profiles
     * @param $fields
     *
     * @return array
     */
    private function serial($profiles, $fields)
    {
        $row = [];
        foreach ($profiles as $profile) {
            if (empty($fields) || in_array($profile['profile_key'], $fields)) {
                $row[$profile['profile_key']] = $profile['profile_value'];
            }
        }

        return $row;
    }

    /**
     * @param $model_id
     *
     * @return array
     */
    public function fields($model_id = 0)
    {
        $fields = [];
        if ($model_id) {
            $models = (new \Admin\Models\Model())->children($model_id);
            foreach ($models as $model) {
                $field = new Field();
                $fields = array_merge($fields, $field->fieldsName($model['id']));
            }
        }

        return $fields;
    }
}
