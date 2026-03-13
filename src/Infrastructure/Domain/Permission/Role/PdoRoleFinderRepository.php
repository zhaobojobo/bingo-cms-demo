<?php

namespace App\Infrastructure\Domain\Permission\Role;

use PDO;
use App\Domain\Permission\Role\Role;
use App\Domain\Permission\Role\RoleFinderRepository;

class PdoRoleFinderRepository implements RoleFinderRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM bgo_role";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $roles = [];
        foreach ($sth->fetchAll() as $row) {
            $roles[$row['id']] = new Role(
                $row['id'], $row['name'], $row['status'], $row['sort'], $row['agency_id'], $row['pid']
            );
        }

        return $roles;
    }

    public function findOneOfId(int $id): ?Role
    {
        $sql = "SELECT * FROM bgo_role WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        $role = null;
        if ($row = $sth->fetch()) {
            $role = new Role($row['id'], $row['name'], $row['status'], $row['sort'], $row['agency_id'], $row['pid']);
        }

        return $role;
    }

    public function findChildren(int $id): array
    {
        $sql = "SELECT * FROM bgo_role WHERE pid=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);
        $roles = [];
        foreach ($sth->fetchAll() as $row) {
            $roles[$row['id']] = new Role(
                $row['id'], $row['name'], $row['status'], $row['sort'], $row['agency_id'], $row['pid']
            );
        }

        return $roles;
    }
}
