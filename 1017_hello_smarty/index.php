<?php

require_once("libs/Smarty.class.php");

$smarty = new Smarty();

//引継ぎデータの設定
$smarty->assign("id",50000);
$smarty->assign("name","s水");
$smarty->assign("address",["tokyo","shinjuku"]);

//でバッキングコンソール表示
$smarty->debugging = false;

//テンプレート(描画メイン)に遷移
$smarty->display("index.tpl");
