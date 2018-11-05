<?php
  $text = "";
  if(isset($_GET['error'])){
    switch($_GET['error']){
      case 0:
        $text="正常に登録されました";
        break;
      case 1:
        $text="既に存在するIDです";
        break;
    }
  }
?>
<!doctype html>
<html>
  <head>
    <title>登録ページ</title>
  </head>
  <body>
    <h1>登録</h1>
    <form method="post" action="add_db.php">
      <label>ID:</label>
      <input type="text" name="id"/></br>

      <label>商品名:</label>
      <input type="text" name="name"/></br>

      <label>単価:</label>
      <input type="text" name="price"/></br>

      <label>画像:</label>
      <input type="text" name="image"/></br>

      <input type="submit" name="add" value="登録"/>
      <a href="index.html">戻る</a>
      <a><?php echo $text; ?></a>
    </form>
  </body>
</html>
