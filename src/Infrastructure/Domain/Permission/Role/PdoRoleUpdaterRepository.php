<?php

namespace App\Infrastructure\Domain\Permission\Role;

use PDO;
use App\Domain\Permission\Role\RoleUpdaterRepository;

class PdoRoleUpdaterRepository implements RoleUpdaterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(array $role): int
    {
        $row = [
            'name'      => $role['name'],
            'agency_id' => (int)$role['agency_id'],
            'pid'       => (int)$role['pid'],
            'id'        => (int)$role['id'],
        ];
        $sql = "UPDATE bgo_role SET
                name=:name,
                agency_id=:agency_id,
                pid=:pid
                WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
