<?php

namespace Site\Actions;

use Site\Action;
use Site\Captcha;

class CaptchaAction extends Action
{
    public function __invoke()
    {
        $captcha = new Captcha();
        $captcha->output();
    }
}