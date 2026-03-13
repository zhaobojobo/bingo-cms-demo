<?php

return [
    'REGISTER'        => [
        'REGISTER_CAPTCHA'                                => [
            'value'   => 0,
            'name'    => '驗證碼',
            'type'    => 'select',
            'options' => [
                '0' => '無',
                '1' => 'Google Recaptcha V2',
                '2' => 'Google Recaptcha V3',
            ]
        ],
        'REGISTER_OTP'                                    => [
            'value'   => 0,
            'name'    => 'OTP',
            'type'    => 'select',
            'options' => [
                '0' => '無',
                '1' => 'Email',
                '2' => 'SMS',
            ]
        ],
        'REGISTER_MUST_CONFIRM_USE_TERMS'                 => [
            'value' => 0,
            'name'  => '必須確認「使用條款」',
            'type'  => 'checkbox'
        ],
        'REGISTER_MUST_CONFIRM_INFO_COLLECTION_STATEMENT' => [
            'value' => 0,
            'name'  => '必須確認「個人信息收集聲明」',
            'type'  => 'checkbox'
        ],
        'REGISTER_MUST_CONFIRM_PRIVACY_STATEMENT'         => [
            'value' => 0,
            'name'  => '必須確認「隱私政策聲明」',
            'type'  => 'checkbox'
        ],
    ],
    'LOGIN'           => [
        'LOGIN_CAPTCHA'                     => [
            'value'   => 0,
            'name'    => '驗證碼',
            'type'    => 'select',
            'options' => [
                '0' => '無',
                '1' => 'Google Recaptcha V2',
                '2' => 'Google Recaptcha V3',
            ]
        ],
        'LOGIN_OTP'                         => [
            'value'   => 0,
            'name'    => 'OTP',
            'type'    => 'select',
            'options' => [
                '0' => '無',
                '1' => 'Email',
                '2' => 'SMS',
            ]
        ],
        'LOGIN_WRONG_PASSWORD_MAX_ATTEMPTS' => [
            'value'   => 0,
            'name'    => '錯誤密碼最大嘗試次數',
            'type'    => 'select',
            'options' => [
                '0'  => '無限',
                '5'  => '5次',
                '10' => '10次',
                '20' => '20次',
            ]
        ],
        'LOGIN_METHOD'                      => [
            'value'   => 0,
            'name'    => '登入方式',
            'type'    => 'select',
            'options' => [
                '0' => '用戶名+密碼',
                '1' => '電郵+密碼',
                '2' => '電話+密碼',
            ]
        ],
        'REQUIRED_ACTIVATE'                 => [
            'value' => 0,
            'name'  => '激活以後才可以登入',
            'type'  => 'checkbox'
        ],
    ],
    'PASSWORD'        => [
        'PASSWORD_MIN_LENGTH'                         => [
            'value' => 6,
            'name'  => '最小長度',
            'type'  => 'input'
        ],
        'PASSWORD_MAX_LENGTH'                         => [
            'value' => 20,
            'name'  => '最大長度',
            'type'  => 'input'
        ],
        'PASSWORD_RANDOM_INIT'                        => [
            'value' => 0,
            'name'  => '初始化隨即密碼',
            'type'  => 'checkbox'
        ],
        'PASSWORD_MUST_CONTAIN_UPPERCASE_LETTERS'     => [
            'value' => 0,
            'name'  => '必須包含大寫字母',
            'type'  => 'checkbox'
        ],
        'PASSWORD_MUST_CONTAIN_LOWERCASE_LETTERS'     => [
            'value' => 0,
            'name'  => '必須包含小寫字母',
            'type'  => 'checkbox'
        ],
        'PASSWORD_MUST_CONTAIN_NON_ALPHA_CHARS'       => [
            'value' => 0,
            'name'  => '必須包含非字母字符',
            'type'  => 'checkbox'
        ],
        'PASSWORD_MUST_CONTAIN_NUMBER_CHARS'          => [
            'value' => 0,
            'name'  => '必須包含數字字符',
            'type'  => 'checkbox'
        ],
        'PASSWORD_CANNOT_CONTAIN_CONSECUTIVE_NUMBERS' => [
            'value' => 0,
            'name'  => '不能包含連續數字',
            'type'  => 'checkbox'
        ],
        'PASSWORD_CANNOT_CONTAIN_CONSECUTIVE_LETTERS' => [
            'value' => 0,
            'name'  => '不能包含連續字母',
            'type'  => 'checkbox'
        ],
    ],
    'PASSWORD_CHANGE' => [
        'CHANGE_PASSWORD_CANNOT_EQUAL_CURRENT'     => [
            'value' => 0,
            'name'  => '不能與舊密碼相同',
            'type'  => 'checkbox'
        ],
        'CHANGE_PASSWORD_MUST_VERIFY_OLD_PASSWORD' => [
            'value' => 0,
            'name'  => '必須驗證舊密碼',
            'type'  => 'checkbox'
        ],
        'EXPIRE_PASSWORD_DURATION'                 => [
            'value'   => 0,
            'name'    => '有效期',
            'type'    => 'select',
            'options' => [
                '0'   => '永不過期',
                '30'  => '30天',
                '90'  => '90天',
                '180' => '180天',
            ]
        ],
        'EXPIRE_PASSWORD_ALERT_TIME'               => [
            'value'   => 0,
            'name'    => '過期提醒郵件發送時間',
            'type'    => 'select',
            'options' => [
                '0' => '從不提醒',
                '1' => '過期前1天',
                '2' => '過期前3天',
                '3' => '過期前10天',
            ]
        ],
        'RESET_PASSWORD_LINK_EXPIRE'               => [
            'value'   => 0,
            'name'    => '重置密碼鏈接有效期',
            'type'    => 'select',
            'options' => [
                '0'  => '無限制',
                '15' => '15分鍾',
                '30' => '30分鍾',
                '60' => '60分鍾',
            ]
        ]
    ],
];
