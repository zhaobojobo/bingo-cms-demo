<?php

namespace Admin\Controllers;

use Admin\DataObject;
use Admin\Helper;
use Admin\Models\User;
use Exception;
use App\Exceptions\PermissionException;
use App\Domain\Permission\Role\RoleFinder;
use App\Domain\Permission\Agency\AgencyFinder;
use App\Infrastructure\Domain\Permission\Role\PdoRoleFinderRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyFinderRepository;

/**
 * Class UserController
 *
 * @package Admin\Controllers
 */
class UserController extends BaseController
{
    public $permission = 'ACCOUNT';

    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        Helper::checkPermission('users-index');

        $repository1 = new PdoRoleFinderRepository($this->c['pdo']);
        $service1    = new RoleFinder($repository1);
        $roles       = $service1->findDescendants($_SESSION['user']['role_id']);
        $roleIds = [0];
        foreach ($roles as $role) {
            $roleIds[] = $role->getId();
        }

        $model = $this->model(User::class);
        $p     = intval(Helper::get('p', 1));
        $where = $_SESSION['user']['id'] != 1 ? 'id<>1' : '1';
        if($roleIds) {
            $where .= " AND role_id IN(" . implode(',', $roleIds) . ")";
        }
        $where = sprintf('(%s) OR %s', $where, 'id = '. $_SESSION['user']['id']);

        $data = $model->findPage($p, 10, $where);

        $repository2 = new PdoAgencyFinderRepository($this->c['pdo']);
        $service2    = new AgencyFinder($repository2);

        foreach ($data['rows'] as $i => $user) {
            $data['rows'][$i]['role']   = $service1->findOneOfId($user['role_id']);
            $data['rows'][$i]['agency'] = $service2->findOneOfId($user['agency_id']);
        }

        $this->assign(['pageData' => $data]);

        return $this->render('user/index');
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function user()
    {
        $model = $this->model(User::class);
        $user  = $model->find($_SESSION['user']['id']);
        $this->assign(['row' => new DataObject($user)]);

        return $this->render('user/user');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $model       = $this->model(User::class);
        $row         = [];
        if ($id) {
            $row = $model->find($id);
            Helper::checkPermission('users-edit');
            $row = $model->outputFilter($row);
        } else {
            Helper::checkPermission('users-add');
        }
        $row = new DataObject($row);
        $this->assign(['row' => $row]);

        //获取角色列表
        $repository = new PdoRoleFinderRepository($this->c['pdo']);
        $service    = new RoleFinder($repository);
        $roles      = $service->findDescendants($this->user['role_id']);
        $self       = $service->findOneOfId($this->user['role_id']);
        $roles = RoleFinder::toTree($roles, $self ? $self->getId() : 0);
        $roles = RoleFinder::flattenedTree($roles);
        $this->assign(['roles' => $roles]);

        // 機構列表
        $repository2 = new PdoAgencyFinderRepository($this->c['pdo']);
        $service2    = new AgencyFinder($repository2);
        $agencies    = $service2->findAll();
        $agencies    = AgencyFinder::toTree($agencies);
        $agencies    = AgencyFinder::flattenedTree($agencies);
        $this->assign(['agencies' => $agencies]);

        return $this->render('user/edit');
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function password($id = 0)
    {
        Helper::checkPermission('users-password');
        if ($id == 1 && ! Helper::isSuper()) {
            throw new PermissionException(Helper::_('No permission'));
        }
        $model = $this->model(User::class);
        if ($id) {
            $row = $model->find($id);
            $this->assign(['row' => $row]);
        }

        return $this->render('user/password');
    }

    public function savePassword()
    {
        Helper::checkPermission('users-password');
        $id = Helper::post('id');
        if ($id == 1 && ! Helper::isSuper()) {
            throw new PermissionException(Helper::_('No permission'));
        }
        $model = $this->model(User::class);

        $_POST['update_time'] = date('Y-m-d H:i:s');

        $ret = $model->password($_POST, $id);
        $this->action('Chang password');
        $this->success($ret, '/users/');
    }

    public function save()
    {
        Helper::checkPermission('users-edit');
        $id = Helper::post('id');
        if ($id == 1 && ! Helper::isSuper()) {
            throw new PermissionException(Helper::_('No permission'));
        }
        $model = $this->model(User::class);
        if ($id) {
            Helper::checkPermission('users-edit');
            $_POST['update_time'] = date('Y-m-d H:i:s');
            $this->action('Update');
            if ($id == 1) {
                $_POST['role_id'] = 0;
            }
            $ret = $model->update($_POST, $id);
        } else {
            Helper::checkPermission('users-add');
            $_POST['create_time'] = date('Y-m-d H:i:s');
            $_POST['update_time'] = date('Y-m-d H:i:s');
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, '/users/');
    }

    public function delete()
    {
        Helper::checkPermission('users-delete');
        $id = Helper::post('id');
        if ($id == 1) {
            throw new PermissionException(Helper::_('No permission'));
        }
        $model = $this->model(User::class);
        $ret   = $model->remove($id);
        $this->action('Delete');
        $this->success($ret);
    }

    public function reviewers($type)
    {
        $model     = $this->model(User::class);
        $reviewers = $model->getReviewers($type . '-review');
        $html      = $this->render('acl-reviewers', ['reviewers' => $reviewers]);
        $this->success(['html' => $html]);
    }

    public function editors($type)
    {
        $model   = $this->model(User::class);
        $editors = $model->getReviewers($type . '-edit');
        $html    = $this->render('acl-editors', ['editors' => $editors]);
        $this->success(['html' => $html]);
    }
}
