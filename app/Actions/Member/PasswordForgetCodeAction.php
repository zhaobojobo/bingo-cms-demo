<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class PasswordForgetCodeAction extends Action
{
    public function __invoke()
    {
        $data = [
            'field' => Helper::post('field', 'phone'),
            'username' => Helper::post('username', '')
        ];
        $model = new Member();
        try {
            $result = $model->sendVerifyCode($data);
            return $this->success($result, '驗證碼已發送');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $model->errors());
        }
    }
}
