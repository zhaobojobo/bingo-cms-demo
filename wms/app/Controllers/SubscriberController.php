<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Subscriber;
use Exception;
use LogicException;

/**
 * Class SubscriberController
 *
 * @package Admin\Controllers
 */
class SubscriberController extends BaseController
{
    /**
     * @return string
     */
    public function index()
    {
        Helper::checkPermission('subscriber-index');
        $model = $this->model(Subscriber::class);
        $pageData = $model->findPage(intval(Helper::get('p', 1)), 10);

        $this->assign(['pageData' => $pageData]);

        return $this->render('subscriber/index');
    }

    public function export()
    {
        $model = $this->model(Subscriber::class);
        $subscribers = $model->findAll();

        $data = [];
        foreach ($subscribers as $i => $subscriber) {
            $data[$i] = [
                'ID' => $subscriber['id'],
                '郵件' => $subscriber['email'],
                '注冊時間' => $subscriber['register_time'],
                '已確認' => $subscriber['confirm'] ? '是' : '否',
            ];
        }

        $keys = array_keys($data[0]);
        $rows[] = implode(',', $keys);
        foreach ($data as $row) {
            $rows[] = implode(',', $row);
        }
        $content = implode("\n", $rows);
        $filename = 'subscribers_' . date('Y-m-d_His');
        header("Content-Type: application/vnd.ms-excel; charset=GB2312");
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename={$filename}.csv ");
        header("Content-Transfer-Encoding: binary ");
        die($content);
    }

    public function delete()
    {
        $id = Helper::post('id');
        $model = $this->model(Subscriber::class);
        $this->success($model->remove($id));
    }

    public function batchDelete()
    {
        $model = $this->model(Subscriber::class);

        $ids = $_POST['ids'];
        try {
            foreach ($ids as $id) {
                $model->remove($id);
            }
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        $this->success(true, '/subscribers');
    }
}
