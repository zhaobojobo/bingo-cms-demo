<?php

namespace App\Domain\ArticleType;

use App\Domain\Finder;

class ArticleTypeFinder extends Finder
{
    public function __construct(ArticleTypeFinderRepository $repository)
    {
        parent::__construct($repository);
    }

    public function findOneOfName(string $name): ?ArticleType
    {
        $object = $this->repository->findOneOfName($name);

        return $object;
    }
}
