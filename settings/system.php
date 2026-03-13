<?php

return [
    'LANGUAGE' => [
        'LANGUAGES'        => [
            'value'   => ['en-GB', 'zh-HK'],
            'name'    => '多語言(前台)',
            'type'    => 'checkbox[]',
            'options' => [
                'en-GB' => '英文',
                'zh-HK' => '繁體中文',
                'zh-CN' => '簡體中文',
            ],
        ],
        'LANGUAGE_DEFAULT' => [
            'value'   => 'zh-HK',
            'name'    => '默認語言',
            'type'    => 'select',
            'options' => 'LANGUAGES'
        ],
    ]
];
