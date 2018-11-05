<?php
require_once('tcpdf_min/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,"A3");

//メタ情報
$pdf->SetCreator("TCPDF");
$pdf->SetAuthor("著作者");
$pdf->SetTitle("タイトル");
$pdf->SetSubject("表題");
$pdf->SetKeywords("keyword1 keyword2");

//余白設定
$pdf->SetMargins(20,30,40);

//下の余白は別
$pdf->SetAutoPageBreak(true,20);

//ヘッダー非表示
//$pdf->SetPrintHeader(true);

//ヘッダーの余白
$pdf->setHeaderMargin(10);

//テンプレートヘッダーの設定
$pdf->setHeaderData("../img/kitty.png",30,"bbb","aaa",[0,255,0],[255,0,0]);

//テンプレートフッターの表示
$pdf->SetFooterMargin(20);

//フッター操作(色限定)
$pdf->SetFooterData([0,255,200],[0,255,255]);

//ページ追加
$pdf->AddPage();

//塗りつぶし色の設定
$pdf->SetFillColor(10,10,10,0);

//ページ番号取得
$pdf->Write(0,$pdf->PageNo());
$pdf->Write(0,"/".$pdf->GetAliasNbPages());


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

$pdf->Ln(12);

//矩形描画
$pdf->Cell(0,0,"XXX",1,1);
$pdf->Cell(0,0,"XXX","LR",1,"C",1);
$pdf->Cell(30,0,"XXX",1);
$pdf->Cell(30,0,"XXX",1,2);
$pdf->Cell(30,0,"XXX",1);

//矩形描画（改行可能)
$pdf->MultiCell(30,0,"mm\nm",1,"",0,1,100,100);
$pdf->Write(0,"aaa");

//線のスタイル
$pdf->SetLineStyle([
    "width"=>3,
    "cap"=>"butt",
    "join"=>"roud",
//    "dash"=>"20,4",
    "phase"=>"500",
    "color"=>[255,0,0],
]);

//線の太さのみ変更
$pdf->SetLineWidth(2);

//矩形描画
$pdf->Rect(130,130,20,30,"DF");

//多角形
$pdf->Polygon([200,200,210,210,200,210]);

//正多角形
$pdf->RegularPolygon(100,200,50,10,30,true);

//楕円
$pdf->Ellipse(100,300,50,20,25,90,270);

//線描画
$pdf->Line(100,100,130,130);

//現在の位置
$pdf->write(0,$pdf->GetX());
$pdf->Ln();
$pdf->Write(0,$pdf->GetY());
$pdf->Ln();

//カーソル位置の座標指定
$pdf->SetY(100);
$pdf->SetX(50);
$pdf->Write(0,"FFF");
$pdf->Ln();

//カーソル位置の座標指定
$pdf->SetXY(80,100);
$pdf->Write(0,"FFF");
$pdf->Ln();

for($i=0;$i<70;$i++){
  $pdf->Write(0,"fff");
  $pdf->Ln();
}

//出力
$pdf->Output('sample.pdf');
