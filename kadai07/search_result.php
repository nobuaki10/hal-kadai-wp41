<?php
$dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

$db_user="root";
$db_password="";
$message_code="";
try{
  $pdo = new PDO($dsn,$db_user,$db_password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $sql = "SELECT * FROM kadai07_products WHERE id=:id";

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id",$_POST["id"]);
  $stmt->execute();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id=$row["id"];
    $name=$row["name"];
    $price=$row["price"];
    $image=$row["image"];
  }
  if($stmt->rowCount() <= 0){
    $message_code = "<a>検索結果が存在しませんでした</a>";
  }

}catch(Exception $e){
  mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
  $pdo=null;
  $stmt=null;
  exit;
}finally{
  $pdo=null;
  $stmt=null;
}

?>
<!doctype html>
<html>
  <head>
    <title>検索結果ページ</title>
  </head>
  <body>
    <h1>検索結果</h1>
    <?php if($message_code == ""){ ?>
    <a>ID:<?php echo $id; ?></a></br>
    <a>商品名:<?php echo $name; ?></a></br>
    <a>単価:<?php echo $price; ?></a></br>
    <a>画像:<?php echo $image; ?></a></br>
    <?php } else { echo $message_code; } ?>
    <a href="search_form.html">戻る</a></br>
  </body>
</html>
