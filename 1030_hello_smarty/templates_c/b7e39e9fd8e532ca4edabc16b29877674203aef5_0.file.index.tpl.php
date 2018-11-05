<?php
/* Smarty version 3.1.33, created on 2018-10-30 18:22:43
  from 'C:\xampp7\htdocs\1030_hello_smarty\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5bd822e3406643_64324117',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7e39e9fd8e532ca4edabc16b29877674203aef5' => 
    array (
      0 => 'C:\\xampp7\\htdocs\\1030_hello_smarty\\templates\\index.tpl',
      1 => 1540891150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
  ),
),false)) {
function content_5bd822e3406643_64324117 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\xampp7\\htdocs\\1030_hello_smarty\\libs\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),1=>array('file'=>'C:\\xampp7\\htdocs\\1030_hello_smarty\\libs\\plugins\\modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),2=>array('file'=>'C:\\xampp7\\htdocs\\1030_hello_smarty\\libs\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<!doctype html><?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('aaa'=>'bbb'), 0, false);
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, '..\..\..\config\1030_smarty.conf', 'DB', 0);
echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'siteName');?>
</br><?php echo $_smarty_tpl->smarty->ext->configload->_getConfigVariable($_smarty_tpl, 'id');?>
</br><p><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
</p><p><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true));?>
</p><p><?php echo smarty_modifier_date_format(time(),'%Y/%m/%d %H:%M:%S');?>
</p><p>最大数は<?php echo @constant('MAX_COUNT');?>
です。</p><p><?php echo $_GET['id'];?>
</p><p><?php echo $_SESSION['name'];?>
</p><p><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['l']->value, 'UTF-8');?>
</p><p><?php echo mb_strtolower($_smarty_tpl->tpl_vars['l']->value, 'UTF-8');?>
</p><p><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['u']->value, 'UTF-8');?>
</p><p><?php echo mb_strtolower($_smarty_tpl->tpl_vars['u']->value, 'UTF-8');?>
</p><p><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['l']->value);?>
</p><p><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['u']->value);?>
</p><p><?php echo (($tmp = @$_GET['age'])===null||$tmp==='' ? '未入力' : $tmp);?>
</p><p><?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['u']->value,'B','ddd');?>
</p><p><?php echo sprintf('%09d',$_smarty_tpl->tpl_vars['id']->value);?>
</p>  </body></html>
<?php }
}
