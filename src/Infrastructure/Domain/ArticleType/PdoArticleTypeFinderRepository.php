<?php

namespace App\Infrastructure\Domain\ArticleType;

use PDO;
use App\Domain\ArticleType\ArticleType;
use App\Domain\ArticleType\ArticleTypeFinderRepository;

class PdoArticleTypeFinderRepository implements ArticleTypeFinderRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM bgo_type";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows  = $sth->fetchAll();
        $types = [];
        foreach ($rows as $row) {
            $types[] = new ArticleType(
                $row['id'],
                $row['name'],
                $row['has_content'],
                $row['has_summary'],
                $row['has_seo'],
                $row['has_slug'],
                $row['has_tags'],
                $row['has_image'],
                $row['image_sensitive'],
                $row['has_top']
            );
        }

        return $types;
    }

    public function findOneOfId(int $id): ?ArticleType
    {
        $sql = "SELECT * FROM bgo_type WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        $type = null;
        if ($row = $sth->fetch()) {
            $type = new ArticleType(
                $row['id'],
                $row['name'],
                $row['has_content'],
                $row['has_summary'],
                $row['has_seo'],
                $row['has_slug'],
                $row['has_tags'],
                $row['has_image'],
                $row['image_sensitive'],
                $row['has_top']
            );
        }

        return $type;
    }

    public function findOneOfName(string $name)
    {
        $sql = "SELECT * FROM bgo_type WHERE name=:name";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['name' => $name]);

        $type = null;
        if ($row = $sth->fetch()) {
            $type = new ArticleType(
                $row['id'],
                $row['name'],
                $row['has_content'],
                $row['has_summary'],
                $row['has_seo'],
                $row['has_slug'],
                $row['has_tags'],
                $row['has_image'],
                $row['image_sensitive'],
                $row['has_top']
            );
        }

        return $type;
    }
}
