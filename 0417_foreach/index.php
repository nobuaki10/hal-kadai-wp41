<?php
  $a = [1,2,3];
  foreach ($a as $e) {
    echo $e;
  }

  //初期化されていればfoecach問題なし
  //nullのforeachはNG

  //$a = null;        error
  $a = [];
  foreach ($a as $e) {
    echo $e;
  }

  $a = ["a","b","c"];
  foreach ($a as $key => $e) {
    echo $key;
    echo $e;
  }
?>
