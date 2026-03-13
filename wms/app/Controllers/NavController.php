<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Catalog;
use Admin\Models\Menu;
use Admin\Models\Nav;
use Admin\Models\Page;
use Admin\Ui;
use Exception;

/**
 * Class NavController
 *
 * @package Admin\Controllers
 */
class NavController extends BaseController
{
    /**
     * @param $menu_id
     *
     * @return false|string
     * @throws Exception
     */
    public function index($menu_id)
    {
        Helper::checkPermission('nav-index');
        $model = $this->model(Nav::class);
        $navs = Helper::listAsTree($model->findAll("menu_id={$menu_id}", [], SORT_ORDER_DESC));
        $this->assign(['menu_id' => $menu_id]);
        $this->assign(['navs' => $navs]);

        return $this->render('nav/index');
    }

    public function sort()
    {
        Helper::checkPermission('nav-sort');
        $model = $this->model(Nav::class);
        $sorts = [];
        foreach (Helper::post('sorts') as $id => $sort) {
            $sorts[] = ['id' => $id, 'sort' => $sort];
        }
        $this->success($model->sort($sorts));
    }

    /**
     * @param     $menu_id
     * @param int $id
     *
     * @return false|string
     * @throws Exception
     */
    public function edit($menu_id, $id = 0)
    {
        Helper::checkPermission('nav-edit');
        $model = $this->model(Nav::class);
        $row = $model->init();
        if ($id) {
            $row = $model->find($id);
        }
        $this->assign(['row' => $row]);
        $this->assign(
            [
                'menu_id' => $menu_id,
                'menu' => $this->model(Menu::class)->find($menu_id),
                'parents' => $model->findAll('menu_id=:menu_id', ['menu_id' => $menu_id], SORT_ORDER_DESC),
            ]
        );

        return $this->render('nav/edit');
    }

    public function save()
    {
        Helper::checkPermission('nav-edit');
        $id = Helper::post('id');
        $model = $this->model(Nav::class);
        if ($id) {
            $this->action('Update');
            if (!isset($_POST['sync_title'])) {
                $_POST['sync_title'] = 0;
            }
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $ret = $model->create($_POST);
        }
        $this->success($ret, sprintf("/navs/%s", Helper::post('menu_id')));
    }

    public function delete()
    {
        Helper::checkPermission('nav-delete');
        $model = $this->model(Nav::class);
        $ret = $model->remove(Helper::post('id'), true);
        $this->action('Delete');
        $this->success($ret);
    }

    /**
     * @param $id
     */
    public function hidden($id)
    {
        Helper::checkPermission('nav-hidden');
        $model = $this->model(Nav::class);
        $this->success($model->updateStatus($_POST, $id));
    }

    /**
     * @param $type
     */
    public function data($type)
    {
        switch ($type) {
            case 'page':
                $target_id = Helper::get('target_id');
                $model = $this->model(Page::class);
                $targets = [
                    'label' => Helper::_('Page'),
                    'options' => $model->findAll('', [], SORT_ORDER_DESC),
                ];
                break;
            case 'catalog':
                $target_id = Helper::get('target_id');
                $model = $this->model(Catalog::class);
                $targets = [
                    'label' => Helper::_('Catalog'),
                    'options' => $model->findAll("nav=1", [], SORT_ORDER_DESC),
                ];
                break;
            case 'customize':
                $url = urldecode(Helper::get('url'));
                $targets = [
                    'label' => Helper::_('Nav Url'),
                ];
                break;
            default:
                $targets = [];
        }
        if (!empty($targets)) {
            if (isset($targets['options']) && !empty($targets['options'])) {
                $first = Helper::_('Please Select');
                $options = Ui::parentOptions(
                    DEFAULT_LANG,
                    $targets['options'],
                    0,
                    $target_id
                );
                $ret = <<< NAV_SELECT
    <label for="target_id">{$targets['label']}</label>
    <select name="target_id" id="target_id" class="input_normal">
        <option value="0">{$first}</option>
        {$options}
    </select>
NAV_SELECT;
            } else {
                $ret = <<<NAV_INPUT
    <label for="nav_url">{$targets['label']}</label>
    <input type = "hidden" name = "target_id" id = "target_id" class="input_normal" value="0">
    <input type = "text" name = "url" id = "nav_url" class="input_normal" value="{$url}">
NAV_INPUT;
            }
        } else {
            $ret = <<<NONE_TARGET
    <input type = "hidden" name = "target_id" id = "target_id" class="input_normal" value="0">
NONE_TARGET;
        }

        $this->success($ret);
    }

    public function target($type, $id)
    {
        $target = null;
        if ($type == 'page') {
            $model = new Page();
            $target = $model->find($id);
        }
        if ($type == 'catalog') {
            $model = new Catalog();
            $target = $model->find($id);
        }

        $data = [];
        if ($target) {
            foreach ($target['__data'] as $lang => $item) {
                $data[] = [
                    'lang' => $lang,
                    'text' => $type == 'page' ? $item['title'] : $item['name']
                ];
            }
        }

        $this->success($data);
    }
}
