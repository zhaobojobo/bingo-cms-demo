<?php

namespace Admin\Models;

use Admin\Data;
use App\Exceptions\NormalException;
use Admin\Helper;
use App\Register;

/**
 * Class Nav
 *
 * @package Admin\Models
 */
class Nav extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'nav';
        $this->idField = 'id';
        $this->data    = new Data('nav_data', 'nav_id');
    }

    /**
     * @param $list
     * @param int $level
     *
     * @return string
     */
    public static function treeAsHtmlList($list, $level = -1)
    {
        $html = '';
        $html .= '<ul class="list-unstyled menu-list sortable">';
        $level++;
        $indent = '';
        if ($level > 0) {
            $indent = '├' . str_repeat('─', $level);
        }
        $c      = Register::get('container');
        foreach ($list as $item) :
            $html .= "<li data-id=\"" . $item['id'] . "\">";
            $html .= "<div class=\"row no-gutters\">";
            $html .= "<div class=\"col-1 text-center\">{$item['id']}</div>";
            $html .= "<div class=\"col-9\">{$indent}{$item['__data'][DEFAULT_LANG]['text']}</div>";
            $html .= "<div class=\"col-2\">";
            $html .= "<a class=\"button-gray bingo_button icon_button\" title=\""
                . Helper::_('Edit') . "\" href=\""
                . Helper::getUrl(
                    '/nav/edit/' . $item['menu_id'] . '/'
                    . $item['id']
                ) . "\">";
            $html .= "<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>";
            $html .= "</a>";
            $html .= "<a class=\"button-gray bingo_button icon_button delete\" title=\""
                . Helper::_('Delete') . "\" href=\""
                . Helper::getUrl('/nav/delete') . "\" data-id=\""
                . $item['id'] . "\">";
            $html .= "<i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i>";
            $html .= "</a></div></div>";
            if (isset($item['children']) && $item['children']) :
                $html .= self::treeAsHtmlList($item['children'], $level);
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
        if (!$data['type']) {
            throw new NormalException(Helper::_('Please select 「Type」'));
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        if (isset($data['parent_id'])) {
            $data['parent_id'] = intval($data['parent_id']);
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
}
