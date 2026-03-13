<?php

namespace Admin\Controllers;

use Admin\Models\Field;
use Admin\Models\Model;

/**
 * Class extendController
 *
 * @package Admin\Controllers
 */
class ExtendController extends BaseController
{

    /**
     * @param int $id
     *
     * @return string
     */
    public function page(int $id = 0)
    {
        $type = 'page';

        $Model = $this->model(Model::class);

        $model = $Model->findOne("type='{$type}' AND content_id={$id} AND parent_id=0");

        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $type,
                    'type' => $type,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $Field = $this->model(Field::class);
        $tabs = $Model->children($model['id']);
        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        return $this->render('extend/index', ['tabs' => $tabs]);
    }

    public function setting($id = 0)
    {
        $type = 'setting';

        $Model = $this->model(Model::class);

        $model = $Model->findOne("type='{$type}' AND content_id={$id} AND parent_id=0");

        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $type,
                    'type' => $type,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $Field = $this->model(Field::class);
        $tabs = $Model->children($model['id']);
        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        return $this->render('extend/index', ['tabs' => $tabs]);
    }

    /**
     * @param     $type
     * @param int $id
     *
     * @return string
     */
    public function catalog($subtype, $group, $id = 0)
    {
        $type = 'catalog';

        $Model = $this->model(Model::class);
        $Field = $this->model(Field::class);

        $model = $Model->findOne("type='{$type}' AND subtype='{$subtype}' AND content_id=0 AND parent_id=0");
        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $group,
                    'type' => $type,
                    'subtype' => $subtype,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $commons = $Model->children($model['id']);
        foreach ($commons as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        if (!$id) {
            return $this->render('extend/index', ['tabs' => $commons, 'id' => $id]);
        }

        $idModel = $Model->findOne("type='{$type}' AND subtype='{$subtype}' AND content_id={$id} AND parent_id=0");
        if (!$idModel) {
            $idModel = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $group,
                    'type' => $type,
                    'subtype' => $subtype,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($idModel['id']);
        }

        $tabs = $Model->children($idModel['id']);

        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        return $this->render('extend/index', ['tabs' => $tabs, 'id' => $id]);
    }

    /**
     * @param     $type
     * @param int $id
     *
     * @return string
     */
    public function category($subtype, $id = 0)
    {
        $type = 'category';

        $Model = $this->model(Model::class);

        $model = $Model->findOne("type='{$type}' AND subtype='{$subtype}' AND content_id={$id} AND parent_id=0");
        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $type,
                    'type' => $type,
                    'subtype' => $subtype,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $Field = $this->model(Field::class);
        $tabs = $Model->children($model['id']);
        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        return $this->render('extend/index', ['tabs' => $tabs]);
    }


    /**
     * @param     $type
     * @param int $id
     */
    public function post($subtype, $id = 0)
    {
        $type = 'post';

        $Model = $this->model(Model::class);

        $model = $Model->findOne("type='{$type}' AND subtype='{$subtype}' AND content_id={$id} AND parent_id=0");
        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $type,
                    'type' => $type,
                    'subtype' => $subtype,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $Field = $this->model(Field::class);
        $tabs = $Model->children($model['id']);
        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        return $this->render('extend/index', ['tabs' => $tabs]);
    }

    public function list(int $id = 0)
    {
        $type = 'list';

        $Model = $this->model(Model::class);

        $model = $Model->findOne("type='{$type}' AND content_id={$id} AND parent_id=0");

        if (!$model) {
            $model = $Model->create(
                [
                    'cname' => $type . '-' . $id,
                    'group' => $type,
                    'type' => $type,
                    'content_id' => $id,
                ]
            );
            $Model->createDefaultModel($model['id']);
        }

        $Field = $this->model(Field::class);
        $tabs = $Model->children($model['id']);
        foreach ($tabs as &$tab) {
            $tab->fields = $Field->findAll("model_id={$tab['id']}", [], SORT_ORDER_DESC);
        }

        $html = $this->render('extend/index2', ['tabs' => $tabs]);
        $this->success($html);
    }
}
