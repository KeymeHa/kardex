<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

  
}
 $item = "id";
if (isset($_GET["id_rad"])) 
{
$valor = $_GET["id_rad"];
}

$radicado = ControladorRadicados::ctrMostrarRadicados($item, $valor);
$fecha = ControladorParametros::ctrOrdenFecha($radicado["fecha"], 3);

if ($radicado["id_corte"] != 0) 
{

$cortes = ControladorRadicados::ctrMostrarCortes($item, $radicado["id_corte"]);
$corte = $cortes["corte"];
# code...
}
else
{

$cortes = ControladorParametros::ctrMostrarParametros(29);
$corte = $cortes["codigo"]; 

}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('KB');
$pdf->SetTitle('Planilla N ');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(15, -5, 0);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetAutoPageBreak(TRUE, 0);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set auto page breaks
// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->setPageOrientation('L');

// add a page
 $pdf->AddPage();

 $subtable = '<table cellspacing="1" cellspadding="1" border="0" style="font-size:8px" ><tr><td><img src="images/logoEdubar.png"></td></tr><tr><td><img src="images/FIRMA.jpg"></td></tr></table>';

        $subtableU = '<table  align="center"><tr><td><span style="font-size:11px; line-height:10px;">'.$corte.'</span> <span style="color:white; font-size:2px;">___________</span> <span style="font-size:8px; color:rgb(37, 90, 142);">#'.$radicado["radicado"].'</span> <span style="font-size:5px;">Fecha: '.$fecha.'</span></td></tr></table>';

        

        $headerText = '<table>
        <tr><td height="541" width="100%"></td></tr>
        </table>
        <table border="0">
            <tr>
                <td width="43%"></td>
                <td width="20%" style="font-size:6px;"><span style="color:white;">____</span><b><u>NOTAS</u></b>:
                    <p style="text-align: justify;">
                        <ul>
                         <li>Para Cualquier información cite el <b>Número del Radicado.</b></li>
                         <li>El recibido de la correspondencia <b>NO significa la Aceptación,</b> sino para su revisión.</li>
                        </ul>
                    </p></td>
                <td width="90">'.$subtable.'</td>
                <td width="70">'.$subtableU.'</td>
            </tr>  
        </table>
        ';

$pdf->writeHTML($headerText, false, true, false, true);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('imprimir radicado.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+