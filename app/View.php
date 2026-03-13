<?php

namespace Site;

use App\Register;
use Exception;
use Pimple\Container;

/**
 * Class View
 *
 * @package App
 */
class View
{
    /**
     * @var array
     */
    public $data;

    /**
     * @var Container
     */
    protected $c;

    /**
     * @var
     */
    protected $rootPath;

    public function __construct()
    {
        $this->c        = Register::get('container');
        $this->rootPath = $this->c['config']['view'];
        $this->data     = [];
    }

    /**
     * @param       $filename
     * @param array $data
     *
     * @throws Exception
     */
    public function partial($filename, $data = [])
    {
        $this->template('partials/' . $filename, $data);
    }

    /**
     * @param $filename
     *
     * @throws Exception
     */
    public function template($filename, $data = [])
    {
        $this->data = array_merge($this->data, $data);
        $template   = $this->rootPath . '/' . $filename . '.php';
        if (! file_exists($template) && isset($data['default_view'])) {
            $template = $this->rootPath . '/' . $data['default_view'] . '.php';
            if (! file_exists($template)) {
                throw new Exception(
                    sprintf('Template file "%s" not found', $filename . '.php')
                );
            }
        }
        include $template;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}
