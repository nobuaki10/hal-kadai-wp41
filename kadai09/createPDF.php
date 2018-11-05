<?php
require_once('CustomTCPDF.class.php');
$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,"A4");

//余白設定
$pdf->SetMargins(20,20,20);
$pdf->SetAutoPageBreak(true,30);

//ヘッダー非表示
$pdf->SetPrintHeader(false);

//フッターの表示
$pdf->SetFooterMargin(20);

$pdf->AddPage();

//TTFフォントの追加
$font = new TCPDF_FONTS();
$fontYugothic = $font->addTTFfont('C:\xampp7\htdocs\kadai09\tcpdf_min\fonts\komorebi-gothic.ttf');
$pdf->SetFont($fontYugothic);

//ロゴ、日付
$pdf->SetXY(160,15);
$pdf->Write(0,"2018/10/02");
$pdf->Image('img/hal.png',160,20,25,null);
$pdf->Ln();

//宛先

$pdf->SetFontSize(12);
$pdf->Write(0,"〒".$_POST["postnum"],null,0,null,true);
$pdf->Write(0,$_POST["address"],null,0,null,true);
$pdf->SetFontSize(25);
$pdf->Write(0,$_POST["name"]);
$pdf->SetFontSize(12);
$pdf->Write(15," 様",null,0,null,true);

//差出人情報
$pdf->MultiCell(0,0,"〒160-0023\n東京都新宿区西新宿1-7-3\nTEL:03-3344-xxxx\nFAX:03-33440xxxx",0,"",0,1,130,50);

//金額表示
$total = 0;
foreach($_POST["input"] as $num){
    if($num["price"] != null){
      $total += ($num["price"] * $num["quantity"]) * 1.08;
    }
}
$pdf->Write(20,"下記の通り、徴収いたしました。",null,0,null,true);
$pdf->Cell(70,0,"合計金額","B",0,"L",0);
$total = number_format($total);
$pdf->Cell(0,0,$total."  円","B",1,"L",0);
$pdf->Ln(5);

//明細
$pdf->SetTextColor(255,255,255);
$pdf->Cell(90,10,"内容",1,0,"C",1);
$pdf->Cell(20,10,"単価",1,0,"C",1);
$pdf->Cell(20,10,"数量",1,0,"C",1);
$pdf->Cell(30,10,"金額",1,1,"C",1);
$pdf->SetTextColor(0,0,0);
$subtotal = 0;
foreach($_POST["input"] as $array){
    if($array["name"] == null){
        break;
    }
    $pdf->Cell(90,10,$array["name"],1,0,"L",0);
    $pdf->Cell(20,10,number_format($array["price"]),1,0,"R",0);
    $pdf->Cell(20,10,number_format($array["quantity"]),1,0,"R",0);
    $price = $array["price"] * $array["quantity"];
    $pdf->Cell(30,10,number_format($price),1,1,"R",0);
    $subtotal += $price;
}

$pdf->SetTextColor(255,255,255);
//$pdf->SetXY(100,215);
$pdf->Ln(5);
$pdf->MultiCell(30,10,"小計",1,"C",1,0,100,null,false,0,false,false,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(50,10,number_format($subtotal),1,"R",0,1,null,null,false,0,false,false,0);

$pdf->SetTextColor(255,255,255);
$pdf->MultiCell(30,10,"消費税",1,"C",1,0,100,null,false,0,false,false,0);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(50,10,number_format($subtotal * 0.08),1,"R",0,1,null,null,false,0,false,false,0);
$pdf->Ln(5);
$pdf->Cell(0,25,"備考",1,0,"LC",0);

$pdf->Output('sample.pdf');
