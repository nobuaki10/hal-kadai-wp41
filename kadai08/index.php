<?php
  $text = "";
  if(isset($_GET['error'])){
    switch($_GET['error']){
      case 0:
        $text="正常に処理されました";
        break;
      case 1:
        $text="データベースに接続できませんでした";
        break;
      case 2:
        $text="登録できませんでした";
        break;
      case 3:
        $text="削除できませんでした";
        break;
      case 4:
        $text="更新できませんでした";
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
    <h1>課題08</h1>
    <a href="productsController.php?id=111&name=aaa&state=add">追加</a><br>
    <a href="productsController.php?id=111&state=remove">削除</a><br>
    <a href="productsController.php?id=111&name=bbb&state=update">更新</a><br>
    <?php echo $text; ?>
  </body>
</html>
