<?php


namespace Admin\Controller;


use Admin\Helper;
use Admin\Controllers\BaseController;
use App\Domain\Permission\Agency\AgencyFinder;
use App\Domain\Permission\Agency\AgencyCreator;
use App\Domain\Permission\Agency\AgencyUpdater;
use App\Domain\Permission\Agency\AgencyDeleter;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyFinderRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyCreatorRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyUpdaterRepository;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyDeleterRepository;

class AgencyController extends BaseController
{
    public function index()
    {
        Helper::checkPermission('agencies-index');
        $repository = new PdoAgencyFinderRepository($this->c['pdo']);
        $service    = new AgencyFinder($repository);
        $agencies   = $service->findAll();
        $agencies   = AgencyFinder::toTree($agencies);
        $agencies   = AgencyFinder::flattenedTree($agencies);
        $this->assign(['objects' => $agencies]);
        echo $this->render('agency/index');
    }

    public function add()
    {
        Helper::checkPermission('agencies-add');
        $repository = new PdoAgencyFinderRepository($this->c['pdo']);
        $service    = new AgencyFinder($repository);
        $parents    = $service->findParensSelectedList();
        $this->assign(['parents' => $parents]);
        echo $this->render('agency/add');
    }

    public function create()
    {
        Helper::checkPermission('agencies-add');
        $data       = Helper::post();
        $repository = new PdoAgencyCreatorRepository($this->c['pdo']);
        $service    = new AgencyCreator($repository);
        $id         = $service->create($data);
        $this->success(['id' => $id], '/agencies');
    }

    public function edit($id)
    {
        Helper::checkPermission('agencies-edit');
        $repository = new PdoAgencyFinderRepository($this->c['pdo']);
        $service    = new AgencyFinder($repository);
        $parents    = $service->findParensSelectedList();
        $this->assign(['parents' => $parents]);
        $agency = $service->findOneOfId($id);
        $this->assign(['object' => $agency]);
        echo $this->render('agency/edit');
    }

    public function update()
    {
        Helper::checkPermission('agencies-edit');
        $data       = Helper::post();
        $repository = new PdoAgencyUpdaterRepository($this->c['pdo']);
        $service    = new AgencyUpdater($repository);
        $count      = $service->update($data);
        $this->success(['count' => $count], '/agencies');
    }

    public function delete()
    {
        Helper::checkPermission('agencies-delete');
        $id         = Helper::post('id');
        $repository = new PdoAgencyDeleterRepository($this->c['pdo']);
        $service    = new AgencyDeleter($repository);
        $count      = $service->delete($id);
        $this->success(['count' => $count], '/agencies');
    }
}