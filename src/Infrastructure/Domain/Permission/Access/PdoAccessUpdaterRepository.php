<?php

namespace App\Infrastructure\Domain\Permission\Access;

use PDO;
use App\Domain\Permission\Access\AccessUpdaterRepository;

class PdoAccessUpdaterRepository implements AccessUpdaterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(array $access): int
    {
        $params = [
            'name'         => $access['name'],
            'route'        => strtolower($access['route']),
            'access_code'  => strtolower($access['access_code']),
            'access_group' => strtolower($access['access_group']),
            'access_type'  => (int)$access['access_type'],
            'linkable'     => (int)$access['linkable'],
            'pid'          => (int)$access['pid'],
            'id'           => (int)$access['id'],
        ];
        $sql    = "UPDATE bgo_access SET
                name=:name, 
                route=:route, 
                access_code=:access_code, 
                access_group=:access_group, 
                access_type=:access_type, 
                linkable=:linkable, 
                pid=:pid
                WHERE id=:id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        return (int)$sth->rowCount();
    }

    public function sorts(array $sorts): int
    {
        if (! $sorts) {
            return 0;
        }
        $params = [];
        $cases  = [];
        foreach ($sorts as $id => $sort) {
            $params[] = $id;
            $params[] = $sort;
            $cases[]  = 'WHEN ? THEN ?';
        }
        $cases  = implode(' ', $cases);
        $ids    = array_keys($sorts);
        $params = array_merge($params, $ids);
        $ins    = implode(',', array_fill(0, count($ids), '?'));
        $sql    = "UPDATE bgo_access SET
                sort = CASE id {$cases} END
                WHERE id IN ({$ins})";

        $sth = $this->pdo->prepare($sql);
        $sth->execute($params);

        return (int)$sth->rowCount();
    }
}
