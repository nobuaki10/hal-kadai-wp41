<?php

  //変数$
  $a = 10;
  echo $a;
  echo "<br>";
  //大文字小文字は区別される
  $A = 20;
  echo $a;
  echo $A;

  $a = "a";
  echo $a;
  if(20 == "20"){
    echo "yes";
  }else{
    echo "no";
  }
  if(20 === "20"){
    echo "yes";
  }else{
    echo "no";
  }


  echo "<br>";
  //変数$文字列の出力
  echo "ようこそ${a}さん<br>";
  echo "ようこそ $a さん<br>";
  echo "ようこそ{$a}さん<br>";
  //'は完全文字列
  echo 'ようこそ{$a}さん<br>';

  //文字列連結
  echo "a" . "b";
?>
