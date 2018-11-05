<?php
  $error_message = "";
  if(isset($_GET["error_no"])){
    switch($_GET{"error_no"}){
      case 1:
      $error_message ="<p style='color:red'>不正なアクセスです。</p>";
      break;
    }
  }
?>
<!doctype html>
<html lang ="ja">
  <head>
    <title></title>
    <meta charset="utf-8">
  </head>
  <body>
    <h1>正規表現チェック</h1>
    <?php echo $error_message; ?>
    <form method="post" action="view.php">

      <input type="checkbox" name ="c[]" value="c1">aaaa</input>

      <input type="submit" value="check!">
    </form>
  </body>
</html>
