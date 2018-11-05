<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

//引継ぎデータの設定
$smarty->assign("id",50000);
$smarty->assign("name","<h1>s水\r\nbbb</h1>");
$smarty->assign("address",["tokyo","shinjuku"]);

//定数定義
define('MAX_COUNT',100);

$_GET["id"] = "13";

session_start();
$_SESSION["name"] = "あいう";

$smarty->assign("l","abC");
$smarty->assign("u","ABc");

//でバッキングコンソール表示
$smarty->debugging = false;

//テンプレート(描画メイン)に遷移
$smarty->display("index.tpl");
