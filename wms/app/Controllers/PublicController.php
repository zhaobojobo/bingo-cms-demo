<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\User;
use Exception;

/**
 * Class PublicController
 *
 * @package Admin\Controllers
 */
class PublicController extends BaseController
{

    /**
     * @return false|string
     * @throws Exception
     */
    public function login()
    {
        if (Helper::isPost()) {
            $model = $this->model(User::class);
            $ret = $model->login($_POST);
            $this->action('Login');
            $this->success($ret, '/');
        }
        $this->assign(['sites' => $this->c['config']['sites']]);

        return $this->render('public/login');
    }

    /**
     * @param $langId
     */
    public function language($langId)
    {
        $languages = $this->c['config']['lang']['languages'];
        if (array_key_exists($langId, $languages)) {
            setcookie('userLang', $langId, time() + 86400 * 365, SUB_DIR . '/wms/');
        }
        $this->json($langId);
    }
}
