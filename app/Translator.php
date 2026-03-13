<?php

namespace Site;

use App\Register;

/**
 * Class Translator
 *
 * @package App
 */
class Translator
{
    /**
     * @var
     */
    public $messages;
    public $currentLang;

    /**
     * Translator constructor.
     */
    public function __construct($messages)
    {
        $c = Register::get('container');
        $this->currentLang = str_replace('-', '_', strtolower($c['currentLang']));
        $_message = [];
        foreach ($messages as $message) {
            $_message[$message['key']] = $message[$this->currentLang];
        }
        $this->messages = $_message;
    }

    /**
     * @param $message
     * @param mixed ...$params
     */
    public function _e($message, $params = [])
    {
        $message = strtolower($message);
        echo $this->_($message, $params);
    }

    /**
     * @param $message
     * @param mixed ...$params
     *
     * @return string
     */
    public function _($message, $params = [])
    {
        $message = strtolower($message);
        if (isset($this->messages[$message]) && strlen($this->messages[$message]) > 0) {
            return sprintf($this->messages[$message], ...$params);
        }

        return sprintf($message, ...$params);
    }
}
