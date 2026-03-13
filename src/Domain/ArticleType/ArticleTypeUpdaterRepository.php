<?php

namespace App\Domain\ArticleType;

interface ArticleTypeUpdaterRepository
{
    public function update(array $access): int;
}
