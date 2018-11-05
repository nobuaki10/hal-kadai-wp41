<?php

if(isset($_POST["back"])){
  header("Location: contact.php?".
        "name=".((!empty($_POST["name"])) ? $_POST["name"]:"").
        "&mail=".((!empty($_POST["mail"])) ? $_POST["mail"]:"").
        "&subject=".((!empty($_POST["subject"])) ? (($_POST["subject"] != "件名なし") ? $_POST["subject"]:""):"").
        "&content=".((!empty($_POST["content"])) ? $_POST["content"]:"")
      );
} else {
  require_once("libs/Smarty.class.php");

  $dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";
  $db_user = "root";
  $db_password = "";

  try{
    $pdo = new PDO($dsn,$db_user,$db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO kadai10(name,address,subject,message,created,modified) ".
           "VALUES(:name,:address,:subject,:message,:created,:modified)";

    $pstmt = $pdo->prepare($sql);
    $pstmt->bindValue(":name",$_POST["name"]);
    $pstmt->bindValue(":address",$_POST["mail"]);
    $pstmt->bindValue(":subject",((!empty($_POST["subject"])) ? (($_POST["subject"] != "件名なし") ? $_POST["subject"]:""):""));
    $pstmt->bindValue(":message",$_POST["content"]);
    //$pstmt->bindValue("created",)

  }catch(Exception $e){
    echo mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
    $pdo = null;
  }finally{
    $pdo = null;
  }

  $smarty = new Smarty();
  $smarty->display("contact_finish.tpl");
}
