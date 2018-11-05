<?php
$img = imageCreate(300,300);
$white = imageColorAllocate($img,255,255,255);
$black = imageColorAllocate($img,0,0,0);
$blue = imageColorAllocate($img,0,0,255);
$red = imageColorAllocate($img,255,0,0);
$yellow = imageColorAllocate($img,255,255,0);

//HEAD
imageFilledEllipse($img,150,150,220,180,$blue);
imageEllipse($img,150,150,220,180,$black);
imageFilledEllipse($img,150,175,175,120,$white);
imageEllipse($img,150,175,175,120,$black);

//NOSE
imageFilledEllipse($img,150,150,20,20,$red);
imageline($img,150,160,150,220,$black);
//mouth
imagearc($img,150,195,75,50,20,160,$black);
//beard left
imageline($img,100,180,130,180,$black);
imageline($img,100,160,130,170,$black);
imageline($img,100,200,130,190,$black);
//beard right
imageline($img,170,180,200,180,$black);
imageline($img,170,170,200,160,$black);
imageline($img,170,190,200,200,$black);
//EYES
imageFilledEllipse($img,130,125,40,50,$white);
imageEllipse($img,130,125,40,50,$black);
imageFilledEllipse($img,170,125,40,50,$white);
imageEllipse($img,170,125,40,50,$black);

imageFilledEllipse($img,135,130,15,15,$black);
imageFilledEllipse($img,165,130,15,15,$black);
//collar
imageFilledRectangle($img,80,225,220,240,$red);
imageFilledEllipse($img,80,232,15,15,$red);
imageFilledEllipse($img,220,233,15,15,$red);
//bell
imageFilledEllipse($img,150,240,30,30,$yellow);
imageEllipse($img,150,240,30,30,$black);
imageEllipse($img,150,245,10,10,$black);
imageline($img,150,250,150,255,$black);
imageline($img,137,235,163,235,$black);
imageline($img,137,232,163,232,$black);

header("Content-Type: image/png");
imagePng($img);
