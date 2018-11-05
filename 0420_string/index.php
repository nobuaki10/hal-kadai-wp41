<?php
  header('Content-Type: text/html; charset=UTF-8');
  //バイト数取得
  echo strlen("abc");
  echo strlen("あいう");

  //全角対応文字列長
  echo mb_strlen("あいう");

  //文字列切り取り

  echo substr("abc",0,2);
  echo substr("abc",-1,1);
  echo substr("あいう",0,3);
  echo "<br>";
  echo mb_substr("あいう",0,3);

  //置き換え
  echo str_replace("aa","x","abbaaba");
  echo "<br>";
  echo str_replace("ああ","x","あああああ");

  //前後スペース除去
  echo "|";
  echo "    aaa aaa    ";
  echo "|";
  echo "<br>";

  echo "|";
  echo trim("    aaa aaa    ");
  echo "|";
  echo "<br>";

  echo "|";
  echo trim("　　　aaa   aaa　　　");
  echo "|";
  echo "<br>";

  echo "|";
  echo mb_convert_kana("　　　aaa   aaa　　　","s");
  echo "|";
  echo "<br>";

  //HTMLタグ変換(サニタイジング)
  $data = "<h1>a</h1>";
  echo $data;
  echo htmlspecialchars($data);
  echo "<br>";

  //HTMLタグ除去
  echo strip_tags($data);
  echo "<br>";

  //改行(br)付与
  $data = "a\nb\nc";
  echo $data;
  echo str_replace("\n","<br>",$data);
  echo "<br>";
  echo nl2br($data);
  echo "<br>";

  //配列->文字列生成
  $a = "a,b,c";
  print_r(explode(",",$a));
  echo "<br>";

  //文章の頭出し
  echo mb_strimwidth("あ",0,3,"...");
  echo "<br>";
  echo mb_strimwidth("あいうえお",0,9,"...");
