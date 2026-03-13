<?php

namespace App\Domain\ArticleType;

interface ArticleTypeCreatorRepository
{
    public function insert(array $access): int;
}
