<?php

namespace App;

class Validator
{
    public static function minStringLength(string $string, int $length)
    {
        return strlen($string) >= $length;
    }

    public static function maxStringLength(string $string, int $length)
    {
        return strlen($string) <= $length;
    }

    /*
        alnum  任何字母: alpha digit
        alpha  任何字母和數字 lower  upper
        blank  空白字符 space tab
        digit  數字
        graph  可見字符  alnum  punct
        lower  小寫字母
        upper  大寫字母
        print  可打印字符  alnum  punct space
        punct  標點符號
        space  匹配空格
        xdigit 十六進制數字
     * */

    /***
     * 查找數字
     *
     */
    public static function findDigit($input)
    {
        return preg_match('/[0-9]/', $input);
    }

    /***
     * 查找大寫
     *
     */
    public static function findUpper($input)
    {
        return preg_match('/[A-Z]/', $input);
    }

    /***
     * 查找小寫
     *
     */
    public static function findLower($input)
    {
        return preg_match('/[a-z]/', $input);
    }

    /***
     * 查找符號
     *
     */
    public static function findSymbol($input)
    {
        return preg_match('/\W/', $input);
    }
}
