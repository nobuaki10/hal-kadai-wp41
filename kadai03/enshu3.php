<?php
$img = imageCreate(100,100);
$black = imageColorAllocate($img,0,0,255);
$white = imageColorAllocate($img,255,255,255);

$points = array(0,100,0,0,50,50);
imageFilledPolygon($img,$points,3,$white);

$points = array(100,0,100,100,50,50);
imageFilledPolygon($img,$points,3,$white);

header("Content-Type: image/png");
imagePng($img);
