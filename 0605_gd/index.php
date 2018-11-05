<?php
//キャンバス作成
$img = imageCreate(100,100);

//色設定(取得)
//※初回は背景色となります。
$black = imageColorAllocate($img,0,0,255);

//直線描画
$white = imageColorAllocate($img,255,255,255);

imageLine($img,10,10,90,90,$white);

//長方形描画
imageRectangle($img,10,10,90,90,$white);

//塗りつぶしあり
imageFilledRectangle($img,40,40,60,60,$white);

//円描画
imageEllipse($img,50,50,50,50,$white);

$points = array(10,90,50,10,90,90);
imagePolygon($img,$points,3,$white);


//下に出力しないとかき変わらない
//HTML header出力
header("Content-Type: image/png");
imagePng($img);

//File出力
imagePng($img,"a.png");
