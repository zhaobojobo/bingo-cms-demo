<?php

namespace Admin\Models;

/**
 * Class Subscriber
 * @package Admin\Models
 */
class Subscriber extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'subscriber';
        $this->idField = 'id';
    }

    /**
     * @return array
     */
    public function emails($where = '', $params = [])
    {
        return $this->columns('email', $where, $params);
    }
}
