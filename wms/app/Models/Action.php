<?php

namespace Admin\Models;

use App\SQL;
use PDOStatement;

/**
 * Class Action
 *
 * @package Admin\Models
 */
class Action extends \Admin\Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'action';
        $this->idField = 'id';
    }

    /**
     * @param $n
     * @return bool|PDOStatement
     */
    public function some($n)
    {
        $sql = SQL::getInstance()
            ->table($this->table)
            ->order('time DESC')
            ->limit($n)
            ->find();

        return $this->db->query($sql, []);
    }
}
