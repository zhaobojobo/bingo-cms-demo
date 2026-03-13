<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Catalog;
use Admin\Models\Model;
use App\Exceptions\BannedException;
use App\Exceptions\NormalException;
use Exception;

/**
 * Class CatalogController
 *
 * @package Admin\Controllers
 */
class CatalogController extends BaseController
{
    public $permission = 'POST';

    /**
     * @param string $type
     *
     * @return string
     * @throws Exception
     */
    public function index($cType, $type)
    {
        Helper::checkPermission($cType . '-' . $type . '-index');
        $model = $this->model(Catalog::class);
        $where = 'content_type=:content_type && type=:type';
        $params = ['content_type' => $cType, 'type' => $type];
        $catalogs = $model->findAll($where, $params, SORT_ORDER_DESC);

        $this->assign(['cType' => $cType]);
        $this->assign(['type' => $type]);
        $this->assign(['catalogs' => Helper::listAsTree($catalogs)]);

        return $this->render('catalog/index');
    }

    public function sort()
    {
        $model = $this->model(Catalog::class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $ret = $model->sort($sorts);
        $this->success($ret);
    }

    /**
     * @param     $type
     * @param int $id
     *
     * @return string
     * @throws Exception
     */
    public function edit($cType, $type, $id = 0)
    {
        $model = $this->model(Catalog::class);
        $parent_id = Helper::get('parent_id', 0);

        $row = $model->init();
        $parents = $model->findAll("content_type='{$cType}' AND ban_children=0", [], SORT_ORDER_DESC);

        $parent = $model->find($parent_id);
        if ($parent) {
            if ($parent['ban_children']) {
                throw new BannedException(Helper::_('Operation has been disabled'));
            }
            $parents = [$parent];
        }

        if ($id) {
            $row = $model->find($id);
            Helper::checkPermission($cType . '-' . $type . '-edit');
        } else {
            Helper::checkPermission($cType . '-' . $type . '-add');
        }

        $globalModel = $this->model(Model::class)->findOne(
            "`group`='{$type}' AND type='catalog' AND parent_id=0 AND subtype='{$cType}'  AND content_id=0"
        );
        $contentModel = $this->model(Model::class)->findOne(
            "`group`='{$type}' AND type='catalog' AND parent_id=0 AND subtype='{$cType}' AND content_id={$id}"
        );

        $this->assign(['root_id' => $parent ? $parent['parent_id'] : 0]);
        $this->assign(['parent_id' => $parent_id ? $parent_id : 0]);
        $this->assign(['parents' => $parents]);
        $this->assign(['model_0' => $globalModel['id'] ?? 0]);
        $this->assign(['model_id' => $contentModel ? $contentModel['id'] : 0]);
        $this->assign(['row' => $row]);
        $this->assign(['type' => $type]);
        $this->assign(['modelGroup' => $type]);
        $this->assign(['cType' => $cType]);
        $this->assign(['cTemplate' => $cType]);
        $this->assign(['template' => $cType . '-list']);

        return $this->render('catalog/edit');
    }

    /**
     * @param $type
     */
    public function save($cType, $type)
    {
        $id = Helper::post('id', 0);
        $model = $this->model(Catalog::class);

        if (!$_POST['slug']) {
            $this->error('请输入网址');
        }

        $slug = Helper::formatSlug($_POST['slug']);

        if (Helper::slugExists($slug, $id)) {
            $this->error('网址已存在，请重新输入');
        }

        if ($id) {
            Helper::checkPermission($cType . '-' . $type . '-edit');
            $this->action('Update');
            $ret = $model->update($_POST, $id);
        } else {
            Helper::checkPermission($cType . '-' . $type . '-add');
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, sprintf("/catalogs/%s/%s", $cType, $type));
    }

    public function delete()
    {
        $id = Helper::post('id');
        $model = $this->model(Catalog::class);
        $row = $model->find($id);
        Helper::checkPermission($row['content_type'] . '-' . $row['type'] . '-delete');
        if ($row['ban_delete']) {
            throw new NormalException(Helper::_('Ban delete'));
        }
        if (Helper::post('id', 0) <= 2) {
            throw new NormalException(Helper::_('Ban delete'));
        }
        $ret = $model->remove($id);
        $this->action('Delete');
        $this->success($ret);
    }

    /**
     * @param $id
     */
    public function banDelete($id)
    {
        $model = $this->model(Catalog::class);
        $row = $model->find($id);
        Helper::checkPermission($row['content_type'] . '-' . $row['type'] . '-delete-disable');
        $this->success($model->updateBanDelete($_POST, $id));
    }

    public function slug($id)
    {
        $model = $this->model(Catalog::class);
        Helper::checkPermission('catalog-slug-edit');
        $this->success($model->updateSlug($_POST, $id));
    }

    /**
     * @param $id
     */
    public function banChildren($id)
    {
        $model = $this->model(Catalog::class);
        $row = $model->find($id);
        Helper::checkPermission($row['content_type'] . '-' . $row['type'] . '-subcategory-disable');
        $this->success($model->updateBanChildren($_POST, $id));
    }
}
