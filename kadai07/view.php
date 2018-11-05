<?php
function viewarea(){
  $dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

  $db_user="root";
  $db_password="";

  try{
    $pdo = new PDO($dsn,$db_user,$db_password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    $sql = "SELECT * FROM kadai07_products";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      echo "<tr>";
      echo "<td>".$row["name"]."</td>";
      echo "<td>".$row["price"]."</td>";
      echo "<td><img src='".$row["image"]."' width='50px height='50px'></td>";
      echo "</tr>";
    }

  }catch(Exception $e){
    mb_convert_encoding($e->getMessage(),"UTF-8","SJIS");
    $pdo=null;
    $stmt=null;
    $error=1;
    exit;
  }finally{
    $pdo=null;
    $stmt=null;
    $error=0;
  }
}
?>

<!doctype html>
<html>
  <head>
    <title>一覧</title>
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
    <h1>一覧</h1>
    <table>
      <tr>
        <td>商品名</td>
        <td>単価</td>
        <td>画像</td>
        <?php viewarea(); ?>
      </tr>
    </table>

    <a href="index.html">戻る</a>
</html>
