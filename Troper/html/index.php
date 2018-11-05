<?php
  session_start();
  require_once ('DBaccess/dbdao.php');

  $db = new DAO();
  $_SESSION["flag"] = false; //変更されてないよ!!!!!!!!!!

  $error = '';

  if(!empty($_SESSION['userID'])){
    header('location:Main');
  }
  if (isset($_POST['action'])) {
      if (empty($_POST['userid'])) {
          $error = 'ユーザーIDが未入力です。';
      } else if (empty($_POST["password"])) {
          $error = 'パスワードが未入力です。';
      } else if (!empty($_POST['userid']) && !empty($_POST['password'])) {
          $error = $db->login($_POST['userid'],$_POST['password']);
          if(empty($error)){
              if($_SESSION['permission'] == '0'){
                header('location: Main_admin');
              } else {
                header('location: Main');
              }
          }
      }
  }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="./css/reset.css" rel="stylesheet" type="text/css">
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <title>Troper|ログイン</title>
    </head>
    <body>
        <div id = "index-header">
            <h1>日報システム「Troper」</h1>
        </div>
        <div id = "index-background">
            <form id="index-form" name="loginForm" action="" method="POST">
                <div id="index-formTitle">
                    <legend id="index-formTitleName">ログイン</legend>
                    <div id="index-error"><font color="#ff0000"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></font></div>
                </div>
                <div id="index-formEditor">
                    <label for="userid" id="index-userid"><input type="text" id="index-userid-box" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>"></label>
                    <label for="password" id="index-password"><input type="password" id="index-password-box" name="password" value="" placeholder="パスワードを入力"></label>
                </div>
                <div id="index-login">
                    <div id=index-loginButtonFrame>
                        <button type="submit" id="index-loginButton" name="action" value="login"><img src="./image/login.png">ログイン</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
