<?php
  echo date("Y/m/d H:i:s",time());

  $check_data = $_POST["input_date"];
    //正規表現パターン
    $pattern= "/[0-9]+/";
    //正規表現チェック
    $res = "ng";

    if( preg_match($pattern,$check_data)){
      $res="ok";
    }
    echo $res;
