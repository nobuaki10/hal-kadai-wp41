<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  if($_SESSION['permission'] == 0){
    header('location: Main_admin');
  }

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();
  $date = new DateTime('Asia/Tokyo');
  $error['todyThings']         = '';
  $error['tomorrowThings']     = '';
  $error['problem']            = '';
  $error['goodThings']         = '';

  if(isset($_POST['action'])){
    $tool->transition($_POST['action']);
  }

  if($_SESSION['selectcon'] == 'newreport'){
    if(isset($_POST['report'])){
      $_POST['todayThings'] = preg_replace('/^[ 　]+/u','', $_POST['todayThings']);
      $_POST['tomorrowThings'] = preg_replace('/^[ 　]+/u','', $_POST['tomorrowThings']);
      $_POST['problem'] = preg_replace('/^[ 　]+/u','', $_POST['problem']);
      $_POST['goodThings'] = preg_replace('/^[ 　]+/u','', $_POST['goodThings']);
      if(empty($_POST['todayThings'])){
        $error['todyThings']         = '今日やったことが入力されていません';
      } else if(empty($_POST['tomorrowThings'])){
        $error['tomorrowThings']     = '明日やることが入力されていません';
      } else if(empty($_POST['problem'])){
        $error['problem']            = '問題点が入力されていません';
      } else if(empty($_POST['goodThings'])){
        $error['goodThings']         = '今日のいいことが入力されていません
        ';
      } else {
        $dialy = array(
          ':userID'      => $_SESSION['userID'],
          ':timedate'    => $date->format('Y-m-d H:i:s'),
          ':today'       => $_POST['todayThings'],
          ':tommorow'    => $_POST['tomorrowThings'],
          ':problem'     => $_POST['problem'],
          ':good'        => $_POST['goodThings'],
          ':fatigue'     => $_POST['fatigue'],
          ':motivation'  => $_POST['motivation'],
        );
        $db->createreport($dialy);
        $tool->transition($_POST['action']);
        $SESSION['selectcon'] = 'content';
        header('location: Main.php');
      }
    }
  }else if($_SESSION['selectcon'] == 'editReport'){
    $currentdiary = $db->getreport($_SESSION['reportID']);
    if(isset($_POST['report'])){
      $_POST['todayThings'] = preg_replace('/^[ 　]+/u','', $_POST['todayThings']);
      $_POST['tomorrowThings'] = preg_replace('/^[ 　]+/u','', $_POST['tomorrowThings']);
      $_POST['problem'] = preg_replace('/^[ 　]+/u','', $_POST['problem']);
      $_POST['goodThings'] = preg_replace('/^[ 　]+/u','', $_POST['goodThings']);
      if(empty($_POST['todayThings'])){
        $error['todyThings']         = '今日やったことが入力されていません';
      } else if(empty($_POST['tomorrowThings'])){
        $error['tomorrowThings']     = '明日やることが入力されていません';
      } else if(empty($_POST['problem'])){
        $error['problem']            = '問題点が入力されていません';
      } else if(empty($_POST['goodThings'])){
        $error['goodThings']         = '今日のいいことが入力されていません';
      } else {
        $newdialy = array(
          ':reportID'    => $_SESSION['reportID'],
          ':today'       => $_POST['todayThings'],
          ':tommorow'    => $_POST['tomorrowThings'],
          ':problem'     => $_POST['problem'],
          ':good'        => $_POST['goodThings'],
          ':fatigue'     => $_POST['fatigue'],
          ':motivation'  => $_POST['motivation'],
        );

        $db->editreport($newdialy);
        $SESSION['selectcon'] = 'content';
        header('location: Main.php');
      }
    }
  } else {
    $_SESSION['selectcon'] = 'newreport';
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8"><!--CSS準備-->
    <?php if($_SESSION['selectcon'] == 'newreport'){ ?>
    <title>Troper|新規日報作成</title><!--ウィンドウタブ-->
  <?php } else if($_SESSION['selectcon'] == 'editReport'){ ?>
    <title>Troper|日報編集作成ページ</title><!--ウィンドウタブ-->
  <?php } ?>
    <link href="css/reset.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div id="mainflex-container">
      <?php $tool->leftcontent($_SESSION['name'],$_SESSION['selectcon']);?>
      <div id="right-content">
        <form id="createreport" name="createreport" action="" method="POST">
          <!--ここから新規日報作成-->
          <?php if($_SESSION['selectcon'] == 'newreport'){ ?>
            <div id="content-area">
              <div id="reportflex-topcontainer">
                <div id="dateflex">
                  <p><?php echo $date->format('m月 d日');?></p>
                </div>
                <div class="reportflex">
                  <p>今日やったこと :</p>
                  <textarea name="todayThings" cols="100" rows="5" value="<?php if(isset($_POST['todayThings'])){echo htmlspecialchars($_POST['todayThings'], ENT_QUOTES); } ?>" required></textarea>
                  <div class="error"><?php echo $error['todyThings']; ?></div>
                </div>
                <div class="reportflex">
                  <p>明日やること :</p>
                  <textarea name="tomorrowThings" cols="100" rows="5" value="<?php if(isset($_POST['tomorrowThings'])){echo htmlspecialchars($_POST['tomorrowThings'], ENT_QUOTES);} ?>" required></textarea>
                  <div class="error"><?php echo $error['tomorrowThings']; ?></div>
                </div>
                <div class="reportflex">
                  <p>問題点 :</p>
                  <textarea name="problem" cols="100" rows="5" value="<?php if(isset($_POST['problem'])){echo htmlspecialchars($_POST['problem'], ENT_QUOTES);} ?>" required></textarea>
                  <div class="error"><p><?php echo $error['problem']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>今日のいいこと :</p>
                  <textarea name="goodThings" cols="100" rows="5" value="<?php if(isset($_POST['goodThings'])){echo htmlspecialchars($_POST['goodThings'], ENT_QUOTES);} ?>" required></textarea>
                  <div class="error"><p><?php echo $error['goodThings']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>コンディション</p>
                  <label><input class="report-radio" type="radio" name="fatigue" value="5"><img class="report-radio-img" src="./image/state_5.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="4"><img class="report-radio-img" src="./image/state_4.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="3"><img class="report-radio-img" src="./image/state_3.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="2"><img class="report-radio-img" src="./image/state_2.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="1"><img class="report-radio-img" src="./image/state_1.png"></label>
                </div>
                <div class="reportflex">
                  <p>モチベーション</p>
                  <label><input class="report-radio" type="radio" name="motivation" value="5"><img class="report-radio-img" src="./image/state_5.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="4"><img class="report-radio-img" src="./image/state_4.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="3"><img class="report-radio-img" src="./image/state_3.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="2"><img class="report-radio-img" src="./image/state_2.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="1"><img class="report-radio-img" src="./image/state_1.png"></label>
                </div>
                <div id="rbuttonflex">
                  <button type="submit" name="report" value="create" class="rbutton">完了</button>
                </div>
              </div><!-- reportflex-topcontainer end -->
            </div> <!-- report-wrap end -->
        <?php }
        //ここまで新規日報作成

        //ここから日報編集
        else if($_SESSION['selectcon'] == 'editReport'){?>
            <div id="content-area">
              <div id="reportflex-topcontainer">
                <div id="dateflex">
                  <p>日付 :<?php echo $date->format('Y年 m月 d日 H:i');?></p>
                </div>
                <div class="reportflex">
                  <p>今日やったこと :</p>
                  <textarea name="todayThings" cols="100" rows="5" required><?php echo preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "", $currentdiary[0]['today']);?></textarea>
                  <div class="error"><p><?php echo $error['todyThings']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>明日やること :</p>
                  <textarea name="tomorrowThings" cols="100" rows="5" required><?php echo preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "", $currentdiary[0]['tommorow']);?></textarea>
                  <div class="error"><p><?php echo $error['tomorrowThings']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>問題点 :</p>
                  <textarea name="problem" cols="100" rows="5" required><?php echo preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "", $currentdiary[0]['problem']);?></textarea>
                  <div class="error"><p><?php echo $error['problem']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>今日のいいこと :</p>
                  <textarea name="goodThings" cols="100" rows="5" required><?php echo preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "", $currentdiary[0]['good']);?></textarea>
                  <div class="error"><p><?php echo $error['goodThings']; ?></p></div>
                </div>
                <div class="reportflex">
                  <p>疲労度</p>
                  <label><input class="report-radio" type="radio" name="fatigue" value="5" <?php if($currentdiary[0]['fatigue'] == 5){?>checked<?php }?>><img class="report-radio-img" src="./image/state_5.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="4" <?php if($currentdiary[0]['fatigue'] == 4){?>checked<?php }?>><img class="report-radio-img" src="./image/state_4.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="3" <?php if($currentdiary[0]['fatigue'] == 3){?>checked<?php }?>><img class="report-radio-img" src="./image/state_3.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="2" <?php if($currentdiary[0]['fatigue'] == 2){?>checked<?php }?>><img class="report-radio-img" src="./image/state_2.png"></label>
                  <label><input class="report-radio" type="radio" name="fatigue" value="1" <?php if($currentdiary[0]['fatigue'] == 1){?>checked<?php }?>><img class="report-radio-img" src="./image/state_1.png"></label>
                </div>
                <div class="reportflex">
                  <p>モチベーション</p>
                  <label><input class="report-radio" type="radio" name="motivation" value="5" <?php if($currentdiary[0]['motivation'] == 5){?>checked<?php }?>><img class="report-radio-img" src="./image/state_5.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="4" <?php if($currentdiary[0]['motivation'] == 4){?>checked<?php }?>><img class="report-radio-img" src="./image/state_4.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="3" <?php if($currentdiary[0]['motivation'] == 3){?>checked<?php }?>><img class="report-radio-img" src="./image/state_3.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="2" <?php if($currentdiary[0]['motivation'] == 2){?>checked<?php }?>><img class="report-radio-img" src="./image/state_2.png"></label>
                  <label><input class="report-radio" type="radio" name="motivation" value="1" <?php if($currentdiary[0]['motivation'] == 1){?>checked<?php }?>><img class="report-radio-img" src="./image/state_1.png"></label>
                </div>
                <div id="rbuttonflex">
                  <button type="submit" name="report" value="edit" class="rbutton">完了</button>
                </div>
              </div><!-- reportflex-topcontainer end -->
            </div> <!-- report-wrap end -->
        <?php } ?>
        <!--ここまで日報編集-->
        </form>
      </div>
    </div>
    <!-- ここからモーダルウィンドウ -->
  </body>
</html>
