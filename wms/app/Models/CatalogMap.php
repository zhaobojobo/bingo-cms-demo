<?php

namespace Admin\Models;

/**
 * Class CatalogMap
 *
 * @package Admin\Models
 */
class CatalogMap extends \Admin\Model
{
    public $table = 'catalog_map';

    /**
     * @param $catalog_ids
     * @param $content
     *
     * @return array
     */
    public function contentsId($catalog_ids, $content = '', $type = '')
    {
        $where = "catalog_id IN(" . implode(',', $catalog_ids) . ")";
        if ($content) {
            $where = " AND content='{$content}'";
        }
        if ($type) {
            $where .= " AND type='{$type}'";
        }
        $data = $this->query->findAll($this->table, $where);

        return array_column($data, 'content_id');
    }

    /**
     * @param $catalogs_id
     * @param $content_id
     * @param $content
     */
    public function save($catalogs_id, $content_id, $content, $type = '')
    {
        $exists  = $this->catalogsTypeId($content_id, $content, $type);
        $deletes = array_diff($exists, $catalogs_id);
        $inserts = array_diff($catalogs_id, $exists);
        foreach ($deletes as $catalog_id) {
            $this->remove($catalog_id, $content_id, $content);
        }
        foreach ($inserts as $catalog_id) {
            $this->add($catalog_id, $content_id, $content, $type);
        }
    }

    /**
     * @param $content_id
     * @param $content
     *
     * @return array
     */
    public function catalogsId($content_id, $content)
    {
        $where = "content='{$content}' AND content_id={$content_id}";
        $items = $this->query->findAll($this->table, $where);

        return array_column($items, 'catalog_id');
    }

    public function catalogsTypeId($content_id, $content, $type)
    {
        $where = "content='{$content}' AND content_id={$content_id}";
        if ($type) {
            $where .= " AND type='{$type}'";
        }
        $items = $this->query->findAll($this->table, $where);

        return array_column($items, 'catalog_id');
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
        $where = "catalog_id={$catalog_id} AND content_id={$content_id} AND content='{$content}'";

        return $this->query->delete($this->table, $where);
    }

    /**
     * @param $catalog_id
     * @param $content_id
     * @param $content
     *
     * @return int
     */
    public function add($catalog_id, $content_id, $content, $type)
    {
        $data = ['content' => $content, 'content_id' => $content_id, 'catalog_id' => $catalog_id, 'type' => $type];

        return $this->query->create($this->table, $data);
    }

    /**
     * @param $catalog_id
     *
     * @return mixed
     */
    public function removeByCatalog($catalog_id)
    {
        $where = "catalog_id={$catalog_id}";

        return $this->query->delete($this->table, $where);
    }

    /**
     * @param $content_id
     * @param $content
     *
     * @return mixed
     */
    public function removeByContentId($content_id, $content)
    {
        $where = "content='{$content}' AND content_id={$content_id}";

        return $this->query->delete($this->table, $where);
    }

    /**
     * @param $content
     *
     * @return mixed
     */
    public function removeByContent($content, $type = '')
    {
        $where = "content='{$content}'";
        if ($type) {
            $where .= " AND type='{$type}'";
        }

        return $this->query->delete($this->table, $where);
    }
}
