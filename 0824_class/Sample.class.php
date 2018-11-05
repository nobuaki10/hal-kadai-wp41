<?php
class Sample{
  private $id;
  private $name;
  //public,protecterd あり

  //コンストラクタ
  public function __construct(){
    //自フィールドでは$thisで参照
    $this->id = 123;
    $this->name = "abc";
  }

  public function getId(){
    //$thisでmethod呼び出し
    $this->addId();
    return $this->id;
  }

  //定数
  const MAX = 100;

  private function addId(){
    $this->id += 10;
  }

  public static $count = 0;
  public static function countup(){
    self::$count++;
    //自クラスのstaticを操作する場合は、[クラス名::]を[self::]と書くことができる
  }
}
