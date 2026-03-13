<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Action;
use Exception;

/**
 * Class ActionController
 *
 * @package Admin\Controllers
 */
class ActionController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $model    = $this->model(Action::class);
        $p        = intval(Helper::get('p', 1));
        $pageData = $model->findPage($p, 10);
        $this->assign(['pageData' => $pageData]);

        return $this->render('action/index');
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function loginLogs()
    {
        $model    = $this->model(Action::class);
        $p        = intval(Helper::get('p', 1));
        $pageData = $model->findPage($p, 10, "action='Login'");
        $this->assign(['pageData' => $pageData]);

        return $this->render('action/index');
    }
}
