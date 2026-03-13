<?php

namespace App;

use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * 提取excel表中的數據爲二維數組
 *
 */
class DataFromExcelSheet
{
    /**
     * 緩存文件目錄
     */
    const CACHE_DIR = __DIR__ . '/../tmp';
    /**
     * 文件完整磁盤路徑
     *
     * @var string
     */
    public string $file;
    /**
     * 數據字段與excel表頭映射, 如:
     * [title1 => field1, title2 => field2, title3 => field3, ...]
     *
     * @var array|mixed
     */
    public array $dataFieldsMap;

    public function __construct(string $file, array $dataFieldsMap = [])
    {
        $this->file = $file;
        $this->dataFieldsMap = $dataFieldsMap;
    }

    /**
     * 文件上傳input組建的 name 值
     *
     * @param $fileInputName
     * @return string
     * @throws \Exception
     */
    public static function upload($fileInputName)
    {
        // 检查文件是否上传
        if (!isset($_FILES[$fileInputName]) || $_FILES[$fileInputName]['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Please select a data file.');
        }

        // 检查文件类型
        $allowedExtensions = ['xls', 'xlsx'];
        $fileExtension = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            throw new \Exception('Invalid file type. Only .xls and .xlsx files are allowed.');
        }

        // 移动文件到缓存目录
        try {
            $src = $_FILES[$fileInputName]['tmp_name'];
            $fileName = preg_replace('/\s+/', '_', $_FILES[$fileInputName]['name']);
            $fileName = uniqid() . '_' . $fileName; // 使用唯一标识符作为文件名前缀
            $destDir = realpath(self::CACHE_DIR); // 获取缓存目录的绝对路径
            if (!$destDir || !is_writable($destDir)) {
                throw new \Exception('Destination directory is not writable.');
            }
            $dest = $destDir . DIRECTORY_SEPARATOR . $fileName; // 使用绝对路径保存文件
            if (!move_uploaded_file($src, $dest)) {
                throw new \Exception('Failed to move the uploaded file.');
            }

            // 返回上传文件的路径
            return $dest;
        } catch (\Exception $e) {
            // 捕获并重新抛出异常
            throw new \Exception('File upload failed: ' . $e->getMessage());
        }
    }

    /**
     *
     * 獲取數組鍵值
     *
     * @param $header
     * @return array
     */
    protected function getFields($header)
    {
        $fields = [];
        $trim = true;
        $header = array_reverse($header);
        foreach ($header as $i => $title) {
            if ($trim) {
                if (empty($title)) {
                    unset($header[$i]); // 清理多餘的空白列
                    continue;
                } else {
                    $trim = false;
                }
            }
            array_unshift($fields, $this->dataFieldsMap[$title] ?? $title);
        }

        return $fields;
    }

    /**
     * 提取數據
     *
     * @param $sheetName
     * @return array|mixed
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function extract(string $sheetIndex = '0')
    {
        $reader = IOFactory::createReaderForFile($this->file);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($this->file);
        $names = $spreadsheet->getSheetNames();
        $sheets = [];
        foreach ($names as $name) {
            $rows = $spreadsheet->getSheetByName($name)->toArray();
            $header = array_shift($rows);
            $fields = $this->getFields($header);
            $sheet = [];
            foreach ($rows as $row) {
                foreach ($row as $i => $value) {
                    $row[$i] = strval($value);
                }
                $sheet[] = array_combine($fields, array_slice($row, 0, count($fields)));
            }
            $sheets[$name] = $sheet;
        }

        if ($sheetIndex !== '') {
            if (isset($sheets[$sheetIndex])) {
                // 按照名稱返回
                return $sheets[$sheetIndex];
            }
            $sheets = array_values($sheets);
            if (isset($sheets[$sheetIndex])) {
                // 按照索引順序返回
                return $sheets[$sheetIndex];
            }
        }

        // 返回所有
        return $sheets;
    }
}
