<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  $error = '';

  if(isset($_POST['action'])){
    $tool->transition_admin($_POST['action']);
  }

  if(!empty($_SESSION['listID'])){
    $groupname = $db->getgroupname($_SESSION['listID']);
    $currentmemberlist = $db->getmemberlist($_SESSION['listID']);
    $userlist = $db->userall('admin');
  }

  if(isset($_POST['entry'])){
    $_POST['groupname'] = preg_replace('/^[ 　]+/u','', $_POST['groupname']);//先頭のスペースを消す
    if(empty($_POST['groupname'])){
      $error = 'グループ名を設定してください';
    } else if (mb_strlen($_POST['groupname']) > 30){
      $error = 'グループ名が長すぎます';
    } else if($db->checkmygroupname($groupname[0]['teamname'],$_POST['groupname'])){
      $error = 'すでに存在するグループ名です';
    } else {
      $db->newgroupname($_SESSION['listID'],$_POST['groupname']);
      $_SESSION['flag'] = true; //変更されたよ
    }

    if(isset($_POST['checkbox'])){
      foreach($_POST['checkbox'] as $value){
        $currentmemberflag = false;
        if($currentmemberlist != null)
        {
          foreach($currentmemberlist as $currentmember){
            if($value == $currentmember['userid'])
            {
              $currentmemberflag = true;
              break;
            }
          }
        }
        if($currentmemberflag == false)
        {
          $db->groupmemberadd($_SESSION['listID'],$value);
        }
      }

      if($currentmemberlist != null)
      {
        foreach($currentmemberlist as $currentmember){
          $deletememberflag = true;
          foreach($_POST['checkbox'] as $value){
            if($currentmember['userid'] == $value || $currentmember['userid'] == 'admin')
            {
              $deletememberflag = false;
              break;
            }
          }
          if($deletememberflag == true)
          {
            $db->groupmemberdelete($_SESSION['listID'],$currentmember['userid']);
            $_SESSION['flag'] = true; //変更されたよ
          }
        }
      }
    }else{
      foreach($currentmemberlist as $currentmember){
        $db->groupmemberdelete($_SESSION['listID'],$currentmember['userid']);
        $_SESSION["flag"] = true; //変更されたよ
      }
    }
  }

  if(!empty($_SESSION['listID'])){
    $groupname = $db->getgroupname($_SESSION['listID']);
    $currentmemberlist = $db->getmemberlist($_SESSION['listID']);
    $userlist = $db->userall('admin');
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="./css/reset.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <title>Troper|グループ編集</title>
    
    <!--完了モーダル用------------------------------------->
    <link href="css/modal.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/modal.js"></script>
    <!--完了モーダル用------------------------------------->
  </head>
  <body style="overflow: scroll;">
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
    <form action="" method="POST">
      <div id="right-content">
        <div id="index-header"><h1>グループ編集</h1></div>
        <div id="content-area">
          <div id="list-all-wrap">
            <div id="groupeditflex-topcontainer">
              <div id ="groupeditflex-bottomcontainer">
                <div class="button-area" hidden><button class="mbutton" type="submit" name="entry" value="entry">新規作成</button></div>
                <div class="button-area"><button class="cbutton" type="submit" name="action" value="back">戻る</button></div>
                <div class="button-area"><button class="mbutton" type="submit" name="entry" value="entry">編集完了</button></div>
              </div>
              <div id = "groupname">
                <div class="error"><?php echo $error; ?></div>
                  ■グループ名:<input type="text" name="groupname"
                  value="<?php echo htmlspecialchars($groupname[0]['teamname'], ENT_QUOTES); ?>">
              </div>
              <div id = "userselect">
                ■グループメンバー:
              </div>
            </div> <!--end groupeditflex-topcontainer-->

            <div id="listflex-cencontainer">
              <?php if(empty($userlist))
              { ?>
                <p>ユーザーは登録されていません</p>
              <?php } else { // ユーザいる時 ?>

              <div class="userflex"><!--左-->

                <?php foreach($userlist as $i => $name){
                  if($i%3 == 0){ ?>
                    <div class="one-user">
                      <input class="checkbox" type="checkbox" name="checkbox[]"
                       value=<?php echo $name["userID"];
                        if($currentmemberlist != null)
                        {
                          foreach($currentmemberlist as $j => $currentmember){
                            if($name["userID"] == $currentmember['userid'])
                            { ?> checked = true <?php }
                          }
                        }?>
                      > <!--end input-->
                      <?php echo $name["username"]; ?> <!--メンバーの名前-->
                    </div> <!--end one-user-->
                  <?php } //end if1
                } //end for ?>

              </div><!--end userflex-left-->
              <div class="userflex"><!--真ん中-->

                <?php foreach($userlist as $i => $name){
                  if($i%3 == 1){ ?>
                    <div class="one-user">
                      <input class="checkbox" type="checkbox" name="checkbox[]"
                       value=<?php echo $name["userID"];
                        if($currentmemberlist != null)
                        {
                          foreach($currentmemberlist as $j => $currentmember){
                            if($name["userID"] == $currentmember['userid'])
                            { ?> checked = true <?php }
                          }
                        }?>
                      > <!--end input-->
                      <?php echo $name["username"]; ?> <!--メンバーの名前-->
                    </div> <!--end one-user-->
                  <?php } //end if1
                } //end for ?>

              </div><!--end userflex-center-->
              <div class="userflex"><!--右-->

                <?php foreach($userlist as $i => $name){
                  if($i%3 == 2){ ?>
                    <div class="one-user">
                      <input class="checkbox" type="checkbox" name="checkbox[]"
                       value=<?php echo $name["userID"];
                        if($currentmemberlist != null)
                        {
                          foreach($currentmemberlist as $j => $currentmember){
                            if($name["userID"] == $currentmember['userid'])
                            { ?> checked = true <?php }
                          }
                        }?>
                      > <!--end input-->
                      <?php echo $name["username"]; ?> <!--メンバーの名前-->
                    </div> <!--end one-user-->
                  <?php } //end if1
                } //end for ?>

              </div><!--end userflex-right-->
            <?php } //end ユーザいる時 ?>
            </div> <!--end listflex-cencontainer-->
            <div id ="groupeditflex-bottomcontainer">
              <div class="button-area"><button class="cbutton" type="submit" name="action" value="back">戻る</button></div>
              <div class="button-area"><button class="mbutton" type="submit" name="entry" value="entry">編集完了</button></div>
            </div>
          </div> <!--end list-all-wrap-->
        </div> <!--end content-area-->
      </div> <!--end right-content-->
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
