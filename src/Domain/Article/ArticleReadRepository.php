<?php

namespace App\Domain\Article;

interface ArticleReadRepository
{
    public function fetchById(int $id): array;

    public function fetchBySlug(int $slug): array;

    public function fetchAll(string $type): array;
}
