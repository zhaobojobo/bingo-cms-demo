<?php

namespace Site\Models;

use Site\Data;
use Site\Exceptions\NormalException;
use Site\Helper;

/**
 * Class Model
 *
 * @package Admin\Models
 */
class Model extends Base
{
    public function __construct()
    {
        parent::__construct('model', 'id');
        $this->data            = new Data('model_data', 'model_id');
        $this->data->languages = $this->c['languages'];
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
     * @param $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        if (!$data['group']) {
            throw new NormalException(Helper::_('Please select 「Group」'));
        }
//        if ($data['id'] && !$data['parent_id']) {
//            throw new NormalException(Helper::_('Please select 「Parent」'));
//        }
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
     * @param $parent_id
     *
     * @return array
     */
    public function children($parent_id)
    {
        return $this->findAll("parent_id=:parent_id", ['parent_id' => $parent_id], 'id');
    }

    /**
     * @param $id
     */
    public function createDefaultModel($id)
    {
        $model = $this->find($id);
        if ($model['parent_id'] == 0) {
            $data = [
                [
                    'group'      => $model['group'],
                    'parent_id'  => $model['id'],
                    'tab'        => 'G',
                    'type'       => $model['type'],
                    'content_id' => $model['content_id'],
                    '__data'     => [
                        'en_us' => ['name' => 'General'],
                        'zh_hk' => ['name' => '通用'],
                        'zh_cn' => ['name' => '通用'],
                    ],
                ],
                [
                    'group'      => $model['group'],
                    'parent_id'  => $model['id'],
                    'tab'        => 'L',
                    'type'       => $model['type'],
                    'content_id' => $model['content_id'],
                    '__data'     => [
                        'en_us' => ['name' => 'Multi Language'],
                        'zh_hk' => ['name' => '多語言'],
                        'zh_cn' => ['name' => '多语言'],
                    ],
                ],
            ];
            foreach ($data as $item) {
                $this->create($item);
            }
        }
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
     * @param $group
     * @param $id
     *
     * @return array
     */
    public function models($group, $id)
    {
        $models = $this->findByGroup($group);
        if ($id) {
            $models = array_filter(
                $models,
                function ($v) use ($id) {
                    return $v['id'] == $id;
                }
            );
        }

        return $models;
    }

    /**
     * @param $group
     *
     * @return array
     */
    public function findByGroup($group)
    {
        return $this->findAll("`group`=:group AND parent_id=:parent_id", ['group' => $group, 'parent_id' => 0]);
    }
}
