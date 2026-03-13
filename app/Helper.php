<?php

namespace Site;

use App\Register;
use App\Setting;
use Exception;
use FastRoute\RouteCollector;
use PDO;
use PDOException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use ReflectionClass;
use ReflectionException;
use Site\Exceptions\MailException;
use Site\Models\Catalog;
use Site\Models\Page;
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
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            $params['host'],
            $params['database'],
            $params['charset']
        );
        try {
            $pdo = new PDO($dsn, $params['username'], $params['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        return $pdo;
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
        $params        = $constructor->getParameters();
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
        if (!preg_match('/^Admin\\\Controllers\\\\/', $info[0])) {
            $info[0] = 'Admin\\Controllers\\' . $info[0];
        }
        if (!preg_match('/Controller$/', $info[0])) {
            $info[0] .= 'Controller';
        }
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
        $c   = Register::get('container');
        $uri = $uri ?: $c['uri'];
        if ($langId != $c['defaultLang']) {
            $uri = sprintf(
                '/%s%s',
                $langId,
                $uri != '/' ? $uri : ''
            );
        }

        if ($_SERVER['QUERY_STRING']) {
            $uri .= '?' . $_SERVER['QUERY_STRING'];
        }

        return SUB_DIR . $uri;
    }

    /**
     * @param string $lang
     *
     * @return mixed
     */
    public static function getLangLabel(string $langId)
    {
        $c = Register::get('container');

        return $c['languages'][$langId];
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
        $text  = strip_tags($text);
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
        $c     = Register::get('container');
        $route = ltrim($route, '/');
        if (strlen($route) == 0) {
            $active = '/' == $c['uri'];
        } else {
            $uri    = ltrim($c['uri'], '/');
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

    /**
     * 过滤输入
     *
     * @param $input
     * @return mixed|string|string[]
     */
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
     * @param string|null $name
     * @param mixed $default
     *
     * @return mixed|null
     */
    public static function get(string $name = null, $default = null)
    {
        if ($name) {
            return isset($_GET[$name]) ? self::xssClean($_GET[$name]) : $default;
        }

        return self::xssClean($_GET);
    }

    /**
     * @param string|null $name
     * @param mixed $default
     *
     * @return mixed|null
     */
    public static function post(string $name = null, $default = null)
    {
        if ($name) {
            return isset($_POST[$name]) ? self::xssClean($_POST[$name]) : $default;
        }

        return self::xssClean($_POST);
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
            $arrRes[]        = $arrTmp;
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

    /**
     * @param $permission
     *
     * @return bool
     */
    public static function hasPermission($permission)
    {
        if ($_SESSION['user']['id'] == 1) {
            return true;
        }
        $permission = explode('.', $permission);

        return isset($_SESSION['user']['permission'][$permission[0]]) && in_array(
                $permission[1],
                $_SESSION['user']['permission'][$permission[0]]
            );
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

    public static function getPageUrlPath($page)
    {
        $model   = new Page();
        $parents = [$page->slug ?: $page->id];
        while ($page->parent_id) {
            $page = $model->find($page->parent_id);
            array_unshift($parents, $page->slug ?: $page->id);
        }

        return implode('/', $parents);
    }

    public static function getCatUrlPath($cat)
    {
        $model = new Catalog();
        if ($cat) {
            $parents = [$cat->slug ?: $cat->id];
            while ($cat->parent_id) {
                $cat = $model->find($cat->parent_id);
                array_unshift($parents, $cat->slug ?: $cat->id);
            }

            return implode('/', $parents);
        }

        return '';
    }

    public static function getArticleUrlPath($article)
    {
        $model = new Catalog();
        $cat   = $model->find($article->cat);
        $path  = self::getCatUrlPath($cat);

        return $path . '/' . ($article->slug ?: $article->id);
    }

    /**
     * @param string $uri
     *
     * @return string
     */
    public static function getUrl(string $uri, $prefix = '')
    {
        $c      = Register::get('container');
        $langId = $c['currentLang'];
        if ($langId != $c['defaultLang']) {
            $uri = sprintf('/%s%s', $langId, $uri != '/' ? $uri : '');
        }

        return SUB_DIR . $prefix . $uri;
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
        $prefix    = '';
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
        $setting   = Helper::settings('system');
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
     * @param        $subject
     * @param        $body
     * @param string $replyTo
     */
    public static function mail($addresses, $email, $attachments = [])
    {
        $model   = new Setting('email');
        $setting = $model->getValues('MAILER');

        try {
            $mail             = new PHPMailer(true);
            $mail->SMTPDebug  = SMTP::DEBUG_OFF;
            $mail->CharSet    = PHPMailer::CHARSET_UTF8;
            $mail->Encoding   = PHPMailer::ENCODING_BASE64;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Host       = $setting['HOST'];
            $mail->Port       = $setting['PORT'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $setting['USERNAME'];
            $mail->Password   = $setting['PASSWORD'];
            $mail->isSMTP();
            $mail->setFrom($setting['USERNAME'], $_SERVER['HTTP_HOST']);
            $mail->addReplyTo($setting['USERNAME']);
            $mail->isHTML(true);
            $mail->Subject = '=?UTF-8?B?' . base64_encode($email['subject']) . '?=';
            $mail->Body    = $email['body'];
            $mail->AltBody = strip_tags($email['body']);
            foreach ($addresses as $address) {
                $mail->addAddress($address);
            }
            foreach ($attachments as $attachment) {
                $mail->addAttachment($attachment);
            }

            return $mail->send();
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            $message = sprintf('Mail Send Failed: %s', $mail->ErrorInfo);
            trigger_error($message, E_USER_WARNING);
            throw new MailException($message);
        }
    }

    /**
     * @param $image
     *
     * @return bool
     */
    public static function imageExists($image)
    {
        $c = Register::get('container');

        return $image && file_exists($c['config']['paths'] . $image);
    }

    /**
     * @param $id
     * @param $groups
     *
     * @return mixed
     */
    public static function groupName($id, $groups)
    {
        $groups = array_filter(
            $groups,
            function ($v) use ($id) {
                return $v['id'] == $id;
            }
        );
        $group  = array_pop($groups);
        if ($group) {
            $setting = self::settings('system');

            return $group['__data'][$setting['defaultLang']]['name'];
        }

        return Helper::_('None');
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
    public static function pageLink($p, $anchor = '')
    {
        $uri       = $_SERVER['REQUEST_URI'];
        $gets      = Helper::get();
        $gets['p'] = $p;

        // 构建查询参数字符串
        $query = http_build_query($gets);

        // 如果有锚点，则添加到URI末尾
        if (!empty($anchor)) {
            $query .= '#' . urlencode($anchor);
        }

        return htmlspecialchars($uri . '?' . $query);
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
        return dirname($link) . '/thumbs/' . basename($link);
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

    public static function checkStr($str)
    {
        $len  = strlen($str);
        $len2 = mb_strlen($str);
        if ($len == $len2) {
            return 1;
        } elseif ($len % $len2) {
            return 2;
        } else {
            return 3;
        }
    }

    public static function reCAPTCHAVerifying($token)
    {
        if (!$token) {
            return false;
        }

        $url    = 'https://www.google.com/recaptcha/api/siteverify';
        $secret = setting('site', 'GOOGLE_RECAPTCHA', 'API_SECRET');
        $body   = 'secret=' . $secret . '&response=' . $token;
        $c      = curl_init($url);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $body);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($c);
        curl_close($c);

        return json_decode($response, true);
    }

    public static function inClause($field, $values)
    {
        $params = [];
        if (!empty($values)) {
            $fields = [];
            foreach ($values as $i => $value) {
                $fields[]                  = ':' . $field . '_' . $i;
                $params[$field . '_' . $i] = $value;
            }
            $where = "{$field} IN(" . implode(',', $fields) . ")";
        } else {
            $where = "{$field} IN(0)";
        }

        return ['where' => $where, 'params' => $params];
    }
}
