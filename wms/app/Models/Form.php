<?php

namespace Admin\Models;

use Admin\Data;

/**
 * Class Form
 *
 * @package Admin\Models
 */
class Form extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->table   = 'form';
        $this->idField = 'id';
        $this->data    = new Data('form_data', 'form_id');
    }

    /**
     * @param int $page
     * @param int $size
     * @param string $where
     * @param array $params
     * @param string $sort
     * @return array
     */
    public function findPage($page, $size, $where = '', $params = [], $sort = SORT_ORDER_DESC)
    {
        $model    = new Submission();
        $pageData = parent::findPage($page, $size, $where, $params, $sort);
        foreach ($pageData['rows'] as $i => $row) {
            $pageData['rows'][$i]->submit_count = $model->getCount($row->id);
        }
        return $pageData;
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
     * @return array
     */
    public function html($id)
    {
        $forms = [];
        foreach ($this->c['config']['site']['lang']['languages'] as $langId => $language) {
            $forms[$langId] = $this->htmlOfLang($id, $langId);
        }

        return $forms;
    }

    /**
     * @param $id
     * @param $langId
     *
     * @return string
     */
    public function htmlOfLang($id, $langId)
    {
        $form       = $this->find($id);
        $action     = sprintf('<?= url(\'/form/%s\') ?>', $id);
        $btnText    = $form['__data'][$langId]['submit_btn_text'];
        $fieldModel = new FormField();
        $fields     = $fieldModel->findAll("form_id={$id}", [], SORT_ORDER_ASC);
        $rows       = [];
        $rows[]     = '<form action="' . $action . '" method="post">';
        foreach ($fields as $field) {
            $rows[$field['name']] = FormField::html($field, $langId);
        }
        $rows[] = '<button type="button" class="btn btn-primary">' . $btnText
            . '</button>';
        $rows[] = '</form>';
        foreach ($rows as &$row) {
            $row = htmlspecialchars($row);
        }

        return trim(implode("\n", $rows));
    }
}
