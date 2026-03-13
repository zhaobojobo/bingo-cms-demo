<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;

class HomeAction extends Action
{
    public function __invoke(): string
    {
        if (!isLogin()) {
            $this->redirect(Helper::getUrl('/member/login'));
        }

        $this->view->addData(['member' => $_SESSION['member']]);
        return $this->render(['member/home']);
    }
}
