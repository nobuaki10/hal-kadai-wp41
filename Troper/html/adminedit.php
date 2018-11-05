<?php
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  $error['Password'] = '';
  $error['confPassword'] = '';
  $newPassword           = '';
  $confPassword          = '';
  if(!empty($_POST['newPassword'])){ $newPassword = $_POST['newPassword']; }
  if(!empty($_POST['confPassword'])){ $confPassword = $_POST['confPassword'];}

  if(isset($_POST['action'])){
    if($_POST['action'] == 'rePass'){
      if($_POST['newPassword'] == ''){
        $error['Password'] = '新しいパスワードを入力してください';
      } else if($_POST['confPassword'] == ''){
        $error['confPassword'] = '確認用パスワードを入力してください';
      } else if($_POST['newPassword'] != $_POST['confPassword']){
        $error['confPassword'] = '確認用パスワードが一致しません';
      } else if(!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-zA-Z\d]{8,255}+\z/',$_POST['newPassword']))) {
        $error['Password'] = 'パスワードは半角英数字を含む8~255文字で設定してください。';
      }else {
        $db->resetpassword($_SESSION['userID'],$_POST['newPassword']);
        $newPassword           = '';
        $confPassword          = '';
        $_SESSION['flag'] = true; //変更されたよ
        $_POST = '';;
      }
    }else{
      $tool->transition_admin($_POST['action']);
    }
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"><!--CSS準備-->
    <title>Troper|管理者設定</title><!--ウィンドウタブ-->
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--完了モーダル用------------------------------------->
    <link href="css/modal.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/modal.js"></script>
    <!--完了モーダル用------------------------------------->

  </head>
  <body>
    <?php
    // 完了モーダル用-------------------------------------
    if( $_SESSION['flag'] == false ) // どこも変更されてない
    { ?>
      <script type="text/javascript">flag = -1;</script> <!--出てきちゃダメ-->
    <?php }
    else if( $_SESSION['flag'] == true ) // どこか変更された
    { ?>
      <script type="text/javascript">flag = 1;</script> <!--出てきて欲しい-->
      <?php $_SESSION['flag'] = false; // 一回で十分だよ
    }
    // 完了モーダル用-------------------------------------
    ?>
    <div id="mainflex-container">
      <div id="right-content">
        <div id="index-header">
          <h1>管理者設定</h1>
        </div>
        <div id="content-area">
          <div id="report-wrap">
            <form action="" method="POST">
              <fieldset class='field-content'>
                <div class="profile-title">■パスワード設定</div>
                <div class='profile-flex'>
                    <div class="error"><p><?php echo htmlspecialchars($error['Password'], ENT_QUOTES); ?></p></div>
                  <p><input type="password" name="newPassword" placeholder="パスワードを入力" size="50" maxlength="100"
                    value="<?php if (!empty($_POST["newPassword"])) {echo htmlspecialchars($_POST["newPassword"], ENT_QUOTES);} ?>"></p>
                  <p class="field-content-font">(8~255文字 半角英数字含む)</p>
                </div>
                <div class="profile-flex">
                    <div class="error"><p><?php echo htmlspecialchars($error['confPassword'], ENT_QUOTES); ?></p></div>
                  <p><input type="password" name="confPassword" placeholder="パスワードを入力(確認)" size="50" maxlength="100"
                    value="<?php if (!empty($_POST["confPassword"])) {echo htmlspecialchars($_POST["confPassword"], ENT_QUOTES);} ?>"></p>
                  <button class="lbutton" name="action" value="rePass">パスワード変更</button>
                </div>
              </fieldset>
            </form>

            <form action="" method="POST">
              <div id="reportflex-bottomcontainer">
                <div class="button-area"><button type="submit" name="action" class="cbutton" value="return">戻る</button></div>
              </div> <!-- end reportflex-bottomcontainer-->
            </form>

          </div> <!--end report-wrap-->
        </div> <!--end content-area-->
      </div> <!--end right-content-->
    </div> <!--end mainflex-container-->

    <!-- ここからモーダルウィンドウ -->
     <div id="modal-content">
         <p>正常に登録されました。</p>
         <div id="modalflex-container">
           <p id="modal-cbutton"><button type="button" class="modal-close mod-okbutton">OK</button></p>
         </div>
     </div>
     <!-- モーダルウィンドウのコンテンツ終了 -->

  </body>
</html>
