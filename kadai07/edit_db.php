<?php
$dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

$db_user="root";
$db_password="";

try{
  $pdo = new PDO($dsn,$db_user,$db_password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $sql = "UPDATE kadai07_products SET name=:name,price=:price,image=:image WHERE id=:id";

  $stmt = $pdo->prepare($sql);

  $stmt->bindValue(":id",$_POST["id"]);
  $stmt->bindValue(":name",$_POST["name"]);
  $stmt->bindValue(":price",$_POST["price"]);
  $stmt->bindValue(":image",$_POST["image"]);

  $stmt->execute();
  if($stmt->rowCount() > 0){
    $message_code = 0;
  }else{
    $message_code=1;
  }

}catch(Exception $e){
  mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
  $pdo=null;
  $stmt=null;
  header("Location: edit_form.php?error=1");
  exit;
}finally{
  $pdo=null;
  $stmt=null;
  if(isset($_POST["num"])){
    header("Location: view2.php");
  }else{
    header("Location: edit_form.php?error=".$message_code);
  }
}
