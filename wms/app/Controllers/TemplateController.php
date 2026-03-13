<?php

namespace Admin\Controllers;

use Admin\Helper;
use LogicException;

/**
 * Class TemplateController
 *
 * @package Admin\Controllers
 */
class TemplateController extends BaseController
{
    public function index()
    {
        $dir = dir($this->c['config']['paths']['templates']);
        $list = [];
        while ($file = $dir->read()) {
            if (!in_array($file, ['.', '..'])) {
                $dest = $this->c['config']['paths']['site'] . '/templates/' . $file;
                if (!file_exists($dest)) {
                    mkdir($dest, 0777, true);
                }

                $srcStyle = sprintf("%s/%s/style.css", $dir->path, $file);
                $destStyle = sprintf("%s/style.css", $dest);
                copy($srcStyle, $destStyle);

                $srcImage = sprintf("%s/%s/logo.jpg", $dir->path, $file);
                $destImage = sprintf("%s/logo.jpg", $dest);
                copy($srcImage, $destImage);

                $srcImages = sprintf("%s/%s/images", $dir->path, $file);
                $destImages = sprintf("%s/images", $dest);
                $this->copyDir($srcImages, $destImages);

                $image = sprintf("/templates/%s/logo.jpg", $file);
                $list[] = ['template' => $file, 'image' => $image];
            }
        }
        $this->success($list);
    }

    /**
     * @param $src
     * @param $dest
     */
    public function copyDir($src, $dest)
    {
        if (!file_exists($dest)) {
            mkdir($dest, 0777, true);
        }
        if (file_exists($src)) {
            $dir = dir($src);
            while ($file = $dir->read()) {
                if (!in_array($file, ['.', '..'])) {
                    $srcFile = sprintf("%s/%s", $dir->path, $file);
                    $desFile = sprintf("%s/%s", $dest, $file);
                    copy($srcFile, $desFile);
                }
            }
        }
    }

    /**
     * @param $name
     */
    public function find($name)
    {
        $template = sprintf(
            "%s/%s/template.html",
            $this->c['config']['paths']['templates'],
            $name
        );
        if (!file_exists($template)) {
            $message = Helper::_('Template file is not exists');
            throw new LogicException($message);
        }
        $this->success(file_get_contents($template));
    }
}
