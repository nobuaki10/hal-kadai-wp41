<?php
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();
  $success                = '';
  $error['userid']        = '';
  $error['username']      = '';
  $error['Password']      = '';
  $error['confPassword']  = '';

  if(isset($_POST['action'])){
    $tool->transition_admin($_POST['action']);
  }
  //グループ一覧
  $grouplist = $db->groupall();

  //完了が押されたら
  if(isset($_POST['entry']))
  {
    $_POST['username'] = preg_replace('/^[ 　]+/u','', $_POST['username']);//先頭のスペースを消す
    // 1. ユーザーIDの入力チェック
    if (empty($_POST['userid'])) { // emptyは値が空のとき
        $error['userid']  = 'ユーザーIDが未入力です。';
    } else if (empty($_POST['username'])) {
        $error['username'] = 'ユーザー名が未入力です。';
    } else if (empty($_POST['password'])) {
        $error['Password'] = 'パスワードが未入力です。';
    } else if($_POST['password'] != $_POST['confpassword']){
        $error['confPassword'] = 'パスワード確認欄が一致していません。';
    } else if(!(preg_match('/\A[a-zA-Z_\d]{1,250}+\z/',$_POST['userid']))) {
        $error['userid'] = 'ユーザーIDは30文字以内,半角英数字とアンダーバーのみで設定してください。';
    } else if(mb_strlen($_POST['username']) > 30) {
        $error['username'] = 'ユーザー名は30文字以内で設定してください。';
    } else if(!(preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-zA-Z\d]{8,255}+\z/',$_POST['password']))) {
        $error['Password'] = 'パスワードは半角英数字を含む8~255文字で設定してください。';
    } else if(!empty($_POST['userid']) && !empty($_POST['username']) && !empty($_POST['password'])){
      $user = array(
        ':userID'=>$_POST['userid'],
        ':username'=>$_POST['username'],
        ':password'=>$_POST['password'],
      );
      //ユーザーIDかぶりチェック（被らなければ通る）
      if($db->checkuserid($_POST['userid'])){
        $db->userentry($user);
        if(isset($_POST['checkbox'])){
          foreach($_POST['checkbox'] as $value){
            $groupID = $value;
            $db->groupmemberadd($groupID,$_POST['userid']);
          }
        }
        $_SESSION['flag'] = true; //変更されたよ
        $_POST = '';
      }else{
        $error['userid']      = 'すでに使われているユーザーです';
      }
    }
  }
?>

<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"><!--CSS準備-->
    <title>troper|新規ユーザー登録</title><!--ウィンドウタブ-->
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">

    <!--完了モーダル用------------------------------------->
    <link href="css/modal.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/modal.js"></script>
    <!--完了モーダル用------------------------------------->

  </head>
  <body style="overflow: scroll;">
    <?php
    // 完了モーダル用-------------------------------------
    if($_SESSION['flag'] == false ) // どこも変更されてない
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
    <form id="userentry" name="userentry" action="" method="POST">
      <div id="mainflex-container">
        <div id="right-content">
          <div id="index-header">
            <h1>ユーザー登録</h1>
          </div>
          <div id="content-area">
            <div id="report-wrap">
              <fieldset class='field-content'>
                <p class="profile-title">■ユーザー情報変更</p>
                <div class="profile-flex">
                  <div class="error"><p><?php echo $error['userid']; ?></p></div>
                  <p>ユーザーID :
                    <input type="text" name='userid' size="30" placeholder="ユーザーIDを入力" maxlength="100"
                      value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                  </p>
                  <p class="field-content-font">(半角英数字250文字以内,記号は_のみ使用可)</p>
                </div>
                <div class="profile-flex">
                  <div class="error"><p><?php echo $error['username']; ?></p></div>
                  <p>ユーザー名 :
                    <input type="text" name="username" size="30" placeholder="ユーザー名を入力"
                    value='<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>' maxlength="100">
                  </p>
                  <p class="field-content-font">(250文字以内、先頭にスペース不可)</p>
                    <!--<button class="lbutton" name="action" value="reName">名前変更</button>-->
                </div>
              </fieldset>

              <fieldset class='field-content'>
                <p class="profile-title">■所属グループ一覧</p>
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
                             value=<?php echo $team["teamID"];?>> <!--end input-->
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
                             value=<?php echo $team["teamID"];?>> <!--end input-->
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
                             value=<?php echo $team["teamID"];?>> <!--end input-->
                            <?php echo $team["teamname"]; ?> <!--グループの名前-->
                          </div> <!--end one-user-->
                        <?php } //end if1
                      } //end for ?>

                    </div><!--end userflex-right-->
                  <?php } //end グループある時 ?>
                  </div> <!--end listflex-cencontainer-->

                </div>
              </fieldset>

              <fieldset class='field-content'>
                <p class="profile-title">■パスワード設定</p>
                <div class=profile-flex>
                  <div class="error"><p><?php echo $error['Password']; ?></p></div>
                  <p><input type="password" name="password" placeholder="パスワードを入力"size="50" maxlength="100"
                    value="<?php if (!empty($_POST["password"])) {echo htmlspecialchars($_POST["password"], ENT_QUOTES);} ?>">
                  </p>
                  <p class="field-content-font">(8~255文字 半角英数字含む)</p>
                </div>
                <div class=profile-flex>
                  <div class="error"><p><?php echo $error['confPassword']; ?></p></div>
                  <p><input type="password" name="confpassword" placeholder="パスワードを入力（確認）" size="50" maxlength="100"
                    value="<?php if (!empty($_POST["confpassword"])) {echo htmlspecialchars($_POST["confpassword"], ENT_QUOTES);} ?>">
                  </p>
                  <p class="field-content-font">(確認用)</p>
                    <!--<button class="lbutton" name="action" value="rePass">パスワード変更</button>-->
                </div>
              </fieldset>

              <div id="reportflex-bottomcontainer">
                <div class="button-area" hidden><button  type="submit" name="entry" class="mbutton" value="entry">新規作成</button></div>
                <div class="button-area"><button type="submit" name='action' class="cbutton" value = "back">戻る</button></div>
                <div class="button-area"><button type="submit" name='entry' class="mbutton" value = "entry">完了</button></div>
              </div> <!-- reportflex-bottomcontainer end -->

            </div> <!-- report-wrap end -->
          </div> <!--content-area end-->
        </div> <!--right-content end-->
      </div> <!--mainflex-container end-->
    </form>

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
