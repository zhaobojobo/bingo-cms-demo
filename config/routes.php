<?php

/**
 * @param RouteCollector $r
 */

use FastRoute\RouteCollector;

return function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/member[/]', 'Site\Actions\Member\HomeAction');
    $r->addRoute(['GET', 'POST'], '/member/login', 'Site\Actions\Member\LoginAction');
    $r->addRoute(['GET', 'POST'], '/member/register', 'Site\Actions\Member\RegisterAction');

    $r->addRoute('POST', '/subscribe/register', 'Site\Actions\Subscribe\RegisterAction');
    $r->addRoute('GET', '/subscribe/confirm', 'Site\Actions\Subscribe\ConfirmAction');

    $r->addRoute('POST', '/form/{id}', 'Site\Actions\FormAction');
    $r->addRoute('GET', '/captcha.jpg', 'Site\Actions\CaptchaAction');
    $r->addRoute('GET', '/search', 'Site\Actions\SearchAction');
    $r->addRoute('GET', '/error', 'Site\Actions\ErrorAction');

    $r->addRoute('GET', '/preview/{type:page|post|activity}/{id:.+}', 'Site\Actions\PreviewAction');
    $r->addRoute('GET', '/{path:[-\/\w]+}', 'Site\Actions\FrontAction');
    $r->addRoute('GET', '/', 'Site\Actions\HomeAction');
};
