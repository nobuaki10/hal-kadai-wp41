<?php
$img = imageCreate(120,100);
$black = imageColorAllocate($img,255,255,255);
$red = imageColorAllocate($img,255,0,0);

imageFilledEllipse($img,60,50,50,50,$red);

header("Content-Type: image/png");
imagePng($img);
