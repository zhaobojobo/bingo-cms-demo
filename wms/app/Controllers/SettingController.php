<?php

namespace Admin\Controllers;

use Admin\Helper;
use App\Setting;

class SettingController extends BaseController
{
    public function edit($file): string
    {
        $model = new Setting('system');
        $system = $model->getValues();
        $model = new Setting($file);
        $settings = $model->getSettings();
        $data = [
            'languages'        => $system['LANGUAGE']['LANGUAGES'],
            'language_default' => $system['LANGUAGE']['LANGUAGE_DEFAULT'],
            'settings'         => $settings,
            'file'             => $file
        ];
        $this->assign($data);
        return $this->render('setting/edit');
    }

    public function save($file)
    {
        $model = new Setting($file);
        $post = Helper::post();
        $model->saveSettings($post);
        $this->success();
    }

    public function emailTest()
    {
        $post = Helper::post();
        try {
            if (!$post['address']) {
                throw new \Exception('請輸入收件地址');
            }
            if (!Helper::isEmail($post['address'])) {
                throw new \Exception('收件地址錯誤');
            }
            if (!$post['subject']) {
                throw new \Exception('請輸入郵件主題');
            }
            if (!$post['body']) {
                throw new \Exception('請輸入郵件內容');
            }
            Helper::mail([$post['address']], ['subject' => $post['subject'], 'body' => $post['body']]);
            $this->success();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
