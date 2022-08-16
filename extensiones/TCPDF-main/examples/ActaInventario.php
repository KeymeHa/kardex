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

        $headerText = '<table>
<tr style="border: 1px black solid; margin: 0px">
<td style="width:150px; border: 1px black solid;"><img src="images/logoEdubar.png"></td>
<td style="background-color:white; width:280px; border: 1px black solid;">
<div style="font-size:8.5px; text-align:center; line-height:15px;">
<br>
ACTA DE INVENTARIO DE BODEGA
</div>
</td>
<td style="background-color:white; width:108px; text-align:left; font-size:8px; border: 1px black solid; padding-left: px;">  Acta Nº: 01<br>  Fecha: 15 mayo  2019<br>  Versión: 01<br>  Paginas: '.$this->getAliasNumPage().' de '.$this->getAliasNbPages().'      
</td>
</tr>
<tr>
<td style="width:540px"><div style="height: 25px; width: 100%; background-color: white"></div></td>
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

require_once "../../../controladores/insumos.controlador.php";
require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/insumos.modelo.php";
require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";

$nombreResponsable = $_GET["responsable"];
$item = null;
$valor = null;
$insumos = ControladorInsumos::ctrMostrarInsumos($item, $valor);

date_default_timezone_set('America/Bogota');

$dia = date("d");
$meses = date("n");
$anio = date("Y");
$hora = date("G");
$minutos = date("i");

$mes = ControladorParametros::nombreMes($meses);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Acta de Inventario');
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
$pdf->SetMargins(30, 30, PDF_MARGIN_RIGHT);
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
$pdf->setPageOrientation('P');

// add a page
$pdf->AddPage();

// set some text to print

$bloque6 = <<<EOF

<table>
<tr>

<td style="background-color:white; width:540px; font-size:9px;">
<p style="text-align: justify;">En la ciudad de Barranquilla a los $dia días del mes de $mes siendo las $hora:$minutos del año $anio, en las instalaciones de Bodega de insumos de EDUBAR S.A. Se hace constar mediante esta Acta de inventario físico que:<br><br>El inventariado  de los diferentes productos  contenidos en la bodega se ha llevado a cabo conforme a los estatutos y márgenes estipulados, contabilizando todos los productos de la bodega se procede a hacer entrega del inventario actuando como responsable el (a) señor (a) $nombreResponsable. A continuación se da comienzo a la verificación física de los materiales y equipos que a continuación se detallan:</p>
</td>
</tr>
<tr>
<td style="width:540px"><div style="height: 5px; width: 100%; background-color: white"></div></td>
</tr>
<tr>

<td style="border: 1px solid black; background-color:white; width:92px; text-align:center; font-size:8px;"><b>Ref. Interna</b></td>
<td style="border: 1px solid black; background-color:white; width:260px; text-align:center; font-size:8px;"><b>DESCRIPCIÓN</b></td>
<td style="border: 1px solid black; background-color:white; width:94px; text-align:center; font-size:8px;"><b>CANTIDAD</b></td>
<td style="border: 1px solid black; background-color:white; width:94px; text-align:center; font-size:8px;"><b>OBSERVACIONES</b></td>

</tr>
</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

if( !$insumos == null )
{

foreach ($insumos as $key => $item) {

$bloque5 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

<tr>

<td style="border: 1px solid black; background-color:white; width:92px; text-align:center">$item[codigo]</td>
<td style="border: 1px solid black; background-color:white; width:260px; text-align:center">$item[descripcion]</td>
<td style="border: 1px solid black; background-color:white; width:94px; text-align:center">$item[stock]</td>
<td style="border: 1px solid black; background-color:white; width:94px; text-align:center"></td>

</tr>

</table>


EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

}

}

$bloque6 = <<<EOF

<table style="font-size:8.5px; padding:5px 10px;">
    <tr>
        <td style="width:540px"><div style="height: 40px; width: 100%; background-color: white"></div></td>
    </tr>

    <tr>    
        <td style="background-color:white; width:540px; font-size:9px; text-align: justify;">Mediante esta acta se toma nota y se da fe de la existencia de los productos mencionados en la misma, y que los mismos se encuentran en excelentes condiciones, sin que se hayan pasado las fechas de caducidad.<br><br>Hecho lo anterior y siendo las $hora horas con $minutos minutos del día $dia de $mes de $anio, se cierra el presente inventario para todos los efectos a que haya lugar.</td>

    </tr>

    <tr>
        <td style="width:540px"><div style="height: 40px; width: 100%; background-color: white"></div></td>
    </tr>
    <tr>
        <td style="width: 160px; text-align:center; border-top: 1px solid black; padding-top: 5px;">ENCARGADO ALMACÉN</td>
        <td style="width: 20px;"></td>
        <td style="width: 160px; text-align:center; border-top: 1px solid black; padding-top: 5px;">REVISÓ</td>
        <td style="width: 20px;"></td>
        <td style="width: 170px; text-align:center; border-top: 1px solid black; padding-top: 5px;">JEFE DE COMPRAS</td>
    </tr>
</table>

EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('ActadeInventario.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+