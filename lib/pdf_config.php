<?php
/**
 * File for pdf config.
 * 
 * @author Macca Computer <info@maccacomputer.com>
 * @copyright 2018 - 2023 Macca Computer
 * @license GNU AGPL 3.0 <https://www.gnu.org/licenses/agpl-3.0.txt>
 */
require '../lib/fpdf/';



class BunkoDEX_PDFConfig {
    public $logoPath = '../img/bd_dark.png';
    public $headerText = 'BunkoDEX Catalog System\nMacca Computer (C) 2018 - 2023';

    public function Header($pdf) {
        $pdf->Image($this->logoPath, 10, 10, 30);
        $pdf->SetFont('Courier', 'B', 11);
        $pdf->SetX($pdf->GetPageWidth() - 50);
        $pdf->MultiCell(40, 10, $this->headerText, 0, 'R');
    }

    public function Footer($pdf) {
        $pdf->SetY(-15);
        $pdf->SetFont('Courier', 'I', 8);
        $pdf->Cell(0, 10, 'Page No.'.$pdf->PageNo().'/{nb}', 0, 0, 'C');
    }

    public function Title($pdf, $title) {
        $pdf->SetY(40);
        $pdf->SetFont('Courier', 'BI', 16);
        $pdf->SetX(($pdf->GetPageWidth() - $pdf->GetStringWidth($title)) / 2);
        $pdf->Cell(0, 10, $title, 0, 1, 'C');
    } 
}

class BunkoDEX_PDF extends FPDI {
    protected $pdfConfig;

    public function __construct() {
        parent::__construct();
        $this->pdfConfig = new BunkoDEX_PDFConfig();
    }

    public function Header() {
        $this->pdfConfig->Header($this);
    }

    public function Footer() {
        $this->pdfConfig->Footer($this);
    }

    public function Title($title) {
        $this->pdfConfig->Title($this, $title);
    }
}