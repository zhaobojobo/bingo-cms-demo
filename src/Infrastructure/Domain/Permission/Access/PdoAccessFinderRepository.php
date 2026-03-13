<?php

namespace App\Infrastructure\Domain\Permission\Access;

use PDO;
use App\Domain\Permission\Access\Access;
use App\Domain\Permission\Access\AccessFinderRepository;

class PdoAccessFinderRepository implements AccessFinderRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM bgo_access ORDER BY sort DESC, id DESC";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows     = $sth->fetchAll();
        $accesses = [];
        foreach ($rows as $row) {
            $accesses[] = new Access(
                $row['id'],
                $row['name'],
                $row['route'],
                $row['access_code'],
                $row['access_group'],
                $row['access_type'],
                $row['linkable'],
                $row['status'],
                $row['sort'],
                $row['pid']
            );
        }

        return $accesses;
    }

    public function findAllOfLinkable(): array
    {
        $sql = "SELECT * FROM bgo_access WHERE linkable=1 ORDER BY sort DESC, id DESC";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows     = $sth->fetchAll();
        $accesses = [];
        foreach ($rows as $row) {
            $accesses[] = new Access(
                $row['id'],
                $row['name'],
                $row['route'],
                $row['access_code'],
                $row['access_group'],
                $row['access_type'],
                $row['linkable'],
                $row['status'],
                $row['sort'],
                $row['pid']
            );
        }

        return $accesses;
    }

    public function findOneOfId(int $id): ?Access
    {
        $sql = "SELECT * FROM bgo_access WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        $access = null;
        if ($row = $sth->fetch()) {
            $access = new Access(
                $row['id'],
                $row['name'],
                $row['route'],
                $row['access_code'],
                $row['access_group'],
                $row['access_type'],
                $row['linkable'],
                $row['status'],
                $row['sort'],
                $row['pid']
            );
        }

        return $access;
    }

    public function findOneOfCode(string $accessCode): ?Access
    {
        $sql = "SELECT * FROM bgo_access WHERE access_code=:access_code";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['access_code' => $accessCode]);

        $access = null;
        if ($row = $sth->fetch()) {
            $access = new Access(
                $row['id'],
                $row['name'],
                $row['route'],
                $row['access_code'],
                $row['access_group'],
                $row['access_type'],
                $row['linkable'],
                $row['status'],
                $row['sort'],
                $row['pid']
            );
        }

        return $access;
    }
}
