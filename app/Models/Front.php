<?php

namespace Site\Models;

use App\Register;
use PDO;

class Front
{
    private PDO $pdo;

    public function __construct()
    {
        $container = Register::get('container');
        $this->pdo = $container['pdo'];
    }

    public function getType($path)
    {
        $parts = explode('/', $path);
        $count = count($parts);
        if ($count == 0) {
            return '';
        } elseif ($count == 1) {
            $page = $this->findPage($parts[0]);
            if ($page) {
                return 'page';
            }

            return 'catalog';
        } else {
            $page = $this->findPage($parts[0]);
            if ($page) {
                return 'page';
            }
            $catalog = $this->findCatalog($parts[0]);
            if ($catalog) {
                if (!is_numeric($parts[$count - 1])) {
                    return 'catalog';
                }

                return 'article';
            }

            return '';
        }
    }

    public function getId($path)
    {
        $parts = explode('/', $path);
        $count = count($parts);

        return $parts[$count - 1];
    }

    public function findPage($id)
    {
        if (is_numeric($id)) {
            $sql = "SELECT * FROM page WHERE id=?";
        } else {
            $sql = "SELECT * FROM page WHERE slug=?";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findCatalog($id)
    {
        if (is_numeric($id)) {
            $sql = "SELECT * FROM catalog WHERE id=?";
        } else {
            $sql = "SELECT * FROM catalog WHERE slug=?";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
