<?php

namespace App\Domain\Slideshow;

class SlideReader
{
    private $repository;


    public function __construct(SlideReadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findAll($slideshow_id): array
    {
        $rows       = $this->repository->fetchAll($slideshow_id);
        $collection = self::getCollection($rows);

        return $collection;
    }

    private static function getCollection($rows): array
    {
        $collection = [];
        foreach ($rows as $i => $row) {
            $collection[$row['id']] = self::getObject($row);
        }

        return $collection;
    }

    private static function getObject(array $row): Slide
    {
        $object = new Slide(
            $row['id'], $row['image'], $row['title'], $row['description'], $row['link'], $row['slideshow_id']
        );

        return $object;
    }
}
