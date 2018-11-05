<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  $name                  = $_SESSION['name'];
  $oldPassword           = '';
  $newPassword           = '';
  $confPassword          = '';
  $error['username']     = '';
  $error['oldPassword']  = '';
  $error['newPassword']  = '';
  $error['confPassword'] = '';
  if(!empty($_POST['userName'])){ $name = $_POST['userName']; }
  if(!empty($_POST['oldPassword'])){ $oldPassword = $_POST['oldPassword']; }
  if(!empty($_POST['newPassword'])){ $newPassword = $_POST['newPassword']; }
  if(!empty($_POST['confPassword'])){ $confPassword = $_POST['confPassword'];}

  if(isset($_POST['action'])){
    if($_POST['action'] == 'reName'){
      $_POST['userName'] = preg_replace('/^[ 　]+/u','', $_POST['userName']);
      if(empty($_POST['userName'])){
        $error['username'] = '名前に使用不可な名前が設定されています';
      } else if (strlen($_POST['userName']) > 250) {
        $error['username'] = 'ユーザー名は250文字以内で設定してください。';
      } else {
        $db->newname($_SESSION['userID'],$_POST['userName']);
        $_SESSION['name'] = $_POST['userName'];
        $_SESSION["flag"] = true; //変更されたよ
      }
    }
    if($_POST['action'] == 'rePass'){
      if($_POST['oldPassword'] == ''){
        $error['oldPassword'] = '旧パスワードを入力してください';
      } else if($_POST['newPassword'] == ''){
        $error['newPassword'] = '新しいパスワードを入力してください';
      } else if(!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-zA-Z\d]{8,255}+\z/',$_POST['newPassword']))) {
        $error['newPassword'] = 'パスワードは半角英数字を含む8~255文字で設定してください。';
      } else if($_POST['confPassword'] == ''){
        $error['confPassword'] = '確認用パスワードを入力してください';
      } else if($_POST['newPassword'] != $_POST['confPassword']){
        $error['confPassword'] = '確認用パスワードが一致しません';
      } else {
        $error['oldPassword'] = $db->newpassword($_SESSION['userID'],$_POST['oldPassword'],$_POST['newPassword']);
        if(empty($error['oldPassword'])){
          $oldPassword           = '';
          $newPassword           = '';
          $confPassword          = '';
          $_SESSION["flag"] = true; //変更されたよ
        }
      }
    } else {
      $tool->transition($_POST['action']);
    }
  }
  $grouplist = $db->groupretrieval($_SESSION['userID']);
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"><!--CSS準備-->
    <title>Troper|プロフィール編集</title><!--ウィンドウタブ-->
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
      <?php $tool->leftcontent($_SESSION['name'],$_SESSION['selectcon']); ?>
      <div id="right-content">
        <div id="content-area">
          <div id="report-wrap">
            <fieldset class='field-content'>
              <p class="profile-title">■ユーザ名変更</p>
              <div class="profile-flex">
                <p>ユーザID : <?php echo $_SESSION['userID']; ?></p>
              </div>
              <div class="profile-flex">
                <form action="" method="POST">
                  <div class="error"><?php echo $error['username']; ?></div>
                  <p>ユーザ名 :
                    <input type="text" name="userName" size="30" value='<?php echo htmlspecialchars($name, ENT_QUOTES); ?>' maxlength="100">
                  </p>
                  <button class="lbutton" name="action" value="reName">名前変更</button>
                </form>
              </div>
            </fieldset>
            <form id="rePassword" name="rePassword" value="" method="POST">
              <fieldset class='field-content'>
                <p class="profile-title">■パスワード変更</p>
                <div class=profile-flex>
                  <div class="error"><?php echo $error['oldPassword']; ?></div>
                  <p><input type="password" name="oldPassword" placeholder="旧パスワードを入力" size="50" maxlength="100" value="<?php echo htmlspecialchars($oldPassword, ENT_QUOTES); ?>"></p>
                </div>
                <div class=profile-flex>
                  <div class="error"><?php echo $error['newPassword']; ?></div>
                  <p><input type="password" name="newPassword" placeholder="新パスワードを入力"size="50" maxlength="100" value="<?php echo htmlspecialchars($newPassword, ENT_QUOTES); ?>"></p>
                </div>
                <div class=profile-flex>
                  <div class="error"><?php echo $error['confPassword']; ?></div>
                  <p><input type="password" name="confPassword" placeholder="新パスワードを入力（確認）" size="50" maxlength="100" value="<?php echo htmlspecialchars($confPassword, ENT_QUOTES); ?>"></p>
                  <button class="lbutton" name="action" value="rePass">パスワード変更</button>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- ここからモーダルウィンドウ -->
     <div id="modal-content">
         <p>
        <?php if(isset($_POST['action'])){
          if($_POST['action'] == 'reName'){
            ?>ユーザー名が<?php
            } else {
            ?>パスワードが<?php
          }}?>正常に登録されました
         </p>
         <div id="modalflex-container">
           <p id="modal-cbutton"><button type="button" class="modal-close mod-okbutton">OK</button></p>
         </div>
     </div>
     <!-- モーダルウィンドウのコンテンツ終了 -->
  </body>
</html>
