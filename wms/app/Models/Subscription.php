<?php

namespace Admin\Models;

/**
 * Class Subscription
 *
 * @package Admin\Models
 */
class Subscription extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'subscription';
        $this->idField = 'id';
//        $this->data = new Data('subscription_data', 'subscription_id');
//        $this->profile = new Profile('subscription_profile', 'subscription_id');
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data                = $this->validate($data);
        $data                = $this->inputFilter($data);
        $data['create_time'] = date('Y-m-d H:i:s');

        return parent::create($data);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        $row = $this->find($id);
        if (
            $row['title'] != $data['title']
            || $row['content'] != $data['content']
        ) {
            $data['review'] = 0;
        }
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateStatus($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }
}
