<?php
require_once('tcpdf_min/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,"A3");

//メタ情報
$pdf->SetCreator("TCPDF");
$pdf->SetAuthor("著作者");
$pdf->SetTitle("タイトル");
$pdf->SetSubject("表題");
$pdf->SetKeywords("keyword1 keyword2");

//ページ追加
$pdf->AddPage();

//塗りつぶし色の設定
$pdf->SetFillColor(10,10,10,0);

//文字追加
$pdf->Write(0,"aaa bbb ccc", "http://www.google.co.jp",1,"R",true,4);
$pdf->Write(0,"aaa bbb ccc dddddddddddddd eeeeeeeeeeeee fffffffffffffff ggggggggggggggg hhhhhhhhhhh iiiiiiiiiiii wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww", null,1,null,true,0,true);

//改行
$pdf->Ln();
$pdf->Write(0,"a");
$pdf->Ln(20,true);
$pdf->Write(0,"a");

//文字色変更
$pdf->SetTextColor(100,0,0,0);
$pdf->Write(0,"a");

//フォント変更
$pdf->SetFontSize(12);
$pdf->SetFont("times","D");
$pdf->Write(0,"abcde");

//TTFフォントの追加
$font = new TCPDF_FONTS();
$fontYugothic = $font->addTTFfont('C:\xampp7\htdocs\kadai09\tcpdf_min\fonts\komorebi-gothic.ttf');
$pdf->SetFont($fontYugothic);
$pdf->Write(0,"あいう");

//画像埋め込み
$pdf->Image('img/kitty.png',20,10,20,null);

//出力
$pdf->Output('sample.pdf');
