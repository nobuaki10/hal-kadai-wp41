<?php
 print_r($_FILES);

 //ファイル移動
 if(move_uploaded_file(
    $_FILES["upload_file"]["tmp_name"],
    "updata\\".$_FILES["upload_file"]["name"])){
    //成功
    $image_info = getimagesize("updata\\".$_FILES["upload_file"]["name"]);
    echo "<pre>";
    print_r($image_info);
    echo "</pre>";
  }else{
    //失敗
  }
