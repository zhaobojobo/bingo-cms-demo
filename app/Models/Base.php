<?php

namespace Site\Models;

use App\Register;
use Exception;
use LogicException;
use Site\DataObject;
use Site\Exceptions\NormalException;
use Site\Helper;
use Site\Model;

/**
 * Class Base
 *
 * @package Site\Models
 */
class Base extends Model
{
    public $data = null;

    public $profile = null;

    public $map = null;

    public $languages;

    public $contentType;

    public function __construct($table, $idField)
    {
        parent::__construct($table, $idField);
        $this->languages = $this->c['languages'];
    }

    /**
     * @param $rows
     *
     * @return array
     */
    public static function toArray($rows)
    {
        foreach ($rows as $i => $row) {
            $rows[$i] = Helper::objectToArray($row);
        }

        return $rows;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        try {
            unset($data[$this->idField]);
            $this->db->beginTransaction();

            if ($this->map && isset($data['catalogs_id'])) {
                $catalogs_id = $data['catalogs_id'];
                unset($data['catalogs_id']);
            }

            if ($this->profile && isset($data['__profile'])) {
                $__profile = $data['__profile'];
                unset($data['__profile']);
            }

            if ($this->data && isset($data['__data'])) {
                $__data = $data['__data'];
                unset($data['__data']);
            }

            $id = parent::create($data);

            if ($this->map && isset($catalogs_id)) {
                $this->map->save($catalogs_id, $id, $this->contentType);
            }

            if ($this->profile && isset($__profile)) {
                $this->profile->save($__profile, $id);
            }

            if ($this->data && isset($__data)) {
                $this->data->save($__data, $id);
            }

            $this->db->commit();

            return $this->find($id);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new NormalException($e->getMessage());
        }
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        try {
            unset($data[$this->idField]);
            $this->db->beginTransaction();

            if ($this->profile && isset($data['__profile'])) {
                $this->profile->save($data['__profile'], $id);
                unset($data['__profile']);
            }

            if ($this->data && isset($data['__data'])) {
                $this->data->save($data['__data'], $id);
                unset($data['__data']);
            }

            if ($this->map && isset($data['catalogs_id'])) {
                $this->map->save($data['catalogs_id'], $id, $this->contentType);
                unset($data['catalogs_id']);
            }

            if (!empty($data)) {
                parent::update($data, $id);
            }
            $this->db->commit();

            return $this->find($id);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new LogicException($e->getMessage());
        }
    }

    /**
     * @param      $id
     * @param bool $recursive
     *
     * @return mixed
     */
    public function remove($id, $recursive = false)
    {
        if ($recursive) {
            $children = $this->findAll("parent_id=:parent_id", ['parent_id' => $id]);
            if ($children) {
                foreach ($children as $child) {
                    $this->remove($child['id'], $recursive);
                }
            }
        }
        try {
            $this->db->beginTransaction();
            parent::delete($id);
            if ($this->data) {
                $this->data->delete($id);
            }
            if ($this->profile) {
                $this->profile->delete($id);
            }
            $this->db->commit();

            return true;
        } catch (Exception $e) {
            $this->db->rollBack();

            throw new LogicException($e->getMessage());
        }
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function validate($data)
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
        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function outputFilter($data)
    {
        return new DataObject($data);
    }

    /**
     * @param $rows
     *
     * @return mixed
     */
    public function aggregateRows($rows)
    {
        foreach ($rows as $i => $row) {
            $rows[$i] = $this->aggregateRow($row);
        }

        return $rows;
    }

    /**
     * @param array $row
     *
     * @return array|mixed
     */
    public function aggregateRow($row = [])
    {
        $c = Register::get('container');
        if ($row) {
            $row = array_merge($row, ['lang' => $c['currentLang']]);
            if ($this->data) {
                $data = $this->data->findRows($row['id'], $c['currentLang']);

                if (!empty($data['image'])) {
                    $image = $data['image'];
                } elseif (!empty($row['image'])) {
                    $image = $row['image'];
                } else {
                    $image = '';
                }

                $row = array_merge($row, $data);
                $row['image'] = $image;
            }
            if ($this->profile) {
                $profile = $this->profile->findRows($row['id'], $row['model_id'] ?? 0, $c['currentLang']);
                $row = array_merge($row, $profile);
            }
            if ($this->map) {
                $row['catalogs_id'] = $this->map->catalogsId($row['id'], $row['type']);
            }
            $row = $this->outputFilter($row);
        }

        return $row;
    }

    /**
     * @param int $page
     * @param int $size
     * @param string $where
     * @param array $params
     * @param string $sort
     *
     * @return array
     */
    public function findPage($page, $size, $where = '', $params = [], $sort = ''): array
    {
        $result = parent::findPage($page, $size, $where, $params, $sort);
        $result['rows'] = $this->aggregateRows($result['rows']);

        return $result;
    }

    public function findOne($where = '', $params = [])
    {
        $row = parent::findOne($where, $params);

        return $this->aggregateRow($row);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        $row = parent::find($id);

        return $this->aggregateRow($row);
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function findSlug($slug)
    {
        $row = parent::findOne("slug=:slug", ['slug' => $slug]);

        return $this->aggregateRow($row);
    }

    /**
     * @param string $where
     * @param array $params
     * @param string $order
     *
     * @return array
     */
    public function findAll($where = '', $params = [], $order = '')
    {
        $rows = parent::findAll($where, $params, $order);

        return $this->aggregateRows($rows);
    }

    public function findSome($where = '', $params = [], $order = '', $limit = 0, $offset = 0)
    {
        $rows = parent::findSome($where, $params, $order, $limit, $offset);

        return $this->aggregateRows($rows);
    }

    /**
     * @param array $sorts
     *
     * @return array
     */
    public function sort(array $sorts)
    {
        try {
            $this->db->beginTransaction();
            foreach ($sorts as $sort) {
                $id = $sort['id'];
                unset($sort['id']);
                parent::update($sort, $id);
            }
            $this->db->commit();

            return $sorts;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new LogicException($e->getMessage());
        }
    }

    /**
     * @param      $id
     * @param null $data
     *
     * @return false|int|mixed
     */
    public function cache($id, $data = null)
    {
        $cachePath = $this->c['config']['cache'];
        $filename = $cachePath . '/' . $id . '.json';
        if ($data === null) {
            return json_decode(file_get_contents($filename), true);
        } else {
            return file_put_contents($filename, json_encode($data));
        }
    }

    /**
     * @param array $row
     *
     * @return DataObject
     */
    public function init($row = [])
    {
        if ($this->data) {
            $row['__data'] = $this->data->findRows(0);
        }
        if ($this->profile) {
            $row['__profile'] = $this->profile->findRows(0, 0);
        }
        if ($this->map) {
            $row['catalogs_id'] = [];
        }

        return $this->outputFilter($row);
    }

    /**
     * @param $hid
     * @param $row
     *
     * @return array
     */
    public function history($hid, $row)
    {
        $history = (new History())->find($hid);
        if ($history) {
            $_SESSION['hid'] = $history['id'];
            $content = unserialize($history['content_data']);
            $row->__data = $content['__data'];
            $row->__profile = $content['__profile'];
        }

        return $row;
    }

    /**
     * @param $data
     * @param $type
     *
     * @return bool
     */
    public function saveHistory($data, $type)
    {
        $model = new History();

        return $model->append($data, $type);
    }
}
