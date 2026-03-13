<?php

namespace App\Domain\ArticleType;

use App\Domain\FinderRepository;

/**
 * Interface ArticleTypeFinderRepository
 *
 * @package App\Doman\Permission\ArticleType
 */
interface ArticleTypeFinderRepository extends FinderRepository
{
    public function findOneOfName(string $name);
}
