<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\History;
use Admin\Models\Model;
use Admin\Models\Page;
use Admin\Ui;
use App\Domain\Permission\Agency\AgencyFinder;
use App\Exceptions\BannedException;
use App\Infrastructure\Domain\Permission\Agency\PdoAgencyFinderRepository;
use Exception;

/**
 * Class PageController
 *
 * @package Admin\Controllers
 */
class PageController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        Helper::checkPermission('page-index');

        $model = $this->model(Page::class);
        $review = Helper::get('review');
        $where = !is_null($review) ? "review={$review}" : '';
        $pages = Helper::listAsTree($model->findAll($where, [], SORT_ORDER_DESC));
        $this->assign(['pages' => $pages]);

        // 機構
        $repository = new PdoAgencyFinderRepository($this->c['pdo']);
        $service = new AgencyFinder($repository);
        $agencies = $service->findAll();
        $agencies = AgencyFinder::toTree($agencies);
        $agencies = AgencyFinder::flattenedTree($agencies);
        $this->assign(['agencies' => $agencies]);

        return $this->render('page/index');
    }

    public function sort()
    {
        Helper::checkPermission('pages-sort');

        $model = $this->model(Page::class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $ret = $model->sort($sorts);
        $this->success($ret);
    }

    /**
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($id = 0)
    {
        $model = $this->model(Page::class);

        $parents = $model->findAll('', [], SORT_ORDER_DESC);
        $parent_id = Helper::get('parent_id', 0);
        $parent = $model->find($parent_id);
        if ($parent) {
            if ($parent['ban_children']) {
                throw new BannedException(Helper::_('Operation has been disabled'));
            }
            $parents = [$parent];
        }

        $contentModel = null;
        $template = 'page';
        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
            Helper::checkPermission('page-edit');
            $template = $row['template'];
            if ($hid = Helper::get('hid', 0)) {
                $row = $model->history($hid, $row);
            }
            $contentModel = $this->model(Model::class)->findOne(
                "type='page' AND parent_id=0 AND content_id={$row['id']}"
            );
        } else {
            Helper::checkPermission('page-add');
        }
        $data = [
            'root_id' => $parent ? $parent['parent_id'] : 0,
            'parents' => $parents,
            'parent_id' => $parent_id,
            'model_id' => $contentModel ? $contentModel['id'] : 0,
            'row' => $row,
            'template' => $template,
        ];

        return $this->render('page/edit', $data);
    }

    public function save()
    {
        $id = Helper::post('id', 0);
        $model = $this->model(Page::class);

        if (!$_POST['slug']) {
            $this->error('请输入网址');
        }

        $slug = Helper::formatSlug($_POST['slug']);

        if (Helper::slugExists($slug, $id)) {
            $this->error('网址已存在，请重新输入');
        }

        $_POST['slug'] = $slug;

        if ($id) {
            Helper::checkPermission('page-edit');
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            Helper::checkPermission('page-add');
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        if (!Helper::get('preview', 0)) {
            $change = $model->saveHistory($ret, 'page');
            if ($change) {
                $review = intval(Helper::hasPermission('page-review'));
                $model->updateStatus(['review' => $review], $ret['id']);
            }
        }
        $this->success($ret, '/pages/');
    }

    public function find($id)
    {
        $model = $this->model(Page::class);
        $row = $model->find($id);

        $this->success($row);
    }

    public function grantAgencies()
    {
        Helper::checkPermission('page-grant-agencies');
        $id = Helper::post('id');
        $agencies = Helper::post('agencies', []);
        $agencies = implode(',', $agencies);
        $model = $this->model(Page::class);
        $ret = $model->update(['agencies' => $agencies], $id);
        $this->success($ret);
    }

    public function grantReviewers()
    {
        Helper::checkPermission('page-grant-reviewers');
        $id = Helper::post('id');
        $reviewers = Helper::post('reviewers', []);
        $reviewers = implode(',', $reviewers);
        $model = $this->model(Page::class);
        $ret = $model->update(['reviewers' => $reviewers], $id);
        $this->success($ret);
    }

    public function grantEditors()
    {
        Helper::checkPermission('page-grant-editors');
        $id = Helper::post('id');
        $editors = Helper::post('editors', []);
        $editors = implode(',', $editors);
        $model = $this->model(Page::class);
        $ret = $model->update(['editors' => $editors], $id);
        $this->success($ret);
    }

    /**
     * @param $id
     *
     * @return false|string
     * @throws Exception
     */
    public function detail($id)
    {
        $model = $this->model(Page::class);
        $data = $model->find($id);
        $this->assign(['data' => $data]);

        return $this->render('page/view');
    }

    public function delete()
    {
        Helper::checkPermission('page-delete');
        $model = $this->model(Page::class);
        $page = $model->find(Helper::post('id'));
        if ($page['ban_delete']) {
            throw new BannedException(Helper::_('Operation has been disabled'));
        }
        $ret = $model->remove(Helper::post('id'), true);
        $this->action('Delete');
        $this->success($ret);
    }

    public function title($id)
    {
        $model = $this->model(Page::class);
        $row = $model->find($id);
        Helper::checkPermission('page-title-edit');
        $ret = $model->updateTitle($_POST, $id);
        $this->notice($ret, $model->saveHistory($ret, 'page'), '.');
    }

    public function copy($id)
    {
        $model = $this->model(Page::class);
        Helper::checkPermission('page-copy');
        $ret = $model->copy($id);
        $this->success($ret);
    }

    /**
     * @param $id
     */
    public function slug($id)
    {
        $model = $this->model(Page::class);
        $row = $model->find($id);
        Helper::checkPermission('page-slug-edit');
        $this->success($model->updateSlug($_POST, $id));
    }

    /**
     * @param $id
     */
    public function hidden($id)
    {
        Helper::checkPermission('page-hidden');
        $model = $this->model(Page::class);
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $id
     */
    public function shortcut($id)
    {
        Helper::checkPermission('page-shortcut');
        $model = $this->model(Page::class);
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $id
     */
    public function banDelete($id)
    {
        Helper::checkPermission('page-delete-disable');
        $model = $this->model(Page::class);
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $id
     */
    public function banChildren($id)
    {
        Helper::checkPermission('page-subpage-disable');
        $model = $this->model(Page::class);
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $id
     */
    public function review($id)
    {
        Helper::checkPermission('page-review');
        $model = $this->model(Page::class);
        $row = $model->find($id);
        Helper::checkReviewPermission('page-review', $row);
        $ret = $model->updateStatus($_POST, $id);
        if ($ret['review']) {
            $model->setCache($ret);
        }
        $this->success($ret);
    }

    /**
     * @param $id
     */
    public function preview($id)
    {
        Helper::checkPermission('page-preview');
        $model = $this->model(Page::class);
        $page = $model->find($id);
        $url = '/preview/page/' . ($page['slug'] ?: $page['id']);
        $key = md5($url . time());
        setcookie('PREVIEW_KEY', $key, 0, '/preview/page');
        $this->json($url . '?key=' . $key);
    }

    /**
     * @param $id
     */
    public function histories($id)
    {
        $model = $this->model(Page::class);
        $post = $model->find($id);
        $histModel = $this->model(History::class);
        $histories = $histModel->histories($post, 'page');
        $options = ['' => Helper::_('Latest')];
        foreach ($histories as $history) {
            $options[$history['id']] = $history['time'];
        }
        $value = $_SESSION['hid'] ?? '';
        die(Ui::options($options, $value, false));
    }
}
