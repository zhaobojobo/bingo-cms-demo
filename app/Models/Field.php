<?php

namespace Site\Models;

use Site\Data;
use Site\Exceptions\NormalException;
use Site\Helper;

/**
 * Class Field
 *
 * @package Site\Models
 */
class Field extends Base
{


    public function __construct()
    {
        parent::__construct('field', 'id');
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
        $list   = $this->findAll("model_id=:model_id", ['model_id' => $model_id]);
        foreach ($list as $item) {
            $fields[] = $item['name'];
        }

        return $fields;
    }
}
