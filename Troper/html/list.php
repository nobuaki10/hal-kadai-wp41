<?php
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  if(isset($_POST['view'])){
    $db->changeview($_POST['view']);
  }

  if(isset($_POST['action'])){

    if($_SESSION['permission'] == 0){
      $tool->transition_admin($_POST['action']);
    } else {
      $tool->transition($_POST['action']);
    }
  } else if(isset($_POST['select'])){
    if($_SESSION['list'] == 'user'){
      $_SESSION['listID'] = $_POST['select'];
    }else if($_SESSION['list'] == 'group'){
      $_SESSION['listID'] = $_POST['select'];
    }
    header('location: Main.php');
    exit();

  } else if(isset($_POST['edit'])){
    $_SESSION['listID'] = $_POST['edit'];
    if($_SESSION['list'] =='group'){
      header('location: groupedit');
      exit();
    } else {
      header('location: useredit');
      exit();
    }

  } else if(isset($_POST['add'])){
    if($_SESSION['list'] =='group'){
      header('location: groupentry');
      exit();
    } else {
      header('location: userentry');
      exit();
    }
  } else if(isset($_POST['delete'])){
    if($_SESSION['list'] == 'group'){
      $db->groupdelete($_POST['delete']);
    }
  }

  if(!empty($_SESSION['list'])){
    if($_SESSION['list'] == 'user'){
      $lists = $db->userall($_SESSION['userID']);
    } else if($_SESSION['list'] == 'group'){
      $lists = $db->groupall();
    }
  } else {
    header('location: Main');
    exit();
  }

?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Troper|<?php if($_SESSION['list'] == 'user'){echo 'ユーザ一覧';}else if($_SESSION['list'] == 'group'){ echo 'グループ一覧';}?></title>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="mainflex-container">
      <?php if($_SESSION['permission'] != '0'){
        $tool->leftcontent($_SESSION['name'],$_SESSION['selectcon']);
      } ?>
      <div id="right-content">
        <?php if($_SESSION['permission'] == 0){ ?>
        <div id="index-header"><h1><?php if($_SESSION['list'] == 'user'){echo 'ユーザ管理';}else if($_SESSION['list'] == 'group'){ echo 'グループ管理';}; ?></h1></div>
        <?php } ?>
        <div id="content-area">
          <div id="list-all-wrap">
            <div id="listflex-topcontainer">
              <div id = "usercnt">
                <p>■<?php if($_SESSION['list'] == 'user'){echo 'ユーザ数'; }else if($_SESSION['list'] == 'group'){ echo 'グループ数';}?>:<?php echo count($lists); ?></p>
              </div>
              <!--ユーザー使用時はここから消す-->
              <?php if($_SESSION['permission'] == 0){ ?>
              <div id = "entry">
                <form action="" method="POST">
                  <button type="submid" class="cbutton" name="action" value="return">管理画面へ戻る</button>
                  <button type="submit" class="bbutton" name="add" value="add"><?php if($_SESSION['list'] == 'user'){echo '新規ユーザ登録';}else if($_SESSION['list'] == 'group'){ echo '新規グループ作成';}?></button>
                </form>
              </div>
              <?php } ?>
              <!--ユーザー使用時はここまで消す-->
            </div> <!-- end userlistflex-topcontainer -->

            <div id="listflex-cencontainer">
              <?php if(empty($lists)){ ?>
                <p><?php if($_SESSION['list'] == 'user'){echo 'ユーザがいません';}else if($_SESSION['list'] == 'group'){ echo 'グループがありません';}?></p>
              <?php } else { // ユーザいる時 ?>
                <div class="userflex"><!--左-->
                  <?php $tool->listview($lists,'left',$_SESSION['list']); ?>
                </div><!--end userflex-left-->
                <div class="userflex"><!--真ん中-->
                  <?php $tool->listview($lists,'center',$_SESSION['list']); ?>
                </div><!--end userflex-center-->
                <div class="userflex"><!--右-->
                  <?php $tool->listview($lists,'right',$_SESSION['list']); ?>
                </div><!--end userflex-right-->
              <?php } //end グループある時 ?>
            </div> <!-- end userlistflex-cencontainer -->
          </div>
          <!--ユーザー使用時はここまで消す-->
        </div> <!--end content-area-->
      </div> <!--end right-content-->
    </div> <!-- end mainflex-container -->
  </body>
</html>
