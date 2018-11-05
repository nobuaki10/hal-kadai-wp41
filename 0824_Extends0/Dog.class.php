<?php
require_once("Animal.class.php");

class Dog extends Animal{
  public function bite(){
    echo "kamu<br>";
  }

  //オーバーライドは再定義するだけ
  public function sleep(){
    echo "zzz<br>";
  }
}
