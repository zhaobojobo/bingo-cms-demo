<?php

namespace App\Infrastructure\Domain\Permission\Access;

use PDO;
use League\Flysystem\Exception;
use App\Domain\Permission\Access\AccessDeleterRepository;

class PdoAccessDeleterRepository implements AccessDeleterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function children($pid)
    {
        $params = ['pid' => $pid];
        $sql    = "SELECT * FROM bgo_access WHERE pid=:pid";
        $sth    = $this->pdo->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll();
    }

    public function clean()
    {
        $sql = "SELECT * FROM bgo_access";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll();

        foreach ($rows as $row) {
            if ($row['pid'] != 0) {
                $params = ['id' => $row['pid']];
                $sql    = "SELECT * FROM bgo_access WHERE id=:id";
                $sth    = $this->pdo->prepare($sql);
                $sth->execute($params);
                $parent = $sth->fetch();
                if (! $parent) {
                    $params = ['id' => $row['id']];
                    $sql    = "DELETE FROM bgo_access WHERE id=:id";
                    $sth    = $this->pdo->prepare($sql);
                    $sth->execute($params);
                }
            }
        }

        return (int)$sth->rowCount();
    }

    public function delete($id): int
    {
        $children = $this->children($id);
        if ($children) {
            foreach ($children as $child) {
                $this->delete($child['id']);
            }
        }

        $params = ['id' => $id];
        $sql    = "DELETE FROM bgo_access WHERE id=:id";
        $sth    = $this->pdo->prepare($sql);
        $sth->execute($params);

        return (int)$sth->rowCount();
    }
}
