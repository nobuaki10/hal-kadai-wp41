<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  if($_SESSION['permission'] != 0){
    header('location: Main');
    exit();
  }

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  if(isset($_POST['action'])){
    $tool->transition_admin($_POST['action']);
  }
?>
<html>
    <head>
        <meta charset="UTF-8"><!--CSS準備-->
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <title>Troper|Admin管理画面</title><!--ウィンドウタブ-->
    </head>
    <body>
      <form action="" method="POST">
        <div id="index-header">
            <h1>管理者用メインページ</h1>
        </div>
          <div id="adminmain-wrap">
              <div class="adminmain-menu">
                  <!--php:もしユーザ管理ボタンが押されたらユーザ管理画面にジャンプする-->
                  <button type="submit" class="rbutton adminmain-button" name="action" value="userlist">ユーザ管理</button>
              </div>
              <div class="adminmain-menu">
                  <!--php:もしグループ管理ボタンが押されたらグループ管理画面にジャンプする-->
                  <button type="submit" class="rbutton adminmain-button" name="action" value="grouplist">グループ管理</button>
              </div>
              <div class="adminmain-menu">
                  <button type="submit" class="rbutton adminmain-button" name= "action" value= "adminconfig">管理者設定</button>
              </div>

              <div class="adminmain-menu">
                  <!-- php:もしログアウトボタンが押されたらログアウトする-->
                  <button type="submit" class="rbutton adminmain-button" name="action" value="logout">ログアウト</button>
              </div>
          </div> <!--adminmain-wrap-->
      </form>
    </body>
</html>
