<?php

namespace Admin\Controller;

use Admin\Helper;
use Admin\Controllers\BaseController;
use App\Exceptions\PermissionException;
use App\Domain\Permission\Role\RoleFinder;
use App\Domain\Permission\Access\AccessFinder;
use App\Domain\Permission\Permission\PermissionFinder;
use App\Domain\Permission\Permission\PermissionUpdater;
use App\Domain\Permission\Permission\PermissionCreator;
use App\Infrastructure\Domain\Permission\Role\PdoRoleFinderRepository;
use App\Infrastructure\Domain\Permission\Access\PdoAccessFinderRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionFinderRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionUpdaterRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionCreatorRepository;

class PermissionController extends BaseController
{
    public function edit($role_id)
    {
        if($_SESSION['user']['role_id'] == $role_id) {
            throw new PermissionException(Helper::_('No permission'));
        }
        Helper::checkPermission('roles-grant');
        $permissionRepository = new PdoPermissionFinderRepository($this->c['pdo']);
        $permissionService    = new PermissionFinder($permissionRepository);

        $roleRepository = new PdoRoleFinderRepository($this->c['pdo']);
        $roleService    = new RoleFinder($roleRepository);
        $role           = $roleService->findOneOfId($role_id);
        $this->assign(['role' => $role]);

        $accessRepository = new PdoAccessFinderRepository($this->c['pdo']);
        $accessService    = new AccessFinder($accessRepository);
        $accesses         = $accessService->findAll();
        foreach ($accesses as $i => $access) {
            $permission = $permissionService->findOneOfAccess($access->getId(), $_SESSION['user']['role_id']);
            if ($permission && !$permission->getStatus()) {
                unset($accesses[$i]);
            } else {
                $accesses[$i]->permission = $permissionService->findOneOfAccess($access->getId(), $role->getId());
            }
        }
        $accesses = $accessService::toTree($accesses);
        $this->assign(['accesses' => $accesses]);

        echo $this->render('permission/edit');
    }

    public function save()
    {
        Helper::checkPermission('roles-grant');
        $role_id     = Helper::post('role_id');
        $permissions = Helper::post('permissions');

        $permissionCreatorRepository = new PdoPermissionCreatorRepository($this->c['pdo']);
        $permissionCreatorService    = new PermissionCreator($permissionCreatorRepository);

        $permissionFinderRepository = new PdoPermissionFinderRepository($this->c['pdo']);
        $permissionFinderService    = new PermissionFinder($permissionFinderRepository);

        $permissionUpdaterRepository = new PdoPermissionUpdaterRepository($this->c['pdo']);
        $permissionUpdaterService    = new PermissionUpdater($permissionUpdaterRepository);

        $accessRepository = new PdoAccessFinderRepository($this->c['pdo']);
        $accessService    = new AccessFinder($accessRepository);
        $accesses         = $accessService->findAll();

        foreach ($accesses as $access) {
            $data       = [
                'role_id'   => $role_id,
                'access_id' => $access->getId(),
            ];
            $permission = $permissionFinderService->findOneOfAccess($access->getId(), $role_id);
            if ($permission) {
                if (isset($permissions[$access->getId()])) {
                    $permissionUpdaterService->on($data);
                } else {
                    $permissionUpdaterService->off($data);
                }
            } elseif (isset($permissions[$access->getId()])) {
                $data['status'] = 1;
                $permissionCreatorService->create($data);
            } else {
                $data['status'] = 0;
                $permissionCreatorService->create($data);
            }
        }

        $this->success([], '/roles');
    }
}
