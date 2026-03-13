<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\SubscriberGroup;
use Exception;

/**
 * Class SubscriberGroupController
 *
 * @package Admin\Controllers
 */
class SubscriberGroupController extends BaseController
{
    public $permission = 'SUBSCRIBER';

    public $function   = 'subscriber';

    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $model = $this->model(SubscriberGroup::class);
        $this->assign(['list' => $model->findAll('')]);

        return $this->render('subscriber-group/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $this->checkPermission('SUBSCRIBER.EDIT');
        $model = $this->model(SubscriberGroup::class);

        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
        }
        $this->assign(['row' => $row]);

        return $this->render('subscriber-group/edit');
    }

    public function save()
    {
        $this->checkPermission('SUBSCRIBER.EDIT');
        $id    = Helper::post('id');
        $model = $this->model(SubscriberGroup::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, '/subscriber-groups/');
    }

    public function delete()
    {
        $this->checkPermission('SUBSCRIBER.DELETE');
        $model = $this->model(SubscriberGroup::class);
        $ret   = $model->remove(Helper::post('id'));
        $this->action('Delete');
        $this->success($ret);
    }
}
