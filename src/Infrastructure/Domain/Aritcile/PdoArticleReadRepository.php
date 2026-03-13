<?php

namespace App\Infrastructure\Domain\Aritcile;

use PDO;
use App\Domain\Article\ArticleReadRepository;

class PdoArticleReadRepository implements ArticleReadRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function fetchById(int $id): array
    {
        return [];
    }

    public function fetchBySlug(int $slug): array
    {
        return [];
    }

    public function fetchAll(string $type): array
    {
        return [];
    }
}
