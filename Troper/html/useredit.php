<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  if(isset($_POST['action'])){
    $tool->transition_admin($_POST['action']);
  }

  $username = $db->getusername($_SESSION['listID']);
  $currentmygrouplist = $db->getmygroup($_SESSION['listID']);

  $userID                = $_SESSION['listID'];
  $name                  = $username['username'];
  $newPassword           = '';
  $confPassword          = '';
  $error['userid']        = '';
  $error['username']      = '';
  $error['Password']      = '';
  $error['confPassword']  = '';

  if(!empty($_POST['userID'])){$userID = $_POST['userID'];}
  if(!empty($_POST['userName'])){ $name = $_POST['userName'];}
  if(!empty($_POST['newPassword'])){ $newPassword = $_POST['newPassword']; }
  if(!empty($_POST['confPassword'])){ $confPassword = $_POST['confPassword'];}

  if(isset($_POST['action'])){
    if($_POST['action'] == 'reName'){
      $_POST['userName'] = preg_replace('/^[ 　]+/u','', $_POST['userName']);//先頭のスペースを消す
      if(empty($_POST['userName'])){
        $error['userName'] = '名前に使用不可な名前が設定されています';
      } else {
        if(strlen($_POST['userName'])  > 250) {
          $error['userName'] = 'ユーザー名は250文字以内で設定してください。';
        }else{
          $db->newname($_SESSION['listID'],$_POST['userName']);
          $_SESSION['name'] = $_POST['userName'];
          $_SESSION["flag"] = true; //変更されたよ
        }
      }
    }

    if($_POST['action'] == 'reGroup'){
      if(isset($_POST['checkbox'])){
        foreach($_POST['checkbox'] as $value){
          $currentmygroupflag = false;
          if($currentmygrouplist != null)
          {
            foreach($currentmygrouplist as $currentmygroup){
              if($value == $currentmygroup['teamID'])
              {
                $currentmygroupflag = true;
                break;
              }
            }
          }
          if($currentmygroupflag == false)
          {
            $db->groupmemberadd($value,$_SESSION['listID']);
            $_SESSION["flag"] = true; //変更されたよ
          }
        }

        if($currentmygrouplist != null)
        {
          foreach($currentmygrouplist as $currentmygroup){
            $deletegroupflag = true;
            foreach($_POST['checkbox'] as $value){
              if($currentmygroup['teamID'] == $value)
              {
                $deletegroupflag = false;
                break;
              }
            }
            if($deletegroupflag == true)
            {
              $db->groupmemberdelete($currentmygroup['teamID'],$_SESSION['listID']);
              $_SESSION["flag"] = true; //変更されたよ
            }
          }
        }
      }else{
        foreach($currentmygrouplist as $currentmygroup){
          $db->groupmemberdelete($currentmygroup['teamID'],$_SESSION['listID']);
          $_SESSION["flag"] = true; //変更されたよ
        }
      }
    }

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
        $db->resetpassword($_SESSION['listID'],$_POST['newPassword']);
        $success = 'パスワードを変更しました';
        $newPassword           = '';
        $confPassword          = '';
        $_SESSION["flag"] = true; //変更されたよ
      }
    }
  }
  $currentmygrouplist = $db->getmygroup($_SESSION['listID']);
  $grouplist = $db->groupall();

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
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"><!--CSS準備-->
    <title>Troper|ユーザー編集</title><!--ウィンドウタブ-->
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--完了モーダル用------------------------------------->
    <link href="css/modal.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/modal.js"></script>
    <!--完了モーダル用------------------------------------->

  </head>
  <body>
    <div id="mainflex-container">
      <div id="right-content">
        <div id="index-header">
          <h1>ユーザー編集</h1>
        </div>
        <div id="content-area">
          <div id="report-wrap">
            <fieldset class='field-content'>
              <p class="profile-title">■ユーザ情報変更</p>
              <div class="profile-flex">
                <div class="error"><p><?php echo $error['userid']; ?></p></div>
                <p>ユーザID :<?php echo $userID; ?></p>
                <p class="field-content-font">(半角英数字250文字以内,記号は_のみ使用可)</p>
              </div>
              <div class="profile-flex">
                <form id="rename" name="rename" action="" method="POST">
                    <div class="error"><p><?php echo $error['username']; ?></p></div>
                  <p>ユーザ名 :
                    <input type="text" name="userName" size="30" value='<?php echo $name; ?>' maxlength="100">
                  </p>
                  <p class="field-content-font">(半角英数字250文字以内)</p>
                  <button class="lbutton" name="action" value="reName">名前変更</button>
                </form>
              </div>
            </fieldset>
            <fieldset class='field-content'>
              <form action="" method="POST">
              <p class="profile-title">■所属グループ</p>
              <div class="profile-flex">

                <div id="listflex-cencontainer">
                  <?php if(empty($grouplist))
                  { ?>
                    <p>グループは登録されていません</p>
                  <?php } else { // グループある時 ?>

                    <div class="userflex"><!--左-->

                      <?php foreach($grouplist as $i => $team){
                        if($i%3 == 0){ ?>
                          <div class="one-user">
                            <input class="checkbox" type="checkbox" name="checkbox[]"
                             value=<?php echo $team["teamID"];
                             foreach($currentmygrouplist as $mygroup){
                                if($mygroup["teamID"] == $team["teamID"]){
                                  ?> checked <?php
                                }
                             }?>> <!--end input-->
                            <?php echo $team["teamname"]; ?> <!--グループの名前-->
                          </div> <!--end one-user-->
                        <?php } //end if1
                      } //end for ?>

                    </div><!--end userflex-left-->
                    <div class="userflex"><!--真ん中-->

                      <?php foreach($grouplist as $i => $team){
                        if($i%3 == 1){ ?>
                          <div class="one-user">
                            <input class="checkbox" type="checkbox" name="checkbox[]"
                             value=<?php echo $team["teamID"];
                             foreach($currentmygrouplist as $mygroup){
                                if($mygroup["teamID"] == $team["teamID"]){
                                  ?> checked <?php
                                }
                             }?>> <!--end input-->
                            <?php echo $team["teamname"]; ?> <!--グループの名前-->
                          </div> <!--end one-user-->
                        <?php } //end if1
                      } //end for ?>

                    </div><!--end userflex-center-->
                    <div class="userflex"><!--右-->

                      <?php foreach($grouplist as $i => $team){
                        if($i%3 == 2){ ?>
                          <div class="one-user">
                            <input class="checkbox" type="checkbox" name="checkbox[]"
                             value=<?php echo $team["teamID"];
                             foreach($currentmygrouplist as $mygroup){
                                if($mygroup["teamID"] == $team["teamID"]){
                                  ?> checked <?php
                                }
                             }?>> <!--end input-->
                            <?php echo $team["teamname"]; ?> <!--グループの名前-->
                          </div> <!--end one-user-->
                        <?php } //end if1
                      } //end for ?>

                    </div> <!--end userflex-right-->
                  <?php } //end グループある時 ?>
                  </div> <!--end listflex-cencontainer-->
                </div> <!--end profile-flex-->
                  <button style="margin-left:6rem;" type="submit" name="action" class="lbutton" value="reGroup">グループ変更</button>
                </form>
            </fieldset>

            <form action="" method="POST">
              <fieldset class='field-content'>
                <div class="profile-title">■パスワード設定</div>
                <div class=profile-flex>
                    <div class="error"><p><?php echo $error['Password']; ?></p></div>
                  <p><input type="password" name="newPassword" placeholder="パスワードを入力" size="50" maxlength="100" value="<?php echo $newPassword; ?>">
                  </p>
                  <p class="field-content-font">(8~255文字 半角英数字含む)</p>
                </div>
                <div class=profile-flex>
                    <div class="error"><p><?php echo $error['confPassword']; ?></p></div>
                  <p><input type="password" name="confPassword" placeholder="パスワードを入力(確認)" size="50" maxlength="100" value="<?php echo $confPassword; ?>"></p>
                  <button class="lbutton" name="action" value="rePass">パスワード変更</button>
                </div>
              </fieldset>
            </form>

            <form action="" method="POST">
              <div id="reportflex-bottomcontainer">
                <div class="button-area"><button type="submit" name="action" class="cbutton" value="back">戻る</button></div>
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
