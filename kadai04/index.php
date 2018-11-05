<?php
  $filePath = "counter.txt";

  //ファイルが無い場合作成する
  if(!file_exists($filePath)){
    //ファイル作成
    touch($filePath);
    file_put_contents($filePath,0);
  }

  $ary = array();
  //ファイル読み込み
  if(is_readable($filePath)){
    $nums = file_get_contents($filePath) + 1;
    file_put_contents($filePath,$nums);

    echo "【演習1,2】<br>";
    for($i=4; $i >= 0; $i--){
      $ary[$i] = $nums%10;
      $nums = floor($nums / 10);
    }
    echo $ary[0].$ary[1].$ary[2].$ary[3].$ary[4];
    echo "<br>【演習3,4】<br>";
    for($i=0;$i<=4;$i++){
      echo "<img src='./img/".$ary[$i].".jpg' width='100' height='100'>";
    }

    echo "<br>【演習5 キリ番】<br>";
    if($ary[4] === 0){
      echo "キリ番Get!!";
    }

  

  }else{
    echo "読み込み失敗";
  }
