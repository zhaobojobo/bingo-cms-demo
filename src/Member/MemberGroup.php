<?php

namespace App\Member;

use Admin\Data;
use Admin\Models\Base;

/**
 * Class MemberGroup
 *
 * @package Admin\Models
 */
class MemberGroup extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'member_group';
        $this->idField = 'id';
        $this->data    = new Data('member_group_data', 'member_group_id');
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
