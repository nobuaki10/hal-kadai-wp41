<?php
  require_once("Sample.class.php");

  $s = new Sample();
  echo $s->getId();

  //定数アクセスは::
  echo Sample::MAX;

  //staticへのアクセスも::
  echo Sample::$count;
  echo Sample::countup();
  echo Sample::$count;
  //PHPでのstaticはJavaと違い,
  //1リクエストの範囲内だけで共有される
