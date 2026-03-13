<?php

namespace App\Domain\ArticleType;

class ArticleTypeDeleter
{
    private $repository;

    public function __construct(ArticleTypeDeleterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function delete($id)
    {
        $count = $this->repository->delete($id);

        return $count;
    }
}
