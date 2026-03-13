<?php

namespace Admin;

/**
 * Class Translator
 *
 * @package App
 */
class Translator
{
    /**
     * @var array
     */
    public $messages;

    /**
     * Translator constructor.
     *
     * @param $messages
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * @param       $message
     * @param mixed ...$params
     */
    public function _e($message, $params = [])
    {
        echo $this->_($message, $params);
    }

    /**
     * @param       $message
     * @param mixed ...$params
     *
     * @return string
     */
    public function _($message, $params = [])
    {
        if (isset($this->messages[$message]) && strlen($this->messages[$message]) > 0) {
            return sprintf($this->messages[$message], ...$params);
        }

        return sprintf($message, ...$params);
    }
}
