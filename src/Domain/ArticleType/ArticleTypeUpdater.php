<?php

namespace App\Domain\ArticleType;

class ArticleTypeUpdater
{
    private $repository;

    public function __construct(ArticleTypeUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function update($data)
    {
        $count = $this->repository->update($data);

        return $count;
    }
}
