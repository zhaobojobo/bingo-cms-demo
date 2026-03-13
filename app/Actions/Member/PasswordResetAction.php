<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class PasswordResetAction extends Action
{
    public function __invoke()
    {
        if (Helper::isPost()) {
            $data = [
                'hash' => Helper::post('hash', md5(time())),
                'password' => Helper::post('password'),
                'password_repeat' => Helper::post('password_repeat')
            ];
            $model = new Member();
            try {
                $model->resetPassword($data);
                return $this->success(null, '密碼已更改, 請重新登入', Helper::getUrl('/member/login'));
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        } else {
            $model = new Member();
            $hash = Helper::get('hash');
            $this->view->addData(['verify' => $model->verifyCodeHash($hash)]);
            return $this->render(['member/password-reset']);
        }
    }
}
