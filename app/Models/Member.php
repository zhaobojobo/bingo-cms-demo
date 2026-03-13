<?php

namespace Site\Models;

use Site\Helper;

/**
 * Class Subscriber
 *
 * @package Admin\Models
 */
class Member extends \Site\Model
{
    protected $errors = [];

    public function __construct()
    {
        parent::__construct('member', 'id');
    }

    public function errors()
    {
        return array_values($this->errors);
    }

    public function setError($field, $info)
    {
        $classname = trim(preg_replace('/]\[|[\[\]]/', '-', $field), '-');
        $error = ['field' => $field, 'classname' => $classname, 'info' => $info];
        $this->errors[$field] = $error;
    }

    public function hasErros()
    {
        return !empty($this->errors);
    }

    public function isLogin()
    {
        return !!$_SESSION['member'];
    }

    public function login($data)
    {
        if (!isset($data['email']) || !$data['email']) {
            $this->setError('email', '請輸入電郵地址');
        }

        if (!isset($data['password']) || !$data['password']) {
            $this->setError('password', '請輸入密碼');
        }

        $member = $this->findOne('email=:username OR phone=:username', ['username' => $data['username']]);

        if (!$member) {
            $this->setError('username', '郵件地址或電話號碼錯誤');
        } else {
            if (!password_verify($data['password'], $member['password'])) {
                $this->setError('password', '密碼錯誤');
            }
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        $_SESSION['member'] = $member;

        return true;
    }

    public function logout()
    {
        $_SESSION['member'] = null;
    }

    public function phoneExist($phone)
    {
        return $this->findOne('phone=:phone', ['phone' => $phone]);
    }

    public function emailExist($email)
    {
        return $this->findOne('email=:email', ['email' => $email]);
    }

    public function userExist($username, $field)
    {
        if ($field == 'phone') {
            if (!$username) {
                $this->setError('username', '請輸入電話號碼');
            } else {
                return $this->phoneExist($username);
            }
        }
        if ($field == 'email') {
            if (!$username) {
                $this->setError('username', '請輸入電郵地址');
            } else {
                return $this->emailExist($username);
            }
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        return true;
    }

    // 保存注冊信息
    private function saveRegister()
    {
        $data = $_SESSION['register'];

        return $this->create($data);
    }

    // 注冊
    public function register($data)
    {
        $data = $this->validate($data);
        return $this->create($data);
    }

    // 注冊驗證
    public function validate($data)
    {
        if (!$data) {
            throw new \Exception('缺少数据');
        }

        return $data;
    }

    // 忘記密碼/校驗
    public function verifyCode($code)
    {
        if (!isset($_SESSION['code']) || $_SESSION['code'] != $code) {
            $this->setError('code', '驗證碼錯誤');
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        $_SESSION['code_hash'] = md5($_SESSION['code']);

        return true;
    }

    public function getResetPasswordUrl()
    {
        if (!isset($_SESSION['code_hash'])) {
            $this->setError('code', '驗證碼已失效, 請重新獲取');
        }

        return Helper::getUrl('/member/reset-password?hash=' . $_SESSION['code_hash']);
    }

    public function sendSmsCode($phone, $field = 'phone', $from = '')
    {
        if (!$phone) {
            $this->setError($field, '請輸入電話號碼');
        }

        if (!preg_match('/^[0-9]{8,11}$/', $phone)) {
            $this->setError($field, '請輸入正確的電話號碼, 如: 88888888');
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;
        $message = sprintf('驗證碼：%s', $code);

        // 发送sms ...

        return $code;
    }

    public function sendEmailCode($email, $filed = 'email')
    {
        if (!$email) {
            $this->setError($filed, '請輸入電郵地址');
        }
        if (!preg_match('/^[.\w]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/', $email)) {
            $this->setError($filed, '請輸入正確的電郵地址, 如: love@hotmail.com');
        }
        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }
        $code = rand(100000, 999999);
        $_SESSION['code'] = $code;
        $subject = '重置密碼驗證碼';
        $body = sprintf('驗證碼：%s', $code);
        return Helper::mail([$email], ['subject' => $subject, 'body' => $body]);
    }

    public function sendVerifyCode($data)
    {
        $user = $this->userExist($data['username'], $data['field']);
        $_SESSION['forget_password_user_id'] = $user['id'];
        if ($data['field'] == 'phone') {
            return $this->sendSmsCode($data['username'], 'username');
        } else {
            return $this->sendEmailCode($data['username'], 'username');
        }
    }

    public function updatePersonalInfo($data, $id)
    {
        if (!$data['name']) {
            $this->setError('name', '請輸入姓名');
        }
        if (!$data['phone']) {
            $this->setError('phone', '請輸入電話號碼');
        } elseif ($data['phone'] != $_SESSION['member']['phone'] && $this->phoneExist($data['phone'])) {
            $this->setError('phone', '此電話號碼已注冊');
        }
        if (!$data['email']) {
            $this->setError('email', '請輸入電郵地址');
        } elseif ($data['email'] != $_SESSION['member']['email'] && $this->emailExist($data['email'])) {
            $this->setError('phone', '此郵件地址已注冊');
        }
        if (!$data['area']) {
            $this->setError('area', '請輸入地區');
        }
        if (!$data['address']) {
            $this->setError('address', '請輸入地址');
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        return $this->update($data, $id);
    }

    public function verifyCodeHash($hash)
    {
        return intval(isset($_SESSION['code_hash']) && $hash == $_SESSION['code_hash']);
    }

    public function resetPassword($data)
    {
        if (!isset($data['password']) || !$data['password']) {
            $this->setError('password', '請輸入密碼');
        } elseif (!preg_match('/[0-9]/', $data['password'])) {
            $this->setError('password', '密碼中至少要包含一位數字');
        } elseif (!preg_match('/[a-zA-Z]/', $data['password'])) {
            $this->setError('password', '密碼中至少要包含一位英文字母');
        } elseif (!preg_match('/^.{6,20}$/', $data['password'])) {
            $this->setError('password', '密碼長度限定在6～20位字符');
        }

        if (!isset($data['password_repeat']) || $data['password_repeat'] !== $data['password']) {
            $this->setError('password_repeat', '確認密碼錯誤');
        }

        if (!isset($_SESSION['forget_password_user_id']) || !$_SESSION['forget_password_user_id']) {
            $this->setError('alert', '操作已超時, 請重新開始');
        }

        if ($this->hasErros()) {
            throw new \Exception('輸入錯誤');
        }

        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->update(['password' => $password], $_SESSION['forget_password_user_id']);
        unset($_SESSION['code_hash']);

        return true;
    }
}
