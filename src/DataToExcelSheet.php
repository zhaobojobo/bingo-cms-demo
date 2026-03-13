<?php

namespace App;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * 數據匯出XLS
 */
class DataToExcelSheet
{
    /**
     * @var array
     */
    protected array $data;
    /**
     * @var array|mixed
     */
    protected array $header;
    /**
     * @var Spreadsheet
     */
    protected Spreadsheet $spreadsheet;

    /**
     * 構造對象
     *
     * @param array $data
     * @param array $dataFieldsMap
     */
    public function __construct(array $data, array $dataFieldsMap = [])
    {
        $this->data = $data;
        $this->dataFieldsMap = $dataFieldsMap;
        $this->spreadsheet = new Spreadsheet();
        $this->fillData();
    }

    /**
     * 設置列寬度
     *
     * @param string $column
     * @param string $width
     * @return void
     */
    public function setWidth(string $column, string $width)
    {
        $this->spreadsheet->getActiveSheet()->getColumnDimension($column)->setWidth($width);
    }

    /**
     * @param string $filename
     * @return void
     */
    public function download(string $filename)
    {
        $filename .= '.xlsx';
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Expires: 0");
        try {
            $write = IOFactory::createWriter($this->spreadsheet, IOFactory::WRITER_XLSX);
            $write->save('php://output');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @return void
     */
    protected function fillData()
    {
        $rows = $this->getRows();
        $worksheet = $this->spreadsheet->getActiveSheet();
        foreach ($rows as $rowIdx => $row) {
            foreach ($row as $colIdx => $value) {
                $worksheet->setCellValue([$colIdx + 1, $rowIdx + 1], $value);
                $worksheet->getStyle([$colIdx + 1, $rowIdx + 1])->getAlignment()->setWrapText(true);
            }
        }
    }

    /**
     * @return array[]
     */
    protected function getRows(): array
    {
        $titles = [];
        if ($this->dataFieldsMap) {
            $keys = array_keys($this->dataFieldsMap);
        } else {
            $keys = array_keys($this->data[0]);
        }
        foreach ($keys as $key) {
            array_push($titles, $this->dataFieldsMap[$key] ?? $key);
        }
        $rows = [$titles];
        foreach ($this->data as $item) {
            $row = [];
            foreach ($keys as $key) {
                array_push($row, $item[$key] ?? '');
            }
            $rows[] = $row;
        }

        return $rows;
    }
}
