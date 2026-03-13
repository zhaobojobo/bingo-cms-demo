<?php

namespace App\Infrastructure\Domain\Permission\Agency;

use PDO;
use App\Domain\Permission\Agency\AgencyUpdaterRepository;

class PdoAgencyUpdaterRepository implements AgencyUpdaterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(array $agency): int
    {
        $row = [
            'name' => $agency['name'],
            'id'   => (int)$agency['id'],
        ];
        $sql = "UPDATE bgo_agency SET
                name=:name
                WHERE id=:id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
