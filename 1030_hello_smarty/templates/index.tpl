{strip}
<!doctype html>
    {include file="header.tpl" aaa=bbb}
    {config_load file='..\..\..\config\1030_smarty.conf' section=DB}
    {$smarty.config.siteName}</br>
    {$smarty.config.id}</br>

    <p>{$id}</p>
    <p>{$name|escape|nl2br}</p>
    <p>{$smarty.now|date_format:'%Y/%m/%d %H:%M:%S'}</p>
    <p>最大数は{$smarty.const.MAX_COUNT}です。</p>
    <p>{$smarty.get.id}</p>

    <p>{$smarty.session.name}</p>
    <p>{$l|upper}</p>
    <p>{$l|lower}</p>
    <p>{$u|upper}</p>
    <p>{$u|lower}</p>
    <p>{$l|capitalize}</p>
    <p>{$u|capitalize}</p>
    <p>{$smarty.get.age|default:'未入力'}</p>
    <p>{$u|replace:'B':'ddd'}</p>
    <p>{$id|string_format:'%09d'}</p>



    {* ここはコメント<p>{$address}</p> *}
  </body>
</html>
{/strip}
