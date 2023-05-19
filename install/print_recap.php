<?php
require '../vendor/autoload.php';
require '../vendor/fpdf/fpdf/original/fpdf.php';
require '../lib/pdf_config.php';

$pdf = New BunkoDEX_PDFConfig;

$pdf->AddPage();

