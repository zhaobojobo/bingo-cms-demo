<?php

namespace App\Infrastructure\Domain\Permission\Permission;

use PDO;
use App\Domain\Permission\Permission\Permission;
use App\Domain\Permission\Permission\PermissionFinderRepository;

class PdoPermissionFinderRepository implements PermissionFinderRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM bgo_permission";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows        = $sth->fetchAll();
        $permissions = [];
        foreach ($rows as $row) {
            $permissions[] = new Permission(
                $row['id'], $row['role_id'], $row['access_id'], $row['status']
            );
        }

        return $permissions;
    }

    public function findOneOfId(int $id)
    {
        $sql = "SELECT * FROM bgo_permission WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);
        if ($row = $sth->fetch()) {
            return new Permission($row['id'], $row['role_id'], $row['access_id'], $row['status']);
        }

        return null;
    }

    public function findOneOfAccess(int $access_id, int $role_id)
    {
        $sql = "SELECT * FROM bgo_permission WHERE role_id=:role_id AND access_id=:access_id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['role_id' => $role_id, 'access_id' => $access_id]);
        if ($row = $sth->fetch()) {
            return new Permission($row['id'], $row['role_id'], $row['access_id'], $row['status']);
        }

        return null;
    }
}
