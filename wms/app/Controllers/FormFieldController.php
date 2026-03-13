<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\FormField;
use Exception;

/**
 * Class FormFieldController
 *
 * @package Admin\Controllers
 */
class FormFieldController extends BaseController
{
    public $permission = 'FORM';

    /**
     * @param $fid
     *
     * @return false|string
     * @throws Exception
     */
    public function index($fid)
    {
        Helper::checkPermission('form-fields');
        $model = $this->model(FormField::Class);
        $data  = $model->findAll("form_id={$fid}", [], SORT_ORDER_DESC);
        $list  = FormField::rendList($data, $fid);
        $this->assign(['list' => $list, 'fid' => $fid,]);

        return $this->render('form-field/index');
    }

    public function sort()
    {
        $model = $this->model(FormField::Class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $this->success($model->sort($sorts));
    }

    /**
     * @param     $fid
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($fid, $id = 0)
    {
        $model = $this->model(FormField::Class);
        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
        }
        $this->assign(['row' => $row]);
        $this->assign(['fid' => $fid,]);

        return $this->render('form-field/edit');
    }

    public function save()
    {
        $id    = Helper::post('id');
        $model = $this->model(FormField::Class);
        if (! isset($_POST['required'])) {
            $_POST['required'] = 0;
        }
        if (! isset($_POST['disabled'])) {
            $_POST['disabled'] = 0;
        }
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }

        $this->success(
            $ret,
            sprintf("/form-fields/%s", Helper::post('form_id'))
        );
    }

    public function delete()
    {
        $model = $this->model(FormField::Class);
        $this->action('Delete');
        $this->success($model->remove(Helper::post('id')));
    }
}
