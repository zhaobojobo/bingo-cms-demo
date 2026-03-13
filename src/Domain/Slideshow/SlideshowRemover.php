<?php

namespace App\Domain\Slideshow;

class SlideshowRemover
{
    private $repository;

    public function __construct(SlideshowRemoveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id): int
    {
        return $this->repository->delete($id);
    }
}
