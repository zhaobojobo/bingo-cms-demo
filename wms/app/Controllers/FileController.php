<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Image;
use Admin\Models\File;
use Exception;

/**
 * Class FileController
 *
 * @package Admin\Controllers
 */
class FileController extends BaseController
{
    /**
     * @param $type
     */
    public function upload($type)
    {
        $model = new File();
        $file = $model->saveUploadFile($type);
        $this->action('Upload image');

        if ($type == 'image') {
            $file['thumb'] = Helper::thumb($file['link']);
        }

        $this->success($file);
    }

    /**
     * @param $type
     */
    public function froalaUpload($type)
    {
        $model = new File();
        $file = $model->saveUploadFile($type);
        $this->action('Froala Upload image');
        $this->json($file);
    }

    public function cropUpload()
    {
        $model = new File();
        $file = $model->saveCropFile($_POST['parent'], $_POST['file']);
        $this->action('Crop image');
        $this->success(
            [
                'link' => $file['link'],
                'thumb' => Helper::thumb($file['link']),
            ]
        );
    }

    public function delete()
    {
        $model = $this->model(File::class);
        $this->action('Delete');
        $this->success($model->remove(Helper::post('id')));
    }

    public function batchDelete()
    {
        $ids = Helper::post('ids');
        $model = $this->model(File::class);
        $this->action('Delete');
        foreach ($ids as $id) {
            $model->remove($id);
        }
        $this->success();
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function images()
    {
        $key = trim(Helper::get('key', ''));
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $size = 12;
        $where = "type='image'";
        if (strlen($key)) {
            $where .= " AND name LIKE '%{$key}%'";
        }
        $params = [];
        $pageData = $model->findPage($p, $size, $where, $params, SORT_ORDER_DESC);
        foreach ($pageData['rows'] as $row) {
            $image = new Image($row['filename']);
            if (!file_exists($image->thumbName)) {
                $image->thumb();
            }
        }
        $this->assign(['pageData' => $pageData, 'key' => $key ?? '']);

        return $this->render('file/images');
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function videos()
    {
        $key = trim(Helper::get('key', ''));
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $where = "type='video'";
        if (strlen($key)) {
            $where .= " AND name LIKE '%{$key}%'";
        }
        $this->assign(['pageData' => $model->findPage($p, '12', $where), 'key' => $key ?? '']);

        return $this->render('file/videos');
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function files()
    {
        $key = trim(Helper::get('key', ''));
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $where = "type='file'";
        if (strlen($key)) {
            $where .= " AND name LIKE '%{$key}%'";
        }
        $this->assign(['pageData' => $model->findPage($p, '12', $where), 'key' => $key ?? '']);

        return $this->render('file/files');
    }

    /**
     * @throws Exception
     */
    public function ajaxImages()
    {
        $q = Helper::get('q');
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $size = 12;
        $where = "type='image'";
        if (strlen($q)) {
            $where .= " AND name LIKE '%{$q}%'";
        }
        $params = [];
        $pageData = $model->findPage($p, $size, $where, $params, SORT_ORDER_DESC);

        foreach ($pageData['rows'] as $row) {
            $image = new Image($row['filename']);
            if (!file_exists($image->thumbName)) {
                $image->thumb();
            }
        }
        $this->assign(['pageData' => $pageData]);
        $files = $this->render('file/images-block');
        $this->success(
            [
                'pageInfo' => $pageData,
                'files' => $files
            ]
        );
    }

    public function ajaxVideos()
    {
        $q = Helper::get('q');
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $size = 12;
        $where = "type='video'";
        if (strlen($q)) {
            $where .= " AND name LIKE '%{$q}%'";
        }
        $params = [];
        $pageData = $model->findPage($p, $size, $where, $params, SORT_ORDER_DESC);

        $this->assign(['pageData' => $pageData]);
        $files = $this->render('file/videos-block');
        $this->success(
            [
                'pageInfo' => $pageData,
                'files' => $files
            ]
        );
    }

    public function ajaxFiles()
    {
        $q = Helper::get('q');
        $model = $this->model(File::class);
        $p = intval(Helper::get('p', 1));
        $size = 12;
        $where = "type='file'";
        if (strlen($q)) {
            $where .= " AND name LIKE '%{$q}%'";
        }
        $params = [];
        $pageData = $model->findPage($p, $size, $where, $params, SORT_ORDER_DESC);

        $this->assign(['pageData' => $pageData]);
        $files = $this->render('file/files-block');
        $this->success(
            [
                'pageInfo' => $pageData,
                'files' => $files
            ]
        );
    }

    public function froalaImages()
    {
        $model = $this->model(File::class);
        $rows = $model->findAll("type='image'", [], SORT_ORDER_DESC);
        foreach ($rows as $row) {
            $thumb = new Image($row['filename']);
            if (!file_exists($thumb->thumbName)) {
                $thumb->thumb();
            }
            $images[] = [
                'id' => $row['id'],
                'url' => $row['link'],
                'thumb' => Helper::thumb($row['link']),
                'name' => Helper::basename($row['link']),
            ];
        }
        $this->json($images);
    }
}
