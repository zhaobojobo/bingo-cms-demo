<?php

namespace Site\Models;

use Site\Helper;
use App\Register;


/**
 * Class Category
 * @package Admin\Models
 */
class Category extends Catalog
{
    /**
     * Model constructor.
     * @param $cType
     */
    public function __construct()
    {
        parent::__construct();
        $this->type = 'category';
    }

    /**
     * @param string $where
     * @param array $params
     * @param string $order
     * @return array
     */
    public function findAll($where = '', $params = [], $order = '')
    {
        $_where = "type=:type";
        $_params = ['type' => $this->type];
        if ($where) {
            $_where = $where . ' AND ' . $_where;
            $_params = array_merge($params, $_params);
        }
        return parent::findAll($_where, $_params, $order);
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data                 = $this->validate($data, 'create');
        $data                 = $this->inputFilter($data);
        $data['type']         = $this->type;
        return parent::create($data);
    }

    /**
     * @param $list
     * @param int $parent_id
     * @param int $level
     *
     * @return string
     */
    public static function treeAsHtmlList($cType, $list, $parent_id = 0, $level = -1)
    {
        $html = '';
        $html .= '<ul class="list-unstyled menu-list sortable">';
        $level++;
        $indent = '';
        if ($level > 0) {
            $indent = '├' . str_repeat('─', $level);
        }
        $c      = Register::get('container');
        $langId = $c['defaultLang'];
        foreach ($list as $item) :
            $editUrl   = Helper::getUrl('/category/edit/' . $cType . '/' . $item['id']);
            $addUrl    = Helper::getUrl('/category/edit/' . $cType . '/?parent_id=') . $item['id'];
            $delUrl    = Helper::getUrl('/category/delete');
            $banDelUrl = Helper::getUrl('/category/ban-delete/' . $item['id']);
            $banSubUrl = Helper::getUrl('/category/ban-children/' . $item['id']);

            $editLink = sprintf(
                '<a class="button-gray bingo_button icon_button" title="%s" href="%s">%s</a>',
                Helper::_('Edit'),
                $editUrl,
                '<i class="fa fa-fw fa-pencil" aria-hidden="true"></i>'
            );
            $addLink  = sprintf(
                '<a class="button-gray bingo_button icon_button btn-children" title="%s" href="%s">%s</a>',
                Helper::_('Add Sub Category'),
                $addUrl,
                '<i class="fa fa-fw fa-plus" aria-hidden="true"></i>'
            );
            $delLink  = sprintf(
                '<a class="button-gray bingo_button icon_button delete" title="%s" href="%s" data-id="%s">%s</a>',
                Helper::_('Delete'),
                $delUrl,
                $item['id'],
                '<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i>'
            );

            $banDeleteLink = sprintf(
                '<a class="button-green bingo_button icon_button" data-bandel="1"  href="%s">%s</a>',
                $banDelUrl,
                '<i class="fa fa-fw fa-check" aria-hidden="true"></i>'
            );
            if ($item['ban_delete']) {
                $banDeleteLink = sprintf(
                    '<a class="button-red bingo_button icon_button" data-bandel="0"  href="%s">%s</a>',
                    $banDelUrl,
                    '<i class="fa fa-fw fa-ban" aria-hidden="true"></i>'
                );
            }
            $banChildrenLink = sprintf(
                '<a class="button-green bingo_button icon_button" data-bansub="1"  href="%s">%s</a>',
                $banSubUrl,
                '<i class="fa fa-fw fa-check" aria-hidden="true"></i>'
            );
            if ($item['ban_children']) {
                $banChildrenLink = sprintf(
                    '<a class="button-red bingo_button icon_button" data-bansub="0"  href="%s">%s</a>',
                    $banSubUrl,
                    '<i class="fa fa-fw fa-ban" aria-hidden="true"></i>'
                );
            }

            $html .= "<li data-id=\"" . $item['id'] . "\">";
            $html .= "<div class=\"row no-gutters\">";
            $html .= "<div class=\"col-1 text-center\">{$item['id']}</div>";
            $html .= "<div class=\"col-5\">{$indent}{$item['__data'][$langId]['name']}</div>";
            $html .= "<div class=\"col-2 edit-ban-delete justify-content-center\">{$banDeleteLink}</div>";
            $html .= "<div class=\"col-2 edit-ban-children justify-content-center\">{$banChildrenLink}</div>";
            $html .= "<div class=\"col-2\">";
            $html .= $editLink;
            $html .= !$item['ban_children'] ? $addLink : '';
            $html .= !$item['ban_delete'] ? $delLink : '';
            $html .= "</div></div>";
            if (isset($item['children']) && $item['children']) :
                $html .= self::treeAsHtmlList($cType, $item['children'], $item['id'], $level);
            endif;
            $html .= "</li>";
        endforeach;
        $html .= "</ul>";

        return $html;
    }
}
