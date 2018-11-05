<?php
require_once('tcpdf_min/tcpdf.php');

class CustomTCPDF extends TCPDF{
    public function Footer(){
        $this->Cell(0,0,$this->PageNo().'/'.$this->getAliasNbPages(),"T",0,"R");
    }
}