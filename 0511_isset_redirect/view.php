<?php

  //存在しない場合のエラー処理方法
  if(!isset($_POST["c"])){
    header("Location: index.php?error_no=1");
    exit;
  }
  //正常処理
