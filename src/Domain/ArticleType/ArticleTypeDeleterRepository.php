<?php

namespace App\Domain\ArticleType;

interface ArticleTypeDeleterRepository
{
    public function delete($id): int;
}
