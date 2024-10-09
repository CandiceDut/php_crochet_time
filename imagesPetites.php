<?php

    header('Content-Type: image/jpeg');
    $im =  $_GET['image'];
    $image="Images/".$im;
    $percent=0.25;
    list($width, $height) = getimagesize($image);
    $new_width = $width * $percent;
    $new_height = $height * $percent;
    // retailler
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image = imagecreatefromjpeg($image);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($image_p);
    imagedestroy($image_p);
?>