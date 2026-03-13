<?php

namespace Admin;

use App\Register;
use LogicException;

/**
 * Class Uploader
 *
 * @package Admin
 */
class Uploader
{
    protected string $fileRoute;

    protected string $subPath;

    protected string $fieldName;

    protected array $allowedSuffixes;

    protected array $allowedMimeTypes;

    protected string $urlPrefix;

    protected array $info = [];

    /**
     * Uploader constructor.
     *
     * @param        $type
     * @param string $fieldName
     */
    public function __construct($type, string $fieldName = 'file_data')
    {
        $c = Register::get('container');
        $this->urlPrefix = SUB_DIR . '/' . pathinfo($c['config']['paths']['uploads'], PATHINFO_BASENAME);
        $this->fileRoute = $c['config']['paths']['uploads'];
        $this->subPath = DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . date('Ym');
        $this->fieldName = $fieldName;
        $this->info['type'] = $type;

        if (!file_exists($this->fileRoute . $this->subPath) && !mkdir(
                $this->fileRoute . $this->subPath,
                0777,
                true
            )) {
            throw new LogicException('Create dir failed!');
        }
        if ($type == 'image') {
            $this->allowedSuffixes = ['gif', 'jpeg', 'jpg', 'png', 'svg', 'blob', 'ico', 'webp'];
            $this->allowedMimeTypes = [
                'image/gif',
                'image/jpg',
                'image/jpeg',
                'image/x-png',
                'image/png',
                'image/svg',
                'image/svg+xml',
                'image/x-icon',
                'image/webp',
            ];
        } elseif ($type == 'video') {
            $this->allowedSuffixes = [
                'mp4',
                'webm',
                'ogg',
                'wmv',
                'rm',
                'rmvb',
                '3gp',
                'mov',
                'm4v',
                'avi',
                'mkv',
                'flv',
            ];
            $this->allowedMimeTypes = [
                'video/mp4',
                'video/webm',
                'video/ogg',
                'audio/x-ms-wmv',
                'application/vnd.rn-realmedia',
                'audio/x-pn-realaudio',
                'application/vnd.rn-realmedia-vbr',
                'video/3gpp',
                'video/x-m4v',
                'video/avi',
                'video/x-msvideo',
                'video/quicktime',
                'video/x-matroska',
                'application/octet-stream',
            ];
        } else {
            $this->allowedSuffixes = ['txt', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'json', 'html', 'zip', 'tgz'];
            $this->allowedMimeTypes = [
                'text/plain',
                'application/pdf',
                'application/x-pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-powerpoint',
                'application/json',
                'text/html',
                'application/zip',
                'application/x-zip-compressed',
                'application/x-compressed',
            ];
        }

        $tmp = $_FILES[$this->fieldName]['tmp_name'];
        $files = explode('.', $_FILES[$this->fieldName]['name']);
        $ext = end($files);

        $mimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $tmp);

        if (!in_array(strtolower($mimeType), $this->allowedMimeTypes) ||
            !in_array(strtolower($ext), $this->allowedSuffixes)) {
            throw new LogicException('File does not meet the validation.');
        }

        $this->info = [
            'tmp' => $tmp,
            'hash' => md5_file($tmp),
            'name' => rtrim($_FILES[$this->fieldName]['name'], '.' . $ext),
            'ext' => $ext,
            'dir' => $this->subPath,
            'path' => $this->fileRoute,
            'url' => $this->urlPrefix,
        ];
    }

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }

    /**
     * @return bool
     */
    public function save($src, $dest): bool
    {
        if (!copy($src, $dest)) {
            throw new LogicException('Save file failed!');
        }

        return true;
    }
}
