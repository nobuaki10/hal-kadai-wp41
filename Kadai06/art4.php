<?php
$baseimg = imageCreateTrueColor(200,200);
$img1 = imageCreatefrompng('img/george.png');
$img2 = imageCreatefrompng('img/lennon.png');
$img3 = imageCreatefrompng('img/paul.png');
$img4 = imageCreatefrompng('img/ringo.png');

imageCopyResized($baseimg,$img1,0,0,0,0,100,100,200,200);
imageCopyResized($baseimg,$img2,100,0,0,0,100,100,200,200);
imageCopyResized($baseimg,$img3,0,100,0,0,100,100,200,200);
imageCopyResized($baseimg,$img4,100,100,0,0,100,100,200,200);


header('Content-Type: image/png');
imagePng($baseimg);
