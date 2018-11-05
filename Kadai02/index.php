<?php
  session_start();
  $error_message = "";
  if(isset($_GET["error_no"])){
    switch($_GET{"error_no"}){
      case 1:
      $error_message ="<p style='color:red'>不正なアクセスです</p>";
      break;

      case 2:
      $error_message="<p style='color:red'>IDまたはPASSWORDが違います。</p>";
      break;
    }
  }

  //ログイン情報確認
  if(isset($_SESSION["name"])){
    header("Location:mypage.php");
    exit();
  }

  //cookieの確認
  $id = "";
  if(isset($_COOKIE["id"])){
    $id = $_COOKIE["id"];
  }
?>
<!doctype html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>ログイン</h1>
    <form method="POST" action="login.php">
      <label>ID:</label>
      <input type="text" name="id" value="<?php echo $id ?>"/></br>
      <label>Password:</label>
      <input type="text" name="pass"/></br>
      <input type="submit" name="login" value="ログイン"></br>
    </form>
    <?php echo $error_message; ?>
  </body>
</html>
