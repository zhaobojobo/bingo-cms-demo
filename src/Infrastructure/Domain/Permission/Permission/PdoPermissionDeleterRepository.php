<?php

namespace App\Infrastructure\Domain\Permission\Permission;

use PDO;
use App\Domain\Permission\Permission\PermissionDeleterRepository;

class PdoPermissionDeleterRepository implements PermissionDeleterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM bgo_permission WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        return (int)$sth->rowCount();
    }
}
