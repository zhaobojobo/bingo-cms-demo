<?php


namespace Admin\Controller;


use Admin\Helper;
use Admin\Controllers\BaseController;
use App\Domain\Permission\Role\RoleFinder;
use App\Domain\Permission\Role\RoleDeleter;
use App\Domain\Permission\Role\RoleUpdater;
use App\Domain\Permission\Role\RoleCreator;
use App\Domain\Permission\Agency\AgencyFinder;
use App\Infrastructure\Domain\Permission\Role\PdoRoleFinderRepository;
use App\Infrastructure\Domain\Permission\Role\PdoRoleDeleterRepository;
use App\Infrastructure\Domain\Permission\Role\PdoRoleUpdaterRepository;
use App\Infrastructure\Domain\Permission\Role\PdoRoleCreatorRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyFinderRepository;

class RoleController extends BaseController
{
    public function index()
    {
        Helper::checkPermission('roles-index');
        $repository = new PdoRoleFinderRepository($this->c['pdo']);
        $service    = new RoleFinder($repository);

        $self  = $service->findOneOfId($_SESSION['user']['role_id']);
        $roles = $service->findDescendants($_SESSION['user']['role_id']);

        $agencies    = [];
        $repository2 = new PdoAgencyFinderRepository($this->c['pdo']);
        $service2    = new AgencyFinder($repository2);
        foreach ($roles as $i => $role) {
            $agency                   = $service2->findOneOfId($role->getAgencyId());
            $agencies[$role->getId()] = $agency ? $agency->getName() : '';
        }
        $this->assign(['agencies' => $agencies]);

        $roles = RoleFinder::toTree($roles, $self ? $self->getId() : 0);
        $roles = RoleFinder::flattenedTree($roles);
        $this->assign(['objects' => $roles]);
        echo $this->render('role/index');
    }

    public function add()
    {
        Helper::checkPermission('roles-add');

        $repository = new PdoRoleFinderRepository($this->c['pdo']);
        $service    = new RoleFinder($repository);

        $self  = $service->findOneOfId($_SESSION['user']['role_id']);
        $parents = $service->findDescendants($_SESSION['user']['role_id']);
        if ($self) {
            array_unshift($parents, $self);
        }
        $parents = RoleFinder::toTree($parents, $self ? $self->getPid() : 0);
        $parents = RoleFinder::flattenedTree($parents);

        $this->assign(['self' => $self]);
        $this->assign(['parents' => $parents]);

        // 機構列表
        $repository2 = new PdoAgencyFinderRepository($this->c['pdo']);
        $service2    = new AgencyFinder($repository2);
        $agencies    = $service2->findAll();
        $agencies    = AgencyFinder::toTree($agencies);
        $agencies    = AgencyFinder::flattenedTree($agencies);
        $this->assign(['agencies' => $agencies]);

        echo $this->render('role/add');
    }

    public function create()
    {
        Helper::checkPermission('roles-add');
        $data       = Helper::post();
        $repository = new PdoRoleCreatorRepository($this->c['pdo']);
        $service    = new RoleCreator($repository);
        $id         = $service->create($data);
        $this->success(['id' => $id], '/roles');
    }

    public function edit($id)
    {
        Helper::checkPermission('roles-edit');
        $repository = new PdoRoleFinderRepository($this->c['pdo']);
        $service    = new RoleFinder($repository);

        $self  = $service->findOneOfId($_SESSION['user']['role_id']);
        $parents = $service->findDescendants($_SESSION['user']['role_id']);
        if ($self) {
            array_unshift($parents, $self);
        }
        $parents = RoleFinder::toTree($parents, $self ? $self->getPid() : 0);
        $parents = RoleFinder::flattenedTree($parents);

        $this->assign(['self' => $self]);
        $this->assign(['parents' => $parents]);

        // 機構列表
        $repository2 = new PdoAgencyFinderRepository($this->c['pdo']);
        $service2    = new AgencyFinder($repository2);
        $agencies    = $service2->findAll();
        $agencies    = AgencyFinder::toTree($agencies);
        $agencies    = AgencyFinder::flattenedTree($agencies);
        $this->assign(['agencies' => $agencies]);

        $role = $service->findOneOfId($id);
        $this->assign(['object' => $role]);
        echo $this->render('role/edit');
    }

    public function update()
    {
        Helper::checkPermission('roles-edit');
        $data       = Helper::post();
        $repository = new PdoRoleUpdaterRepository($this->c['pdo']);
        $service    = new RoleUpdater($repository);
        $count      = $service->update($data);
        $this->success(['count' => $count], '/roles');
    }

    public function delete()
    {
        Helper::checkPermission('roles-delete');
        $id         = Helper::post('id');
        $repository = new PdoRoleDeleterRepository($this->c['pdo']);
        $service    = new RoleDeleter($repository);
        $count      = $service->delete($id);
        $this->success(['count' => $count], '/roles');
    }
}