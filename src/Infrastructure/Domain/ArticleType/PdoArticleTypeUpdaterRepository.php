<?php

namespace App\Infrastructure\Domain\ArticleType;

use PDO;
use App\Domain\ArticleType\ArticleTypeUpdaterRepository;

class PdoArticleTypeUpdaterRepository implements ArticleTypeUpdaterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function update(array $type): int
    {
        $row = [
            'id'              => (int)$type['id'],
            'has_content'     => $type['has_content'] ?? 0,
            'has_summary'     => $type['has_summary'] ?? 0,
            'has_seo'         => $type['has_seo'] ?? 0,
            'has_slug'        => $type['has_slug'] ?? 0,
            'has_tags'        => $type['has_tags'] ?? 0,
            'has_image'       => $type['has_image'] ?? 0,
            'image_sensitive' => $type['image_sensitive'] ?? 0,
            'has_top'         => $type['has_top'] ?? 0,
        ];
        $sql = "UPDATE bgo_type SET has_content=:has_content, has_summary=:has_summary, has_seo=:has_seo, has_slug=:has_slug, has_tags=:has_tags, has_image=:has_image, image_sensitive=:image_sensitive, has_top=:has_top WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($row);

        return (int)$sth->rowCount();
    }
}
