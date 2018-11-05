<?php
$dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

$db_user="root";
$db_password="";

try{
  $pdo = new PDO($dsn,$db_user,$db_password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $sql = "INSERT INTO kadai07_products(id,name,price,image) VALUES(:id,:name,:price,:image)";

  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(":id",$_POST["id"]);
  $stmt->bindValue(":name",$_POST["name"]);
  $stmt->bindValue(":price",$_POST["price"]);
  $stmt->bindValue(":image",$_POST["image"]);

  $stmt->execute();

}catch(Exception $e){
  mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
  $pdo=null;
  $stmt=null;
  header("Location: add_form.php?error=1");
  exit;
}finally{
  $pdo=null;
  $stmt=null;
  header("Location: add_form.php?error=0");
}
