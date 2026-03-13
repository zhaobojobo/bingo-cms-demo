<?php

namespace Site;

use App\Register;
use Pimple\Container;

class Captcha
{
    private $image;
    private string $key;
    private Container $c;

    public function __construct(string $key = '_')
    {
        $this->c = Register::get('container');
        $this->key = $key;
        $this->image();
    }

    public function image(): void
    {
        $w = 150;
        $h = 38;

        try {
            $this->image = imagecreatetruecolor($w, $h);
            if (!$this->image) {
                throw new \Exception('Failed to create image resource');
            }

            $bgColor = imagecolorallocate($this->image, random_int(0, 100), random_int(0, 100), random_int(0, 100));
            if ($bgColor === false) {
                throw new \Exception('Failed to allocate background color');
            }
            imagefill($this->image, 0, 0, $bgColor);

            // Generate auth code
            $string = 'abcdefhgkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            $length = strlen($string);
            $authCode = '';
            for ($i = 0; $i <= 3; $i++) {
                $x = 15 + $i * 32;
                $textColor = imagecolorallocate(
                    $this->image,
                    random_int(150, 255),
                    random_int(150, 255),
                    random_int(150, 255)
                );
                if ($textColor === false) {
                    throw new \Exception('Failed to allocate text color');
                }
                $text = $string[random_int(0, $length - 1)];
                $authCode .= $text;
                $fontFile = $this->c['config']['resources'] . '/Baloo-Regular.ttf';
                if (!file_exists($fontFile)) {
                    throw new \Exception('Font file does not exist: ' . $fontFile);
                }
                imagettftext($this->image, 25, 0, $x, 30, $textColor, $fontFile, $text);
            }
            $_SESSION['captcha'][$this->key] = strtoupper($authCode);

            // Generate noise
            for ($i = 0; $i <= 1000; $i++) {
                $pixelColor = imagecolorallocate(
                    $this->image,
                    random_int(0, 255),
                    random_int(0, 255),
                    random_int(0, 255)
                );
                if ($pixelColor === false) {
                    throw new \Exception('Failed to allocate pixel color');
                }
                imagesetpixel($this->image, random_int(0, $w - 1), random_int(0, $h - 1), $pixelColor);
            }
            for ($i = 0; $i <= 10; $i++) {
                $lineColor = imagecolorallocate(
                    $this->image,
                    random_int(0, 255),
                    random_int(0, 255),
                    random_int(0, 255)
                );
                if ($lineColor === false) {
                    throw new \Exception('Failed to allocate line color');
                }
                imageline(
                    $this->image,
                    random_int(0, $w - 1),
                    random_int(0, $h - 1),
                    random_int(0, $w - 1),
                    random_int(0, $h - 1),
                    $lineColor
                );
            }
        } catch (\Exception $e) {
            echo '验证码生成失败: ' . $e->getMessage();
        }
    }

    public static function verify(string $text, string $key = '_'): bool
    {
        return strtoupper($text) === ($_SESSION['captcha'][$key] ?? '');
    }

    public static function destroy(string $key = '_'): void
    {
        unset($_SESSION['captcha'][$key]);
    }

    public function output(): void
    {
        header('content-type: image/jpeg');
        imagejpeg($this->image);
    }
}
