<?php

namespace Admin;

use App\Db;
use App\Exceptions\BannedException;
use App\Exceptions\LoginException;
use App\Exceptions\NormalException;
use App\Exceptions\PermissionException;
use App\Exceptions\ValidationException;
use App\Register;
use App\Setting;
use Exception;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use LogicException;
use Pimple\Container;

use function FastRoute\simpleDispatcher;

/**
 * Class App
 *
 * @package Admin
 */
class App
{
    public const RUN_LEVEL_PROD = 0;
    public const RUN_LEVEL_DEV = 1;

    public $config;

    /**
     * App constructor.
     *
     * @param $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        define('WMS_LANGUAGES', $this->config['lang']['languages']);
        define('WMS_DEFAULT_LANG', WMS_LANGUAGES[$this->config['lang']['defaultLang']]['code']);
    }

    /**
     * @param int $level
     */
    public function run($level = 0)
    {
        error_reporting(E_ALL);
        $logFile = $this->config['paths']['logs'] . '/' . date('Ym') . '.log';
        if (!file_exists($logFile)) {
            if (!touch($logFile)) {
                throw new LoginException('Log file creation failed, please check permissions');
            }
            if (!chmod($logFile, 0777)) {
                throw new LoginException('Log file permissions update failed');
            }
        }

        if ($level == self::RUN_LEVEL_PROD) {
            ini_set('log_errors', 'Off');
            ini_set('display_errors', 'Off');
            ini_set('display_startup_errors', 'Off');
        } elseif ($level == self::RUN_LEVEL_DEV) {
            ini_set('log_errors', 'On');
            ini_set('error_log', $logFile);
            ini_set('display_errors', 'On');
            ini_set('display_startup_errors', 'On');
        }

        $container = new Container();
        $container['config'] = function ($c) {
            return $this->config;
        };
        $container['pdo'] = function ($c) {
            return Helper::getPdo($c['config']['db']);
        };
        $container['db'] = function ($c) {
            return new Db($c['pdo']);
        };

        $_GET = Helper::xssClean($_GET);
        $_POST = Helper::xssClean($_POST);

        function sanitizeInput($input): string
        {
            return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }

        $uri = sanitizeInput($_SERVER['REQUEST_URI']);
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = str_replace(SUB_DIR . '/wms/', '', rawurldecode($uri));
        $parts = explode('/', $uri);

        $currentLang = $container['config']['lang']['defaultLang'];
        if (isset($_COOKIE['userLang']) && $_COOKIE['userLang']) {
            $currentLang = $_COOKIE['userLang'];
        }
        if (!empty($parts)) {
            $paramLang = Helper::languageId($parts[0]);
            if (array_key_exists($paramLang, $container['config']['lang']['languages'])) {
                $currentLang = $paramLang;
                unset($parts[0]);
            }
        }
        $container['currentLang'] = $currentLang;

        $messages = [];
        $messageFilePath = sprintf("%s/%s.php", $container['config']['paths']['languages'], $currentLang);

        // 验证文件路径
        if (!preg_match('/^[a-zA-Z0-9_-]+(?:\/[a-zA-Z0-9_-]+)*$/', $currentLang) || !file_exists(
                $messageFilePath
            ) || !is_readable($messageFilePath)) {
            throw new Exception('语言包路径错误');
        }

        // 加载语言文件
        $loadedMessages = require $messageFilePath;

        // 验证文件内容
        if (!is_array($loadedMessages)) {
            throw new Exception('语言包格式错误');
        }

        $messages = $loadedMessages;

        $container['t'] = new Translator($messages);
        $container['uri'] = '/' . implode('/', $parts);


        $dispatcher = simpleDispatcher(
            function (RouteCollector $r) use ($container) {
                Helper::addRoutes($r, $container['config']['routes']);
            }
        );
        $routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $container['uri']);

        Register::set('container', $container);

        $setting = new Setting('system');
        $systemSettings = $setting->getValues();
        define('LANGUAGES', $systemSettings['LANGUAGE']['LANGUAGES']);
        define('DEFAULT_LANG', $systemSettings['LANGUAGE']['LANGUAGE_DEFAULT']);

        session_start(['name' => 'BINGO_PANEL', 'cookie_path' => SUB_DIR . '/wms/',]);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                http_response_code(404);
                if (Helper::isAjax()) {
                    die(json_encode(['status' => false, 'message' => 'HTTP NOT FOUND']));
                }
                include sprintf("%s/ERROR-404.php", $container['config']['paths']['resources']);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                http_response_code(405);
                if (Helper::isAjax()) {
                    $methods = implode(',', $allowedMethods);
                    $message = sprintf('Only requests for the [%s] method are supported', $methods);
                    die(json_encode(['status' => false, 'message' => $message]));
                }
                include sprintf("%s/ERROR-404.php", $container['config']['paths']['resources']);
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                [$class, $action] = explode(':', $handler, 2);
                try {
                    $controller = Helper::build($class, []);
                    if (!method_exists($controller, $action)) {
                        throw new LogicException(sprintf('%s::%s not found', $class, $action));
                    }
                    $result = call_user_func_array([$controller, $action], $vars);
                    null !== $result && die($result);
                } catch (PermissionException $exception) {
                    $message = $exception->getMessage();
                    if (Helper::isAjax()) {
                        die(json_encode(['status' => false, 'message' => $message]));
                    }
                    header('Location: ' . Helper::getUrl('/error-403'));
                    exit;
                } catch (BannedException $exception) {
                    $message = $exception->getMessage();
                    if (Helper::isAjax()) {
                        die(json_encode(['status' => false, 'message' => $message]));
                    }
                    header('Location: ' . Helper::getUrl('/error-banned'));
                    exit;
                } catch (ValidationException $exception) {
                    $message = $exception->getMessage();
                    foreach ($exception->getErrors() as $key => $error) {
                        $message .= ':<br><i class="fa fa-fw fa-info-circle"></i>「' . $key . '」' . $error;
                    }
                    if (Helper::isAjax()) {
                        die(json_encode(['status' => false, 'message' => $message]));
                    }
                    include sprintf("%s/ERROR-ACCESS.php", $container['config']['paths']['resources']);
                } catch (LoginException $exception) {
                    $message = $exception->getMessage();
                    if (Helper::isAjax()) {
                        die(json_encode(['status' => false, 'message' => $message]));
                    }
                    include sprintf("%s/ERROR-ACCESS.php", $container['config']['paths']['resources']);
                } catch (NormalException $exception) {
                    $message = $exception->getMessage();
                    if (Helper::isAjax()) {
                        die(json_encode(['status' => false, 'message' => $message]));
                    }
                    include sprintf("%s/ERROR-ACCESS.php", $container['config']['paths']['resources']);
                } catch (Exception $exception) {
                    ob_clean();
                    http_response_code(500);
                    if (!DEBUG) {
                        $message = 'Oh eyeballs! Something went wrong. We\'re looking to see what happened.';
                        if (Helper::isAjax()) {
                            die(json_encode(['status' => false, 'message' => $message]));
                        }
                        include sprintf("%s/ERROR-500.php", $container['config']['paths']['resources']);
                    } else {
                        if (Helper::isAjax()) {
                            $message = $exception->getMessage() . "\n" . $exception->getTraceAsString();
                            die(json_encode(['status' => false, 'message' => $message]));
                        }
                        include sprintf("%s/ERROR-DEBUG.php", $container['config']['paths']['resources']);
                    }
                }
                break;
            default:
                die('Disaster level error, contact administrator immediately harper.zhang@hotmail.com');
        }
    }
}
