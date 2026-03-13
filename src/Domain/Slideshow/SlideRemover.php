<?php

namespace App\Domain\Slideshow;

class SlideRemover
{
    private $repository;

    public function __construct(SlideRemoveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id): int
    {
        return $this->repository->delete($id);
    }
}
