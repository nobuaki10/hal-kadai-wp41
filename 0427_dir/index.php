<?php
header('Content-Type: text/html; charset=UTF-8');
  //filecopy    @でエラー抑制
  copy("a.txt","b.txt");

  /*if( $r ){
    echo "ok";
  } else {
    echo "ng";
  }*/

 //fileDelete
 $path = "c.txt";
 if(is_file($path) && unlink("c.txt")){
    echo "${path}削除完了";
 } else {
   echo "${path}削除失敗";
 }
 echo "<br>";

 //directoryCreate
 $dirPath = "tmp";
 if(!is_dir($dirPath) && mkdir($dirPath,0777)){
   echo "作成";
 } else {
   echo "作成失敗";
 }
 echo "<br>";

 //directoryDelete
 @rmdir("tmp2");

 //カレントディレクトリ一覧
 foreach(glob("*") as $fileName){
   echo "<li>${fileName}<li>";
 }

 //パス情報の取得
 $p = pathinfo(__FILE__);
 echo __FILE__;
 echo "<br>";

 echo "<pre>";
 print_r ($p);
 echo "</pre>";
