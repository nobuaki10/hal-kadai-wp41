<?php

  $c = 1;
  $g = 1;
  //関数定義はfunction
  function kansu($age=0){
    $c = 2;
    global $g;
    $g = 2;
    $GLOBALS["g"]++; //GLOBALS配列を用いて操作
    echo "b";
    echo $age;
    return 5;
  }

  echo kansu(12);
  echo "<br>";
  kansu();
  echo "<br>";
  echo $c;
  echo $g;

  echo "<pre>";
  print_r($GLOBALS);
  echo "</pre>";
?>
