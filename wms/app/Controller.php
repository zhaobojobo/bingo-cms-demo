<?php

namespace Admin;

use Exception;
use App\Register;
use LogicException;
use Pimple\Container;
use Admin\Models\Action;
use League\Plates\Engine;

/**
 * Class Controller
 *
 * @package app
 */
class Controller
{
    /**
     * @var Container
     */
    protected $c;

    protected $view;

    protected $data = [];

    public function __construct()
    {
        $this->c    = Register::get('container');
        $this->view = new Engine($this->c['config']['paths']['views']);
    }

    /**
     * @param $data
     */
    public function json($data)
    {
        header("Content-type:application/json;charset=utf-8");

        die(json_encode($data));
    }

    /**
     * @param array  $data
     * @param string $message
     * @param string $location
     */
    public function success($data = [], $location = '', $message = '')
    {
        $ret = ['status' => true];
        if ($data) {
            $ret['data'] = $data;
        }
        if ($location) {
            if (preg_match('/^https?:\/\/.+/', $location)) {
                $ret['redirect'] = $location;
            } else {
                $ret['redirect'] = Helper::getUrl($location);
            }
        }
        if ($message) {
            $ret['message'] = $message;
        }
        $this->json($ret);
    }

    public function redirect($location)
    {
        header('Location: ' . Helper::getUrl($location));
        exit;
    }

    /**
     * @param $message
     *
     * @return false|string
     * @throws Exception
     */
    public function error($message)
    {
        $this->json([
                'status'  => false,
                'message' => $message,
            ]);
    }

    /**
     * @param       $template
     * @param array $data
     *
     * @return string
     */
    public function render($template, $data = [])
    {
        $this->assign($data);

        return $this->view->render($template, ['data' => $this->data]);
    }

    /**
     * @param      $data
     * @param bool $check
     */
    public function assign($data, $check = true)
    {
        if ($check) {
            $this->checkData($data);
        }
        $this->data = array_merge($this->data, $data);
    }

    /**
     * @param $data
     */
    public function checkData($data)
    {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->constants)) {
                throw new LogicException(sprintf('%s cannot be overridden, please reassign the name', $key));
            }
        }
    }

    /**
     * @param $action
     */
    public function action($action)
    {
        if ($_SESSION['user']['id'] != 0) {
            $model = new Action();
            $data  = [
                'action' => $action,
                'admin'  => $_SESSION['user']['username'],
                'url'    => $_SERVER['REQUEST_URI'],
                'time'   => date('Y-m-d H:i:s'),
                'ip'     => Helper::getIP(),
            ];
            $model->create($data);
        }
    }

    /**
     * @param $class
     *
     * @return Model
     */
    public function model($class): Model
    {
        if ( ! class_exists($class)) {
            throw new LogicException(sprintf('%s is not found!', $class));
        }

        return new $class();
    }
}
