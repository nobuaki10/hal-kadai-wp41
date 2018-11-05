<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

$smarty->assign("name",$_POST["name"]);
$smarty->assign("mail",$_POST["mail"]);

$smarty->assign("subject",((!empty($_POST["subject"])) ? $_POST["subject"]:"件名なし"));

$smarty->assign("content",$_POST["content"]);

$smarty->display("contact_confirm.tpl");
