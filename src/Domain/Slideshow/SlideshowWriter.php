<?php

namespace App\Domain\Slideshow;

class SlideshowWriter
{
    private $repository;

    public function __construct(SlideshowWriteRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $post)
    {
        return $this->repository->insert($post);
    }

    public function update(array $post)
    {
        return $this->repository->update($post);
    }
}
