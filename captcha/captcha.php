<?php
session_start();

$kode = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
$_SESSION['captcha'] = $kode;

$image = imagecreate(120, 40);
$bg = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 25, 10, $kode, $text_color);

// noise biar lebih aman
for ($i = 0; $i < 50; $i++) {
    $noise_color = imagecolorallocate($image, rand(150,255), rand(150,255), rand(150,255));
    imagesetpixel($image, rand(0,120), rand(0,40), $noise_color);
}

header("Content-type: image/png");
imagepng($image);
imagedestroy($image);
?>