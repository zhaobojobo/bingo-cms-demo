<?php

namespace Site\Actions\Subscribe;

use Site\Action;
use Site\Helper;
use Site\Models\Subscriber;

class ConfirmAction extends Action
{
    public function __invoke(): string
    {
        $hash = Helper::get('hash', md5(time()));
        $model = new Subscriber();

        $page = [
            'title' => '訂閱確認',
            'message' => '確認成功, 感謝您的訂閱!',
            'status' => true,
        ];

        try {
            $model->confirm($hash);
        } catch (\Exception $e) {
            $page['status'] = false;
            $page['message'] = $e->getMessage();
        }

        $this->view->addData(['page' => $page]);
        return $this->render(['subscribe/confirm']);
    }
}
