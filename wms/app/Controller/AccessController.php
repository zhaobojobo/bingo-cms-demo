<?php


namespace Admin\Controller;

use Admin\Helper;
use Admin\Controllers\BaseController;
use App\Domain\Permission\Access\AccessFinder;
use App\Domain\Permission\Access\AccessCreator;
use App\Domain\Permission\Access\AccessUpdater;
use App\Domain\Permission\Access\AccessDeleter;
use App\Infrastructure\Domain\Permission\Access\PdoAccessFinderRepository;
use App\Infrastructure\Domain\Permission\Access\PdoAccessCreatorRepository;
use App\Infrastructure\Domain\Permission\Access\PdoAccessUpdaterRepository;
use App\Infrastructure\Domain\Permission\Access\PdoAccessDeleterRepository;

class AccessController extends BaseController
{
    public function index()
    {
        $repository = new PdoAccessFinderRepository($this->c['pdo']);
        $service    = new AccessFinder($repository);
        $accesses   = $service->findAll();
        $accesses   = AccessFinder::toTree($accesses);
        // $accesses   = AccessFinder::flattenedTree($accesses);
        $this->assign(['objects' => $accesses]);
        echo $this->render('access/index');
    }

    public function add()
    {
        $repository = new PdoAccessFinderRepository($this->c['pdo']);
        $service    = new AccessFinder($repository);
        $parents    = $service->findParensSelectedList();
        $this->assign(['parents' => $parents]);
        echo $this->render('access/add');
    }

    public function create()
    {
        $data       = Helper::post();
        $repository = new PdoAccessCreatorRepository($this->c['pdo']);
        $service    = new AccessCreator($repository);
        $id         = $service->create($data);
        $this->success(['id' => $id], '/accesses');
    }

    public function edit($id)
    {
        $repository = new PdoAccessFinderRepository($this->c['pdo']);
        $service    = new AccessFinder($repository);
        $parents    = $service->findParensSelectedList();
        $this->assign(['parents' => $parents]);
        $access = $service->findOneOfId($id);
        $this->assign(['object' => $access]);
        echo $this->render('access/edit');
    }

    public function update()
    {
        $data       = Helper::post();
        $repository = new PdoAccessUpdaterRepository($this->c['pdo']);
        $service    = new AccessUpdater($repository);
        $count      = $service->update($data);
        $this->success(['count' => $count], '/accesses');
    }

    public function delete()
    {
        $id         = Helper::post('id');
        $repository = new PdoAccessDeleterRepository($this->c['pdo']);
        $service    = new AccessDeleter($repository);
        $count      = $service->delete($id);
        $this->success(['count' => $count], '/accesses');
    }

    public function sorts()
    {
        $sorts      = Helper::post('sorts');
        $repository = new PdoAccessUpdaterRepository($this->c['pdo']);
        $service    = new AccessUpdater($repository);
        $count      = $service->sorts($sorts);
        $this->success(['count' => $count]);
    }
}