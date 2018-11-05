<?php
$count = 0;

//cookieの存在確認
if(isset($_COOKIE["count"])){
  $count = $_COOKIE["count"];
}

$count++;

//cookie保存
setcookie("count",$count,time()+5);

echo "${count}回目";
?>
<input type="id" value="<?php $count ?>"/>
