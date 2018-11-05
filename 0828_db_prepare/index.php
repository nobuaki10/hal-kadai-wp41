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

  //セキュリティ向上
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  //SQL分作成
  $sql = "SELECT * FROM users WHERE id=? AND name=?";

  $pstmt = $pdo->prepare($sql);
  //値の設定
  $pstmt->bindValue(1,1);
  $pstmt->bindValue(2,"s水");

  //SQLの発行
  $pstmt->execute();

  //存在する行数分
  while($row = $pstmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
    echo "<br>";
  }
  //fetchの動作モード切替
  /* PDO::FETCH_ASSOC...連想配列
     PDO::FETC_NUM......添え字
     PDO::FETCH_BOTH....連想＆添え字
     ※規定はBOTH
  */

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
