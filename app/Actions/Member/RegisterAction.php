<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class RegisterAction extends Action
{
    public function __invoke()
    {
        if (Helper::isPost()) {
            $data = Helper::post();
            $model = new Member();
            try {
                $model->register($data);
                return $this->success([], '註冊成功，請登錄！', Helper::getUrl('/member/login'));
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        } else {
            if (isLogin()) {
                $this->redirect(Helper::getUrl('/member/'));
            }
            $register = $_SESSION['register'] ?? [];
            $this->view->addData(['register' => $register]);
            return $this->render(['member/register']);
        }
    }
}
