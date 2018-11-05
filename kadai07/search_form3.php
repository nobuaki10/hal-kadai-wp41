<?php
function search3(){
  $dsn = "mysql:host=localhost;dbname=wp41;charset=utf8";

  $db_user="root";
  $db_password="";
  if(isset($_POST["name"])){
    try{
      $pdo = new PDO($dsn,$db_user,$db_password);

      $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

      $sql = "SELECT * FROM kadai07_products WHERE name LIKE :name";

      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(":name","%".$_POST["name"]."%");
      $stmt->execute();

      echo "<table><tr><td>商品名</td><td>単価</td><td>画像</td><tr>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>".$row["image"]."</td>";
        echo "</tr>";
      }
      echo "</table>";
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
}
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>search3</title>
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
    <h1>search3</h1>
    <form method="post" action="search_form3.php">
      <label>商品名:</label>
      <input type="text" name="name"/></br>

      <input type="submit" name="add" value="search"/>
      <a href="index.html">back</a>
    </form>
    <hr width="100%" height="10px">
    <?= search3(); ?>
  </body>
</html>
