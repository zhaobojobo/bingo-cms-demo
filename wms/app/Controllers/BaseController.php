<?php

namespace Admin\Controllers;

use Admin\Controller;
use App\Exceptions\NormalException;
use Admin\Helper;
use Admin\Models\Page;
use App\Domain\Permission\Access\AccessFinder;
use App\Domain\Permission\Permission\PermissionFinder;
use App\Infrastructure\Domain\Permission\Access\PdoAccessFinderRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionFinderRepository;
use App\Setting;

/**
 * Class BaseController
 *
 * @package Admin\Controllers
 */
class BaseController extends Controller
{
    public $user      = null;

    public $function  = '';

    public $constants = [];

    public $langDefault;

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
        $constants         = [
            'USER'        => $this->user,
            'LANG_ID'     => $this->c['currentLang'],
            'LANGUAGES'   => $this->c['config']['lang']['languages'],
            'PATHS'       => $this->c['config']['paths'],
            'PARAMS'      => $this->c['config']['params'],
            'SITE'        => $this->c['config']['site'],
            'SHORTCUTS'   => $this->model(Page::class)->shortcuts(),
        ];
        $constants['LANG'] = $constants['LANGUAGES'][$constants['LANG_ID']]['code'];
        $this->constants   = $constants;
        $this->assign($constants, false);

        $permissionRepository = new PdoPermissionFinderRepository($this->c['pdo']);
        $permissionService    = new PermissionFinder($permissionRepository);
        $repository           = new PdoAccessFinderRepository($this->c['pdo']);
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
        $menus = AccessFinder::toTree($menus);
        $this->assign(['menus' => $menus]);
    }

    protected function checkLogin()
    {
        if (! Helper::hasLogin()) {
            if ($this->c['uri'] != '/login') {
                $this->redirect('/login');
            }
        } else {
            if ($this->c['uri'] == '/login') {
                $this->redirect('/');
            }
            $this->user = $_SESSION['user'];
        }
    }

    /**
     * @param $ret
     * @param $change
     * @param $location
     */
    protected function notice($ret, $review, $location)
    {
        $message = Helper::_('The data has been saved.');
        if (! $review) {
            $message = Helper::_(
                <<<'NOTICE'
Since the administrator has set the protection of terrorism, before the article is displayed, it needs to be approved by the administrator; the system has notified the administrator through email, and it will be processed as soon as possible, hard work!
NOTICE
            );
        }
        $this->success($ret, $location, $message);
    }

    /**
     * @param $permission
     */
    protected function checkPermission($permission)
    {
        if ($permission && ! Helper::hasPermission($permission)) {
            throw new NormalException(Helper::_('No Permission'));
        }
    }
}
