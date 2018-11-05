<?php
  $text = "";
  if(isset($_GET['error'])){
    switch($_GET['error']){
      case 0:
        $text="正常に更新されました";
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
    <title>更新ページ</title>
  </head>
  <body>
    <h1>更新</h1>
    <form method="post" action="edit_db.php">
      <label>ID:</label>
      <input type="text" name="id" value="<?= $_GET["id"] ?>"/></br>

      <label>商品名:</label>
      <input type="text" name="name" value="<?= $_GET["name"] ?>"/></br>

      <label>単価:</label>
      <input type="text" name="price" value="<?= $_GET["price"] ?>"/></br>

      <label>画像:</label>
      <input type="text" name="image" value="<?= $_GET["image"] ?>"/></br>

      <input type="hidden" name="num" value="1"/>
      <input type="submit" name="add" value="更新"/>
      <a href="view.php">戻る</a>
      <a><?php echo $text; ?></a>
    </form>
  </body>
</html>
