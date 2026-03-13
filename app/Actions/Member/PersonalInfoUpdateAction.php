<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class PersonalInfoUpdateAction extends Action
{
    public function __invoke()
    {
        $data = [
            'name' => Helper::post('name', ''),
            'phone' => Helper::post('phone', ''),
            'email' => Helper::post('email', ''),
            'area' => Helper::post('area', ''),
            'address' => Helper::post('address', ''),
        ];
        $model = new Member();
        try {
            $model->updatePersonalInfo($data, $_SESSION['member']['id']);
            return $this->success();
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $model->errors());
        }
    }
}
