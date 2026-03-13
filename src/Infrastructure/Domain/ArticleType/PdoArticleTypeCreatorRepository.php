<?php

namespace App\Infrastructure\Domain\ArticleType;

use PDO;
use App\Domain\ArticleType\ArticleTypeCreatorRepository;

class PdoArticleTypeCreatorRepository implements ArticleTypeCreatorRepository
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert(array $type): int
    {
        $sql = "SELECT * FROM bgo_type WHERE name=:name";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['name' => $type['name']]);
        $row = $sth->fetch();
        if (! $row) {
            $sql = "INSERT INTO bgo_type SET name=:name, has_content=:has_content, has_summary=:has_summary, has_seo=:has_seo, has_slug=:has_slug, has_tags=:has_tags, has_image=:has_image, image_sensitive=:image_sensitive, has_top=:has_top";
            $sth = $this->pdo->prepare($sql);
            $sth->execute(
                [
                    'name'            => $type['name'],
                    'has_content'     => $type['has_content'] ?? 0,
                    'has_summary'     => $type['has_summary'] ?? 0,
                    'has_seo'         => $type['has_seo'] ?? 0,
                    'has_slug'        => $type['has_slug'] ?? 0,
                    'has_tags'        => $type['has_tags'] ?? 0,
                    'has_image'       => $type['has_image'] ?? 0,
                    'image_sensitive' => $type['image_sensitive'] ?? 0,
                    'has_top'         => $type['has_top'] ?? 0,
                ]
            );
            $id = (int)$this->pdo->lastInsertId();
        } else {
            $id = $row['id'];
        }

        $this->insertAccesses($type['name']);

        return $id;
    }

    private function getAccessNextSort()
    {
        $sql = "SELECT max(sort) FROM bgo_access";
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $sort = $sth->fetchColumn(0);

        return (int)$sort;
    }

    private function insertAccesses($accessCode)
    {
        $access = $this->findAccessOfCode($accessCode);
        if (! $access) {
            $access  = [
                'name'         => ucwords(str_replace('-', ' ', $accessCode)),
                'route'        => '',
                'access_code'  => $accessCode,
                'access_group' => '',
                'access_type'  => 0,
                'linkable'     => 1,
                'pid'          => 0,
                'sort'         => $this->getAccessNextSort(),
            ];
            $root_id = $this->insertAccess($access);
        } else {
            $root_id = $access['id'];
        }

        $categoryManageAccess = $this->findAccessOfCode($accessCode . '-category-index', $root_id);
        if (! $categoryManageAccess) {
            $access              = [
                'name'         => 'Category Manage',
                'route'        => '/catalogs/' . $accessCode . '/category',
                'access_code'  => $accessCode . '-category-index',
                'access_group' => $accessCode . '-category',
                'access_type'  => 1,
                'linkable'     => 1,
                'pid'          => $root_id,
                'sort'         => $this->getAccessNextSort(),
            ];
            $category_manage_pid = $this->insertAccess($access);
        } else {
            $category_manage_pid = $categoryManageAccess['id'];
        }

        $categoryManageAccesses = array_reverse($this->categoryManageAccesses($accessCode, $category_manage_pid));
        foreach ($categoryManageAccesses as $manage_access) {
            $oneAccess = $this->findAccessOfCode($manage_access['access_code'], $category_manage_pid);
            if (! $oneAccess) {
                $this->insertAccess($manage_access);
            }
        }

        $manageAccess = $this->findAccessOfCode($accessCode . '-index', $root_id);
        if (! $manageAccess) {
            $access     = [
                // 'name'         => ucwords(str_replace('-', ' ', $accessCode)) . ' Manage',
                'name'         => ucwords(str_replace('-', ' ', $accessCode)) . ' Manage',
                'route'        => '/posts/' . $accessCode,
                'access_code'  => $accessCode . '-index',
                'access_group' => $accessCode,
                'access_type'  => 1,
                'linkable'     => 1,
                'pid'          => $root_id,
                'sort'         => $this->getAccessNextSort(),
            ];
            $manage_pid = $this->insertAccess($access);
        } else {
            $manage_pid = $manageAccess['id'];
        }

        $manageAccesses = array_reverse($this->manageAccesses($accessCode, $manage_pid));
        foreach ($manageAccesses as $manage_access) {
            $oneAccess = $this->findAccessOfCode($manage_access['access_code'], $manage_pid);
            if (! $oneAccess) {
                $this->insertAccess($manage_access);
            }
        }
    }

    public function insertAccess(array $access): int
    {
        $params = [
            'name'         => $access['name'],
            'route'        => strtolower($access['route']),
            'access_code'  => strtolower($access['access_code']),
            'access_group' => strtolower($access['access_group']),
            'access_type'  => (int)$access['access_type'],
            'linkable'     => (int)$access['linkable'],
            'pid'          => (int)$access['pid'],
            'sort'         => $this->getAccessNextSort(),
        ];
        $sql    = "INSERT INTO bgo_access SET 
                name=:name, 
                route=:route, 
                access_code=:access_code, 
                access_group=:access_group, 
                access_type=:access_type, 
                linkable=:linkable, 
                pid=:pid,
                sort=:sort";
        $sth    = $this->pdo->prepare($sql);
        $sth->execute($params);

        return (int)$this->pdo->lastInsertId();
    }

    private function findAccessOfCode(string $accessCode, $pid = 0): ?array
    {
        $sql = "SELECT * FROM bgo_access WHERE access_code=:access_code AND pid=:pid";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(['access_code' => $accessCode, 'pid' => $pid]);

        return $sth->fetch() ?: null;
    }

    private function manageAccesses($type, $pid)
    {
        return [
            [
                'name'         => 'Add',
                'route'        => '/post/edit/' . $type . '/',
                'access_code'  => $type . '-add',
                'access_group' => $type,
                'access_type'  => 1,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit',
                'route'        => '/post/edit/' . $type . '/{id}',
                'access_code'  => $type . '-edit',
                'access_group' => $type,
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Review',
                'route'        => '/post/review/update/{id}',
                'access_code'  => $type . '-review',
                'access_group' => $type,
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Hidden',
                'route'        => '/post/hidden/update/{id}',
                'access_code'  => $type . '-hidden',
                'access_group' => $type,
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit Title',
                'route'        => '/post/title/update',
                'access_code'  => $type . '-title-edit',
                'access_group' => $type,
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit Slug',
                'route'        => '/post/slug/update',
                'access_code'  => $type . '-slug-edit',
                'access_group' => $type,
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Fields Manage',
                'route'        => '/extend/post/' . $type,
                'access_code'  => $type . '-fields',
                'access_group' => $type,
                'access_type'  => 0,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Copy',
                'route'        => '/post/copy/' . $type . '/{id}',
                'access_code'  => $type . '-copy',
                'access_group' => $type,
                'access_type'  => 1,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Batch Copy',
                'route'        => '/post/batch/copy/' . $type,
                'access_code'  => $type . '-batch-copy',
                'access_group' => $type,
                'access_type'  => 1,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Delete',
                'route'        => '/post/delete/' . $type,
                'access_code'  => $type . '-delete',
                'access_group' => $type,
                'access_type'  => 4,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Batch Delete',
                'route'        => '/post/batch/delete/' . $type,
                'access_code'  => $type . '-batch-delete',
                'access_group' => $type,
                'access_type'  => 4,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Preview',
                'route'        => '/post/preview/{id}',
                'access_code'  => $type . '-preview',
                'access_group' => $type,
                'access_type'  => 3,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Export',
                'route'        => '/post/export/' . $type,
                'access_code'  => $type . '-export',
                'access_group' => $type,
                'access_type'  => 1,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
        ];
    }

    private function categoryManageAccesses($type, $pid)
    {
        return [
            [
                'name'         => 'Add',
                'route'        => '/catalog/edit/' . $type . '/category',
                'access_code'  => $type . '-category-add',
                'access_group' => $type . '-category',
                'access_type'  => 1,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit',
                'route'        => '/catalog/edit/' . $type . '/category/{id}',
                'access_code'  => $type . '-category-edit',
                'access_group' => $type . '-category',
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Delete',
                'route'        => '/catalog/delete',
                'access_code'  => $type . '-category-delete',
                'access_group' => $type . '-category',
                'access_type'  => 4,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Disable Delete',
                'route'        => '/catalog/ban-delete/{id}',
                'access_code'  => $type . '-category-delete-disable',
                'access_group' => $type . '-category',
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Disable Subcatalog',
                'route'        => '/catalog/ban-children/{id}',
                'access_code'  => $type . '-category-subcategory-disable',
                'access_group' => $type . '-category',
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Fields Manage',
                'route'        => '/extend/category/' . $type,
                'access_code'  => $type . '-category-fields',
                'access_group' => $type . '-category',
                'access_type'  => 0,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit Name',
                'route'        => '/catalog/name/update',
                'access_code'  => $type . '-category-name-edit',
                'access_group' => $type . '-category',
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
            [
                'name'         => 'Edit Slug',
                'route'        => '/catalog/slug/update',
                'access_code'  => $type . '-category-slug-edit',
                'access_group' => $type . '-category',
                'access_type'  => 2,
                'linkable'     => 0,
                'pid'          => $pid,
            ],
        ];
    }
}
