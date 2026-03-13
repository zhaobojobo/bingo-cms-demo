<?php

namespace Site\Actions\Member;

use Site\Action;
use Site\Helper;
use Site\Models\Member;

class LoginAction extends Action
{
    public function __invoke()
    {
        unset($_SESSION['register']);
        if (Helper::isPost()) {
            $data = Helper::post();
            $backUrl = $data['backUrl'] ?? '';
            $backUrl = $backUrl ?: Helper::getUrl('/member/');
            unset($data['backUrl']);
            $model = new Member();
            try {
                $model->login($data);
                return $this->success(null, '登入成功', $backUrl);
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        } else {
            if (isLogin()) {
                $this->redirect(Helper::getUrl('/member/'));
            }
            $backUrl = Helper::get('backUrl', '');
            $this->view->addData([
                'page' => [],
                'seo'  => [
                    'title'       => '會員登入',
                    'keywords'    => '',
                    'description' => '',
                ]
            ]);
            $this->view->addData(['backUrl' => $backUrl]);
            return $this->render(['member/login']);
        }
    }
}
