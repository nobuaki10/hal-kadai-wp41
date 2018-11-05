<?php
  //存在チェック
  $a = "";
  if(isset($b)){
    echo "yes";
  }
  //存在する場合に$aに入れる
  if(isset($_POST["a"])){
    $a = $_POST["a"];
  }

  $c = [];
  if(isset($_POST["c"])){
    $c = $_POST["c"];
  }
  foreach($c as $k => $cd){
    echo $k;
    echo $cd;
  }
 ?>
