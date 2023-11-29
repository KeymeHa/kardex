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

    //Page header
    public function Header() {
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
        


       // $subtable = '<table border="1" ><tr align="center"><td><img src="images/logo.PNG" width="50"></td></tr><tr><td align="center"><img  src="images/FIRMA.jpg" width="60"></td></tr></table>';

        $subtable = '<table cellspacing="1" border="0" style="font-size:8px" ><tr><td><img src="images/logo.PNG"></td></tr><tr><td><img src="images/FIRMA.jpg"></td></tr></table>';

        $subtableU = '<table  align="center"><tr><td><span style="font-size:11px;">'.$corte.'</span> <span style="font-size:8px; color:rgb(37, 90, 142);">'.$radicado["radicado"].'</span> <span style="font-size:5px;">Fecha: '.$fecha.'</span></td></tr></table>';

        

        $headerText = '<table border="0">
    <tr>
        <td width="40%"></td>
        <td width="35%" style="font-size:7px;"><span style="color:white;">____</span><b><u>NOTAS</u></b>:
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
        // Logo
        $this->SetFont('helvetica', 'B', 20);

        $this->writeHTML($headerText, false, true, false, true); 
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Rad: ');
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
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintFooter(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetFont('dejavusans', '', 10);
$pdf->setPageOrientation('P');

// add a page
 $pdf->AddPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('impRad.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+