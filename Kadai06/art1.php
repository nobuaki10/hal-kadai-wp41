<?php

$img = imageCreate(200,200);
$white = imageColorAllocate($img,255,255,255);

for($i = 0;$i < 10;$i++){
  $color = imageColorAllocate($img,rand(0,255),rand(0,255),rand(0,255));
  imageFilledRectangle($img,rand(0,200),rand(0,200),rand(0,200),rand(0,200),$color);
}
header('Content-Type: image/png');
imagePng($img);
