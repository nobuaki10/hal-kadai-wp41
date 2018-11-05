<?php
  //外部ファイル読み込み
  require("a.php");
  include("a.php");

  //->errorの対処が異なる。

  //1回目のみ読み込み
  require("a.php");
  require_once("a.php");
?>
