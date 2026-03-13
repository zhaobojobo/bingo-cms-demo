<?php

declare(strict_types=1);

namespace Admin\Controller;

use Admin\Helper;
use Admin\Models\Page;
use App\Domain\Permission\Access\AccessFinder;
use App\Domain\Permission\Permission\PermissionFinder;
use App\Infrastructure\Domain\Permission\Access\PdoAccessFinderRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionFinderRepository;
use League\Plates\Engine;
use Pimple\Container;

class Controller
{
    protected Container $container;
    protected Engine $view;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->checkLogin();
        $this->view = new Engine($this->container['config']['paths']['views']);
        $this->view->addData(['constants' => $this->getConstants()]);
        $this->view->addData(['user' => $this->user]);
        $this->view->addData(['menus' =>  $this->getMenu()]);
    }

    public function redirect($location)
    {
        header('Location: ' . Helper::getUrl($location));
        exit;
    }

    protected function checkLogin()
    {
        if (! Helper::hasLogin()) {
            if ($this->container['uri'] != '/login') {
                $this->redirect('/login');
            }
        } else {
            if ($this->container['uri'] == '/login') {
                $this->redirect('/');
            }
            $this->user = $_SESSION['user'];
        }
    }

    public function getConstants(){
        $constants         = [
            'LANG_ID'     => $this->container['currentLang'],
            'LANGUAGES'   => $this->container['config']['lang']['languages'],
            'PATHS'       => $this->container['config']['paths'],
            'PARAMS'      => $this->container['config']['params'],
            'SITE'        => $this->container['config']['site'],
            'SHORTCUTS'   => (new Page())->shortcuts(),
        ];
        $constants['LANG'] = $constants['LANGUAGES'][$constants['LANG_ID']]['code'];

        return $constants;
    }

    public function getMenu()
    {
        $permissionRepository = new PdoPermissionFinderRepository($this->container['pdo']);
        $repository           = new PdoAccessFinderRepository($this->container['pdo']);
        $permissionService    = new PermissionFinder($permissionRepository);
        $service              = new AccessFinder($repository);
        $menus                = $service->findAllOfLinkable();

        if ($this->user && $this->user['role_id']) {
            foreach ($menus as $i => $access) {
                $permission = $permissionService->findOneOfAccess($access->getId(), $this->user['role_id']);
                if (! $permission || ! $permission->getStatus()) {
                    unset($menus[$i]);
                }
            }
        }

        return AccessFinder::toTree($menus);
    }
}
