<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Field;
use Admin\Models\Model;
use Exception;

/**
 * Class FieldController
 *
 * @package Admin\Controllers
 */
class FieldController extends BaseController
{
    /**
     * @param $model_id
     *
     * @return false|string
     * @throws Exception
     */
    public function index($model_id)
    {
        $model = $this->model(Field::class);
        $rows = $model->findAll("model_id={$model_id}", [], SORT_ORDER_DESC);
        $this->assign(['rows' => $rows, 'model_id' => $model_id]);

        return $this->render('field/index');
    }

    public function sort()
    {
        $model = $this->model(Field::class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $ret = $model->sort($sorts);
        $this->success($ret);
    }

    /**
     * @param     $model_id
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($model_id, $id = 0)
    {
        $Model = $this->model(Model::class);
        $model = $Model->find($model_id);

        $this->assign(['model_id' => $model_id, 'model' => $model]);

        $fieldModel = $this->model(Field::class);
        $row = $fieldModel->init();
        if ($id) {
            $row = $fieldModel->find($id);
        }

        $this->assign(['row' => $row]);

        return $this->render('field/edit');
    }

    /**
     * @param     $model_id
     * @param int $id
     */
    public function modify($model_id, $id = 0)
    {
        $Model = $this->model(Model::class);
        $model = $Model->find($model_id);

        $this->assign(['model_id' => $model_id, 'model' => $model]);

        $fieldModel = $this->model(Field::class);
        $row = $fieldModel->init();
        if ($id) {
            $row = $fieldModel->find($id);
        }

        $this->assign(['row' => $row, 'type' => $model->type]);

        $ret = $this->render('field/modify');
        $this->success($ret);
    }

    /**
     * @param     $model_id
     * @param int $id
     */
    public function modify2($model_id, $id = 0)
    {
        $Model = $this->model(Model::class);
        $model = $Model->find($model_id);

        $this->assign(['model_id' => $model_id, 'model' => $model]);

        $fieldModel = $this->model(Field::class);
        $row = $fieldModel->init();
        if ($id) {
            $row = $fieldModel->find($id);
        }

        $this->assign(['row' => $row, 'type' => $model->type]);

        $ret = $this->render('field/modify2');
        $this->success($ret);
    }

    public function keep()
    {
        $this->checkPermission('MODEL.EDIT');
        $id = Helper::post('id');
        $model = $this->model(Field::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret);
    }

    public function save()
    {
        $this->checkPermission('MODEL.EDIT');
        $id = Helper::post('id');
        $model = $this->model(Field::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, sprintf("/fields/%s", Helper::post('model_id')));
    }

    public function delete()
    {
        $this->checkPermission('MODEL.DELETE');
        $model = $this->model(Field::class);
        $ret = $model->remove(Helper::post('id'));
        $this->action('Delete');
        $this->success($ret);
    }
}
