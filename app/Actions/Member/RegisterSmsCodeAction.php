<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class RegisterSmsCodeAction extends Action
{
    public function __invoke()
    {
        $phone = Helper::post('phone', '');
        $model = new Member();
        try {
            $result = $model->sendSmsCode($phone);
            return $this->success($result, '驗證碼已發送');
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), $model->errors());
        }
    }
}
