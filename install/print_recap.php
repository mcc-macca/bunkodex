<?php
require '../vendor/autoload.php';
require '../lib/pdf_config.php';

$pdf = New Fpdf;
$def = New BunkoDEX_PDFConfig;

$pdf->AddPage();
$pdf->SetAuthor("Macca Computer BunkoDEX");
$pdf->SetCreator("BunkoDEX Automatic PDF Generator");
$def->Header($pdf);

