<?php


namespace Admin\Controllers;


use Admin\Helper;
use Admin\Models\SystemSetting;

class SystemSettingController extends BaseController
{
    public function edit()
    {
        $model    = $this->model(SystemSetting::class);
        $rows = $model->findAll();
        $settings = [];
        foreach ($rows as $i => $row) {
            $settings[$row['name']] = json_decode($row['value'], true);
            $settings[$row['name']]['public'] = $row['public'];
        }

        $this->assign(['settings' => $settings]);

        return $this->render('system-setting/edit');
    }

    public function save()
    {
        $model = $this->model(SystemSetting::class);
        $data  = Helper::post();
        foreach ($data as $name => $value) {
            $public = 0;
            if (isset($value['public'])) {
                $public = $value['public'];
                unset($value['public']);
            }
            $value   = json_encode($value);
            $setting = $model->findOne('name=:name', ['name' => $name]);
            if ($setting) {
                $model->update(['value' => $value, 'public' => $public], $setting['id']);
            } else {
                $model->create(['name' => $name, 'value' => $value, 'public' => $public]);
            }
        }
        $this->success();
    }
}