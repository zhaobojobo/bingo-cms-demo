<?php

namespace App\Infrastructure\Domain\Permission\Permission;

use PDO;
use App\Domain\Permission\Permission\PermissionUpdaterRepository;

class PdoPermissionUpdaterRepository implements PermissionUpdaterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(array $permission)
    {
        $row = [
            'status' => (int)$permission['status'],
            'id'     => (int)$permission['id'],
        ];
        $sql = "UPDATE bgo_permission SET
                status=:status
                WHERE id=:id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }

    public function statusOn(array $permission)
    {
        $row = [
            'status'    => 1,
            'access_id' => (int)$permission['access_id'],
            'role_id'   => (int)$permission['role_id'],
        ];
        $sql = "UPDATE bgo_permission SET
                status=:status
                WHERE role_id=:role_id AND access_id=:access_id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }

    public function statusOff(array $permission)
    {
        $row = [
            'status'    => 0,
            'access_id' => (int)$permission['access_id'],
            'role_id'   => (int)$permission['role_id'],
        ];
        $sql = "UPDATE bgo_permission SET
                status=:status
                WHERE role_id=:role_id AND access_id=:access_id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
