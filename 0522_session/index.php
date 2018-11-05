<?php
//セッションを使うには必ず必要

session_start();

$_SESSION["keyname"] = "s水";

?>
<a href="member.php">メンバーページへ</a>
