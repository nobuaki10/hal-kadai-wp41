<?php
/* Smarty version 3.1.33, created on 2018-11-01 10:09:29
  from 'C:\xampp7\htdocs\kadai10\templates\contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bda5249d342b7_27913352',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a982de1bf264b415e00a86d32889d5f5775c6962' => 
    array (
      0 => 'C:\\xampp7\\htdocs\\kadai10\\templates\\contact.tpl',
      1 => 1540953959,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bda5249d342b7_27913352 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="ja">
  <head>お問い合わせ</head>
  <body>
    <form method="post" action="">
      <label>お名前＊</label>
      <input type="text" name="name"/>

      <label>ご連絡先(メールアドレス)</label>
      <input type="text" name="mail"/>

      <label>お問合せ件名</label>
      <input type="text" name="subject"/>

      <label>お問い合わせ内容＊</label>
      <input type="text" size=20 name="content"/>

    </form>
  </body>
</html>
<?php }
}
