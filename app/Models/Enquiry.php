<?php

namespace Site\Models;

use Site\Model;

class Enquiry extends Model
{
    private $errors = [];

    public function __construct()
    {
        parent::__construct('enquiry', 'id');
    }

    /**
     * 创建预约报价记录
     *
     * @param array $data 表单数据
     * @return int|false 返回插入的ID或false
     */
    public function createEnquiry($data)
    {
        if (!$this->validate($data)) {
            return false;
        }

        $insertData = $this->formatData($data);
        try {
            return $this->create($insertData);
        } catch (\Exception $e) {
            $this->errors[] = '数据库插入失败：' . $e->getMessage();
            return false;
        }
    }

    /**
     * 验证表单数据
     *
     * @param array $data
     * @return bool
     */
    private function validate($data)
    {
        // 第一步验证：装修资料
        if (empty($data['addr'])) {
            $this->errors['addr'] = '詳細單位地址不能為空';
        }

        if (empty($data['ft2'])) {
            $this->errors['ft2'] = '單位面積不能為空';
        } elseif (!is_numeric($data['ft2'])) {
            $this->errors['ft2'] = '單位面積必須為數字';
        }

        if (empty($data['hkd'])) {
            $this->errors['hkd'] = '裝修預算不能為空';
        } elseif (!is_numeric($data['hkd'])) {
            $this->errors['hkd'] = '裝修預算必須為數字';
        }

        // 第三步验证：联络资料
        if (empty($data['name'])) {
            $this->errors['name'] = '姓名不能為空';
        }

        if (empty($data['call'])) {
            $this->errors['call'] = '稱呼不能為空';
        }

        if (empty($data['phone'])) {
            $this->errors['phone'] = '聯絡電話不能為空';
        } elseif (!preg_match('/^[0-9\-+\s]{8,20}$/', $data['phone'])) {
            $this->errors['phone'] = '請輸入有效的聯絡電話';
        }

        // 邮箱格式验证（如果有填写）
        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = '請輸入有效的電郵地址';
        }
//var_dump($this->errors);exit;
        return empty($this->errors);
    }

    /**
     * 格式化数据以匹配数据库表结构
     *
     * @param array $data
     * @return array
     */
    private function formatData($data)
    {
        $insertData = [];

        // 第一步：装修资料
        $insertData['property_status'] = $data['wyzk'] ?? null;
        $insertData['property_type'] = $data['dwzl'] ?? null;
        $insertData['address'] = $data['addr'] ?? null;
        $insertData['area_sqft'] = !empty($data['ft2']) ? intval($data['ft2']) : null;
        $insertData['budget_hkd'] = !empty($data['hkd']) ? floatval($data['hkd']) : null;
        $insertData['residents_count'] = !empty($data['people']) ? intval($data['people']) : null;
        $insertData['rooms_count'] = !empty($data['num']) ? intval($data['num']) : null;

        // 收楼日期处理
        if (!empty($data['date'])) {
            $date = \DateTime::createFromFormat('Y-m-d', $data['date']);
            if ($date) {
                $insertData['handover_date'] = $date->format('Y-m-d');
            }
        }

        // 第二步：设计方针
        $insertData['design_priority'] = $data['sszfg'] ?? '設計風格優先';

        // 偏好风格（JSON格式）
        if (!empty($data['fg']) && is_array($data['fg'])) {
            $insertData['preferred_styles'] = json_encode($data['fg'], JSON_UNESCAPED_UNICODE);
        } else {
            $insertData['preferred_styles'] = json_encode([]);
        }
        $insertData['preferred_styles_other'] = $data['fg_other'] ?? null;

        // 偏好颜色（JSON格式）
        if (!empty($data['color']) && is_array($data['color'])) {
            $insertData['preferred_colors'] = json_encode($data['color'], JSON_UNESCAPED_UNICODE);
        } else {
            $insertData['preferred_colors'] = json_encode([]);
        }
        $insertData['preferred_colors_other'] = $data['color_other'] ?? null;

        // 第三步：联络资料
        $insertData['salutation'] = $data['call'] ?? null;
        $insertData['full_name'] = $data['name'] ?? null;
        $insertData['email'] = $data['email'] ?? null;
        $insertData['phone'] = $data['phone'] ?? null;

        // 认识途径（JSON格式）
        if (!empty($data['tj']) && is_array($data['tj'])) {
            $insertData['source_channels'] = json_encode($data['tj'], JSON_UNESCAPED_UNICODE);
        } else {
            $insertData['source_channels'] = json_encode([]);
        }
        $insertData['source_other'] = $data['tj_other'] ?? null;

        // 其他查询
        $insertData['other_inquiry'] = $data['other'] ?? null;

        // 客户端信息
        $insertData['ip_address'] = $data['ip_address'] ?? null;
        $insertData['user_agent'] = $data['user_agent'] ?? null;

        // 状态默认为1-待处理
        $insertData['status'] = 1;

        return $insertData;
    }

    /**
     * 获取错误信息
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * 根据状态获取预约列表
     *
     * @param int $status
     * @param int $page
     * @param int $size
     * @return array
     */
    public function getListByStatus($status, $page = 1, $size = 20)
    {
        $where = 'status = :status';
        $params = ['status' => $status];
        $order = 'created_at DESC';

        return $this->findPage($page, $size, $where, $params, $order);
    }

    /**
     * 更新预约状态
     *
     * @param int $id
     * @param int $status
     * @return int
     */
    public function updateStatus($id, $status)
    {
        $data = ['status' => $status];
        return $this->update($data, $id);
    }

    /**
     * 添加备注
     *
     * @param int $id
     * @param string $remarks
     * @return int
     */
    public function addRemarks($id, $remarks)
    {
        $data = ['remarks' => $remarks];
        return $this->update($data, $id);
    }

    /**
     * 获取统计数据
     *
     * @return array
     */
    public function getStatistics()
    {
        $stats = [];

        // 总预约数
        $stats['total'] = $this->count();

        // 各状态数量
        $statuses = [1 => '待处理', 2 => '已联系', 3 => '已完成', 0 => '已取消'];
        foreach ($statuses as $status => $label) {
            $stats['status'][$status] = [
                'label' => $label,
                'count' => $this->count('status = :status', ['status' => $status])
            ];
        }

        // 今日新增
        $today = date('Y-m-d');
        $stats['today'] = $this->count('DATE(created_at) = :today', ['today' => $today]);

        return $stats;
    }
}