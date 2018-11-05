<?php
  header('Content-Type: text/html; charset=UTF-8');
  //連想配列
  $user["id"] = 50000;
  $user["name"] = "s水";
  $user["age"] = 37;

  echo "<pre>";
  print_r($user);
  echo "</pre>";

  echo $user["id"];

  //連想配列の初期データ
  $user = [
          "user" => 59999,
          "age" => 27,
        ];
  echo "<pre>";
  print_r($user);
  echo "</pre>";

  //演算子いろいろ
  $flg = 1 != 1;
  $flg = 1 <> 1;
  //!= 値が等しくない、または型が等しくない
  $flg = 1 !== 2;
  $flg = 1 !== "1";

  if($flg){
    echo "yes";
  }else{
    echo "no";
  }

  //三項演算子
  echo $a = (1 == 1)? "yes":"no";

  //エラー抑制
  echo @$x;


?>
