<?php
class tool{
  function __construct($logincheck){
    if (empty($logincheck)){
      header('location: index');
    }
  }

  public function transition($action){
    if($action == 'logout'){
      $_SESSION = array();
      session_destroy();
      header('location: index');
      exit();
    } else if ($action == 'usercontent'){
        $_SESSION['selectcon'] = 'content';
        $_SESSION['count']     = 100;
        header('location: Main');
        exit();
    } else if ($action == 'allcontent'){
        $_SESSION['selectcon'] = 'allcontent';
        $_SESSION['count']     = 100;
        header('location: Main');
        exit();
    } else if ($action == 'userlist'){
        $_SESSION['list'] = 'user';
        $_SESSION['selectcon'] = 'userlist';
        header('location: list');
        exit();
    } else if ($action == 'grouplist'){
        $_SESSION['list'] = 'group';
        $_SESSION['selectcon'] = 'grouplist';
        header('location: list');
        exit();
    } else if ($action == 'newreport'){
        $_SESSION['selectcon'] = 'newreport';
        header('location: Report');
        exit();
    } else if ($action == 'editprofile'){
        $_SESSION['selectcon'] = 'editprofile';
        header('location: editProfile');
        exit();
    } else if($action == 'admin_main'){
        header('location: Main_admin');
        exit();
    }
  }

  public function transition_admin($action){
    if($action == 'return'){
        header('location: Main_admin');
        exit();
    } else if ($action == 'userlist'){
        $_SESSION['list'] = 'user';
        $_SESSION['selectcon'] = 'userlist';
        header('location: list');
        exit();
    } else if ($action == 'grouplist'){
        $_SESSION['list'] = 'group';
        $_SESSION['selectcon'] = 'grouplist';
        header('location: list');
        exit();
    } else if($action == 'adminconfig'){
        header('location: adminedit');
        exit();
    } else if ($action == 'back'){
        header('location: list');
        exit();
    } else if ($action == 'logout'){
        $_SESSION = array();
        session_destroy();
        header('location: index');
        exit();
    }
  }

  public function listview($lists,$align,$option){
    if($align == 'left'){
     foreach($lists as $i => $list){
      if($i%3 == 0){
        $this->listSet($list,$option);
       } //end if1
     } //end for
    } else if($align == 'center'){
     foreach($lists as $i => $list){
       if($i%3 == 1){
         $this->listSet($list,$option);
        } //end if2
      } //end for
    } else if($align == 'right'){
      foreach($lists as $i => $list){
        if($i%3 == 2){
          $this->listSet($list,$option);
        } //end if3
      } //end for
    }
  }

  private function listSet($list,$option){
    if($option =='user'){  $id = 'userID'; $name = 'username'; }
    else {  $id = 'teamID'; $name = 'teamname'; } ?>
      <div class="one-user">
        <form action="" method="POST">
        <?php if($_SESSION['permission'] == 0){ ?>
            <div class="one-user-button"><pre><?php echo htmlspecialchars($list[$name], ENT_QUOTES); ?></pre></div><!--グループ,ユーザー名表示-->
          <div class="buttonflex">
              <!--ユーザー使用時はここから消す(ボタンだよ)-->
                  <button type="submit" class="ebutton" name="edit" value="<?php echo htmlspecialchars($list[$id], ENT_QUOTES); ?>">編集</button>
              <?php if($option == 'user'){ //ユーザー側の表示、非表示ボタンの表示
                      //表示、非表示の切り替え
                      if($list['view'] == 1){?>
                          <button type="submit" class="mbutton" name="view" value="<?php echo htmlspecialchars($list[$id], ENT_QUOTES); ?>">表示状態</button>
                      <?php } else { ?>
                          <button type="submit" class="mbutton" name="view" value="<?php echo htmlspecialchars($list[$id], ENT_QUOTES); ?>">非表示状態</button>
                      <?php } ?>
              <?php } else { //グループ側の削除ボタン表示 ?>
                      <button type="submit" class="mbutton" name="delete" value="<?php echo htmlspecialchars($list[$id], ENT_QUOTES); ?>">削除</button>
              <?php } ?>
              <!--ユーザー使用時はここまで消す-->
          </div>
        <?php } else { ?>
              <button type="submit" name="select" value="<?php echo $list[$id]; ?>" class="rbutton"><?php echo $list[$name]; ?></button><!--グループ名表示-->
        <?php } ?>
        </form>
      </div>

  <?php }

  public function leftcontent($name,$action){ ?>
          <div id="left-content">
            <form id="toolform" name="toolForm" action="" method="POST">
              <div id="menu">
                <ul>
                  <li>
                    <div id="userform">
                      <div id="username"><pre><?php echo htmlspecialchars($name, ENT_QUOTES); ?></pre></div>
                    </div>
                  </li>
                  <li>
                    <button class="btnoption" type="submit" name="action" value="editprofile"><img src="./image/config.png" title="プロフィール編集"></button>
                    <button class="btnoption" type="submit" name="action" value="logout"><img src="./image/logout.png" title="ログアウト"></button>
                  </li>
                  <hr style="width:80%; border:none; border-top:solid 1px #666; margin-bottom:0.5rem;">
                  <li><button class="<?php if($action == 'content'){echo 'btnlistactive';} else{echo 'btnlist';} ?>" type="submit" name="action" value="usercontent">
                      <img src="./image/home.png"/>マイ日報</button></li>
                  <li><button class="<?php if($action == 'allcontent'){echo 'btnlistactive';} else{echo 'btnlist';} ?>" type="submit" name="action" value="allcontent"><img src="./image/all.png"/>全員の日報</button></li>
                  <li><button class="<?php if($action == 'userlist'){echo 'btnlistactive';} else{echo 'btnlist';} ?>" type="submit" name="action" value="userlist"><img src="./image/user.png"/>ユーザ一覧</button></li>
                  <li><button class="<?php if($action == 'grouplist'){echo 'btnlistactive';} else{echo 'btnlist';} ?>" type="submit" name="action" value="grouplist"><img src="./image/group.png"/>グループ一覧</button></li>
                  <li><button class="<?php if($action == 'newreport'){echo 'btnlistactive';} else{echo 'btnlist';} ?>" type="submit" name="action" value="newreport"><img src="./image/report.png"/>日報作成</button></li>
                </ul>
              </div>
            </form>
          </div>
<?php }
  public function season(){
    $date = new DateTime('Asia/Tokyo');
    if($date->format('m-d') == '12-23' ||
        $date->format('m-d') == '12-24' ||
        $date->format('m-d') == '12-25'){ ?>
        <script>
          $(function() {
            $(document).snowfall(
              {
                minSize  : 1,    // 雪の最小サイズ
                maxSize  : 5,    // 雪の最大サイズ
                minSpeed : 1,    // 雪の最低速度
                maxSpeed : 8,    // 雪の最高速度
                round    : true, // 雪の形を丸くする
                shadow   : true, // 雪に影をつける
                flakeColor : "#fff", // 雪の色を指定
                flakeCount : 100,
              }
            );
          });
        </script>
      <?php
    }
    if($date->format('m-d') == '4-1' ||
        $date->format('m-d') == '4-2' ||
        $date->format('m-d') == '4-3'){ ?>
        <script>
          $(function() {
            $(document).snowfall(
              {
                minSize  : 15,    // 雪の最小サイズ
                maxSize  : 25,    // 雪の最大サイズ
                minSpeed : 1,    // 雪の最低速度
                maxSpeed : 3,    // 雪の最高速度
                flakeColor : "#fff", // 雪の色を指定
                image : "./image/sakura.png"// オリジナル画像を使用する場合
              }
            );
          });
        </script>
      <?php
    }
    if($date->format('m-d') == '10-1' ||
        $date->format('m-d') == '10-2' ||
        $date->format('m-d') == '10-3'){ ?>
        <script>
          $(function() {
            $(document).snowfall(
              {
                minSize  : 5,    // 雪の最小サイズ
                maxSize  : 10,    // 雪の最大サイズ
                minSpeed : 1,    // 雪の最低速度
                maxSpeed : 3,    // 雪の最高速度
                flakeColor : "#fff", // 雪の色を指定
                image : "./image/ochiba.png"// オリジナル画像を使用する場合
              }
            );
          });
        </script>
      <?php
    }
  }
}
?>
