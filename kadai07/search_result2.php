<?php

function search2(){
  $dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

  $db_user="root";
  $db_password="";
  $message_code = "";
  try{
    $pdo = new PDO($dsn,$db_user,$db_password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    $sql = "SELECT * FROM kadai07_products WHERE name LIKE :name";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":name","%".$_POST["name"]."%");
    $stmt->execute();
    if($stmt->rowCount() <= 0){
      $message_code = "<a>検索結果が存在しませんでした</a>";
    }
    if($message_code == ""){
      echo "<table><tr><td>商品名</td><td>単価</td><td>画像</td><tr>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["image"]."</td>";
        echo "</tr>";
      }
      echo "</table>";
    } else{
      echo $message_code;
    }


  }catch(Exception $e){
    mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
    $pdo=null;
    $stmt=null;
    exit;
  }finally{
    $pdo=null;
    $stmt=null;
  }
}
?>
<!doctype html>
<html>
  <head>
    <title>検索結果ページ</title>
    <style>
      table {
      	border-collapse: collapse;
      }
      td {
      	border: solid 1px;
      	padding: 0.5em;
        width:10em;
      }
    </style>
  </head>
  <body>
    <h1>検索結果</h1>
    <?php search2(); ?>
    <a href="search_form2.html">戻る</a></br>
  </body>
</html>
