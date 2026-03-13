<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Catalog;
use Admin\Models\CatalogMap;
use Admin\Models\Category;
use Admin\Models\History;
use Admin\Models\Model;
use Admin\Models\Post;
use Admin\Ui;
use App\DataFromExcelSheet;
use App\Domain\ArticleType\ArticleTypeFinder;
use App\Infrastructure\Domain\ArticleType\PdoArticleTypeFinderRepository;
use Exception;
use Gevman\Inflector\Inflector;
use LogicException;

/**
 * Class PostController
 *
 * @package Admin\Controllers
 */
class PostController extends BaseController
{
    public $permission = 'POST';

    /**
     * @param string $type
     *
     * @return string
     * @throws Exception
     */
    public function index($type = '', $cat = 0)
    {
        Helper::checkPermission($type . '-index');

        $model = $this->model(Post::class);
        $model->contentType = $type;

        $where = 1;
        $params = [];
        if ($type) {
            $where .= " AND type=:type";
            $params['type'] = $type;
        }

        $review = Helper::get('review');
        if (!is_null($review)) {
            $where .= " AND review=:review";
            $params['review'] = $review;
        }

        $ids = [];
        if (!$cat) {
            $catModel = new Catalog();
            $catObject = $catModel->findOne('content_type=:content_type AND parent_id=0', ['content_type' => $type]);
            $cat = $catObject ? $catObject->id : 0;
        } else {
            // 目录
            $mapModel = new CatalogMap();
            $ids = $mapModel->contentsId([$cat]);
            $ids = !empty($ids) ? $ids : [0];
        }

        $key = trim(Helper::get('key', ''));
        if ($key) {
            $ids2 = $model->search($key);
            if ($ids2) {
                $ids = array_merge($ids2, $ids);
                $ids = array_unique($ids);
            }
        }

        $inClause = Helper::inClause('id', $ids);
        if ($inClause['where']) {
            $where .= ' AND ' . $inClause['where'];
            $params = array_merge($params, $inClause['params']);
        }

        $sort = Helper::get('sort', '');
        $order = Helper::get('order', '');
        if ($sort && $order) {
            $sort .= ' ' . $order;
        } else {
            $sort = SORT_ORDER_DESC;
        }

        $pageData = $model->findPage(intval(Helper::get('p', 1)), 10, $where, $params, $sort);
        $this->assign(['pageData' => $pageData, 'type' => $type, 'cat' => $cat, 'key' => $key ?? '']);

        return $this->render('post/index');
    }

    /**
     * @param     $type
     * @param int $id
     *
     * @return string
     * @throws Exception
     */
    public function edit($type, $id = 0)
    {
        $repository = new PdoArticleTypeFinderRepository($this->c['pdo']);
        $service = new ArticleTypeFinder($repository);

        $type = $service->findOneOfName($type);
        $this->assign(['type' => $type]);

        $catalogModel = new Catalog();
        $catalogs = $catalogModel->findAll("content_type='{$type}'", [], SORT_ORDER_DESC);

        $cats = [];
        foreach ($catalogs as $catalog) {
            $cats[$catalog['type']][] = $catalog;
        }

        $this->assign(['cats' => $cats]);

        $model = $this->model(Post::class);
        $model->contentType = $type;
        if ($row = $model->find($id)) {
            Helper::checkPermission($type . '-edit');
            if ($hid = Helper::get('hid', 0)) {
                $row = $model->history($hid, $row);
            }
            $categoryMap = $this->model(CatalogMap::class);
            $categories_id = $categoryMap->catalogsId($row->id, $type);
            $catId = $catalogModel->root($row['cat'])->id;
        } else {
            $catId = Helper::get('cat', 0);
            Helper::checkPermission($type . '-add');
            $row = $model->init();
            $categories_id = [];
        }


        $cat = $catalogModel->find($catId);
        $contentModel = $this->model(Model::class)->findOne(
            "type='post' AND parent_id=0 AND subtype='{$type}' AND content_id={$catId}"
        );

        $this->assign(['categories_id' => $categories_id]);
        $this->assign(['model_id' => $contentModel ? $contentModel['id'] : 0]);
        $this->assign(['row' => $row]);
        $this->assign(['backListUrl' => $_SERVER['HTTP_REFERER'] ?? '']);
        $this->assign(['cat' => $cat]);
        $this->assign(['type' => $type]);

        return $this->render('post/edit');
    }

    /**
     * @param string $type
     */
    public function save($type = '')
    {
        $backListUrl = Helper::post('backListUrl', '');
        unset($_POST['backListUrl']);

        $id = Helper::post('id');
        $model = $this->model(Post::class);
        $model->contentType = $type;
        $_POST['cat'] = $_POST['cats']['category'] ?? 0;
        if (!$_POST['cat']) {
            $this->error('请選擇分類');
        }

        if ($id) {
            Helper::checkPermission($type . '-edit');
            $this->action('Update');
            $_POST['type'] = $type;
            $ret = $model->update($_POST, $id);
        } else {
            $_POST['sort'] = $model->nextSort() + 1;
            Helper::checkPermission($type . '-add');
            $this->action('Create');
            $_POST['type'] = $type;
            $ret = $model->create($_POST);
        }
        if (!Helper::get('preview', 0)) {
            $change = $model->saveHistory($ret, 'post');
            if ($change) {
                $review = intval(Helper::hasPermission($type . '-review'));
                $model->updateStatus(['review' => $review], $ret['id']);
            }
        }

        $this->success($ret, $backListUrl);
    }

    public function title($id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        Helper::checkPermission($row['type'] . '-title-edt');
        $ret = $model->updateTitle($_POST, $id);
        $change = $model->saveHistory($ret, 'post');
        $this->notice($ret, $change, '.');
    }

    /**
     * @param $type
     * @param $id
     */
    public function copy($type, $id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        Helper::checkPermission($row['type'] . '-copy');
        $ret = $model->copy($id);
        $this->success($ret, '/posts/' . $type);
    }

    /**
     * @param $type
     */
    public function batchCopy($type)
    {
        Helper::checkPermission($type . '-batch-copy');
        $model = $this->model(Post::class);
        $model->contentType = $type;
        $ids = Helper::post('ids');
        try {
            foreach ($ids as $id) {
                $model->copy($id);
            }
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        $this->success(true, '/posts/' . $type);
    }

    /**
     * @param $id
     *
     * @return string
     * @throws Exception
     */
    public function detail($id)
    {
        $model = $this->model(Post::class);
        $data = $model->find($id);
        $this->assign(['data' => $data,]);

        return $this->render('post/view');
    }

    /**
     * @param $type
     */
    public function delete($type)
    {
        Helper::checkPermission($type . '-delete');

        $id = Helper::post('id');

        $model = $this->model(Post::class);
        $model->contentType = $type;
        $ret = $model->remove($id);

        $Catalog = $this->model(CatalogMap::class);
        $Catalog->removeByContentId($id, 'post');

        $this->action('Delete');
        $this->success($ret);
    }

    /**
     * @param $type
     */
    public function batchDelete($type)
    {
        Helper::checkPermission($type . '-batch-delete');
        $model = $this->model(Post::class);
        $model->contentType = $type;
        $Catalog = $this->model(CatalogMap::class);

        $ids = $_POST['ids'];
        try {
            foreach ($ids as $id) {
                $model->remove($id);
                $Catalog->removeByContentId($id, 'post');
            }
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        $this->success(true, '/posts/' . $type);
    }

    /**
     * @param $id
     */
    public function slug($id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        Helper::checkPermission($row['type'] . '-slug-edit');
        $this->success($model->updateSlug($_POST, $id));
    }

    public function sorts()
    {
        $model = $this->model(Post::class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $ret = $model->sort($sorts);
        $this->success($ret);
    }

    /**
     * @param $id
     */
    public function sort($id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        Helper::checkPermission($row['type'] . '-sort-edit');
        $this->success($model->updateSort($_POST, $id));
    }

    /**
     * @param $id
     */
    public function hidden($id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        Helper::checkPermission($row['type'] . '-hidden');
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $id
     */
    public function review($id)
    {
        $model = $this->model(Post::class);
        $row = $model->find($id);
        $categoryModel = new Category();
        $cat = $categoryModel->find($row['cat']);
        Helper::checkReviewPermission($row['type'] . '-review', $cat);
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
        $model = $this->model(Post::class);
        $post = $model->find($id);
        Helper::checkPermission($post['type'] . '-preview');
        $url = '/preview/post/' . ($post['slug'] ?: $post['id']);
        $key = md5($url . time());
        setcookie('PREVIEW_KEY', $key, 0, '/preview/post');
        $this->json($url . '?key=' . $key);
    }

    /**
     * @param $id
     */
    public function histories($id)
    {
        $model = $this->model(Post::class);
        $post = $model->find($id);
        $histModel = $this->model(History::class);
        $histories = $histModel->histories($post, 'post');
        $options = ['' => Helper::_('Latest')];
        foreach ($histories as $history) {
            $options[$history['id']] = $history['time'];
        }
        $value = $_SESSION['hid'] ?? '';
        die(Ui::options($options, $value, false));
    }

    /**
     * @param $type
     */
    public function export($type)
    {
        // 验证权限
        Helper::checkPermission($type . '-export');

        // 获取语言ID
        $langId = isset($_POST['langId']) ? $_POST['langId'] : 'default';

        // 获取产品数据
        $model = new Post();
        $products = $model->findAll("type='{$type}'");

        // 构建分类映射
        $categories = Helper::objectToArray((new Category())->findAll());
        $cats = [];
        foreach ($categories as $category) {
            $cats[$category['id']] = $category['__data'][$langId]['name'];
        }

        // 构建 CSV 数据
        $csvData = [];
        $csvData[] = implode(',', array_keys(Post::normalizeProduct($products[0], $langId, $cats)));
        foreach ($products as $product) {
            $csvData[] = implode(',', Post::normalizeProduct($product, $langId, $cats));
        }

        // 设置下载文件名
        $filename = Inflector::pluralize($type) . '_' . date('Y-m-d_His') . '_' . htmlspecialchars($langId) . '.csv';

        // 发送 CSV 文件
        header("Content-Type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename={$filename}");

        $output = fopen("php://output", "w");
        foreach ($csvData as $row) {
            fputcsv($output, explode(',', $row));
        }
        fclose($output);
        exit;
    }

    public function import($type)
    {
        $object = new DataFromExcelSheet('/vagrant/www/bingo-wms/tmp/ijcle_all_issues_data-20230329.xlsx');
        $data = $object->extract('工作表1');
        print_r($data);
    }
}
