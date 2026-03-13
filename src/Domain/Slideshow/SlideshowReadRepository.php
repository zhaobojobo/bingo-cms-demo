<?php

namespace App\Domain\Slideshow;

use PDO;

class SlideshowReadRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchAll(): array
    {
        $sql = "SELECT bgo_slideshow.* 
                FROM bgo_slideshow_id 
                LEFT JOIN bgo_slideshow ON bgo_slideshow_id.id=bgo_slideshow.id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll();

        return $rows;
    }

    public function fetch($id)
    {
        $sql = "SELECT bgo_slideshow.* 
                FROM bgo_slideshow_id 
                LEFT JOIN bgo_slideshow ON bgo_slideshow_id.id=bgo_slideshow.id 
                WHERE bgo_slideshow.id=:id";

        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);
        $row = $sth->fetch();

        return $row;
    }

    public function fetchBySlug($slug)
    {
        $sql = "SELECT bgo_slideshow.* 
                FROM bgo_slideshow_id 
                LEFT JOIN bgo_slideshow ON bgo_slideshow_id.id=bgo_slideshow.id 
                WHERE bgo_slideshow.slug=:slug";

        $sth = $this->pdo->prepare($sql);
        $sth->execute(['slug' => $slug]);
        $row = $sth->fetch();

        return $row;
    }
}
