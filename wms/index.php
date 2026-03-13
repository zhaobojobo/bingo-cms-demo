<?php

use Admin\App;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config.php';
require __DIR__ . '/../constant.php';

$config = require __DIR__ . '/config/config.php';

$app = new App($config);

$app->run(App::RUN_LEVEL_PROD);
