<?php

namespace Admin;

use App\Register;

/**
 * Class Image
 *
 * @package Admin
 */
class Image
{
    public $thumbName;

    private $image;

    private $file;

    private $info;

    private $path;

    private $thumbPath;

    /**
     * Image constructor.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        $c = Register::get('container');
        $this->file = $c['config']['paths']['uploads'] . $filename;
        $this->info = $this->getInfo();
        $this->image = $this->getImage();
        if (file_exists($c['config']['paths']['uploads'])) {
            $this->path = dirname($this->file);
            $this->thumbPath = $this->path . '/thumbs';
            $this->thumbName = $this->thumbPath . '/' . Helper::basename($this->file);
            if (!file_exists($this->thumbPath)) {
                mkdir($this->thumbPath, 0777, true);
            }
        }
    }

    /**
     * @return array
     */
    public function getInfo()
    {
        if (!file_exists($this->file)) {
            return [];
        }
        $info = [];
        $info['mini'] = mime_content_type($this->file);
        $info['ext'] = pathinfo($this->file, PATHINFO_EXTENSION);

        return $info;
    }

    /**
     * @return false|resource|null
     */
    public function getImage()
    {
        ini_set('memory_limit', '1024M');
        if (!$this->info) {
            return false;
        }
        switch ($this->info['mini']) {
            case 'image/jpeg':
                return imagecreatefromjpeg($this->file);
            case 'image/png':
            case 'image/x-png':
                return imagecreatefrompng($this->file);
            case 'image/webp':
                return imagecreatefromwebp($this->file);
            default:
                return null;
        }
    }

    /**
     * @param int $mw
     * @param int $mh
     */
    public function thumb($mw = 300, $mh = 300)
    {
        $image = $this->size($mw, $mh);
        $this->saveImage($image, $this->thumbName);
    }

    /**
     * @param $mw
     * @param $mh
     *
     * @return false|resource
     */
    public function size($mw, $mh)
    {
        if (!$this->image) {
            return false;
        }
        $w = imagesx($this->image);
        $h = imagesy($this->image);
        if ($w <= $mw && $h <= $mh) {
            return $this->image;
        }
        if (($mw / $w) < ($mh / $h)) {
            $rate = $mw / $w;
        } else {
            $rate = $mh / $h;
        }
        $nw = floor($w * $rate);
        $nh = floor($h * $rate);
        $image = imagecreatetruecolor($nw, $nh);
        $color = imagecolorallocate($image, 255, 255, 255);
        imagecolortransparent($image, $color);
        imagefill($image, 0, 0, $color);
        imagecopyresampled($image, $this->image, 0, 0, 0, 0, $nw, $nh, $w, $h);

        return $image;
    }

    /**
     * @param $image
     * @param $saveFile
     */
    public function saveImage($image, $saveFile)
    {
        if ($this->info) {
            switch ($this->info['mini']) {
                case 'image/jpeg':
                    imagejpeg($image, $saveFile);
                    break;
                case 'image/png':
                    imagesavealpha($image, true);
                    imagepng($image, $saveFile);
                    break;
                case 'image/webp':
                    imagewebp($image, $saveFile);
                    break;
                default:
                    copy($this->file, $saveFile);
            }
            if ($image) {
                imagedestroy($image);
            }
        }
    }

    /**
     * @param int $mw
     * @param int $mh
     */
    public function crop($mw = 1920, $mh = 1920)
    {
        $image = $this->size($mw, $mh);
        $this->saveImage($image, $this->file);
    }
}
