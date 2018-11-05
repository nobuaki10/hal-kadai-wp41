<?php
  header("Cache-Control: private");
  session_cache_limiter('none');
  session_start();
  require_once ('tools/tool.php');
  require_once ('DBaccess/dbdao.php');

  $tool = new tool($_SESSION['userID']);
  $db = new DAO();

  if($_SESSION['permission'] == 0){
    header('location: Main_admin');
    exit();
  }

  if(isset($_POST['action'])){
    $tool->transition($_POST['action']);
  }
  if($_SESSION['selectcon'] == 'userlist' && !empty($_SESSION['listID'])){
    $contents = $db->content($_SESSION['listID'],$_SESSION['selectcon']);
  } else if($_SESSION['selectcon'] == 'grouplist' && !empty($_SESSION['listID'])){
    $contents = $db->content($_SESSION['listID'],$_SESSION['selectcon']);
  } else if($_SESSION['selectcon'] == 'allcontent'){
    $contents = $db->content($_SESSION['userID'],$_SESSION['selectcon']);
  } else {
    $_SESSION['selectcon'] = 'content';
    $contents = $db->content($_SESSION['userID'],$_SESSION['selectcon']);
  }
  if(isset($_POST['editReport'])){
    $_SESSION['selectcon'] = 'editReport';
    $_SESSION['reportID'] = $_POST['editReport'];
    header('location: Report');
  }

  if(isset($_POST['deleteReport'])){
    $db->deletereport($_POST['deleteReport']);
    header("Location: " . $_SERVER['PHP_SELF']);
  }

  if(isset($_POST['updown'])){
    if($_POST['updown'] == 'up'){
      $_SESSION['count'] += 100;
      $count = $_SESSION['count'] - 100;
    } else if($_POST['updown'] == 'down'){
      $_SESSION['count'] -= 100;
      $count = $_SESSION['count'] - 100;
    }
  } else {
    $count = $_SESSION['count'] - 100;
  }

  if(isset($_POST['transmission'])){
    if(!empty($_POST['comment'])){
      $date = new DateTime('Asia/Tokyo');
      $comment = array(
        ':timedata'=>$date->format('Y-m-d H:i:s'),
        ':comment'=>$_POST['comment'],
        ':userID'=>$_SESSION['userID'],
        ':reportID'=>$_POST['transmission'],
      );
      $db->commentcreate($comment);
    }
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <link href="./css/reset.css" rel="stylesheet" type="text/css">
    <link href="./css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/snowfall.jquery.js"></script>
    <title>Troper</title>
    <?php $tool->season(); ?>
  </head>
  <body>
    <div id="mainflex-container">
      <?php $tool->leftcontent($_SESSION['name'],$_SESSION['selectcon']);?>
      <div id="right-content">
        <div id="content-area">
          <form action="" method="POST">
            <?php if($_SESSION['count'] != 100){ ?>
            <div id="up"><button type="submit" name="updown" value="down" id="updownbutton">１００件前</button></div>
          <?php } if($_SESSION['count'] < count($contents)){?>
            <div id="down"><button type="submit" name="updown" value="up" id="updownbutton"></button></div>
          <?php } ?>
          </form>
  <?php if(!empty($contents)){
          for($number = $count;$number <= $_SESSION['count'];$number++){;
            if(empty($contents[$number])){
                break;
            };
            $content = $contents[$number];?>
            <div class="flex-wrap-content">
              <div class="contime"><pre><?php echo date('m月d日 H:i',strtotime($content['timedate']))?></pre></div>
              <div class="contributor"><pre><?php echo htmlspecialchars($content['username'], ENT_QUOTES) ?></pre></div>
              <div>
                <div class="comment-title">■今日やった事</div>
                <div class="comment"><pre><?php echo htmlspecialchars($content['today'], ENT_QUOTES)?><pre></div>
              </div>
              <div>
                <div class="comment-title">■明日やる事</div>
                <div class="comment"><pre><?php echo htmlspecialchars($content['tommorow'], ENT_QUOTES)?></pre></div>
              </div>
              <div>
                <div class="comment-title">■問題点</div>
                <div class="comment"><pre><?php echo htmlspecialchars($content['problem'], ENT_QUOTES)?></pre></div>
              </div>
              <div>
                <div class="comment-title">■今日のよかった事</div>
                <div class="comment"><pre><?php echo htmlspecialchars($content['good'], ENT_QUOTES)?></pre></div>
              </div>
              <div class="comment-num-wrap">
                <div class="comment-grow">
                  <div class="comment-title">■コンディション</div>
                  <div class="comment-parameter">
                    <img class="report-radio-img" src=
                    <?php if($content['fatigue']==5){ ?>
                      "./image/state_5.png" <?php }
                      else if($content['fatigue']==4){ ?>
                      "./image/state_4.png" <?php }
                      else if($content['fatigue']==3){ ?>
                      "./image/state_3.png" <?php }
                      else if($content['fatigue']==2){ ?>
                      "./image/state_2.png" <?php }
                      else if($content['fatigue']==1){ ?>
                      "./image/state_1.png" <?php }
                    ?> >
                  </div>
                </div>
                <div class="comment-grow">
                  <div class="comment-title">■モチベーション</div>
                  <div class="comment-parameter">
                    <img class="report-radio-img" src=
                    <?php if($content['motivation']==5){ ?>
                      "./image/state_5.png" <?php }
                    else if($content['motivation']==4){ ?>
                      "./image/state_4.png" <?php }
                    else if($content['motivation']==3){ ?>
                      "./image/state_3.png" <?php }
                    else if($content['motivation']==2){ ?>
                      "./image/state_2.png" <?php }
                    else if($content['motivation']==1){ ?>
                      "./image/state_1.png" <?php }
                     ?> >
                  </div>
                </div>
              </div>
              <div>
                <form action="" method="POST">
                    <div class="editReport">
                      <button type="button" onclick="writeElement(<?php echo $number; ?>);">
                        <img style="width:30px;height:30px" src="./image/comment.png" onmouseover="this.src='./image/comment_onmouse.png'" onmouseout="this.src='./image/comment.png'" title ="コメント表示">
                      </button>
                      <?php if($_SESSION['name'] == $content['username'] && $_SESSION['selectcon'] == 'content'){?>
                      <button type="submit" name="editReport" value='<?php echo $content['reportID']; ?>'>
                        <img style="width:30px;height:30px" src="./image/edit.png" onmouseover="this.src='./image/edit_hover.png'" onmouseout="this.src='./image/edit.png'" title="編集">
                      </button>
                      <button type="submit" name="deleteReport" value='<?php echo $content['reportID']; ?>'>
                        <img style="width:30px;height:30px" src="./image/trash.png" onmouseover="this.src='./image/trash_hover.png'" onmouseout="this.src='./image/trash.png'" title="削除">
                      </button>
                      <?php }?>
                    </div>
                </form>
                <!-- コメント表示 -->
                <div id="<?php echo 'write',$number; ?>" class="write">
                  <p>コメント</p>
                  <div class="modalflex-container">
                    <div id="<?php echo 'view',$number; ?>" class="view">
                    <?php if($response = $db->commentcheck($content['reportID'])){
                      foreach($response as $res){
                        if($res['reportID'] == $content['reportID']){?>
                        <pre><?php
                          echo htmlspecialchars($res['username']);
                          echo '(',htmlspecialchars(date('m月d日 H:i',strtotime($res['timedata']))),')';?>
                        </pre>
                        <pre><?php echo htmlspecialchars($res['comment'], ENT_QUOTES);?></pre>
                        <hr>
                    <?php }}} else{ echo 'コメントがありません';} ?>

                    </div>
                    <form aciton="" method ="POST">
                      <textarea name="comment" cols="100" rows="3"></textarea>
                      <button name="transmission"　class="lbutton" onclick="sendElement();" value="<?php echo $content['reportID'];?>">
                        <img style="width:30px;height:30px;" src="./image/submit_send.png" onmouseover="this.src='./image/submit_send_onmouse.png'" onmouseout="this.src='./image/submit_send.png'" title="送信">
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

    <?php }}else{ ?>
            <div id="nonereport"><a>まだ日報がありません。</a></div>
    <?php }?>
        </div>
      </div>
    </div>
  </body>


</html>
