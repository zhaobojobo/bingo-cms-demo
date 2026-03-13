<?php

namespace App\Infrastructure\Domain\Permission\Agency;

use PDO;
use App\Domain\Permission\Agency\AgencyDeleterRepository;

class PdoAgencyDeleterRepository implements AgencyDeleterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete($id): int
    {
        $sql = "DELETE FROM bgo_agency WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        return (int)$sth->rowCount();
    }
}
