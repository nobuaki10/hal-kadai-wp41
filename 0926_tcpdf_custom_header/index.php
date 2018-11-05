<?php
require_once('MyTCPDF.class.php');
$pdf = new MyTCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,"A3");

//ページ追加
$pdf->AddPage();

//HTMLによるPDF出力
$css=<<<EOS
<style>
  h1{color:red}
  table{border:1px solid black;}
  td{border:1px solid black;}
 .xxx{color:blue;}
</style>
EOS;

$html=<<<EOS

<h1>aaa</h1>
<p class="xxx">aaa</p>
<table>
  <tr><td>内容</td><td>単価</td><td>数量</td><td>金額</td></tr>
  <tr><th>a</th><th>b</th><th>c</th></tr>
</table>

<ul>
  <li>a</li>
  <li>a</li>
  <li>a</li>
<ul>
EOS;

$pdf->writeHTML($css.$html);

//出力
$pdf->Output('sample.pdf');
