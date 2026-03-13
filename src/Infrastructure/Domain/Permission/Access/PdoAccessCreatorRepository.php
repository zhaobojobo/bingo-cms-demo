<?php

namespace App\Infrastructure\Domain\Permission\Access;

use PDO;
use App\Domain\Permission\Access\AccessCreatorRepository;

class PdoAccessCreatorRepository implements AccessCreatorRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $access): int
    {
        $params = [
            'name'         => $access['name'],
            'route'        => strtolower($access['route']),
            'access_code'  => strtolower($access['access_code']),
            'access_group' => strtolower($access['access_group']),
            'access_type'  => (int)$access['access_type'],
            'linkable'     => (int)$access['linkable'],
            'pid'          => (int)$access['pid'],
        ];
        $sql    = "INSERT INTO bgo_access SET 
                name=:name, 
                route=:route, 
                access_code=:access_code, 
                access_group=:access_group, 
                access_type=:access_type, 
                linkable=:linkable, 
                pid=:pid";
        $sth    = $this->pdo->prepare($sql);
        $sth->execute($params);

        return (int)$this->pdo->lastInsertId();
    }
}
