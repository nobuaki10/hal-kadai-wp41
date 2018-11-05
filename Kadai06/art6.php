<?php
$img = imageCreatefrompng('img/gaga.png');
$bone = imageCreatefrompng('img/bone.png');
$ribbon = imageCreatefrompng('img/ribbon.png');
$color = imagecolorallocatealpha($img,0,0,0,127);
$ribbon_r = imagerotate($ribbon,45,$color);
imagecopy($img,$bone,15,110,0,0,173,36);
imagecopy($img,$ribbon_r,100,-40,0,0,120,120);

for($i = 0;$i<10;$i++){
  $crystal = imageCreatefrompng('img/crystal.png');
  $crystal_r = imagerotate($crystal,rand(0,180),$color);
  $size = rand(20,40);
  imagecopyresized($img,$crystal_r,rand(0,200),rand(0,200),0,0,$size,$size,227,227);
}


header('Content-Type:image/png');
imagePng($img);
