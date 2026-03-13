<?php

namespace App\Domain;

abstract class FinderOfTree extends Finder
{
    public function findParent(int $id): ?Data
    {
        $parent = null;
        $object = $this->findOneOfId($id);
        if ($object) {
            $parent = $this->findOneOfId($object->getPid());
        }

        return $parent;
    }

    /**
     * @return Data[]
     */
    public function findParents(int $id): array
    {
        $parents = [];
        $parent  = $this->findParent($id);
        while ($parent) {
            $parents[$parent->getId()] = $parent;
            if ($parent->getPid()) {
                $parent = $this->findOneOfId($parent->getPid());
            } else {
                $parent = null;
            }
        }

        return $parents;
    }

    public static function toTree($rows, $pid = 0)
    {
        $tree = [];
        if (! empty($rows)) {
            $list = [];
            foreach ($rows as $item) {
                $list[$item->getId()] = $item;
            }
            foreach ($list as $item) {
                if ($pid == $item->getPid()) {
                    $tree[] = &$list[$item->getId()];
                } elseif (isset($list[$item->getPid()])) {
                    $list[$item->getPid()]->children[] = &$list[$item->getId()];
                }
            }
        }

        return $tree;
    }

    public static function flattenedTree($tree = [], $level = 0)
    {
        if (! is_array($tree) || empty($tree)) {
            return $tree;
        }

        $list = [];
        foreach ($tree as $item) {
            $children = null;
            if (isset($item->children)) {
                $children = $item->children;
                unset($item->children);
            }

            $item->level  = $level;
            $item->indent = str_repeat('─', $level);
            $list[]       = $item;

            if ($children) {
                $list = array_merge($list, self::flattenedTree($children, $level + 1));
            }
        }

        return $list;
    }

    public function findParensSelectedList()
    {
        $parents = $this->findAll();
        $parents = self::toTree($parents);
        $parents = self::flattenedTree($parents);

        return $parents;
    }
}
