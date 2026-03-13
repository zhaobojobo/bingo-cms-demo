<?php

namespace Admin;

/**
 * Class Captcha
 *
 * @package Admin
 */
class Captcha
{
    public $image;

    public $key;

    /**
     * Captcha constructor.
     *
     * @param string $key
     */
    public function __construct($key = '_')
    {
        $this->key = $key;
        $this->image();
    }

    public function image()
    {
        $width  = 150;
        $height = 38;
        // 创建画布
        $this->image = imagecreatetruecolor($width, $height);
        // 创建背景色
        $bgColor = imagecolorallocate(
            $this->image,
            rand(0, 100),
            rand(0, 100),
            rand(0, 100)
        );
        // 填充画布背景色
        imagefill($this->image, 0, 0, $bgColor);

        // 验证码可用字符集
        $string = 'abcdefhgkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        // 获取字符集长度
        $length = strlen($string);

        // 验证码
        $authCode = '';
        for ($i = 0; $i <= 3; $i++) {
            // 计算字符在画布的X位置
            $x = 15 + $i * 32;
            // 生成字符颜色
            $textColor = imagecolorallocate(
                $this->image,
                rand(150, 255),
                rand(150, 255),
                rand(150, 255)
            );
            // 随机获取字符
            $text = $string[rand(0, $length - 1)];
            // 收集验证码
            $authCode .= $text;
            // 将字符写入画布
            imagettftext(
                $this->image,
                25,
                0,
                $x,
                30,
                $textColor,
                ROOT . 'Baloo-Regular.ttf',
                $text
            );
        }

        // 将验证码缓存
        $_SESSION['captcha'][$this->key] = strtoupper($authCode);

        // 生成干扰点
        for ($i = 0; $i <= 1000; $i++) {
            $pixelColor = imagecolorallocate(
                $this->image,
                rand(0, 255),
                rand(0, 255),
                rand(0, 255)
            );
            imagesetpixel(
                $this->image,
                rand(0, $width - 1),
                rand(0, $height - 1),
                $pixelColor
            );
        }

        // 生成干扰线
        for ($i = 0; $i <= 10; $i++) {
            $lineColor = imagecolorallocate(
                $this->image,
                rand(0, 255),
                rand(0, 255),
                rand(0, 255)
            );
            imageline(
                $this->image,
                rand(0, $width - 1),
                rand(0, $height - 1),
                rand(0, $width - 1),
                rand(0, $height - 1),
                $lineColor
            );
        }
    }

    /**
     * @param        $text
     * @param string $key
     *
     * @return bool
     */
    public static function verify($text, $key = '_')
    {
        return strtoupper($text) == $_SESSION['captcha'][$key];
    }

    /**
     * @param string $key
     */
    public static function destroy($key = '_')
    {
        unset($_SESSION['captcha'][$key]);
    }

    public function output()
    {
        header('content-type: image/jpeg');
        imagejpeg($this->image);
    }
}
