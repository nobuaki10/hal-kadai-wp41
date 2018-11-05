<?php
  $error_message = "";
  if(isset($_GET["error_no"])){
    switch($_GET{"error_no"}){
      case 1:
      $error_message ="<p style='color:red'>不正なアクセスです</p>";
      break;

      case 4:
      $error_message="<p style='color:red'>IDまたはPASSWORDが違います。</p>";
      break;
    }
  }
?>
<!doctype html>
<html>
  <head>
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>ログイン</h1>
    <form method="POST" action="auth.php">
      <input type="text" name="id"/>
      <input type="text" name="pass"/>
      <input type="hidden" name="k" value="k"/>
      <input type="submit" value="ログイン"></br>
    </form>
    <?php echo $error_message; ?>
  </body>
</html>
