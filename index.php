<?php

use App\Db;
use App\Register;
use League\Plates\Engine;
use Pimple\Container;
use Site\App;
use Site\Helper;
use Site\Models\Language;
use Site\Translator;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';
require __DIR__ . '/constant.php';

try {
    if (DEBUG) {
        error_reporting(E_ALL);
        ini_set('log_errors', 'On');
        ini_set('display_errors', 'On');
        ini_set('display_startup_errors', 'On');
        $config  = require __DIR__ . '/config/config.php';
        $logFile = $config['logs'] . '/' . date('Ym') . '.log';
        if (!file_exists($logFile)) {
            if (!touch($logFile)) {
                throw new Exception('Log file creation failed, please check permissions');
            }
            if (!chmod($logFile, 0777)) {
                throw new Exception('Log file permissions update failed');
            }
        }
        ini_set('error_log', $logFile);
    } else {
        error_reporting(0);
        ini_set('log_errors', 'Off');
        ini_set('display_errors', 'Off');
        ini_set('display_startup_errors', 'Off');
    }

    $container = new Container();
    $app       = new App($container);

    $container['config'] = function ($c) {
        return require __DIR__ . '/config/config.php';
    };
    $container['pdo']    = function ($c) {
        return Helper::getPdo($c['config']['db']);
    };
    $container['db']     = function ($c) {
        return new Db($c['pdo']);
    };

    $language         = require __DIR__ . '/config/language.php';
    $languageSettings = $language($container['pdo']);

    // 处理用户输入，确保安全性
    function sanitizeInput($input): string
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    // 处理 URI 中的用户输入
    $uri = isset($_SERVER['REQUEST_URI']) ? sanitizeInput($_SERVER['REQUEST_URI']) : '/';
    $uri = str_replace(SUB_DIR, '', $uri);
    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri         = ltrim($uri, '/');
    $parts       = explode('/', $uri);
    $currentLang = $languageSettings['defaultLang'];
    if (!empty($parts)) {
        $paramLang = $parts[0];
        if (array_key_exists($paramLang, $languageSettings['languages'])) {
            $currentLang = $paramLang;
            unset($parts[0]);
        }
    }
    $container['languages']   = $languageSettings['languages'];
    $container['defaultLang'] = $languageSettings['defaultLang'];
    $container['currentLang'] = htmlspecialchars($currentLang);
    $container['uri']         = '/' . implode('/', $parts);
    $container['view']        = function ($c) {
        return new Engine($c['config']['view']);
    };

    $dispatcher = FastRoute\simpleDispatcher($container['config']['routes']);
    $routeInfo  = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $container['uri']);
    Register::set('container', $container);

    $container['system'] = setting('system');
    $langModel           = new Language();
    $messages            = $langModel->findAll();
    $container['t']      = new Translator($messages);

    ini_set('session.cookie_httponly', 1);
    session_start(['name' => 'MEMBER_ID']);

    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            echo '404 Not Find!';
            http_response_code(404);
            break;
        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            echo '405';
            http_response_code(405);
            break;
        case FastRoute\Dispatcher::FOUND:
            $action = App::actionFactory(
                $routeInfo[1],
                ['view' => $app->get('view'), 'lang' => $container['currentLang']]
            );
            echo call_user_func_array($action, $routeInfo[2]);
            break;
    }
} catch (Throwable $e) {
    http_response_code(500);
    if (DEBUG) {
        echo $e->getFile();
        echo $e->getLine();
        echo $e->getMessage();
    } else {
        echo 'Internal Server Error';
    }
}
