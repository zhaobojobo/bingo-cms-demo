<?php

namespace Site\Models;

use Exception;
use Site\Captcha;
use Site\Data;
use Site\Helper;
use Site\Uploader;

/**
 * Class Form
 *
 * @package Admin\Models
 */
class Form extends Base
{
    public function __construct()
    {
        parent::__construct('form', 'id');
        $this->data = new Data('form_data', 'form_id');
    }

    /**
     * @param int $page
     * @param int $size
     * @param string $where
     * @param array $params
     * @param string $sort
     *
     * @return array
     */
    public function findPage($page, $size, $where = '', $params = [], $sort = ''): array
    {
        $model = new Submission();
        $pageData = parent::findPage($page, $size, $where, $params, $sort);
        foreach ($pageData['rows'] as $i => $row) {
            $pageData['rows'][$i]->submit_count = $model->getCount($row->id);
        }

        return $pageData;
    }

    public function find($id)
    {
        if (is_numeric($id)) {
            return parent::find($id);
        } else {
            return $this->findOne('cname=:cname', ['cname' => $id]);
        }
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data): array
    {
        $data = $this->validate($data, 'create');
        $data = $this->inputFilter($data);

        return parent::create($data);
    }

    /**
     * @param        $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, string $scenes = 'all')
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
    public function update($data, $id): array
    {
        $data = $this->validate($data, 'update');
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    /**
     * @param $form
     * @return string
     */
    public function html($form): string
    {
        $form_id = $form['id'];
        $action = url('/form');
        $btnText = $form['submit_btn_text'];
        $fieldModel = new FormField();
        $fields = $fieldModel->findAll("form_id=:form_id", ['form_id' => $form_id], 'sort');
        $rows = [];
        $rows[] = '<h3 class="form-title">' . $form['title'] . '</h3>';
        $rows[] = '<p class="form-desc">' . $form['description'] . '</p>';
        $rows[] = '<form action="' . $action . '" method="post" enctype="multipart/form-data">';
        $rows[] = '<div class="form-row">';
        foreach ($fields as $field) {
            $rows[$field['name']] = FormField::html($field);
        }
        $rows[] = '</div>';
        if ($form['captcha']) {
            $rows[] = '<div class="form-row">';
            $rows[] = '<div class="form-inline mb-3">';
            $rows[] = '<div class="form-group">';
            $rows[] = '<input type="text" name="captcha" class="form-control" maxlength="4" autocomplete="off"
                        placeholder="' . Helper::_('CAPTCHA') . '"
                        style="text-align:center;width:150px;font-weight: bolder;letter-spacing: 5px">';
            $rows[] = '</div>';
            $rows[] = '<div class="form-group ml-3">';
            $rows[] = '<img src="' . Helper::getUrl(
                    '/captcha.jpg'
                ) . '" alt="captcha" onclick="this.src=\'/captcha.jpg?s=\' + Math.random();">';
            $rows[] = '</div>';
            $rows[] = '</div>';
            $rows[] = '</div>';
        }

        $rows[] = '<div class="form-group form-submit">';
        $rows[] = '<input type="hidden" name="id" value="' . $form_id . '">';
        $rows[] = '<button type="button" class="btn btn-primary submit">' . $btnText . '</button>';
        $rows[] = '</div>';
        $rows[] = '</form>';

        return trim(implode("\n", $rows));
    }

    public function email($val): bool
    {
        // 使用 filter_var 函数验证电子邮件地址
        return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function phone($val): bool
    {
        return preg_match('/^\d{7,20}$/', $val) === 1;
    }

    /**
     * @param $form
     * @return mixed
     * @throws Exception
     */
    public function submit($form)
    {
        $post = Helper::post();

        if (!$form) {
            throw new Exception(Helper::_('The submission parameter is wrong, and the form information is not found'));
        }

        $fieldModel = new FormField();
        $where = "form_id=:form_id AND disabled=:disabled";
        $params = ['form_id' => $form['id'], 'disabled' => 0];
        $fields = $fieldModel->findAll($where, $params, 'sort DESC');

        // 驗證表單
        foreach ($fields as $field) {
            if (!$field['disabled']) {
                if ($field['required']) {
                    if ($field['input'] == 'file') {
                        if (empty($_FILES[$field['name']])) {
                            throw new Exception(Helper::_('「%s」 is required', [$field['label']]));
                        }
                    } else {
                        if (!isset($post[$field['name']]) || $post[$field['name']] == '') {
                            $label = $field['label'] ?: $field['placeholder'];
                            throw new Exception(Helper::_('「%s」 is required', [$label]));
                        }
                    }
                    if ($field['name'] == 'email') {
                        if (!$this->email($post['email'])) {
                            throw new Exception(Helper::_('Require 「%s」 to be in legal format.', ['Email']));
                        }
                    }
                    if ($field['name'] == 'phone') {
                        if (!$this->phone($post['phone'])) {
                            throw new Exception(
                                Helper::_('The 「%s」 must be a valid 7-20 digit numeric value', ['Phone'])
                            );
                        }
                    }
                }
            }
        }

        // 上傳附件
        $attachments = [];
        foreach ($fields as $i => $field) {
            if (!$field['disabled']) {
                if ($field['input'] == 'file') {
                    if (isset($_FILES[$field['name']])) {
                        $file = $this->upload($field['name']);
                        $post[$field['name']] = $file;
                        $attachment = ROOT . '/data/uploads/' . $file;
                        if (file_exists($attachment)) {
                            $attachments[] = $attachment;
                        }
                    }
                }
            }
        }

        if ($form['captcha'] == 'an') {
            if (!isset($post['captcha'])) {
                throw new Exception(Helper::_('The form is missing the captcha field'));
            }
            $captcha = $post['captcha'];
            unset($post['captcha']);
            if (!Captcha::verify($captcha)) {
                throw new Exception(Helper::_('CAPTCHA input error'));
            }
        } elseif ($form['captcha'] == 'grc_v2' || $form['captcha'] == 'grc_v3') {
            $token = Helper::post('g-recaptcha-response', '');
            if (!$token) {
                $token = Helper::post('token', '');
            }
            if (!Helper::reCAPTCHAVerifying($token)) {
                throw new Exception(Helper::_('Google reCAPTCHA verify failed'));
            }
        }

        // 發送郵件
        $emailBody = '';
        if ($form['email']) {
            $title = $form['title'];
            $content = [];
            foreach ($fields as $field) {
                $content[] = sprintf(
                    '<dt>%s: </dt><dd>%s</dd>',
                    $field['label'] ?: $field['placeholder'],
                    $post[$field['name']]
                );
            }
            $emailBody = sprintf("<dl>\n%s\n</dl>\n", implode("\n", $content));
            $email = ['subject' => $title, 'body' => $emailBody];

            Helper::mail([$form['email']], $email, $attachments);
        }

        // 保存
        $submission = new Submission();
        $data = [
            'form_id' => $form['id'],
            'lang' => $this->c['currentLang'],
            'data' => json_encode($post),
            'email_body' => $emailBody,
            'submit_time' => date('Y-m-d H:i:s'),
            'submit_ip' => $_SERVER['REMOTE_ADDR'],
        ];
        $submission->create($data);

        return $form;
    }

    /**
     * @param $fieldName
     *
     * @return bool|string
     * @throws Exception
     */
    public function upload($fieldName)
    {
        $uploader = new Uploader($fieldName);

        return $uploader->upload();
    }
}
