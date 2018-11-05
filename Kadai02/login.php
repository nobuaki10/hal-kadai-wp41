<?php
session_start();
$users = file("users.txt");
$user = $_POST["id"].",".$_POST["pass"];
$url = "";

//正しくログインが押されたかチェック
if(!isset($_POST["login"])){
  header("Location: index.php?error_no=1");
  exit;
}

//パスワードチェック
foreach($users as $user){
  list($id,$pass,$name,$img) = explode(",",$user);
  if($id == $_POST["id"] && $pass == $_POST["pass"]){
    //セッション設定
    $_SESSION["name"] = $name;
    $_SESSION["img"] = $img;

    //クッキー設定
    setcookie("id",$_POST["id"],time()+86400);
    header("Location: mypage.php");
    exit;
  }
}
header("Location: index.php?error_no=2");
exit;
