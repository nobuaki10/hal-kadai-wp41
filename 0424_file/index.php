<?php
  //文字化け防止
  header('Content-Type: text/html; charset=UTF-8');

  //ファイル一括読み込み
  $path = "a.txt";
  $fileData = file_get_contents($path);

  echo $fileData;

  //ファイルチェック
  //$path = "a.txt";
  //$fileData = file_get_contents($path);
  //echo $fileData;

  //ファイルが存在して、かつ
  //読み込み権限があるかチェックする
  if( is_readable($path)){
    $fileData = file_get_contents($path);
    echo $fileData;
  }

  //ファイルの存在チェック
  if(file_exists($path)){
    echo "ある。<br>";
  }

  //ファイル書き込み
  file_put_contents("c.txt","aaa,bbb,ccc/nddd,eee,fff\n");


  //ファイル一括読み込み
  $fileData = file("a.txt");
  print_r($fileData);
