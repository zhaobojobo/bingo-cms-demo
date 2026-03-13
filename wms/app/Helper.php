<?php

namespace Admin;

use Admin\Models\Catalog;
use Admin\Models\Page;
use Admin\Models\User;
use App\Domain\Permission\Access\AccessFinder;
use App\Domain\Permission\Permission\PermissionFinder;
use App\Exceptions\LoginException;
use App\Exceptions\PermissionException;
use App\Infrastructure\Domain\Permission\Access\PdoAccessFinderRepository;
use App\Infrastructure\Domain\Permission\Permission\PdoPermissionFinderRepository;
use App\Register;
use App\Setting;
use Exception;
use FastRoute\RouteCollector;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use ReflectionClass;
use ReflectionException;
use voku\helper\AntiXSS;

/**
 * Class Helper
 *
 * @package App
 */
class Helper
{
    /**
     * @param $params
     *
     * @return PDO
     */
    public static function getPdo(array $params)
    {
        $host = $params['host'];
        $dbname = $params['database'];
        $username = $params['username'];
        $password = $params['password'];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        return new PDO($dsn, $username, $password, [
            // Turn off persistent connections
            PDO::ATTR_PERSISTENT => false,
            // Enable exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Emulate prepared statements
            PDO::ATTR_EMULATE_PREPARES => true,
            // Set default fetch mode to array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // Set character set
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
        ]);
    }

    /**
     * @param string $class
     * @param array $vars
     *
     * @return object
     * @throws ReflectionException
     * @throws Exception
     */
    public static function build(string $class, array $vars = [])
    {
        $ref = new ReflectionClass($class);
        if (!$ref->isInstantiable()) {
            throw new Exception("Class {$class} does not exist");
        }
        $constructor = $ref->getConstructor();
        if (is_null($constructor)) {
            return new $class();
        }
        $params = $constructor->getParameters();
        $resolveParams = [];
        foreach ($params as $key => $value) {
            $name = $value->getName();
            if (isset($vars[$name])) {
                $resolveParams[] = $vars[$name];
            } else {
                $default = $value->isDefaultValueAvailable() ? $value->getDefaultValue() : null;
                if (is_null($default)) {
                    if ($value->getClass()) {
                        $resolveParams[] = static::build(
                            $value->getClass()->getName(),
                            $vars
                        );
                    } else {
                        throw new Exception(
                            "{$name} no value passed and no default"
                        );
                    }
                } else {
                    $resolveParams[] = $default;
                }
            }
        }

        return $ref->newInstanceArgs($resolveParams);
    }

    /**
     * @param RouteCollector $r
     * @param                $routes
     */
    public static function addRoutes(RouteCollector $r, $routes)
    {
        foreach ($routes as $route) {
            if (isset($route[3]) && is_array($route[3])) {
                $r->addGroup(
                    $route[1],
                    function (RouteCollector $r) use ($route) {
                        self::addRoutes($r, $route[3]);
                    }
                );
            }
            self::addRoute($r, $route);
        }
    }

    /**
     * @param RouteCollector $r
     * @param                $route
     */
    public static function addRoute(RouteCollector $r, $route)
    {
        $info = explode(':', $route[2]);
        $r->addRoute($route[0], $route[1], implode(':', $info));
    }

    /**
     * @param string $tel
     * @param string $sp
     *
     * @return string
     */
    public static function telLink(string $tel, string $sp = '')
    {
        if ($sp != '') {
            $tels = array_filter(explode($sp, $tel));
        } else {
            $tels = [$tel];
        }
        foreach ($tels as $i => $tel) {
            $tels[$i] = '<a href="' . Helper::telUri($tel) . '">' . $tel . '</a>';
        }

        return implode("\n<span class=\"sp\">{$sp}</span>\n", $tels);
    }

    /**
     * @param $telNumber
     *
     * @return string
     */
    public static function telUri($telNumber)
    {
        return sprintf('tel:%s', self::telNumber($telNumber, false));
    }

    /**
     * @param      $telNumber
     * @param bool $space
     * @param bool $noPlus
     * @param bool $noArea
     *
     * @return mixed|string|string[]|null
     */
    public static function telNumber(
        $telNumber,
        $space = true,
        $noPlus = false,
        $noArea = false
    ) {
        $number = trim($telNumber);
        if (preg_match(
            '/\+?\s*?(\(?\d+\)?\s*(\d{4}\s*\d{4}))/',
            $number,
            $numbers
        )) {
            $number = $numbers[0];
            if ($noPlus) {
                $number = $numbers[1];
                if ($noArea) {
                    $number = $numbers[2];
                }
            }

            if (!$space) {
                $number = preg_replace('/\s+/', '', $number);
            }
        } elseif (preg_match(
            '/\+?(((\d+)-)?((\d+)-(\d+)))/',
            $number,
            $numbers
        )) {
            $number = $numbers[0];
            if ($noPlus) {
                $number = $numbers[1];
                if ($noArea) {
                    $number = $numbers[3];
                }
            }
            if (!$space) {
                $number = preg_replace('/-/', '', $number);
            }
        }

        return $number;
    }

    /**
     * @param string $email
     *
     * @return string
     */
    public static function emailLink(string $email)
    {
        return '<a href="' . self::emailUri($email) . '">' . $email . '</a>';
    }

    /**
     * @param $email
     *
     * @return string
     */
    public static function emailUri($email)
    {
        return sprintf('mailto:%s', $email);
    }

    /**
     * @param        $html
     * @param string $height
     * @param string $width
     *
     * @return string|string[]|null
     */
    public static function googleMapWithSize(
        string $html,
        string $height = '400',
        string $width = '100%'
    ) {
        return preg_replace(
            ['/(?<=width=")\d+%?(?=")/', '/(?<=height=")\d+(?=")/'],
            [$width, $height],
            $html
        );
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public static function normalizeLang(string $lang)
    {
        $parts = explode('-', $lang);
        if (isset($parts[0])) {
            $parts[0] = strtolower($parts[0]);
        }
        if (isset($parts[1])) {
            $parts[1] = strtoupper($parts[1]);
        }
        if (count($parts) == 2) {
            return implode('-', $parts);
        }

        return $lang;
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public static function languageId(string $lang)
    {
        return strtolower(str_replace('-', '_', $lang));
    }

    /**
     * @param string $lang
     *
     * @return mixed|string
     */
    public static function getLangUrl(string $langId, $uri = '')
    {
        $c = Register::get('container');
        $uri = $uri ?: $c['uri'];
        if ($langId != $c['config']['lang']['defaultLang']) {
            $uri = sprintf(
                '/%s%s',
                strtolower($c['config']['lang']['languages'][$langId]['code']),
                $uri != '/' ? $uri : ''
            );
        }

        if ($_SERVER['QUERY_STRING']) {
            return '/wms' . $uri . '?' . $_SERVER['QUERY_STRING'];
        }

        return SUB_DIR . '/wms' . $uri;
    }

    /**
     * @param string $lang
     *
     * @return mixed
     */
    public static function getLangLabel(string $langId)
    {
        $c = Register::get('container');

        return $c['config']['lang']['languages'][$langId]['label'];
    }

    /**
     * @param string $html
     *
     * @return string|string[]|null
     */
    public static function stripYtbSize(string $html)
    {
        return preg_replace('/width="[\d]*" height="[\d]*"/', '', $html);
    }

    /**
     * @param $phone
     *
     * @return string
     */
    public static function whatsAppUrl($tel, $web = true)
    {
        $tel = self::telNumber($tel, false);

        return $web ? sprintf(
            'https://web.whatsapp.com/send?phone=%s',
            $tel
        ) : sprintf(
            'https://api.whatsapp.com/send?phone=%s',
            $tel
        );
    }

    /**
     * @param $text
     *
     * @return string
     */
    public static function nl2p($text)
    {
        $text = strip_tags($text);
        $lines = explode(PHP_EOL, $text);
        foreach ($lines as $i => $line) {
            $line = trim($line);
            if (strlen($line) == 0) {
                unset($lines[$i]);
            } else {
                $lines[$i] = $line;
            }
        }

        return '<p>' . implode("</p>\n<p>", $lines) . "</p>\n";
    }

    /**
     * @param        $tel
     * @param string $sp
     * @param int $n
     *
     * @return mixed
     */
    public static function getOneTel($tel, $sp = ' ', $n = 0)
    {
        if (!$sp) {
            return $tel;
        }
        $tels = array_values(array_filter(explode($sp, $tel)));

        return $tels[$n];
    }

    /**
     * @param $route
     *
     * @return string
     */
    public static function activeNavItem($route, $className = 'active')
    {
        $c = Register::get('container');
        $route = ltrim($route, '/');
        if (strlen($route) == 0) {
            $active = '/' == $c['uri'];
        } else {
            $uri = ltrim($c['uri'], '/');
            $active = preg_match(
                '/^' . str_replace('/', '\/', $route) . '/',
                $uri
            );
        }

        return $active ? sprintf(' %s', $className) : '';
    }

    /**
     * @return bool
     */
    public static function isAjax()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(
                $_SERVER['HTTP_X_REQUESTED_WITH']
            ) == 'xmlhttprequest') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }

    /**
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }

    /**
     * @param       $message
     * @param array $params
     */
    public static function _e($message, $params = [])
    {
        echo self::_($message, $params = []);
    }

    /**
     * @param       $message
     * @param array $params
     *
     * @return mixed
     */
    public static function _($message, $params = [])
    {
        $c = Register::get('container');

        return $c['t']->_($message, $params);
    }

    /**
     * @param $langId
     * @param $name
     *
     * @return string
     */
    public static function dataFieldName($langId, $name)
    {
        return sprintf('__data[%s][%s]', $langId, $name);
    }

    /**
     * @param $langId
     * @param $name
     *
     * @return string
     */
    public static function profileFieldName($langId, $name)
    {
        return sprintf('__profile[%s][%s]', $langId, $name);
    }

    public static function xssClean($input)
    {
        $antiXss = new AntiXSS();

        if (is_string($input)) {
            $input = $antiXss->xss_clean($input);
        } elseif (is_array($input)) {
            foreach ($input as $key => $value) {
                $input[$key] = self::xssClean($value);
            }
        }

        return $input;
    }

    /**
     * @param null $name
     * @param null $default
     *
     * @return mixed|null
     */
    public static function get($name = null, $default = null)
    {
        if ($name) {
            return $_GET[$name] ?? $default;
        } else {
            return $_GET;
        }
    }

    /**
     * @param null $name
     * @param null $default
     *
     * @return mixed|null
     */
    public static function post($name = null, $default = null)
    {
        if ($name) {
            return $_POST[$name] ?? $default;
        } else {
            return $_POST;
        }
    }

    /**
     * @param     $list
     * @param int $parent_id
     *
     * @return array
     */
    public static function listAsTree($list, $parent_id = 0)
    {
        $tree = [];
        if (!empty($list)) {
            $newList = [];
            foreach ($list as $k => $v) {
                $newList[$v['id']] = $v;
            }
            foreach ($newList as $value) {
                if ($parent_id == $value['parent_id']) {
                    $tree[] = &$newList[$value['id']];
                } elseif (isset($newList[$value['parent_id']])) {
                    $newList[$value['parent_id']]['children'][] = &$newList[$value['id']];
                }
            }
        }

        return $tree;
    }

    /**
     * @param array $arrData
     * @param int $level
     *
     * @return array
     */
    public static function treeAsList($arrData = [], $level = -1)
    {
        if (empty($arrData) || !is_array($arrData)) {
            return $arrData;
        }
        $level++;
        $arrRes = [];
        foreach ($arrData as $k => $v) {
            $arrTmp = $v;
            if (isset($v['children'])) {
                unset($arrTmp['children']);
            }
            $arrTmp['level'] = $level;
            $arrRes[] = $arrTmp;
            if (!empty($v['children'])) {
                $arrTmp = self::treeAsList($v['children'], $level);
                $arrRes = array_merge($arrRes, $arrTmp);
            }
        }

        return $arrRes;
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function indexAsId($data)
    {
        $list = [];
        foreach ($data as $item) {
            $list[$item['id']] = $item;
        }

        return $list;
    }

    /**
     * @param $val
     *
     * @return false|int
     */
    public static function isEmail($val)
    {
        return preg_match(
            '/^[a-z0-9]+([-_.]?[a-z0-9]+)*@[a-z0-9]+(-[a-z0-9]+)*(\.[a-z0-9]+(-[a-z0-9]+)*)*(\.[a-z]+)$/i',
            $val
        );
    }

    /**
     * @return bool
     */
    public static function hasLogin()
    {
        return boolval($_SESSION['user'] ?? null);
    }

    public static function userHasPermission($permission, $id)
    {
        $model = new User();

        return $model->hasPermission($permission, $id);
    }

    public static function hasPermission($code, $user = null)
    {
        $user = $user ?: $_SESSION['user'];
        $c = Register::get('container');
        if ($user['id'] != 1) {
            $accessRepository = new PdoAccessFinderRepository($c['pdo']);
            $accessService = new AccessFinder($accessRepository);
            $access = $accessService->findOneOfCode($code);

            if (!$access) {
                return false;
            }

            $permissionRepository = new PdoPermissionFinderRepository($c['pdo']);
            $permissionService = new PermissionFinder($permissionRepository);

            $permission = $permissionService->findOneOfAccess($access->getId(), $user['role_id']);
            if (!$permission || !$permission->getStatus()) {
                return false;
            }
        }

        return true;
    }

    public static function checkPermission($code, $user = null)
    {
        $user = $user ?: $_SESSION['user'];
        $c = Register::get('container');
        if ($user['id'] != 1) {
            $accessRepository = new PdoAccessFinderRepository($c['pdo']);
            $accessService = new AccessFinder($accessRepository);
            $access = $accessService->findOneOfCode($code);
            if (!$access) {
                throw new LoginException('Access code invalid');
            }

            $permissionRepository = new PdoPermissionFinderRepository($c['pdo']);
            $permissionService = new PermissionFinder($permissionRepository);

            $permission = $permissionService->findOneOfAccess($access->getId(), $user['role_id']);
            if (!$permission || !$permission->getStatus()) {
                throw new PermissionException(Helper::_('No permission'));
            }
        }
    }

    public static function checkReviewPermission($code, $src)
    {
        if ($_SESSION['user']['id'] != 1 && $src) {
            $reviewers = explode(',', $src['reviewers']);
            if ($reviewers) {
                if (!in_array($_SESSION['user']['id'], $reviewers)) {
                    throw new PermissionException(Helper::_('No permission'));
                }
            }
        }

        self::checkPermission($code);
    }

    public static function checkEditPermission($code, $src)
    {
        if ($_SESSION['user']['id'] != 1 && $src) {
            $editors = explode(',', $src['editors']);
            if ($editors) {
                if (!in_array($_SESSION['user']['id'], $editors)) {
                    throw new PermissionException(Helper::_('No permission'));
                }
            }
        }

        self::checkPermission($code);
    }

    /**
     * @param $post
     *
     * @return string
     */
    public static function previewUrl($post)
    {
        $url = Helper::getUrl('/post/' . ($post['slug'] ?: $post['id']), '');
        $key = md5($url . time());
        setcookie('PREVIEW_KEY', $key, time() + 100, '/post');

        return $url . '?action=preview&key=' . $key;
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    public static function getUrl(string $uri, $prefix = '/wms')
    {
        $c = Register::get('container');
        $langId = $c['currentLang'];
        if ($langId != $c['config']['lang']['defaultLang']) {
            $uri = sprintf(
                '/%s%s',
                strtolower($c['config']['lang']['languages'][$langId]['code']),
                $uri != '/' ? $uri : ''
            );
        }

        return SUB_DIR . $prefix . $uri;
    }

    public static function staticUrl()
    {
        return SUB_DIR . '/wms/static';
    }

    /**
     * @param string $img
     * @param bool $imgHtmlCode
     *
     * @return string
     */
    public static function imgBase64Encode($img = '', $imgHtmlCode = true)
    {
        if (strpos($img, 'http') === false && !file_exists($img)) {
            return $img;
        }
        $file_content = file_get_contents($img);
        if ($file_content === false) {
            return $img;
        }
        $imageInfo = getimagesize($img);
        $prefix = '';
        if ($imgHtmlCode) {
            $prefix = 'data:' . $imageInfo['mime'] . ';base64,';
        }
        $base64 = $prefix . chunk_split(base64_encode($file_content));

        return $base64;
    }

    /**
     * @param string $base64_image_content
     *
     * @return bool|false|string
     */
    public static function imgBase64Decode($base64_image_content = '')
    {
        if (empty($base64_image_content)) {
            return false;
        }

        $match = preg_match(
            '/^(data:\s*image\/(\w+);base64,)/',
            $base64_image_content,
            $result
        );
        if (!$match) {
            return false;
        }

        $base64_image = str_replace($result[1], '', $base64_image_content);
        $file_content = base64_decode($base64_image);

        return $file_content;
    }

    /**
     * @param $fileName
     *
     * @return string
     */
    public static function fileIcon($fileName)
    {
        $type = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        switch ($type) {
            case 'pdf':
                return '<i class="fa fa-file-pdf-o"></i>';
                break;
            case 'doc':
                return '<i class="fa fa-file-word-o"></i>';
                break;
            default:
                return '<i class="fa fa-file"></i>';
        }
    }

    /**
     * @return array
     */
    public static function languages()
    {
        $setting = self::setting('system', 'LANGUAGE', 'LANGUAGES');
        $languages = [
            'en_us' => ['code' => 'en-US', 'label' => 'English'],
            'zh_hk' => ['code' => 'zh-HK', 'label' => '繁體中文'],
            'zh_cn' => ['code' => 'zh-CN', 'label' => '简体中文'],
        ];
        foreach ($languages as $langId => $language) {
            if (!$setting[$langId]) {
                unset($languages[$langId]);
            }
        }

        return $languages;
    }

    public static function setting($file, $group = '', $key = '')
    {
        $model = new Setting($file);

        return $model->getValues($group, $key);
    }

    public static function mail($addresses, $email, $attachments = [])
    {
        $config = self::setting('email', 'MAILER');
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->CharSet = PHPMailer::CHARSET_UTF8;
            $mail->Encoding = PHPMailer::ENCODING_BASE64;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host = $config['HOST'];
            $mail->Port = $config['PORT'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['USERNAME'];
            $mail->Password = $config['PASSWORD'];
            $mail->isSMTP();
            $mail->setFrom($config['USERNAME'], $_SERVER['HTTP_HOST']);
            $mail->addReplyTo($config['USERNAME']);
            $mail->isHTML(true);
            $mail->Subject = '=?UTF-8?B?' . base64_encode($email['subject']) . '?=';
            $mail->Body = $email['body'];
            $mail->AltBody = strip_tags($email['body']);
            foreach ($addresses as $address) {
                $mail->addAddress($address);
            }
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }

            return $mail->send();
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            $message = sprintf('Mail Send Failed >> %s', $mail->ErrorInfo);
            throw new Exception($message);
        }
    }

    /**
     * @return array|false|mixed|string
     */
    public static function getIP()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ip = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ip = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ip = getenv('HTTP_FORWARDED');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    /**
     * @return bool
     */
    public static function isSuper()
    {
        return $_SESSION['user']['id'] == 1;
    }

    /**
     * @param $image
     *
     * @return bool
     */
    public static function fileExists($image)
    {
        $c = Register::get('container');

        if (SUB_DIR) {
            return $image && file_exists(dirname($c['config']['paths']['site']) . $image);
        }

        return $image && file_exists($c['config']['paths']['site'] . $image);
    }

    /**
     * @param $password
     *
     * @return false|string|null
     */
    public static function password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param $password
     * @param $hash
     *
     * @return bool
     */
    public static function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    /**
     * @param      $time
     * @param bool $default
     *
     * @return string
     */
    public static function datetime($time, $default = false)
    {
        if ($time) {
            return date('Y-m-d', strtotime($time)) . 'T' . date(
                    'H:i',
                    strtotime($time)
                );
        } elseif ($default) {
            return date('Y-m-d') . 'T' . date('H:i');
        } else {
            return $time;
        }
    }

    /**
     * @param $p
     *
     * @return string
     */
    public static function pageLink($p)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $gets = Helper::get();
        $gets['p'] = $p;
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        $qs = [];
        foreach ($gets as $k => $v) {
            $qs[] = $k . '=' . $v;
        }

        $q = implode('&', $qs);

        return $uri . '?' . $q;
    }

    /**
     * @param $object
     *
     * @return array
     */
    public static function objectToArray($data)
    {
        if (is_object($data)) {
            $data = (array)$data;
        }
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = self::objectToArray($value);
            }
        }

        return $data;
    }

    /**
     * @param $link
     *
     * @return string
     */
    public static function thumb($link)
    {
        return dirname($link) . '/thumbs/' . Helper::basename($link);
    }

    public static function basename($file)
    {
        $info = explode('/', $file);

        return end($info);
    }

    /**
     * @param      $data
     * @param bool $return
     *
     * @return string|string[]|null
     */
    public static function var_export_short($data, $return = true)
    {
        $dump = var_export($data, true);

        $dump = preg_replace('#(?:\A|\n)([ ]*)array \(#i', '[', $dump); // Starts
        $dump = preg_replace('#\n([ ]*)\),#', "\n$1],", $dump);         // Ends
        $dump = preg_replace('#=> \[\n\s+\],\n#', "=> [],\n", $dump);   // Empties

        if (gettype($data) == 'object') { // Deal with object states
            $dump = str_replace('__set_state(array(', '__set_state([', $dump);
            $dump = preg_replace('#\)\)$#', "])", $dump);
        } else {
            $dump = preg_replace('#\)$#', "]", $dump);
        }

        if ($return === true) {
            return $dump;
        } else {
            echo $dump;

            return null;
        }
    }

    public static function cleanFroala($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = preg_replace(
                '/<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https:\/\/www\.froala\.com\/wysiwyg-editor\?pb=1" title="Froala Editor">Froala Editor<\/a><\/p>/',
                '',
                $value
            );
        }

        return $data;
    }

    public static function inClause($field, $values)
    {
        $where = '';
        $params = [];
        if (!empty($values)) {
            $fields = [];
            foreach ($values as $i => $value) {
                $fields[] = ':' . $field . '_' . $i;
                $params[$field . '_' . $i] = $value;
            }
            $where = "{$field} IN(" . implode(',', $fields) . ")";
        }

        return ['where' => $where, 'params' => $params];
    }

    public static function getLangCode($lang)
    {
        if ($lang == 'en-GB') {
            return 'en_gb';
        }
        if ($lang == 'zh-HK') {
            return 'zh_hk';
        }
        if ($lang == 'zh-CN') {
            return 'zh_cn';
        }
    }

    public static function formatSlug($slug)
    {
        // 移除特殊字符和空格
        $slug = preg_replace('/[^a-z0-9]+/', '-', strtolower($slug));

        // 移除开头和结尾的短划线
        return trim($slug, '-');
    }

    public static function slugExists($slug, $id)
    {
        $model = new Page();
        if ($id) {
            if ($model->findOne('id<>:id AND slug=:slug', ['id' => $id, 'slug' => $slug])) {
                return true;
            }
        } else {
            if ($model->findSlug($slug)) {
                return true;
            }
        }

        $model = new Catalog();
        if ($id) {
            if ($model->findOne('id<>:id AND slug=:slug', ['id' => $id, 'slug' => $slug])) {
                return true;
            }
        } else {
            if ($model->findSlug($slug)) {
                return true;
            }
        }

        return false;
    }
}
