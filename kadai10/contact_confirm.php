<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

$smarty->assign("name",$_POST["name"]);
$smarty->assign("mail",$_POST["mail"]);

if(isset($_POST["subject"])){
  $smarty->assign("subject",$_POST["subject"]);
} else {
  $smarty->assign("subject","件名なし");
}

$smarty->assign("content",$_POST["content"]);

$smarty->display("contact_confirm.tpl");
