<?php

namespace Admin\Models;

use Admin\Helper;
use Admin\Image;
use Admin\Model;
use Admin\Uploader;
use LogicException;

/**
 * Class File
 *
 * @package Admin\Models
 */
class File extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'file';
        $this->idField = 'id';
    }

    /**
     *
     * @param $id
     *
     * @return int
     */
    public function remove($id)
    {
        $file = $this->find($id);
        $filename = $this->c['config']['paths']['uploads'] . $file['filename'];
        if (file_exists($filename)) {
            if (!unlink($filename)) {
                throw new LogicException('Delete file failed!');
            }
        }
        $thumb = dirname($filename) . '/thumbs/' . basename($filename);
        if (file_exists($thumb)) {
            if (!unlink($thumb)) {
                throw new LogicException('Delete file failed!');
            }
        }

        return parent::delete($id);
    }

    /**
     * @param $hash
     *
     * @return mixed
     */
    public function findByHash($hash)
    {
        return $this->findOne("hash='{$hash}'");
    }

    public function findByFilename($filename)
    {
        return $this->findOne("filename='{$filename}'");
    }

    public function findByLink($link)
    {
        return $this->findOne("link='{$link}'");
    }

    /**
     * @param $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data)
    {
        return $data;
    }

    public function saveUploadFile($type)
    {
        $uploader = new Uploader($type);
        $info = $uploader->getInfo();

        $name = $this->getName($info['dir'], $info['name'], $info['ext']);
        $filename = $info['dir'] . DIRECTORY_SEPARATOR . $name . '.' . $info['ext'];
        $link = $info['url'] . str_replace("\\", '/', $filename);

        $data = [
            'type' => $type,
            'hash' => $info['hash'],
            'ext' => $info['ext'],
            'name' => $name,
            'filename' => $filename,
            'link' => $link,
            'sort' => time(),
        ];

        $uploader->save($info['tmp'], $info['path'] . $filename);
        if ($type == 'image') {
            $image = new Image($data['filename']);
            $image->thumb();
        }

        $this->create($data);

        return [
            'link' => $data['link'],
            'name' => $data['name'],
            'ext' => $data['ext'],
        ];
    }

    public function saveCropFile($parent, $file)
    {
        $parent = $this->findByLink($parent);
        $fileData = Helper::imgBase64Decode($file);

        $dir = DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . date('Ym');
        $name = $this->getName($dir, $parent['name'], $parent['ext']);
        $filename = dirname($parent['filename']) . '/' . $name . '.' . $parent['ext'];
        $link = dirname($parent['link']) . '/' . $name . '.' . $parent['ext'];

        $filePath = $this->c['config']['paths']['uploads'] . $filename;
        if (!file_exists($filePath)) {
            file_put_contents($filePath, $fileData);
        }

        $data = [
            'type' => $parent['type'],
            'hash' => md5($fileData),
            'ext' => $parent['ext'],
            'name' => $name,
            'filename' => $filename,
            'link' => $link,
            'sort' => $parent['sort'],
            'parent_id' => $parent['id'],
        ];

        $this->create($data);
        $image = new Image($data['filename']);
        $image->thumb();

        return [
            'link' => SUB_DIR . $data['link'],
            'name' => $data['name'],
            'ext' => $data['ext'],
        ];
    }

    public function getName($dir, $name, $ext)
    {
        $nextName = $name;
        $filename = $dir . DIRECTORY_SEPARATOR . $name . '.' . $ext;
        $exist = $this->findByFilename($filename);
        $n = 0;
        while ($exist) {
            $n = $n + 1;
            $nextName = sprintf('%s[%s]', $name, $n);
            $filename = $dir . DIRECTORY_SEPARATOR . $nextName . '.' . $ext;
            $exist = $this->findByFilename($filename);
        }

        return $nextName;
    }
}
