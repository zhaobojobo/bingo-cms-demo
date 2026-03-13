<?php

$config = [];

// 路徑
$config['root'] = dirname(__DIR__);
$config['config'] = $config['root'] . '/config';
$config['logs'] = $config['root'] . '/logs';
$config['resources'] = $config['root'] . '/resources';
$config['cache'] = $config['root'] . '/data/cache';
$config['uploads'] = $config['root'] . '/data/uploads';
$config['theme'] = 'theme';
$config['theme_path'] = $config['root'] . '/themes' . '/' . $config['theme'];
$config['view'] = $config['root'] . '/themes/' . $config['theme'] . '/view';

// 數據庫
$config['db'] = require 'db.php';

// 路由
$config['routes'] = require 'routes.php';

$config['allowedSuffixes'] = [
    'gif',
    'jpeg',
    'jpg',
    'png',
    'txt',
    'pdf',
    'doc',
];
$config['allowedMimeTypes'] = [
    'image/gif',
    'image/jpeg',
    'image/png',
    'text/plain',
    'application/pdf',
    'application/msword',
];

$config['GOOGLE_RECAPTCHA'] = false;

return $config;
