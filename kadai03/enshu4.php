<?php
$img = imageCreate(100,100);
$black = imageColorAllocate($img,0,0,255);
$white = imageColorAllocate($img,255,255,255);

$points = array(40,40,50,20,60,40);
imageFilledPolygon($img,$points,3,$white);
$points = array(20,40,40,40,30,60);
imageFilledPolygon($img,$points,3,$white);
$points = array(30,80,30,60,50,75);
imageFilledPolygon($img,$points,3,$white);
$points = array(50,75,70,80,70,60);
imageFilledPolygon($img,$points,3,$white);
$points = array(80,40,60,40,70,60);
imageFilledPolygon($img,$points,3,$white);

header("Content-Type: image/png");
imagePng($img);
