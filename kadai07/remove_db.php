<?php
$dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

$db_user="root";
$db_password="";

try{
  $pdo = new PDO($dsn,$db_user,$db_password);

  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $sql = "DELETE FROM kadai07_products WHERE id=:id";

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":id",$_POST["id"]);
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
  header("Location: remove_form.php?error=1");
  exit;
}finally{
  $pdo=null;
  $stmt=null;
  if(isset($_POST["num"])){
    header("Location: view2.php");
  }else{
    header("Location: remove_form.php?error=".$message_code);
  }
}
