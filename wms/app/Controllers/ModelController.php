<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Model;
use Admin\Ui;
use Exception;

/**
 * Class ModelController
 *
 * @package Admin\Controllers
 */
class ModelController extends BaseController
{

    public $permission = 'MODEL';

    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $model = $this->model(Model::class);
        $data  = Helper::listAsTree($model->findAll());
        $data  = Model::toArray($data);
        //        print_r($data);exit;
        $this->assign(['list' => Helper::treeAsList($data)]);

        return $this->render('model/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $this->checkPermission('MODEL.EDIT');
        $model  = $this->model(Model::class);
        $groups = $this->c['config']['params']['model_groups'];
        $row    = $model->init();
        if ($id) {
            $row    = $model->find($id);
            $filter = function ($v, $k) use ($row) {
                return $k == $row['group'];
            };
            $groups = array_filter($groups, $filter, ARRAY_FILTER_USE_BOTH);
        }
        $this->assign(['groups' => $groups]);
        $this->assign(['row' => $row]);

        return $this->render('model/edit');
    }

    public function parents()
    {
        $id      = Helper::post('id');
        $group   = Helper::post('group');
        $model   = $this->model(Model::class);
        $parents = $model->findAll("`group`='{$group}' AND parent_id=0");
        //        print_r($parents);
        $view = Ui::parentOptions($parents, $this->c['currentLang']);
        if ($id) {
            $row  = $model->find($id);
            $view = Ui::parentOptions($parents, $this->c['currentLang'], $row['parent_id'], $row['id']);
        }
        $this->success($view);
    }

    public function save()
    {
        $this->checkPermission('MODEL.EDIT');
        $id    = Helper::post('id');
        $model = $this->model(Model::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            if ($_POST['parent_id']) {
                $_POST['tab'] = 'C';
            }
            $this->action('Create');
            $ret = $model->create($_POST);
            $model->createDefaultModel($ret['id']);
        }
        $this->success($ret, '/models/');
    }

    public function delete()
    {
        $this->checkPermission('MODEL.DELETE');
        $model = $this->model(Model::class);
        $ret   = $model->remove(Helper::post('id'), true);
        $this->action('Delete');
        $this->success($ret);
    }
}
