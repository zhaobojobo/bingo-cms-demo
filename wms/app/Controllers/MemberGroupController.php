<?php

namespace Admin\Controllers;

use Admin\Helper;
use App\Member\MemberGroup;
use Exception;

/**
 * Class MemberGroupController
 *
 * @package Admin\Controllers
 */
class MemberGroupController extends BaseController
{
    public $permission = 'MEMBER';

    public $function   = 'member';

    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $model = $this->model(MemberGroup::class);
        $this->assign(['list' => $model->findAll('')]);

        return $this->render('member-group/index');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $this->checkPermission('MEMBER.EDIT');
        $model = $this->model(MemberGroup::class);

        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
        }
        $this->assign(['row' => $row]);

        return $this->render('member-group/edit');
    }

    public function save()
    {
        $this->checkPermission('MEMBER.EDIT');
        $id    = Helper::post('id');
        $model = $this->model(MemberGroup::class);
        if ($id) {
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, '/member-groups/');
    }

    public function delete()
    {
        $this->checkPermission('MEMBER.DELETE');
        $model = $this->model(MemberGroup::class);
        $ret   = $model->remove(Helper::post('id'));
        $this->action('Delete');
        $this->success($ret);
    }
}
