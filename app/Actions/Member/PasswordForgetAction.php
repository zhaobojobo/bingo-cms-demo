<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class PasswordForgetAction extends Action
{
    public function __invoke()
    {
        if (Helper::isPost()) {
            $data = [
                'method' => Helper::post('method'),
                'username' => Helper::post('username'),
                'code' => Helper::post('code')
            ];
            $model = new Member();
            try {
                $model->verifyCode($data['code']);
                $url = $model->getResetPasswordUrl();
                return $this->success(null, '', $url);
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        } else {
            return $this->render(['member/password-forget']);
        }
    }
}
