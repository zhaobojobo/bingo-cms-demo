<?php

namespace Site\Models;

use Site\Model;
use PDO;

/**
 * Class File
 * @package Site\Models
 */
class File extends Model
{
    public function __construct()
    {
        parent::__construct('file', 'id');
        $this->hasMain = true;
    }

    /**
     * @param $hash
     * @return mixed
     */
    public function findByHash($hash)
    {
        $sql = "SELECT * FROM {$this->table} WHERE hash=?";
        $stmt = $this->db->query($sql, [$hash]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validate($data, $scenes = 'all')
    {
        return $data;
    }
}
