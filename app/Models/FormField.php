<?php

namespace Site\Models;

use Site\Data;
use Site\Exceptions\NormalException;
use Site\Helper;
use App\Register;

/**
 * Class FormField
 *
 * @package Admin\Models
 */
class FormField extends Base
{
    public function __construct()
    {
        parent::__construct('form_field', 'id');
        $this->data = new Data('form_field_data', 'form_field_id');
    }

    /**
     * @param $list
     * @param $fid
     *
     * @return string
     */
    public static function rendList($list, $fid)
    {
        $html   = '';
        $html   .= '<ul class="list-unstyled menu-list sortable">';
        $c      = Register::get('container');
        $langId = $c['config']['site']['lang']['defaultLang'];
        foreach ($list as $item) :
            $input  = Helper::_($c['config']['params']['front_input_types'][$item->input]);
            $length = $item->min . ' ~ ' . $item->max;
            if (
            !in_array(
                $item->input,
                ['input', 'textarea', 'input.email', 'input.url']
            )
            ) {
                $length = Helper::_('Not applicable');
            }
            $item->required = $item->required ? Helper::_('Yes')
                : Helper::_('No');
            $item->disabled = $item->disabled ? Helper::_('Yes')
                : Helper::_('No');
            $html           .= "<li data-id=\"" . $item->id . "\">";
            $html           .= "<div class=\"row no-gutters\">";
            $html           .= "<div class=\"col-1 justify-content-center\">{$item->id}</div>";
            $html           .= "<div class=\"col-2\"><span>{$item->name}</span><button class=\"d-none\" type=\"button\" data-toggle=\"modal\" data-target=\"#edit-title-modal\" data-id=\"{$item->id}\" data-lang=\"{$langId}\"></button></div>";
            $html           .= "<div class=\"col-2\">{$input}</div>";
            $html           .= "<div class=\"col-3\">{$item->__data[$langId]->label}</div>";
            $html           .= "<div class=\"col-1 justify-content-center\">{$item->required}</div>";
            $html           .= "<div class=\"col-1 justify-content-center\">{$item->disabled}</div>";
            $html           .= "<div class=\"col-2\">";
            $html           .= "<a class=\"button-gray bingo_button icon_button\" title=\""
                . Helper::_('Edit') . "\" href=\"" .
                Helper::getUrl('/form-field/edit/' . $fid . '/' . $item->id) . "\">";
            $html           .= "<i class=\"fa fa-fw fa-pencil\" aria-hidden=\"true\"></i>";
            $html           .= "</a>";
            $html           .= "<a class=\"button-gray bingo_button icon_button delete\" title=\""
                . Helper::_('Delete') . "\" href=\""
                . Helper::getUrl('/form-field/delete') . "\" data-id=\"" . $item->id . "\">";
            $html           .= "<i class=\"fa fa-fw fa-trash-o\" aria-hidden=\"true\"></i>";
            $html           .= "</a>";
            $html           .= "</div></div>";
            $html           .= "</li>";
        endforeach;
        $html .= "</ul>";

        return $html;
    }

    /**
     * @param $field
     * @param $langId
     *
     * @return string
     */
    public static function html($field)
    {
        $html        = '';
        $name        = $field['name'];
        $id          = $field['name'] . '-' . $field['lang'];
        $label       = $field['label'];
        $placeholder = $field['placeholder'];
        $tip         = '';
        if ($field['tip']) {
            $tip = "\n" . '<small id="emailHelp" class="form-text text-muted">' . $field['tip'] . '</small>';
        }

        switch ($field['input']) {
            case 'input':
                $html = <<<INPUT
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="text" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
INPUT;
                break;

            case 'input.number':
                $html = <<<NUMBER
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="number" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
NUMBER;
                break;
            case 'input.email':
                $html = <<<EMAIL
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="email" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
EMAIL;
                break;
            case 'input.url':
                $html = <<<URL
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="url" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
URL;
                break;
            case 'input.datetime':
                $html = <<<DATETIME
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="datetime-local" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
DATETIME;
                break;
            case 'input.date':
                $html = <<<DATE
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="date" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
DATE;
                break;
            case 'input.time':
                $html = <<<TIME
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="time" class="form-control" id="{$id}" name="{$name}" placeholder="{$placeholder}">{$tip}
</div>
TIME;
                break;
            case 'textarea':
                $html = <<<TEXTAREA
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <textarea class="form-control" id="{$id}" name="{$name}" rows="3" placeholder="{$placeholder}"></textarea>{$tip}
</div>
TEXTAREA;

                break;
            case 'file':
                $html = <<<FILE
<div class="form-group col-lg-{$field['col']}">
    <label for="{$id}">{$label}</label>
    <input type="file" class="form-control-file" id="{$id}" name="{$name}">{$tip}
</div>
FILE;

                break;
            case 'input.checkbox':
                $html = <<<CHECKBOX
<div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="{$id}" name="{$name}">
    <label class="form-check-label" for="{$id}">{$label}</label>
</div>
CHECKBOX;

                break;
            default:
        }

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
        if ($scenes == 'create' && !$data['name']) {
            throw new NormalException(Helper::_('「Field Name」 is required'));
        }
        if (!$data['input']) {
            throw new NormalException(Helper::_('「Input Control」 is required'));
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
        if (isset($data['captcha'])) {
            $captcha = intval($data['captcha']);
            if ($captcha > 5 || $captcha < 0) {
                $captcha = 0;
            }
            $data['captcha'] = $captcha;
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

    public function deleteAll($fid)
    {
        $fields = $this->findAll("form_id={$fid}");
        foreach ($fields as $field) {
            $this->remove($field['id']);
        }
    }
}
