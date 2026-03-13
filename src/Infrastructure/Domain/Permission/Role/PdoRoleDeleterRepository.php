<?php

namespace App\Infrastructure\Domain\Permission\Role;

use PDO;
use App\Domain\Permission\Role\RoleDeleterRepository;

class PdoRoleDeleterRepository implements RoleDeleterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete($id): int
    {
        $sql = "DELETE FROM bgo_role WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        return (int)$sth->rowCount();
    }
}
