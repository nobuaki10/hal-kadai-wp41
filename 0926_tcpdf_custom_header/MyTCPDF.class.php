<?php
require_once('tcpdf_min/tcpdf.php');

class MyTCPDF extends TCPDF{
  //ヘッダーオーバーライド
  public function Header(){
    $this->SetXY(270,5);
    $this->Write(0,"AAA");
    
  }
}
