<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Menu;
use Exception;

/**
 * Class MenuController
 *
 * @package Admin\Controllers
 */
class MenuController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        Helper::checkPermission('menu-index');
        $model = $this->model(Menu::class);
        $this->assign(['list' => $model->findAll()]);

        return $this->render('menu/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        Helper::checkPermission('menu-edit');
        $model = $this->model(Menu::class);
        $row   = $model->init();
        if ($id) {
            $row = $model->find($id);
        }
        $this->assign(['row' => $row]);

        return $this->render('menu/edit');
    }

    public function save()
    {
        Helper::checkPermission('menu-edit');
        $id    = Helper::post('id');
        $model = $this->model(Menu::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, '/menus/');
    }

    public function delete()
    {
        Helper::checkPermission('menu-delete');
        $id = Helper::post('id');
        $model = $this->model(Menu::class);
        $ret   = $model->remove($id);
        $this->action('Delete');
        $this->success($ret);
    }
}
