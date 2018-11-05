<?php
  $text = "";
  if(isset($_GET['error'])){
    switch($_GET['error']){
      case 0:
        $text="正常に削除されました";
        break;
      case 1:
        $text="存在しないIDです";
        break;
    }
  }
?>
<!doctype html>
<html>
  <head>
    <title>削除ページ</title>
  </head>
  <body>
    <h1>削除</h1>
    <form method="post" action="remove_db.php">
      <label>ID:</label>
      <input type="text" name="id" value="<?php echo $_GET["id"] ?>"/></br>
      <input type="hidden" name="num" value="1"/></br>
      <input type="submit" name="add" value="削除"/>
      <a href="view2.php">戻る</a>
      <a><?php echo $text; ?></a>
    </form>
  </body>
</html>
