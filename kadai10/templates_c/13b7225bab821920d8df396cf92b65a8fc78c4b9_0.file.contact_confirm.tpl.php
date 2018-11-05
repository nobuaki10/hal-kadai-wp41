<?php
/* Smarty version 3.1.33, created on 2018-11-01 06:48:09
  from 'C:\xampp\htdocs\kadai10\templates\contact_confirm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bda9399ce45a0_17752607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13b7225bab821920d8df396cf92b65a8fc78c4b9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\kadai10\\templates\\contact_confirm.tpl',
      1 => 1541051237,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5bda9399ce45a0_17752607 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html lang="ja">
  <head>
    <title>お問い合わせ</title>
    <style type="text/css">
      .max{
        margin:0 20px;
      }
      .center{
        text-align:center;
      }
      #submitbtn{
        margin:10px;
        padding:5px 10px;
      }
    </style>
  </head>
  <body>
    <p>以下の内容でよろしいですか？</p>
    <form method="post" action="">
      <h2>お名前</h2>
      <p class="max"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true));?>
</p>

      <h2>ご連絡先(メールアドレス)</h2>
      <p class="max"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['mail']->value, ENT_QUOTES, 'UTF-8', true));?>
</p>

      <h2>お問合せ件名</h2>
      <p class="max"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['subject']->value, ENT_QUOTES, 'UTF-8', true));?>
</p>

      <h2>お問い合わせ内容＊</h2>
      <p class="max"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['content']->value, ENT_QUOTES, 'UTF-8', true));?>
</p>

      <div>
        <input id="submitbtn" type="submit" name="back" value="戻る"/>
        <input id="submitbtn" type="submit" name="next" value="送信"/>
      </div>
    </form>
  </body>
</html>
<?php }
}
