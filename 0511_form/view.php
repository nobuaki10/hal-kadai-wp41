<?php

  //POSTで受け渡されたデータが配列でかえって来る
  //POSTデータ(本命)
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";

  //同様にGETに帰ってくる　今回は何も入れてないので空
  //GETデータ（本命)
  echo "<pre>";
  print_r($_GET);
  echo "</pre>";

  //POSTのデータ引っこ抜き
  $check_date = $_POST["input_date"];

  //TextArea & <br>付き
  $ta = $_POST["ta"];
  echo nl2br($ta);
