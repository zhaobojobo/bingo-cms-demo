<?php

namespace App\Member;

use Admin\Helper;
use Admin\Models\Base;
use Admin\Profile;
use App\Exceptions\NormalException;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/**
 * Class Member
 *
 * @package Admin\Models
 */
class Member extends Base
{
    public const  STATUS_NORMAL = 0;
    public const  STATUS_LOCKED = 1;

    public function __construct()
    {
        parent::__construct();
        $this->table = 'member';
        $this->idField = 'id';
        $this->profile = new Profile('member_profile', 'member_id');
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function create($data)
    {
        $data = $this->validate($data, 'create');
        $data = $this->inputFilter($data);
        $data['create_time'] = date('Y-m-d H:i:s');
        $data['update_time'] = $data['create_time'];

        return parent::create($data);
    }

    /**
     * @param        $data
     * @param string $scenes
     *
     * @return mixed
     */
    public function validate($data, $scenes = 'all')
    {
        if (isset($data['username']) && !$data['username']) {
            throw new NormalException(Helper::_('Please enter 「Username」'));
        }
        if (isset($data['password'])) {
            if (strlen($data['password']) == 0) {
                throw new NormalException(Helper::_('Password can not be blank'));
            }
            if (strlen($data['password']) < 6) {
                throw new NormalException(Helper::_('Password length is at least 6 characters'));
            }
            if (strlen($data['password']) > 20) {
                throw new NormalException(Helper::_('Maximum password length is 20 characters'));
            }
            $data['password'] = Helper::password($data['password']);
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
        if (isset($data['birth_date']) && !$data['birth_date']) {
            unset($data['birth_date']);
        }
        if (isset($data['subscription'])) {
            $data['subscription'] = intval($data['subscription']);
        }

        return $data;
    }

    /**
     * @param $data
     * @param $id
     *
     * @return array
     */
    public function update($data, $id)
    {
        if (isset($data['password']) && strlen($data['password']) != 0) {
            if (strlen($data['password']) < 6) {
                throw new NormalException(Helper::_('Password length is at least 6 characters'));
            }
            if (strlen($data['password']) > 20) {
                throw new NormalException(Helper::_('Maximum password length is 20 characters'));
            }
            if (!preg_match('/\w/', $data['password'])) {
                throw new NormalException(Helper::_('密碼至少要包含一個字母'));
            }
            if (!preg_match('/\d/', $data['password'])) {
                throw new NormalException(Helper::_('密碼至少要包含一個數字'));
            }
            $data['password'] = Helper::password($data['password']);
        } else {
            unset($data['password']);
        }

        return parent::update($data, $id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function detail($id)
    {
        $data = $this->find($id);
        unset($data['password']);

        return $data;
    }

    /**
     * @return array
     */
    public function emails($where, $params = [])
    {
        return $this->columns('email', $where, $params);
    }

    public function export()
    {
        $titles = ['username'];
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
                if ($rIndex == 1) {
                    $worksheet->getColumnDimensionByColumn(1 + $column)->setAutoSize(false)->setWidth(30);
                }
                $cIndex = $column + 1;
                $worksheet->setCellValue([$cIndex, $rIndex,], $value);
            }
        }

        return $spreadsheet;
    }
}
