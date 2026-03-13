<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Language;
use App\DataFromExcelSheet;
use App\DataToExcelSheet;
use Exception;

/**
 * Class TranslationController
 *
 * @package Admin\Controllers
 */
class TranslationController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $q = Helper::get('q', '');
        Helper::checkPermission('translation-index');

        $model = $this->model(Language::class);
        $where = '';
        if ($q) {
            $where = "`key` LIKE '%{$q}%'";
            foreach (LANGUAGES as $language) {
                if ($language['value'] == 'en-GB') {
                    $where .= " OR `en_us` LIKE '%{$q}%'";
                }
                if ($language['value'] == 'zh-HK') {
                    $where .= " OR `zh_hk` LIKE '%{$q}%'";
                }
                if ($language['value'] == 'zh-CN') {
                    $where .= " OR `zh_cn` LIKE '%{$q}%'";
                }
            }
        }

        $pageData = $model->findPage(intval(Helper::get('p', 1)), 10, $where);
        $this->assign(
            [
                'q'             => $q,
                'pageData'      => $pageData,
                'defaultLang'   => DEFAULT_LANG,
                'import_action' => Helper::getUrl('/translations/import'),
            ]
        );

        return $this->render('translation/index');
    }

    /**
     * @param $id
     */
    public function find($id)
    {
        $model = $this->model(Language::class);
        $this->success($model->find($id));
    }

    public function save()
    {
        Helper::checkPermission('translation-edit');
        $id = Helper::post('id');
        $model = $this->model(Language::class);
        if ($id) {
            $this->action('Update');
            $_POST['key'] = strtolower($_POST['key']);
            $ret = $model->update($_POST, $id);
        } else {
            $this->action('Create');
            $_POST['key'] = strtolower($_POST['key']);
            $ret = $model->create($_POST);
        }

        $this->success($ret);
    }

    public function delete()
    {
        Helper::checkPermission('translation-delete');
        $model = $this->model(Language::class);
        $ret = $model->delete(Helper::post('id'));
        $this->action('Delete');
        $this->success($ret);
    }

    public function export()
    {
        try {
            $modal = new Language();
            $data = $modal->findAll('', [], SORT_ORDER_DESC);
            $dataFieldsMap = [
                'id'          => 'ID',
                'key'         => '鍵',
                'en_us'       => '英文',
                'zh_cn'       => '簡體中文',
                'zh_hk'       => '繁體中文',
                'description' => '說明'
            ];
            $exporter = new DataToExcelSheet($data, $dataFieldsMap);
            $exporter->setWidth('B', '30');
            $exporter->setWidth('C', '30');
            $exporter->setWidth('D', '30');
            $exporter->setWidth('E', '30');
            $exporter->setWidth('F', '30');
            $exporter->download('譯文翻譯_' . date('YmdHis'));
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    public function import()
    {
        try {
            $dataFieldsMap = array_flip([
                'id'          => 'ID',
                'key'         => '鍵',
                'en_us'       => '英文',
                'zh_cn'       => '簡體中文',
                'zh_hk'       => '繁體中文',
                'description' => '說明'
            ]);
            $file = DataFromExcelSheet::upload('import_file');
            $importer = new DataFromExcelSheet($file, $dataFieldsMap);
            $data = $importer->extract();
            $modal = new Language();
            $count = 0;
            foreach ($data as $item) {
                $id = $item['id'];
                $exist = $modal->find($id);
                if ($exist) {
                    unset($item['id']);
                    $modal->update($item, $id);
                } else {
                    $modal->create($item);
                }
                $count += 1;
            }
            $this->success(['count' => $count]);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
