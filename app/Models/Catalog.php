<?php

namespace Site\Models;

use Site\Data;
use Site\Exceptions\NormalException;
use Site\Helper;
use Site\Profile;

/**
 * Class Catalog
 *
 * @package Admin\Models
 */
class Catalog extends Base
{
    public $type;

    /**
     * Model constructor.
     *
     */
    public function __construct()
    {
        parent::__construct('catalog', 'id');
        $this->type    = 'catalog';
        $this->data    = new Data('catalog_data', 'catalog_id');
        $this->profile = new Profile('catalog_profile', 'catalog_id');
    }

    /**
     * @param $list
     * @param int $parent_id
     * @param int $level
     *
     * @return string
     */
    public static function treeAsHtmlList($type, $list, $parent_id = 0, $level = -1)
    {
        $html = '';
        $html .= '<ul class="list-unstyled menu-list sortable">';
        $level++;
        $indent = '';
        if ($level > 0) {
            $indent = '├' . str_repeat('─', $level);
        }
        $c      = Register::get('container');
        $langId = $c['config']['site']['lang']['defaultLang'];
        foreach ($list as $item) :
            $banDeleteApi   = Helper::getUrl('/' . $type . '/ban-delete/' . $item['id']);
            $banChildrenApi = Helper::getUrl('/' . $type . '/ban-children/' . $item['id']);

            $banDeleteLink
                = "<a class=\"button-green bingo_button icon_button\" data-bandel=\"1\"  href=\"{$banDeleteApi}\"><i class=\"fa fa-fw fa-check\" aria-hidden=\"true\"></i></a>";
            if ($item['ban_delete']) {
                $banDeleteLink
                    = "<a class=\"button-red bingo_button icon_button\" data-bandel=\"0\"  href=\"{$banDeleteApi}\"><i class=\"fa fa-fw fa-ban\" aria-hidden=\"true\"></i></a>";
            }

            $banChildrenLink
                = "<a class=\"button-green bingo_button icon_button\" data-bansub=\"1\"  href=\"{$banChildrenApi}\"><i class=\"fa fa-fw fa-check\" aria-hidden=\"true\"></i></a>";
            if ($item['ban_children']) {
                $banChildrenLink
                    = "<a class=\"button-red bingo_button icon_button\" data-bansub=\"0\"  href=\"{$banChildrenApi}\"><i class=\"fa fa-fw fa-ban\" aria-hidden=\"true\"></i></a>";
            }

            $html .= "<li data-id=\"" . $item['id'] . "\">";
            $html .= "<div class=\"row no-gutters\">";
            $html .= "<div class=\"col-1 text-center\">{$item['id']}</div>";
            $html .= "<div class=\"col-5\">{$indent}{$item['__data'][$langId]['name']}</div>";
            $html .= "<div class=\"col-2 edit-ban-delete justify-content-center\">{$banDeleteLink}</div>";
            $html .= "<div class=\"col-2 edit-ban-children justify-content-center\">{$banChildrenLink}</div>";
            $html .= "<div class=\"col-2\">";
            $html .= "<a class=\"button-gray bingo_button icon_button\" title=\""
                . Helper::_('Edit') . "\" href=\""
                . Helper::getUrl('/' . $type . '/edit/' . $item['id']) . "\">";
            $html .= "<i class=\"fa fa-fw fa-pencil\" aria-hidden=\"true\"></i>";
            $html .= "</a>";
            if (!$item['ban_children']) {
                $html .= "<a class=\"button-gray bingo_button icon_button btn-children\" title=\""
                    . Helper::_('Add Sub Catalog') . "\" href=\""
                    . Helper::getUrl(
                        '/' . $type . '/edit/?parent_id='
                    ) . $item['id']
                    . "\"><i class=\"fa fa-fw fa-plus\" aria-hidden=\"true\"></i></a>";
            }
            if (!$item['ban_delete']) {
                $html .= "<a class=\"button-gray bingo_button icon_button delete\" title=\""
                    . Helper::_('Delete') . "\" href=\""
                    . Helper::getUrl('/' . $type . '/delete') . "\" data-id=\""
                    . $item['id'] . "\">";
                $html .= "<i class=\"fa fa-fw fa-trash-o\" aria-hidden=\"true\"></i>";
                $html .= "</a>";
            }
            $html .= "</div></div>";
            if (isset($item['children']) && $item['children']) :
                $html .= self::treeAsHtmlList($type, $item['children'], $item['id'], $level);
            endif;
            $html .= "</li>";
        endforeach;
        $html .= "</ul>";

        return $html;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data = $this->validate($data, 'create');
        $data = $this->inputFilter($data);

        return parent::create($data);
    }

    /**
     * @param $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        if (isset($data['slug'])) {
            $data['slug'] = strtolower($data['slug']);
            if ($data['slug']) {
                $exist = $this->findSlug($data['slug']);
                if ($exist && $exist['id'] != $data['id']) {
                    $data['slug'] = $data['slug'] . '-' . $data['id'];
                }
            }
        }
        if (isset($data['parent_id'])) {
            $data['parent_id'] = intval($data['parent_id']);
        }
        if (isset($data['model_id'])) {
            $data['model_id'] = intval($data['model_id']);
        }
        if (isset($data['content_model_id'])) {
            $data['content_model_id'] = intval($data['content_model_id']);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        $data = $this->validate($data, 'update');
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function root($id)
    {
        $catalog = $this->find($id);
        if (!$catalog['parent_id']) {
            return $catalog;
        } else {
            return $this->root($catalog['parent_id']);
        }
    }

    /**
     * @param $id
     *
     * @return array
     */
    public function allCatIds($id)
    {
        $ids = [];
        $cat = $this->find($id);
        if ($cat) {
            $ids[] = $id;
            $list  = $this->findAll("parent_id=:parent_id", ['parent_id' => $id]);
            foreach ($list as $item) {
                $children = $this->allCatIds($item['id']);
                if ($children) {
                    $ids = array_merge($ids, $children);
                }
            }
        }

        return $ids;
    }

    /**
     * @param $id
     * @return array
     */
    public function children($id)
    {
        $children  = $this->findAll("parent_id=:parent_id", ['parent_id' => $id], 'sort DESC');

        return $children;
    }

    /**
     * @param $id
     * @return array
     */
    public function ancestors($id)
    {
        $ancestors = [];
        if ($parent = $this->parent($id)) {
            $ancestors[] = $parent;
            $ancestors   = array_merge($ancestors, $this->ancestors($parent['id']));
        }

        return $ancestors;
    }

    /**
     * @param $id
     * @return mixed|null
     */
    public function parent($id)
    {
        $find = $this->find($id);
        if ($find && $find['parent_id']) {
            return $this->find($find->parent_id);
        }

        return null;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateBanDelete($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $id
     */
    public function checkBanDelete($id)
    {
        $catalog = $this->find($id);
        if ($catalog) {
            if ($catalog['ban_delete']) {
                throw new NormalException(Helper::_('Can not delete'));
            }
        }
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function updateBanChildren($data, $id)
    {
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

}
