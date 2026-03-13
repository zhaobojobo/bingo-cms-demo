<?php

namespace Site\Models;

/**
 * Class CatalogMap
 *
 * @package Site\Models
 */
class CatalogMap extends \Site\Model
{
    public function __construct()
    {
        parent::__construct('catalog_map', 'id');
    }

    /**
     * @param $catalogs_id
     * @param $content_id
     * @param $content
     */
    public function save($catalogs_id, $content_id, $content)
    {
        $exists  = $this->catalogsId($content_id);
        $deletes = array_diff($exists, $catalogs_id);
        $inserts = array_diff($catalogs_id, $exists);
        foreach ($deletes as $catalog_id) {
            $this->remove($catalog_id, $content_id, $content);
        }
        foreach ($inserts as $catalog_id) {
            $this->add($catalog_id, $content_id, $content);
        }
    }

    /**
     * @param $catalog_ids
     * @param $content
     *
     * @return array
     */
    public function contentsId($catalog_ids)
    {
        $params = [];
        $fields = [];
        $prefix = 'catalog_id';
        foreach ($catalog_ids as $k => $id) {
            $field          = $prefix . '_' . $k;
            $params[$field] = $id;
            $fields[]       = ':' . $field;
        }
        $where = "catalog_id IN(" . implode(',', $fields) . ")";
        $data  = $this->query->findAll($this->table, $where, $params);

        return array_column($data, 'content_id');
    }

    /**
     * @param $content_id
     * @param $content
     *
     * @return array
     */
    public function catalogsId($content_id)
    {
        $where  = "content_id=:content_id";
        $params = ['content_id' => $content_id];
        $items  = $this->query->findAll($this->table, $where, $params);

        return array_column($items, 'catalog_id');
    }

    public function catIdOfType($content_id, $catType)
    {
        $where  = "content_id=:content_id AND type=:type";
        $params = ['content_id' => $content_id, 'type' => $catType];
        $item   = $this->query->find($this->table, $where, $params);

        return $item['catalog_id'];
    }

    /**
     * @param $catalog_id
     * @param $content_id
     * @param $content
     *
     * @return int
     */
    public function remove($catalog_id, $content_id, $content)
    {
        $where  = "catalog_id=:catalog_id AND content_id=:content_id AND content=:content";
        $params = ['catalog_id' => $catalog_id, 'content_id' => $content_id, 'content' => $content];

        return $this->query->delete($this->table, $where, $params);
    }

    /**
     * @param $catalog_id
     * @param $content_id
     * @param $content
     *
     * @return int
     */
    public function add($catalog_id, $content_id, $content)
    {
        $data = ['content' => $content, 'content_id' => $content_id, 'catalog_id' => $catalog_id];

        return $this->query->create($this->table, $data);
    }

    /**
     * @param $catalog_id
     *
     * @return mixed
     */
    public function removeByCatalog($catalog_id)
    {
        $where = "catalog_id=:catalog_id";

        return $this->query->delete($this->table, $where, ['catalog_id' => $catalog_id]);
    }

    /**
     * @param $content_id
     * @param $content
     *
     * @return mixed
     */
    public function removeByContentId($content_id, $content)
    {
        $where = "content=:content AND content_id=:content_id";

        return $this->query->delete($this->table, $where, ['content' => $content, 'content_id' => $content_id]);
    }

    /**
     * @param $content
     *
     * @return mixed
     */
    public function removeByContent($content)
    {
        $where = "content=:content";

        return $this->query->delete($this->table, $where, ['content' => $content]);
    }
}
