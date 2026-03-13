<?php

namespace App\Domain\Article;

class ArticleReader
{
    private $repository;

    public function __construct(ArticleReadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find($id)
    {
        if (is_numeric($id)) {
            $this->repository->fetchById($id);
        } else {
            $this->repository->fetchBySlug($id);
        }
    }

    public function findAll($type)
    {
        $this->repository->fetchAll($type);
    }
}
