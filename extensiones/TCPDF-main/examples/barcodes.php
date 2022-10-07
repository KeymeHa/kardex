<?php
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 027');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// ---------------------------------------------------------

// set a barcode on the page footer
$pdf->setBarcode(12345678910);

// add a page
$pdf->AddPage();

// -----------------------------------------------------------------------------

$pdf->SetFont('helvetica', '', 10);

// define barcode style
$style = array(
    'position' => '',
    'align' => 'P',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

$pdf->write1DBarcode('20220803274', 'EAN13', '', '', '', 10, 0.2, $style, 'N');


//Close and output PDF document
$pdf->Output('example_027.pdf', 'I');
