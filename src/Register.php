<?php

namespace App;

/**
 * Class Register
 *
 * @package Admin
 */
class Register
{
    protected static $data;

    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        self::$data[$key] = $value;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public static function get($key)
    {
        return self::$data[$key];
    }
}
