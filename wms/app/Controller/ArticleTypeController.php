<?php


namespace Admin\Controller;


use Admin\Helper;
use Admin\Controllers\BaseController;
use App\Domain\ArticleType\ArticleTypeFinder;
use App\Domain\ArticleType\ArticleTypeCreator;
use App\Domain\ArticleType\ArticleTypeUpdater;
use App\Domain\ArticleType\ArticleTypeDeleter;
use App\Infrastructure\Domain\ArticleType\PdoArticleTypeFinderRepository;
use App\Infrastructure\Domain\ArticleType\PdoArticleTypeCreatorRepository;
use App\Infrastructure\Domain\ArticleType\PdoArticleTypeUpdaterRepository;
use App\Infrastructure\Domain\ArticleType\PdoArticleTypeDeleterRepository;

class ArticleTypeController extends BaseController
{
    public function index()
    {
        Helper::checkPermission('type-index');
        $repository = new PdoArticleTypeFinderRepository($this->c['pdo']);
        $service    = new ArticleTypeFinder($repository);
        $types   = $service->findAll();
        $this->assign(['objects' => $types]);
        echo $this->render('article-type/index');
    }

    public function add()
    {
        Helper::checkPermission('type-add');
        echo $this->render('article-type/add');
    }

    public function create()
    {
        Helper::checkPermission('type-add');
        $data       = Helper::post();
        $repository = new PdoArticleTypeCreatorRepository($this->c['pdo']);
        $service    = new ArticleTypeCreator($repository);
        $id         = $service->create($data);
        $this->success(['id' => $id], '/system/types');
    }

    public function edit($id)
    {
        Helper::checkPermission('type-edit');
        $repository = new PdoArticleTypeFinderRepository($this->c['pdo']);
        $service    = new ArticleTypeFinder($repository);
        $type = $service->findOneOfId($id);
        $this->assign(['object' => $type]);
        echo $this->render('article-type/edit');
    }

    public function update()
    {
        Helper::checkPermission('type-edit');
        $data       = Helper::post();
        $repository = new PdoArticleTypeUpdaterRepository($this->c['pdo']);
        $service    = new ArticleTypeUpdater($repository);
        $count      = $service->update($data);
        $this->success(['count' => $count], '/system/types');
    }

    public function delete()
    {
        Helper::checkPermission('type-delete');
        $id         = Helper::post('id');
        $repository = new PdoArticleTypeDeleterRepository($this->c['pdo']);
        $service    = new ArticleTypeDeleter($repository);
        $count      = $service->delete($id);
        $this->success(['count' => $count], '/system/types');
    }
}