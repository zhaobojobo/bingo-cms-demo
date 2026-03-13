<?php

namespace App\Infrastructure\Domain\ArticleType;

use PDO;
use App\Domain\ArticleType\ArticleTypeDeleterRepository;

class PdoArticleTypeDeleterRepository implements ArticleTypeDeleterRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function delete($id): int
    {
        $sql = "SELECT * FROM bgo_type WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);
        $type = $sth->fetch();
        if ($type) {
            $access = $this->findAccessOfCode($type['name']);
            if ($access) {
                $this->deleteAccesses($access['id']);
            }

            $this->deleteCatalogs($type['name']);
            $this->deletePosts($type['name']);
            $this->deleteCatModel($type['name']);
            $this->deletePostModel($type['name']);
        }

        $sql = "DELETE FROM bgo_type WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        return (int)$sth->rowCount();
    }

    private function deleteCatalogs($type)
    {
        $sql = "SElECT * FROM catalog WHERE content_type=:content_type";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['content_type' => $type]);
        $catalogs = $sth->fetchAll();

        foreach ($catalogs as $catalog) {
            $sql = "DELETE FROM catalog_data WHERE catalog_id=:catalog_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['catalog_id' => $catalog['id']]);

            $sql = "DELETE FROM catalog_map WHERE catalog_id=:catalog_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['catalog_id' => $catalog['id']]);

            $sql = "DELETE FROM catalog_profile WHERE catalog_id=:catalog_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['catalog_id' => $catalog['id']]);

            $sql = "DELETE FROM catalog WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $catalog['id']]);
        }
    }

    private function deletePosts($type)
    {
        $sql = "SElECT * FROM post WHERE type=:type";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['type' => $type]);
        $posts = $sth->fetchAll();

        foreach ($posts as $post) {
            $sql = "DELETE FROM history WHERE content_id=:content_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['content_id' => $post['id']]);

            $sql = "DELETE FROM post_data WHERE post_id=:post_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['post_id' => $post['id']]);

            $sql = "DELETE FROM post_profile WHERE post_id=:post_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['post_id' => $post['id']]);

            $sql = "DELETE FROM post WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $post['id']]);
        }
    }

    private function deleteCatModel($type)
    {
        $sql = "SELECT * FROM model WHERE type=:type AND subtype=:subtype";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['type' => 'catalog', 'subtype' => $type]);
        $models = $sth->fetchAll();
        foreach ($models as $model) {
            $sql = "SELECT * FROM model WHERE parent_id=:parent_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['parent_id' => $model['id']]);
            $subModels = $sth->fetchAll();
            foreach ($subModels as $sub_model) {
                $this->deleteFields($sub_model['id']);
                $sql = "DELETE FROM model WHERE id=:id";
                $sth = $this->pdo->prepare($sql);
                $sth->execute(['id' => $sub_model['id']]);
            }

            $this->deleteFields($model['id']);
            $sql = "DELETE FROM model WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $model['id']]);
        }
    }

    private function deletePostModel($type)
    {
        $sql = "SELECT * FROM model WHERE type=:type AND subtype=:subtype";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['type' => 'post', 'subtype' => $type]);
        $models = $sth->fetchAll();
        foreach ($models as $model) {
            $sql = "SELECT * FROM model WHERE parent_id=:parent_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['parent_id' => $model['id']]);
            $subModels = $sth->fetchAll();
            foreach ($subModels as $sub_model) {
                $this->deleteFields($sub_model['id']);
                $sql = "DELETE FROM model WHERE id=:id";
                $sth = $this->pdo->prepare($sql);
                $sth->execute(['id' => $sub_model['id']]);
            }

            $this->deleteFields($model['id']);
            $sql = "DELETE FROM model WHERE id=:id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['id' => $model['id']]);
        }
    }

    private function deleteFields($model_id)
    {
        $sql = "SELECT * FROM field WHERE model_id=:model_id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['model_id' => $model_id]);
        $fields = $sth->fetchAll();

        foreach ($fields as $field) {
            $sql = "DELETE FROM field_data WHERE field_id=:field_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['field_id' => $field['id']]);

            $sql = "DELETE FROM field_data WHERE field_id=:field_id";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(['field_id' => $field['id']]);
        }
    }

    private function deletePermissions($access_id)
    {
        $sql = "DELETE FROM bgo_permission WHERE access_id=:access_id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['access_id' => $access_id]);

        return (int)$sth->rowCount();
    }

    private function deleteAccesses($id): int
    {
        $children = $this->children($id);
        if ($children) {
            foreach ($children as $child) {
                $this->deleteAccesses($child['id']);
            }
        }

        $this->deletePermissions($id);
        $sql = "DELETE FROM bgo_access WHERE id=:id";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['id' => $id]);

        return (int)$sth->rowCount();
    }

    private function children($pid)
    {
        $params = ['pid' => $pid];
        $sql    = "SELECT * FROM bgo_access WHERE pid=:pid";
        $sth    = $this->pdo->prepare($sql);
        $sth->execute($params);

        return $sth->fetchAll();
    }

    private function findAccessOfCode(string $accessCode, $pid = 0): ?array
    {
        $sql = "SELECT * FROM bgo_access WHERE access_code=:access_code AND pid=:pid";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['access_code' => $accessCode, 'pid' => $pid]);

        return $sth->fetch() ?: null;
    }
}
