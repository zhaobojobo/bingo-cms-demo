<?php

namespace Site\Models;

use Site\Helper;

class Subscriber extends Base
{
    public function __construct()
    {
        parent::__construct('subscriber', 'id');
    }

    public function register($email)
    {
        if (!preg_match('/^[.\w]+@[-a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', $email)) {
            throw new \Exception('請輸入正確的電子郵件地址');
        }

        $exist = $this->findOne('email=:email', ['email' => $email]);
        $hash = md5($email . time());
        if ($exist) {
            $data = [
                'hash' => $hash,
                'register_time' => date('Y-m-d H:i'),
            ];
            if ($exist['confirm']) {
                throw new \Exception('您已經訂閱過本站, 無需重復提交!');
            }
            $this->update($data, $exist['id']);
        } else {
            $data = [
                'email' => $email,
                'hash' => $hash,
                'register_time' => date('Y-m-d H:i'),
            ];
            $this->create($data);
        }
        // Send mail
        $link = Helper::getSiteUrl() . '/subscribe/confirm?hash=' . $hash;
        $title = '訂閱確認';
        $body = <<<SUBCRIBE_EMAIL
        <p>請點擊一下鏈接確認訂閱:</p>
        <p><a target="_blank" href="{$link}">{$link}</a></p>
SUBCRIBE_EMAIL;

        Helper::mail([$email], ['subject' => $title, 'body' => $body]);
    }

    public function confirm($hash)
    {
        $exist = $this->findOne('hash=:hash', ['hash' => $hash]);
        if (!$exist) {
            throw new \Exception('鏈接已失效, 請重新提交訂閱申請!');
        } else {
            $data = [
                'hash' => md5(time()),
                'confirm' => 1
            ];
            $this->update($data, $exist['id']);
        }
    }
}