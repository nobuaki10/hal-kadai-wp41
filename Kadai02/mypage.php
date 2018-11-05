<?php
session_start();

//ログインがされているか確認
if(!isset($_SESSION["name"])){
  header("Location:index.php?error_no=1");
}

//ログアウトボタンが押されたとき
if(isset($_POST["logout"])){
  //セッションを全て破棄
  $_SESSION = array();
  //セッション破棄
  session_destroy();
  header("Location:index.php");
  exit();
}
?>
<!doctype html>
<html>
  <head>
    <title>マイページ</title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>マイページ</h1>
    <h2>ようこそ <?php echo $_SESSION['name']; ?> さん</h2>
    <img border ="0" src="<?php echo $_SESSION["img"] ?>" width="100" height="100"/>
    <form method="post" action="">
      <input type="submit" name="logout" value="ログアウト"/>
    </form>
  </body>
</html>
