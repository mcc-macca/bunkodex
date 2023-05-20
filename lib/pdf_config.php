<?php

/**
 * File for pdf config.
 * 
 * @author Macca Computer <info@maccacomputer.com>
 * @copyright 2018 - 2023 Macca Computer
 * @license GNU AGPL 3.0 <https://www.gnu.org/licenses/agpl-3.0.txt>
 */

use setasign\Fpdi\Fpdi;

require '../lib/fpdfi/src/autoload.php';
require '../lib/fpdf/fpdf.php';



class BunkoDEX_PDFConfig
{
    public $logoPath = '../img/bd_black.png';
    public $headerText = 'BunkoDEX Catalog System\nMacca Computer (C) 2018 - 2023';

    public function Header($pdf)
    {
        $pdf->SetTitle("BunkoDEX Automatic Print Recap");
        $pdf->SetAuthor("Macca Computer BunkoDEX");
        $pdf->SetCreator("BunkoDEX Automatic PDF Generator");
        $logoPath = realpath($this->logoPath);
        $pdf->Image($logoPath, 40, 10, 45);
        $pdf->SetFont('Courier', 'B', 11);
        $pdf->SetX($pdf->GetPageWidth() - 150);
        $pdf->Cell(0, 15, 'BunkoDEX Catalog System', 0, 2, 'C');
        $pdf->Cell(0, 0, 'Macca Computer (C) 2018 - 2023', 0, 2, 'C');
    }

    public function Footer($pdf)
    {
        $pdf->SetY(-15);
        $pdf->SetFont('Courier', 'I', 8);
        $pdf->Cell(0, 10, 'Page No.' . $pdf->PageNo(), 0, 0, 'C');
    }

    public function Title($pdf, $title)
    {
        $pdf->SetY(40);
        $pdf->SetFont('Courier', 'BI', 16);
        $pdf->Cell(0, 10, $title, 0, 1, 'C');
    }
    // Simple table
    public function BasicTable($pdf, $header, $data)
    {
        // Header
        foreach ($header as $col)
            $pdf->Cell(40, 7, $col, 1);
        $pdf->Ln();
        // Data
        foreach ($data as $row) {
            foreach ($row as $col)
                $pdf->Cell(40, 6, $col, 1);
            $pdf->Ln();
        }
    }

    // Better table
    /*public function ImprovedTable($pdf, $header, $data)
    {
        // Column widths
        $w = array(40, 35, 40, 45);
        // Header
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $pdf->Ln();
        // Data
        foreach ($data as $row) {
            $pdf->Cell($w[0], 6, $row[0], 'LR');
            $pdf->Cell($w[1], 6, $row[1], 'LR');
            $pdf->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R');
            $pdf->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R');
            $pdf->Ln();
        }
        // Closing line
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }*/

    // Colored table
    public function FancyTable($pdf, $header, $data)
    {
        // Colors, line width and bold font
        $pdf->SetFillColor(255, 0, 0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128, 0, 0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('', 'B');
        // Header
        $w = array(40, 35, 40, 45);
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $pdf->Ln();
        // Color and font restoration
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = false;
        foreach ($data as $row) {
            $pdf->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $pdf->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $pdf->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $pdf->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        // Closing line
        $pdf->Cell(array_sum($w), 0, '', 'T');
    }
}

class BunkoDEX_PDF extends Fpdi
{
    protected $pdfConfig;

    public function __construct()
    {
        parent::__construct();
        $this->pdfConfig = new BunkoDEX_PDFConfig();
    }

    public function Header()
    {
        $this->pdfConfig->Header($this);
    }

    public function Footer()
    {
        $this->pdfConfig->Footer($this);
    }

    public function Title($title)
    {
        $this->pdfConfig->Title($this, $title);
    }
}
