<?php

namespace App\Domain\Slideshow;

use PDO;
use PDOException;

class SlideWriteRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $slide)
    {
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO bgo_slide_id SET id=:id";
            $this->pdo->prepare($sql)->execute(['id' => null]);
            $id = $this->pdo->lastInsertId();

            $row = [
                'id'           => $id,
                'lang'         => $slide['lang'],
                'image'        => $slide['image'],
                'title'        => $slide['title'],
                'description'  => $slide['description'],
                'link'         => $slide['link'],
                'create_time'  => $slide['create_time'],
                'update_time'  => $slide['update_time'],
                'slideshow_id' => $slide['slideshow_id'],
            ];
            $sql = "INSERT INTO bgo_slide SET
                    id=:id,
                    lang=:lang,
                    image=:image,
                    title=:title,
                    description=:description,
                    link=:link,
                    create_time=:create_time,
                    update_time=:update_time,
                    slideshow_id=:slideshow_id;
                    ";
            $this->pdo->prepare($sql)->execute($row);
            $this->pdo->commit();

            return (int)$id;
        } catch (PDOException $exception) {
            $this->pdo->rollBack();

            return false;
        }
    }

    public function update(array $slide)
    {
        $row = [
            'id'          => $slide['id'],
            'image'       => $slide['image'],
            'title'       => $slide['title'],
            'description' => $slide['description'],
            'link'        => $slide['link'],
            'update_time' => $slide['update_time'],
        ];
        $sql = "UPDATE bgo_slideshow SET
                    image=:image,
                    title=:title,
                    description=:description
                    link=:link
                    update_time=:update_time,
                    WHERE id=:id
                    ";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
