<?php

$img = imageCreatefrompng('img/kitty.png');

imageFilledRectangle($img,45,70,150,80,imageColorAllocate($img,0,0,0));

$x = 200;
$y = 200;
$rgb = 10;

for($i = 0;$i < 6;$i++){
  imageFilledEllipse($img,$x,$x,$y,$y,imageColorAllocate($img,255,rand(10,200),rand(10,200)));
  $y -= 32;
  $rgb += 30;
}
header('Content-Type: image/png');
imagePng($img);
