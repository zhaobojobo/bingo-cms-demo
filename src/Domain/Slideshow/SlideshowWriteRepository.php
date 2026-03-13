<?php

namespace App\Domain\Slideshow;

use PDO;
use PDOException;

class SlideshowWriteRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $slideshow): int
    {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO bgo_slideshow_id SET id=:id";
            $this->pdo->prepare($sql)->execute(['id' => null]);
            $id = $this->pdo->lastInsertId();

            $row = [
                'id'          => $id,
                'lang'        => $slideshow['lang'],
                'slug'        => $slideshow['slug'],
                'name'        => $slideshow['name'],
                'create_time' => $slideshow['create_time'],
                'update_time' => $slideshow['update_time'],
                'review'      => $slideshow['review'],
            ];
            $sql = "INSERT INTO bgo_slideshow SET
                    id=:id,
                    lang=:lang,
                    slug=:slug,
                    name=:name,
                    create_time=:create_time,
                    update_time=:update_time,
                    review=:review;
                    ";
            $this->pdo->prepare($sql)->execute($row);
            $this->pdo->commit();

            return (int)$id;
        } catch (PDOException $exception) {
            $this->pdo->rollBack();

            return false;
        }
    }

    public function update(array $slideshow): int
    {
        $row = [
            'slug'        => $slideshow['slug'],
            'name'        => $slideshow['name'],
            'update_time' => $slideshow['update_time'],
            'review'      => $slideshow['review'],
            'id'          => $slideshow['id'],
        ];
        $sql = "UPDATE bgo_slideshow SET
                    slug=:slug,
                    name=:name,
                    update_time=:update_time,
                    review=:review
                    WHERE id=:id
                    ";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }

    public function updateReview($id, $review)
    {
        $row = [
            'update_time' => date('Y/m/d H:i:s', time()),
            'review'      => $review,
            'id'          => $id,
        ];
        $sql = "UPDATE bgo_slideshow SET
                    update_time=:update_time,
                    review=:review
                    WHERE id=:id
                    ";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
