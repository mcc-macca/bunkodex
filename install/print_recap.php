<?php
require '../lib/pdf_config.php';

$pdf = new FPDFI();
$def = new BunkoDEX_PDFConfig();

$pdf->AddPage();
$pdf->SetAuthor("Macca Computer BunkoDEX");
$pdf->SetCreator("BunkoDEX Automatic PDF Generator");
$def->Header($pdf);
$pdf->Output("print_recap.pdf");