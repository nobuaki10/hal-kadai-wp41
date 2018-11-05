<?php
class ModelProduct{
  public $pdo;

  public function __construct(){
    try{
      $dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";
      $db_user = "root";
      $db_password = "";
      $this->pdo = new PDO($dsn,$db_user,$db_password);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    }catch(Exception $e){
      mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=1");
      exit;
    }
  }

  public function add($id,$name){
    try{
      $stmt = $this->pdo->prepare("INSERT INTO kadai08(id,name) VALUES(:id,:name)");
      $stmt->bindValue(":id",$id);
      $stmt->bindValue(":name",$name);
      $stmt->execute();
    }catch(Exception $e){
      echo mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=2");
      exit;
    }finally{
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=0");
    }
  }

  public function remove($id){
    $message_code = 0;
    try{
      $stmt = $this->pdo->prepare("DELETE FROM kadai08 WHERE id=:id");
      $stmt->bindValue(":id",$id);
      $stmt->execute();
      if($stmt->rowCount() <= 0){
        $message_code = 3;
      }
    }catch(Exception $e){
      echo mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=3");
      exit;
    }finally{
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=".$message_code);
    }
  }

  public function update($id,$name){
    try{
      $stmt = $this->pdo->prepare("UPDATE kadai08 SET name=:name WHERE id=:id");
      $stmt->bindValue(":id",$id);
      $stmt->bindValue(":name",$name);
      $stmt->execute();
    }catch(Exception $e){
      echo mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=4");
      exit;
    }finally{
      $this->pdo=null;
      $stmt=null;
      header("Location: index.php?error=0");
    }
  }
}
