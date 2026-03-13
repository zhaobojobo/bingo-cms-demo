<?php

namespace Admin\Models;

use Admin\Data;
use App\Exceptions\NormalException;
use Admin\Helper;
use Admin\Profile;

/**
 * Class Post
 *
 * @package Admin\Models
 */
class Post extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table       = 'post';
        $this->idField     = 'id';
        $this->contentType = 'post';
        $this->map         = new CatalogMap();
        $this->data        = new Data('post_data', 'post_id');
        $this->profile     = new Profile('post_profile', 'post_id');
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateTitle($data, $id)
    {
        $data['update_time'] = date('Y-m-d H:i:s');
        $data                = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        if (isset($data['slug'])) {
            $data['slug'] = preg_replace('/[^a-z]+/', '-', strtolower($data['slug']));
            if ($data['slug']) {
                $exist = $this->findSlug($data['slug']);
                if ($exist && $exist['id'] != $data['id']) {
                    $data['slug'] = $data['slug'] . '-' . $data['id'];
                }
            }
        }
        if (isset($data['hidden'])) {
            $data['hidden'] = intval($data['hidden']);
        }
        if (isset($data['review'])) {
            $data['review'] = intval($data['review']);
        }
        if (isset($data['model_id'])) {
            $data['model_id'] = intval($data['model_id']);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateSlug($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateSort($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     */
    public function setCache($data)
    {
        $this->updateStatus(['cache' => 1], $data['id']);
        parent::cache(md5('post-' . $data['id']), $data);
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateStatus($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function copy($id)
    {
        $data = $this->find($id);
        unset($data['cats']);
        unset($data['catsId']);
        unset($data['cats_id']);
        $data                 = Helper::objectToArray($data);
        $data['create_time']  = date('Y-m-d H:i:s');
        $data['update_time']  = date('Y-m-d H:i:s');
        $data['publish_time'] = date('Y-m-d H:i:s');
        $data['review']       = 0;
        $data['slug']         = '';
        foreach ($data['__data'] as $langId => $_data) {
            $data['__data'][$langId]['title'] = $_data['title'] . '[copy]';
        }

        return parent::create($data);
    }

    public function update($data, $id)
    {
        $data['update_time'] = date('Y-m-d H:i:s');
        $data                = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data                = $this->validate($data, 'create');
        $data                = $this->inputFilter($data);
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = $data['create_time'];

        return parent::create($data);
    }

    public function nextSort()
    {
        return $this->max('sort', '', []);
    }

    /**
     * @param        $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        // if (! $data['cat']) {
        //     throw new NormalException(Helper::_('Please select 「Category」'));
        // }

        return $data;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function search($key)
    {
        return $this->data->search($this->c['currentLang'], $key);
    }

    /**
     * @param $link
     *
     * @return string
     */
    public static function thumb($link)
    {
        return dirname($link) . '/thumbs/' . basename($link);
    }

    /**
     * @param $data
     * @param $langId
     *
     * @return array
     */
    public static function normalizeProduct($data, $langId, $cats)
    {
        $data = Helper::objectToArray($data);
        unset($data['type']);
        unset($data['model_id']);
        unset($data['cache']);
        if (isset($data['catalogs_id'])) {
            $data['categories'] = [];
            $catalogs_id        = $data['catalogs_id'];
            unset($data['catalogs_id']);
            foreach ($catalogs_id as $catalog_id) {
                if (isset($cats[$catalog_id])) {
                    $data['categories'][] = $cats[$catalog_id];
                }
            }
            $data['categories'] = implode(',', $data['categories']);
        }
        if (isset($data['__data'])) {
            $langData = $data['__data'][$langId];
            unset($data['__data']);
            foreach ($langData as $key => $item) {
                if (array_key_exists($key, $data) && ! $item) {
                    unset($langData[$key]);
                }
            }
            $data = array_merge($data, $langData);
        }

        if (isset($data['__profile'])) {
            $allProfile  = $data['__profile']['all'] ?? [];
            $langProfile = $data['__profile'][$langId];
            unset($data['__profile']);
            if ($allProfile) {
                foreach ($allProfile as $key => $item) {
                    if (array_key_exists($key, $data) && ! $item) {
                        unset($allProfile[$key]);
                    }
                }
                $data = array_merge($data, $allProfile);
            }
            if ($langProfile) {
                foreach ($langProfile as $key => $item) {
                    if (array_key_exists($key, $data) && ! $item) {
                        unset($langProfile[$key]);
                    }
                }
                $data = array_merge($data, $langProfile);
            }
        }

        return $data;
    }
}
