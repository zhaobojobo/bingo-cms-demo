<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class LogoutAction extends Action
{
    public function __invoke()
    {
        $model = new Member();
        if (Helper::isPost()) {
            try {
                if (isLogin()) {
                    $model->logout();
                }
                return $this->success(null, '', Helper::getUrl('/member/'));
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        } else {
            if (isLogin()) {
                $model->logout();
            }
            $this->redirect(Helper::getUrl('/member/'));
        }
    }
}
