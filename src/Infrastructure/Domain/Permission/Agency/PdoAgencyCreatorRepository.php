<?php

namespace App\Infrastructure\Domain\Permission\Agency;

use PDO;
use App\Domain\Permission\Agency\AgencyCreatorRepository;

class PdoAgencyCreatorRepository implements AgencyCreatorRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $agency): int
    {
        $row = [
            'name' => $agency['name'],
        ];
        $sql = "INSERT INTO bgo_agency SET 
                name=:name";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$this->pdo->lastInsertId();
    }
}
