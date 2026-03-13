<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Form;
use Admin\Models\FormField;
use Exception;
use LogicException;

/**
 * Class FormController
 *
 * @package Admin\Controllers
 */
class FormController extends BaseController
{
    public $permission = 'FORM';

    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        Helper::checkPermission('form-index');
        $model    = $this->model(Form::class);
        $page     = intval(Helper::get('p', 1));
        $pageData = $model->findPage($page, 10);
        $this->assign(['pageData' => $pageData]);

        return $this->render('form/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        Helper::checkPermission('form-edit');
        $model = $this->model(Form::class);
        $row = $model->init();
        if ($id) {
            $row         = $model->find($id);
            $activity_id = $row['activity_id'];
        } else {
            $activity_id = Helper::get('activity_id', 0);
        }
        $this->assign(['row' => $row]);
        $this->assign(['activity_id' => $activity_id]);
        $cname = '';
        if ($id == 0 && $activity_id) {
            $cname = 'activity_' . $activity_id;
        }
        $this->assign(['cname' => $cname]);

        return $this->render('form/edit');
    }

    public function save()
    {
        Helper::checkPermission('form-edit');
        $id    = Helper::post('id');
        $model = $this->model(Form::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }

        $this->success($ret, '/forms/');
    }

    public function delete()
    {
        Helper::checkPermission('form-delete');
        $model = $this->model(Form::class);
        $this->action('Delete');
        $id    = Helper::post('id');
        $field = $this->model(FormField::class);
        $field->deleteAll($id);
        $this->success($model->remove($id));
    }

    public function batchDelete()
    {
        $model = $this->model(Form::class);

        $ids = $_POST['ids'];
        try {
            foreach ($ids as $id) {
                $model->remove($id);
            }
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        $this->success(true, '/forms/');
    }

    /**
     * @param $id
     */
    public function html($id)
    {
        $model = $this->model(Form::class);
        $this->success($model->html($id));
    }
}
