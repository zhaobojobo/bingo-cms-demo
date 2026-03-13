<?php

namespace App\Domain\Slideshow;

use PDO;

class SlideReadRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAll($slideshow_id): array
    {
        $sql = "SELECT * FROM `bgo_slide` WHERE slideshow_id=:slideshow_id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute(['slideshow_id' => $slideshow_id]);
        $rows = $sth->fetchAll();

        return $rows;
    }
}
