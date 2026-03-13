<?php

namespace App\Infrastructure\Domain\Permission\Role;

use PDO;
use App\Domain\Permission\Role\RoleCreatorRepository;

class PdoRoleCreatorRepository implements RoleCreatorRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $role): int
    {
        $row = [
            'name'      => $role['name'],
            'agency_id' => intval($role['agency_id']),
            'pid'       => intval($role['pid']),
        ];
        $sql = "INSERT INTO bgo_role SET name=:name, agency_id=:agency_id, pid=:pid";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$this->pdo->lastInsertId();
    }
}
