<?php
session_start();
require '../lib/pdf_config.php';
require '../lib/conf.php';
$pdf = new Fpdf();
$def = new BunkoDEX_PDFConfig();

if (INST_DATE != "") {
    $pdf->AddPage();
    $def->Header($pdf);
    $def->Title($pdf, "BunkoDEX Installation recap");
    $pdf->Cell(0, 10, 'Thank you for choosing BunkoDEX free software!', 0, 0, 'C');
    $pdf->SetFont('Courier', '', 11);
    $pdf->Ln(15);
    $data = array(
        array('BunkoDEX registered as:', NAME_DEX),
        array('at:', INST_DATE),
        array('Admin username:', $_SESSION['tmptmp']),
        array('Admin password:', $_SESSION['password'])
    );
    $colWidth = $pdf->GetPageWidth() / 3;
    $tableHeight = count($data) * 10;
    foreach ($data as $row) {
        foreach ($row as $cell) {
            $pdf->Cell($colWidth, 10, $cell, 0, 0);
        }
        $pdf->Ln();
    }
    $pdf->Ln(10);
    $pdf->SetFont('Courier', 'I', 8);
    $pdf->Write(3, 'The information contained in this document may include, but is not limited to, proprietary business data, trade secrets, financial information, and personal data. Sharing, forwarding, or disseminating this document without proper authorization is a violation of company policy and may also be subject to legal consequences.', 0);
    $pdf->Ln(10);
    $pdf->Write(3, 'By accessing and reviewing this document, you acknowledge that you are authorized to do so and agree to handle its contents with the utmost confidentiality. You are strictly prohibited from sharing, reproducing, or distributing any part of this document without prior written consent.', 0);
    $pdf->Ln(10);
    $pdf->Write(3, 'Failure to comply with these confidentiality guidelines may result in disciplinary action, legal liabilities, and damages. Please treat this document with the highest level of confidentiality and ensure its secure storage and proper disposal when no longer needed.', 0);
    $pdf->Ln(10);
    $pdf->SetFont('Courier', 'BI', 11);
    $pdf->Cell(300, 8, "Macca Computer", NULL, 1, "C");
    $pdf->Cell(300, 3, date("D, M Y"), NULL, 1, "C");
    $pdf->Output("I", "print_recap.pdf");
} else {
    echo "<center><br><br><br><h1>***********************<br>BUNKODEX ERROR REPORT<br>***********************</h1>
    <br><br><br><hr><br><h2>Please complete the installation process of BunkoDEX.</h2></center>";
    die;
}
