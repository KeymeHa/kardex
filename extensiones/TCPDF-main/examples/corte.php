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

require_once "../../../controladores/areas.controlador.php";
require_once "../../../modelos/areas.modelo.php";


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $item = "id";
        if (isset($_GET["idC"]) ) 
        {
           $valor = $_GET["idC"];
        }
        else
        {
           $valor = 1;     
        }
        $corte = ControladorRadicados::ctrMostrarCortes($item, $valor);
        $fecha = ControladorParametros::ctrOrdenFecha($corte["fecha"], 3);
        $numCorte = substr($corte["corte"], 6 , 4);

        $headerText = '<table style="font-size:8px;">  
        <tr>        
            <td style="width:10px;"></td>
            <td style="width:170px;">Archivo N°: '.$corte['corte'].'-EDU-RADICACIÓN</td>
            <td style="width:620px;"></td>
            <td style="width:40px;text-align: right;"><strong>Fec.Rep:</strong></td>
            <td style="width:90px;text-align: right;">'.$fecha.'</td>
            <td style="width:50px;text-align: right;">Cite: '.$numCorte.'</td>
        </tr>
    </table>
    <table align="center"> 
        <tr>        
            <td rowspan="3" style="width:5px;"></td>
            <td rowspan="3" style="width:120px; border: 1px solid black; font-size:5px; line-height: 1;"><img src="images/logoEdubar.png" width="80" height="auto"></td>
            <td rowspan="3" style="width:750px; border: 1px solid black; font-size:8px;"><span style="line-height:5px;">CONTROL DE GESTIÓN</span> <br> OFICINA DE RADICACIÓN</td>
            <td style="width:58px; border: 1px solid black; font-size:7px;" >
            Código&nbsp;&nbsp;
            </td>
            <td style="width:58px; border: 1px solid black; font-size:7px;">
            GD-FA-17
            </td>
        </tr>
        <tr>
            <td style="width:58px; border: 1px solid black; font-size:7px;">
            Versión:
            </td>
            <td style="width:58px; border: 1px solid black; font-size:7px;">
            1
            </td>   
        </tr>
        <tr>
            <td style="width:58px; border: 1px solid black; font-size:7px;">
            Páginas:&nbsp;&nbsp;
            </td>
            <td style="width:58px; border: 1px solid black; font-size:7px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$this->getAliasNbPages().'
            </td>   
        </tr>
    </table>
';
        // Logo
        $this->SetFont('helvetica', 'B', 20);

        $this->writeHTML($headerText, false, true, false, true); 
        // Title
        //$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 0, 'Entregado Por:_____________| Recibido Por:___________ Fecha:____/___/________  Hora:___:___[am] - [pm]      Página: '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$item = "id";
if (isset($_GET["idC"]) ) 
{
   $valor = $_GET["idC"];
}
else
{
   $valor = 1;     
}


$corte = ControladorRadicados::ctrMostrarCortes($item, $valor);
$radicados = ControladorRadicados::ctrMostrarRadicadosCorte($item."_corte", $corte["id"]);
$fecha = ControladorParametros::ctrOrdenFecha($corte["fecha"], 3);
$numCorte = substr($corte["corte"], 6 , 4);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Planilla N '.$corte["corte"]);
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
$pdf->SetMargins(4, 22, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

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
$pdf->setPageOrientation('L');

// add a page
$pdf->AddPage();

// set some text to print

$contador = 0;//cuenta las filas para reiniciarlas y crear nueva pagina

if (count($radicados) != 0) 
{
    $contenidoPDF = "";

    if (count($radicados) < 12) 
    {

         $contenidoPDF.='<table cellpadding="8" style="text-align:center;">
        <tr style="text-align:center; font-size:7.5px;">
                <td style="border-color: white !important;" width="25"><b>#</b></td>
                <td border="1" width="107"><b>Número Radicado</b></td>
                <td border="1" width="107"><b>Fecha Radicado</b></td>
                <td border="1" width="107"><b>Tipo</b></td>
                <td border="1" width="107"><b>Remitido A</b></td>
                <td border="1" width="107"><b>Remitente</b></td>
                <td border="1" width="107"><b>Asunto</b></td>
                <td border="1" width="107"><b>Enviado Por</b></td>
                <td border="1" width="107"><b>Recepcionado Por</b></td>
                <td border="1" width="107"><b>Fecha Recepcionado</b></td>
            </tr>';


        foreach ($radicados as $key => $value) 
        {
            $contar = $key+1;//enumera las filas
            $remitente = ControladorRadicados::ctrValidarRemitente($value["id_remitente"]);
            $areas = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);
            $pqr = ControladorParametros::ctrmostrarRegistros("pqr", "id", $value["id_pqr"]);
            $fechaRad = ControladorParametros::ctrOrdenFecha($value["fecha"], 3);
            $contenidoPDF.='<tr style="text-align:center; font-size:7.5px;">
                    <td style="border-color: white !important;">'.$contar.'</td>
                    <td border="1">'.$value["radicado"].'</td>
                    <td border="1">'.$fechaRad.'</td>
                    <td border="1">'.$pqr["nombre"].'</td>
                    <td border="1">'.$areas["nombre"].'-GRAL</td>
                    <td border="1">'.$remitente.'</td>
                    <td border="1">'.$value["asunto"].'</td>
                    <td border="1"></td>
                    <td border="1">'.$value["recibido"].'</td>
                    <td border="1"></td>
                </tr>';

        }
      $contenidoPDF.='</table>';

      $pdf->writeHTML($contenidoPDF, false, true, false, true);
    }
    else#holaaa
    {

    }
   
}

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Planilla N '.$corte["corte"].'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+