<?php

namespace Admin\Models;

use Admin\Data;
use App\Exceptions\NormalException;
use Admin\Helper;

/**
 * Class Field
 *
 * @package Admin\Models
 */
class Field extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'field';
        $this->idField = 'id';
        $this->data = new Data('field_data', 'field_id');
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
     * @param $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        if (!$data['name']) {
            throw new NormalException(Helper::_('「Name is required」'));
        }
        if (!$data['type']) {
            throw new NormalException(Helper::_('Please select 「Type」'));
        }

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
     * @param $model_id
     *
     * @return array
     */
    public function fieldsName($model_id)
    {
        $fields = [];
        $list = $this->findAll("model_id={$model_id}");
        foreach ($list as $item) {
            $fields[] = $item['name'];
        }

        return $fields;
    }

    public function findAll($where = '', $params = [], $order = '')
    {
        $rows = self::toArray(parent::findAll($where, $params, $order));

        return $this->aggregateRows($rows);
    }

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
                $row['__data'] = $this->data->findWmsRows($row['id']);
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
}
