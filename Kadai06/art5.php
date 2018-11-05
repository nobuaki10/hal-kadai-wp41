<?php
$img = imageCreatefrompng('img/bokete.png');
// 吹き出し
$fukidashi = imagecreatefrompng('img/fukidashi.png');
imagecopy($img, $fukidashi, 80, 20, 0, 0,110,150);
// テキスト
$textColor = imageColorAllocate(
    $img,
    0,
    0,
    0
);
$font = 'c:/xampp7/htdocs/Kadai06/font/msgothic.ttc';
$text = 'あ';
$texrArray = str_split($text);
$textPosition = 70;
foreach($texrArray as $str){
    imagettftext($img,30,0,123,$textPosition,$textColor,$font,$str);
    $textPosition += 40;
}
header('Content-Type:image/png');
imagePng($img);
