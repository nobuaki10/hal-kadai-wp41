<?php
//接続文字列
//DNS(Data Source Name)
$dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

//DBユーザ/PW
$db_user = "root";
$db_password = "";

try{
  //DB接続
  $pdo = new PDO($dsn,$db_user,$db_password);
  //動作モードの変更
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  //※既定は,ERRMODE_SILENT

  //SQL分作成
  $sql = "INSERT INTO users(name,address) VALUES('S水','東京')";

  //SQL発行
  $pdo->query($sql);

}catch(Exception $e){
  echo mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
  $pdo=null;
  //よくあるつくり方
  //header("Location:error.html");
  //exit;
}finally{
  //DB切断
  $pdo = null;
}
