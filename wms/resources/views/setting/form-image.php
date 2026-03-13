<?php

/**
 * @var $lang
 * @var $key
 * @var $setting
 */

$this->insert('image-upload', [
    'data' => [
        'LANG_ID' => $lang,
        'label'   => $setting['name'],
        'image'   => $setting['value'],
        'name'    => $key,
    ]
]);
