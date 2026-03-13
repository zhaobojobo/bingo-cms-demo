<?php

namespace Admin\Controllers;

use Admin\Helper;
use Admin\Models\Action;
use Admin\Models\Fragment;
use Admin\Models\ListData;
use Admin\Models\Post;
use Admin\Models\User;
use Exception;

/**
 * Class IndexController
 *
 * @package Admin\Controllers
 */
class HomeController extends BaseController
{
    /**
     * @return false|string
     * @throws Exception
     */
    public function index()
    {
        $actionModel = $this->model(Action::class);
        $actions = $actionModel->some(10);
        $postModel = $this->model(Post::class);
        $infoFile = $this->c['config']['paths']['data'] . '/info.php';
        if (!file_exists($infoFile)) {
            $protection = [
                'today_protection_times' => 1,
                'total_protection_times' => 100,
            ];
            $fileContent = sprintf("<?php\nreturn %s;\n", Helper::var_export_short($protection, true));
            file_put_contents($infoFile, $fileContent);
        } else {
            $mtime = filemtime($infoFile);
            $today = strtotime(date('Y-m-d 00:00:00'));
            $protection = include $infoFile;
            if ($mtime < $today) {
                $times = rand(0, 9);
                $protection['today_protection_times'] = $times;
                $protection['total_protection_times'] += $times;

                $fileContent = sprintf("<?php\nreturn %s;\n", Helper::var_export_short($protection, true));
                file_put_contents($infoFile, $fileContent);
            }
        }

        $this->assign(
            [
                'actions' => $actions,
                'protection' => $protection,
            ]
        );

        return $this->render('index/index');
    }

    public function logout()
    {
        $this->model(User::class)->logout();
        $this->redirect('/');
    }

    /**
     * @param $name
     * @return bool|false|string
     */
    public function attachment($name)
    {
        $file = $this->c['config']['site']['uploads'] . '/' . $name;
        if (file_exists($file)) {
            $info = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($info, $file);
            Header("Content-type: {$mimeType}");
            return file_get_contents($file);
        } else {
            $this->redirect('/404');
            return false;
        }
    }

    public function error403()
    {
        return $this->render('index/error-403');
    }

    public function errorBanned()
    {
        return $this->render('index/error-banned');
    }
}
