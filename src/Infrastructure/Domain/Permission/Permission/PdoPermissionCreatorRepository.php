<?php

namespace App\Infrastructure\Domain\Permission\Permission;

use PDO;
use App\Domain\Permission\Permission\PermissionCreatorRepository;

class PdoPermissionCreatorRepository implements PermissionCreatorRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $permission)
    {
        $row = [
            'role_id'   => (int)$permission['role_id'],
            'access_id' => (int)$permission['access_id'],
            'status'    => (int)$permission['status'],
        ];
        $sql = "INSERT INTO bgo_permission SET 
                role_id=:role_id, 
                access_id=:access_id, 
                status=:status";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$this->pdo->lastInsertId();
    }
}
