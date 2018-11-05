<?php

$img = imageCreate(200,200);
$white = imageColorAllocate($img,0,0,0);
$x = 0;
$y = 200;
$rgb = 10;

for($i = 0;$i < 10;$i++){
  $color = imageColorAllocate($img,$rgb,$rgb,$rgb);
  imageFilledRectangle($img,$x,$x,$y,$y,$color);
  $x += 10;
  $y -= 10;
  $rgb += 20;
}

header('Content-Type: image/png');
imagePng($img);
