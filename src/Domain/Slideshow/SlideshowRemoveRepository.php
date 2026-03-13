<?php

namespace App\Domain\Slideshow;

use PDO;
use PDOException;

class SlideshowRemoveRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete($id)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "DELETE FROM bgo_slideshow WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $id]);

            $sql = "DELETE FROM bgo_slideshow_id WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $id]);

            $count = $sth->rowCount();
            $this->pdo->commit();

            return $count;
        } catch (PDOException $exception) {
            $this->pdo->rollBack();

            return false;
        }
    }
}
