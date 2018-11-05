<?php
  function a(){
    $c = 0;
    $c ++;
    echo $c;
  }

  a();
  a();
  a();
  a();
  echo "<br>";

  function sa(){
    //javaのstaticとは異なる
    //phpは、リクエスト内で有効
    static $c = 0;
    $c ++;
    echo $c;
  }

  sa();
  sa();
  sa();
  echo "<br>";
?>
