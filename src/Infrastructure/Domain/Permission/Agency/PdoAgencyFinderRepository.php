<?php

namespace App\Infrastructure\Domain\Permission\Agency;

use PDO;
use App\Domain\Permission\Agency\Agency;
use App\Domain\Permission\Agency\AgencyFinderRepository;

class PdoAgencyFinderRepository implements AgencyFinderRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM bgo_agency";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows     = $sth->fetchAll();
        $agencies = [];
        foreach ($rows as $row) {
            $agencies[] = new Agency(
                $row['id'], $row['name'], $row['status'], $row['sort'], $row['pid']
            );
        }

        return $agencies;
    }

    public function findOneOfId(int $id): ?Agency
    {
        $sql = "SELECT * FROM bgo_agency WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        $agency = null;
        if ($row = $sth->fetch()) {
            $agency = new Agency($row['id'], $row['name'], $row['status'], $row['sort'], $row['pid']);
        }

        return $agency;
    }
}
