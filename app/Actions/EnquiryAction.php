<?php


namespace Site\Actions;

use Site\Action;
use Site\Helper;
use Site\Models\Enquiry;

class EnquiryAction extends Action
{
    public function __invoke()
    {
        if (Helper::isPost()) {
            $data = Helper::post();

            // 获取客户端信息
            $data['ip_address'] = Helper::getIp();
            $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';

            $model = new Enquiry();

            try {
                $id = $model->createEnquiry($data);
                if ($id) {
                    return $this->success([], '預約報價提交成功，我們會盡快與您聯繫！');
                }
                return $this->error('提交失敗，請稍後重試');
            } catch (\Exception $e) {
                return $this->error($e->getMessage(), $model->errors());
            }
        }
    }
}
