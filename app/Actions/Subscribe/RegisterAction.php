<?php

namespace Site\Actions\Subscribe;

use Site\Action;
use Site\Helper;
use Site\Models\Subscriber;

class RegisterAction extends Action
{
    public function __invoke()
    {
        $email = Helper::post('email');
        $model = new Subscriber();
        try {
            $model->register($email);
            return $this->success(null, '驗證郵件已發送至您的郵箱, 請點擊郵件中的鏈接確認訂閱!');
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
