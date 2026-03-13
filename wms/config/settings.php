<?php

declare(strict_types=1);

$db = require ROOT . '/config/db.php';

return [
    'tmp' => WMS . '/tmp',
    'logs' => WMS . '/logs',
    'data' => WMS . '/data',
    'views' => WMS . '/views',
    'templates' => WMS . '/templates',
    'languages' => WMS . '/languages',

    'database' => [
        'host' => $db['host'],
        'dbname' => $db['database'],
        'username' => $db['username'],
        'password' => $db['password'],
    ],
];
