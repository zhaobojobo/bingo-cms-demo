<?php

namespace Admin\Models;

use Admin\Helper;
use App\Exceptions\NormalException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class Language
 *
 * @package Admin\Models
 */
class Language extends \Admin\Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'language';
        $this->idField = 'id';
    }

    /**
     * @param $data
     *
     * @return int
     */
    public function create($data)
    {
        if (isset($data['key']) && $this->exists($data['key'])) {
            return true;
        }
        unset($data['id']);
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::create($data);
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function exists($key)
    {
        $key = strtolower($key);

        return $this->findOne("`key`=:key", ['key' => $key]);
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function validate($data)
    {
        if (!$data['key']) {
            throw new NormalException(Helper::_('Please enter 「Key」'));
        }

        return $data;
    }

    /**
     * @param $data
     *
     * @return mixed
     */
    public function inputFilter($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return int
     */
    public function update($data, $id)
    {
        $row = $this->find($id);
        if (isset($data['key']) && $data['key'] != $row['key']) {
            $finder = $this->exists($data['key']);
            if ($finder && $finder['id'] != $id) {
                throw new NormalException(Helper::_('This key exists'));
            }
        }
        $data = $this->validate($data);
        $data = $this->inputFilter($data);

        return parent::update($data, $id);
    }

    public function export()
    {
        $titles = ['key', 'en_us', 'zh_cn', 'zh_hk', 'description'];
        $data = [$titles];
        $messages = $this->findAll('', [], SORT_ORDER_DESC);

        foreach ($messages as $message) {
            $row = [];
            foreach ($titles as $title) {
                $row[] = $message[$title];
            }
            $data[] = $row;
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        foreach ($data as $row => $item) {
            $rIndex = $row + 1;
            $item = array_values($item);
            foreach ($item as $column => $value) {
                if($rIndex == 1) {
                    $worksheet->getColumnDimensionByColumn(1 + $column)->setAutoSize(false)->setWidth(30);
                }
                $cIndex = $column + 1;
                $worksheet->setCellValue([$cIndex, $rIndex,], $value);
            }
        }

        return $spreadsheet;
    }
}
