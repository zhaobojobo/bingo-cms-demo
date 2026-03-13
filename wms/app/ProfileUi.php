<?php

namespace Admin;

use App\Register;

/**
 * Class ProfileUi
 *
 * @package Admin
 */
class ProfileUi
{
    /**
     * @param $fields
     *
     * @return array
     */
    protected static function normalizeAllFields($fields)
    {
        $result = [];
        foreach ($fields as $i => $field) {
            $__data = $field['__data'];
            unset($field['__data']);
            $_data = $__data[DEFAULT_LANG];
            $_data['langId'] = 'all';
            $result[$i] = array_merge($field, $_data);
        }

        return $result;
    }

    /**
     * @param $fields
     *
     * @return array
     */
    protected static function normalizeLangFields($fields)
    {
        $result = [];
        foreach ($fields as $i => $field) {
            $__data = $field['__data'];
            unset($field['__data']);
            foreach ($__data as $langId => $_data) {
                $_data['label'] = $__data[DEFAULT_LANG]['label'];
                if (isset($field['value'])) {
                    $_data['value'] = $field['value'][$langId];
                } else {
                    $_data['value'] = $__data[DEFAULT_LANG]['default'];
                }
                $result[$langId][$i] = array_merge($field, $_data);
            }
        }

        return $result;
    }

    /**
     * @param $field
     * @param $langId
     * @param $value
     *
     * @return string
     */
    protected static function renderField($field, $langId, $value)
    {
        switch ($field['type']) {
            case 'input':
                $html = Ui::inputText($field, $langId, $value ?: '');
                break;
            case 'textarea':
                $html = Ui::textarea($field, $langId, $value ?: '');
                break;
            case 'textarea.editor':
                $html = Ui::textareaEditor($field, $langId, $value ?: '');
                break;
            case 'file':
                $html = Ui::fileSelect($field, $langId, $value ?: '');
                break;
            case 'video':
                $html = Ui::videoSelect($field, $langId, $value ?: '');
                break;
            case 'image':
                $html = Ui::imageSelect($field, $langId, $value ?: '');
                break;
            case 'images':
                $html = Ui::imagesSelect($field, $langId, $value ?: '');
                break;
            case 'input.number':
                $html = Ui::inputNumber($field, $langId, $value ?: '');
                break;
            case 'input.email':
                $html = Ui::inputEmail($field, $langId, $value ?: '');
                break;
            case 'input.url':
                $html = Ui::inputUrl($field, $langId, $value ?: '');
                break;
            case 'input.range':
                $html = Ui::inputRange($field, $langId, $value ?: '');
                break;
            case 'input.datetime':
                $html = Ui::inputDataTime($field, $langId, $value ?: '');
                break;
            case 'input.date':
                $html = Ui::inputData($field, $langId, $value ?: '');
                break;
            case 'input.time':
                $html = Ui::inputTime($field, $langId, $value ?: '');
                break;
            case 'input.color':
                $html = Ui::inputColor($field, $langId, $value ?: '');
                break;
            case 'input.checkbox':
                $html = Ui::inputCheckbox($field, $langId, $value ?: 0);
                break;
            case 'list':
                $html = Ui::list($field, $langId, $value ?: 0);
                break;
            case 'data.fragment':
                $html = Ui::link($field, $langId, $value ?: 0);
                break;
            case 'input.radio':
            case 'fieldset':
            case 'fieldset.list':
            case 'input.select':
                break;
        }

        return $html;
    }

    /**
     * @param      $fields
     * @param bool $lang
     *
     * @return array|string
     */
    public static function render($fields)
    {
        $fields = self::normalizeAllFields($fields);
        return self::renderFields($fields, 'all');
    }

    /**
     * @param      $fields
     * @param bool $lang
     *
     * @return array|string
     */
    public static function renderLang($fields)
    {
        $view = [];
        $fields = self::normalizeLangFields($fields);
        foreach ($fields as $langId => $_fields) {
            $view[$langId] = self::renderFields($_fields, $langId);
        }

        return $view;
    }

    /**
     * @param $fields
     * @param $langId
     *
     * @return string
     */
    protected static function renderFields($fields, $langId)
    {
        $inputs = [];
        foreach ($fields as $field) {
            $inputs[] = self::renderField($field, $langId, $field['value'] ?? $field['default']);
        }

        return implode("\n", $inputs);
    }
}
