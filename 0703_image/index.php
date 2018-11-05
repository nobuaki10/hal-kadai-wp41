<?php
$img = imagecreatefrompng("4.png");
$black = imagecolorallocate( $img, 255, 255, 255);
//透過色
$clear = imagecolorallocatealpha( $img, 0, 0, 0, 127);
//回転
$img = imagerotate( $img, 45, $clear);
//画像サイズ取得
//echo imagesx($img);
//echo imagesy($img);
//exit;
//文字描画(半角限定)
imageString( $img, 3, 50, 50, "abc", $black);
//文字描画(TrueTypeフォント)
//$fontPath = ""
//imagettftext($img, 12, 10, 80, 80, $black, $fontPath, "あいう");
//true colorのキャンバス
$imgTrueColor = imageCreateTrueColor(200, 200);
//画像リサイズ
imageCopyResized($imgTrueColor, $img, 0, 0, 0, 0, 200, 200, 100, 100);
imageCopyReSampled($imgTrueColor, $img, 0, 0, 0, 0, 200, 200, 100, 100);
header("Content-Type: image/png");
imagePng($img);
