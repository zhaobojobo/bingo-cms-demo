<?php

namespace Admin\Models;

use Admin\Data;

/**
 * Class MemberGroup
 *
 * @package Admin\Models
 */
class SubscriberGroup extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'subscriber_group';
        $this->idField = 'id';
        $this->data    = new Data('subscriber_group_data', 'subscriber_group_id');
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
}
