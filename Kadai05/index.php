<?php
$express = "";
$carstr = "";
$color = "white";
if(isset($_POST["express"]) && isset($_POST["carstr"])){
  $express = $_POST["express"];
  $carstr = $_POST["carstr"];
  if(preg_match($_POST["express"],$_POST["carstr"])){
  } else {
    $color = "red";
  }
}
?>
<!doctype html>
<html>
  <head>
  </head>
  <body style="background-color:<?php echo $color; ?>;">
    <form method="POST" action="">
      <label>正規表現:</label>
      <input type="text" name="express" value="<?php echo $express; ?>"/></br>
      <label>検証文字列:</label>
      <input type="text" name="carstr" value="<?php echo $carstr;?>"></br>
      <input type="submit" name="login" value="検証"></br>
    </form>
  </body>
</html>
