<?php

namespace App\Domain\Slideshow;

class SlideshowReader
{
    private $repository;

    private $slideReader;

    public function __construct(SlideshowReadRepository $repository, SlideReader $slideReader)
    {
        $this->repository  = $repository;
        $this->slideReader = $slideReader;
    }

    public function findAll()
    {
        $rows       = $this->repository->fetchAll();
        $collection = self::getCollection($rows);

        return $collection;
    }

    public function find($id)
    {
        if ($row = $this->repository->fetch($id)) {
            $slideshow = self::getObject($row);
            $slides    = $this->slideReader->findAll($slideshow->id());
            $slideshow->setSlides($slides);

            return $slideshow;
        }

        return false;
    }

    public function findBySlug($slug)
    {
        if ($row = $this->repository->fetchBySlug($slug)) {
            $slideshow = self::getObject($row);
            $slides    = $this->slideReader->findAll($slideshow->id());
            $slideshow->setSlides($slides);

            return $slideshow;
        }

        return false;
    }

    private static function getObject(array $row): Slideshow
    {
        $object = new Slideshow(
            $row['id'],
            $row['lang'],
            $row['slug'],
            $row['name'],
            $row['review'],
            $row['create_time'],
            $row['update_time']
        );

        return $object;
    }

    private static function getCollection($rows)
    {
        $collection = [];
        foreach ($rows as $i => $row) {
            $collection[$row['id']] = self::getObject($row);
        }

        return $collection;
    }
}
