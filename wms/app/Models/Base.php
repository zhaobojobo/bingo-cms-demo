<?php

namespace Admin\Models;

use Admin\DataObject;
use Admin\Helper;
use Admin\Model;
use App\Exceptions\NormalException;
use App\Setting;
use Exception;
use LogicException;

/**
 * Class Base
 *
 * @package Admin\Models
 */
class Base extends Model
{
    public $data = null;

    public $profile = null;

    public $map = null;

    public $languages;

    public $defaultLang;

    public $contentType;

    public function __construct()
    {
        parent::__construct();
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
     * @return mixed
     */
    public function validate($data)
    {
        return $data;
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
    public function findPage($page, $size, $where = '', $params = [], $sort = SORT_ORDER_DESC)
    {
        $result = parent::findPage($page, $size, $where, $params, $sort);
        $result['rows'] = $this->aggregateRows($result['rows']);

        return $result;
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
        if ($row) {
            if ($this->data) {
                $row['__data'] = $this->data->findRows($row['id']);
            }
            if ($this->profile) {
                $row['__profile'] = $this->profile->findRows($row['id'], $row['model_id'] ?? 0);
            }
            if ($this->map) {
                $row['cats'] = [];
                $row['catsId'] = [];
                $row['cats_id'] = $this->map->catalogsId($row['id'], $this->contentType);
                $catModel = new Catalog();
                foreach ($row['cats_id'] as $id) {
                    $cat = $catModel->find($id);
                    $row['catsId'][$cat['type']][] = $id;
                    $row['cats'][$cat['type']][] = $cat;
                }
            }
            $row = $this->outputFilter($row);
        }

        return $row;
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
     * @param $slug
     *
     * @return mixed
     */
    public function findSlug($slug)
    {
        return $this->findOne("slug='{$slug}'");
    }

    /**
     * @param $slug
     *
     * @return mixed
     */
    public function findOne($where = '', $params = [])
    {
        $row = parent::findOne($where, $params);

        return $this->aggregateRow($row);
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

            if ($this->map && isset($data['cats'])) {
                $cats = $data['cats'];
                unset($data['cats']);
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

            if ($this->map && isset($cats)) {
                foreach ($cats as $type => $_cats) {
                    if (is_array($_cats)) {
                        $_cats = array_filter(
                            $_cats,
                            function ($v) {
                                return $v;
                            }
                        );
                        $this->map->save($_cats, $id, $this->contentType, $type);
                    } else {
                        if ($_cats) {
                            $this->map->save([$_cats], $id, $this->contentType, $type);
                        }
                    }
                }
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
                $__profile = $data['__profile'];
                $this->profile->save($__profile, $id);
                unset($data['__profile']);
            }

            if ($this->data && isset($data['__data'])) {
                $this->data->save($data['__data'], $id);
                unset($data['__data']);
            }

            if ($this->map && isset($data['cats'])) {
                foreach ($data['cats'] as $type => $_cats) {
                    if (is_array($_cats)) {
                        $_cats = array_filter(
                            $_cats,
                            function ($v) {
                                return $v;
                            }
                        );
                        $this->map->save($_cats, $id, $this->contentType, $type);
                    } else {
                        if ($_cats) {
                            $this->map->save([$_cats], $id, $this->contentType, $type);
                        }
                    }
                }
                unset($data['cats']);
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
            $children = $this->findAll("parent_id={$id}");
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
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        return $data;
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
        $filename = $cachePath . '/' . $id . '.json';
        if ($data === null) {
            if (file_exists($filename)) {
                return json_decode(file_get_contents($filename), true);
            }

            return false;
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
}
