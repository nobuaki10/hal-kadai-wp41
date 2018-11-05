<?php

$num = mt_rand(1, 3);
$img = imageCreatefromjpeg('img/option2-'.$num.'.jpg');
list($width, $height, $type) = getimagesize('img/option2-'.$num.'.jpg');

$newwidth = 0;
$newheight = 0;
$w = 200;
$h = 200;

if($h < $height && $w < $width)
{
    if($w < $h)
    {
        $newwidth = $w;
        $newheight = $height * ($w / $width);
    } else if ($h < $w) {
        $newwidth = $width * ($h / $height);
        $newheight = $h;
    }
    else
    {
        if ($width < $height) {
            $newwidth = $width * ($h / $height);
            $newheight = $h;
        }
        else if($height < $width)
        {
            $newwidth = $w;
            $newheight = $height * ($w / $width);
        }
    }
}

else if ($height < $h && $width < $w) {
    $newwidth = $width;
    $newheight = $height;
}

else if ($h < $height && $width <= $w) {

    $newwidth = $width * ($h / $height);
    $newheight = $h;
}

else if ($height <= $h && $w < $width) {
    $newwidth = $w;
    $newheight = $height * ($w / $width);
}

else if ($height == $h && $width < $w) {
    $newwidth = $width * ($h / $height);
    $newheight = $h;
}

else if ($height < $h && $width == $w) {
    $newwidth = $w;
    $newheight = $height * ($w / $width);
}

else {
    $newwidth = $width;
    $newheight = $height;
}

$canvas = imagecreatetruecolor($newwidth,$newheight);
imagecopyresized($canvas, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

header("Content-Type:image/jpeg");
imagePng($canvas);
