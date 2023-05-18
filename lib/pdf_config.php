<?php
require '../vendor/autoload.php';
class BunkoDEX_PDF extends FPDF {
    function Header(){
        $this->Image('../img/bd_dark.png', 10, 10, 30);
        $this->SetFont('Courier', 'B', 11);
        $this->SetX($this->GetPageWidth() - 50);
        $this->MultiCell(40, 10, 'BunkoDEX Catalog System\nMacca Computer (C) 2018 - 2023', 0, 'R');
    }
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Courier', 'I', 8);
        $this->Cell(0, 10, 'Page No.'.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
    function Title($title) {
        $this->SetY(40);
        $this->SetFont('Courier', 'BI', 16);
        $this->SetX(($this->GetPageWidth() - $this->GetStringWidth($title)) / 2);
        $this->Cell(0, 10, $title, 0, 1, 'C');
    }
    
}