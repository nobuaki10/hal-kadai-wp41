<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

$smarty->assign("name",((isset($_GET["name"])) ? $_GET["name"]:""));
$smarty->assign("mail",((isset($_GET["mail"])) ? $_GET["mail"]:""));
$smarty->assign("subject",((isset($_GET["subject"])) ? $_GET["subject"]:""));
$smarty->assign("content",((isset($_GET["content"])) ? $_GET["content"]:""));

$smarty->display("contact.tpl");
