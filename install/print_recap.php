<?php
require '../lib/pdf_config.php';
require '../lib/conf.php';

$pdf = new Fpdf();
$def = new BunkoDEX_PDFConfig();

$pdf->AddPage();
$pdf->SetTitle("BunkoDEX Automatic Print Recap");
$pdf->SetAuthor("Macca Computer BunkoDEX");
$pdf->SetCreator("BunkoDEX Automatic PDF Generator");
$def->Header($pdf);
$def->Title($pdf, "BunkoDEX Installation recap");
$pdf->Cell(0, 10, 'Thank you for choosing BunkoDEX free software!', 0, 0, 'C');
$pdf->SetFont('Courier', '', 11);
$pdf->Ln(15);

$pdf->Cell(0, 10, 'Login credentials:', 0, 0);

/*
$x = $pdf->GetX();
$pdf->Cell(40,6,'Words Here', 1,0, 'C');
$pdf->Cell(40,6,'Words Here', 1,1);
$pdf->SetX($x);
$pdf->Cell(40,6,'[x] abc', 1,0);
$pdf->Cell(40,6,'[x] Checkbox 1', 1,1);
$pdf->SetX($x);
$pdf->Cell(40,6,'[x] def', 1,0);
$pdf->Cell(40,6,'[x] Checkbox 1', 1,1);*/
$pdf->Output("I", "print_recap.pdf");