<?php

define('DEFAULT_W', 512);
define('DEFAULT_H', 512);
define('DEFAULT_MODE', 'colorful');
define('LIMIT_W', 1280);
define('LIMIT_H', 720);

$img_height = $_GET['h'] ?? DEFAULT_H;
if ($img_height > LIMIT_H) $img_height = LIMIT_H;

$img_width = $_GET['w'] ?? DEFAULT_W;
if ($img_width > LIMIT_W) $img_width = LIMIT_W;

$img = imagecreatetruecolor($img_width, $img_height);

switch ($_GET['m'] ?? DEFAULT_MODE) {
    case 'snow':
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                if (random_int(0, 1) == 0)
                    imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 0));
                else
                    imagesetpixel($img, $x, $y, imagecolorallocate($img, 255, 255, 255));
        break;

    case 'snowleak':
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                switch (random_int(0, 4)) {
                    case 0:
                    case 3:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 0));
                        break;
                    case 4:
                    case 1:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 255, 255, 255));
                        break;
                    case 2:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, random_int(128, 255), random_int(128, 255), random_int(128, 255)));
                        break;
                }
        break;

    case 'primary':
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                switch (random_int(0, 2)) {
                    case 0:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 255, 0, 0));
                        break;
                    case 1:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 255, 0));
                        break;
                    case 2:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 255));
                        break;
                }
        break;

    case 'primarysnow':
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                switch (random_int(0, 4)) {
                    case 0:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 255, 0, 0));
                        break;
                    case 1:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 255, 0));
                        break;
                    case 2:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 255));
                        break;
                    case 3:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 255, 255, 255));
                        break;
                    case 4:
                        imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 0));
                        break;
                }
        break;

    case 'colorfulalpha':
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                imagesetpixel($img, $x, $y, imagecolorallocatealpha($img, random_int(0, 255), random_int(0, 255), random_int(0, 255), random_int(0, 127)));
        break;

    case 'colorful':
    default:
        for ($x = 0; $x < $img_width; $x++)
            for ($y = 0; $y < $img_height; $y++)
                imagesetpixel($img, $x, $y, imagecolorallocate($img, random_int(0, 255), random_int(0, 255), random_int(0, 255)));
        break;
}

header("Cache-Control: no-store, no-cache, max-age=0");
header("Pragma: no-cache");
header("Content-Type: image/png");
imagepng($img);
imagedestroy($img);
