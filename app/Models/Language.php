<?php

namespace Site\Models;

use Site\Exceptions\NormalException;
use Site\Helper;

/**
 * Class Language
 *
 * @package Admin\Models
 */
class Language extends \Site\Model
{
    public function __construct()
    {
        parent::__construct('language', 'id');
    }

    /**
     * @param $data
     *
     * @return int
     */
    public function create($data)
    {
        if (isset($data['key']) && $this->exists($data['key'])) {
            return true;
        }
        unset($data['id']);
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::create($data);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function exists($key)
    {
        return $this->findOne("`key`=:key", ['key' => $key]);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function validate($data)
    {
        if (!$data['key']) {
            throw new NormalException(Helper::_('Please enter 「Key」'));
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
        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return int
     */
    public function update($data, $id)
    {
        $row = $this->find($id);
        if (isset($data['key']) && $data['key'] != $row['key']) {
            if ($this->exists($data['key'])) {
                throw new NormalException(Helper::_('This key exists'));
            }
        }
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }
}
