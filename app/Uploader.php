<?php


namespace Site;


use App\Register;
use Exception;

/**
 * Class Uploader
 * @package Site
 */
class Uploader
{
    protected $c;
    protected $fieldName;

    /**
     * Uploader constructor.
     * @param $type
     * @param string $fieldName
     */
    public function __construct($fieldName)
    {
        $this->c = Register::get('container');
        $this->savePath = $this->c['config']['uploads'];
        $this->fieldName = $fieldName;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function upload()
    {
        if ($_FILES[$this->fieldName]['error']) {
            switch ($_FILES[$this->fieldName]['error']) {
                case UPLOAD_ERR_FORM_SIZE:
                case UPLOAD_ERR_INI_SIZE:
                    $message = Helper::_('The uploaded file exceeds the maximum allowed size');
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $message = Helper::_('The uploaded file was only partially uploaded');
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $message = Helper::_('No file was uploaded');
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                case UPLOAD_ERR_EXTENSION:
                case UPLOAD_ERR_NO_TMP_DIR:
                    $message = Helper::_('Server error encountered while saving the file');
                    break;
                default:
                    $message = Helper::_('An unknown error occurred while uploading the file');
            }
            throw new Exception($message);
        }

        if ($_FILES[$this->fieldName]['size'] > MAX_UPLOAD_FILE_SIZE) {
            $message = Helper::_('The uploaded file exceeds the maximum allowed size');
            throw new Exception($message);
        }

        // Validate uploaded files.
        // Do not use $_FILES['file']['type'] as it can be easily forged.
        $info = finfo_open(FILEINFO_MIME_TYPE);
        // Get temp file name.
        $tmpName = $_FILES[$this->fieldName]['tmp_name'];
        // Get mime type. You must include fileinfo PHP extension.
        $mimeType = finfo_file($info, $tmpName);
        // Get filename.
        $nameInfo = explode('.', $_FILES[$this->fieldName]['name']);
        // Get extension.
        $extension = end($nameInfo);
        // Validate file.
        if (!in_array(strtolower($mimeType), $this->c['config']['allowedMimeTypes']) ||
            !in_array(strtolower($extension), $this->c['config']['allowedSuffixes'])) {
            throw new Exception('File does not meet the validation.');
        }
        $hash = md5_file($tmpName);
        $filename = $hash . '.' . $extension;
        $filePath = $this->savePath . DIRECTORY_SEPARATOR . $filename;

        if (!move_uploaded_file($tmpName, $filePath)) {
            throw new Exception('Save file failed!');
        }

        return $filename;
    }
}