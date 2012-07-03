<?php
$code= (isset($_GET["code"])) ? $_GET["code"] : NULL;

$dir = '../../../theme/fonts/';

$image = imagecreatetruecolor(165, 50);

$font = "recaptchaFont.ttf"; // font style

$color = imagecolorallocate($image, 0, 0, 0);// color

$white = imagecolorallocate($image, 255, 255, 255); // background color white

imagefilledrectangle($image, 0,0, 709, 99, $white);

imagettftext ($image, 22, 0, 5, 30, $color, $dir.$font, $code);

header("Content-type: image/png");

imagepng($image);  
?>