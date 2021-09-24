<?php

require_once "../../../controladores/insumos.controlador.php";
require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/insumos.modelo.php";

class generarActaInsumos{

public $responsable;

public function actaInventarioPDF(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$nombreResponsable = $this->responsable;
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


require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

<table>
<tr style="border: 1px black solid; margin: 0px">
<td style="width:150px; border: 1px black solid;"><img src="images/logoEdubar.png" style="height: auto; margin-left: 10%;"></td>
<td style="background-color:white; width:280px; border: 1px black solid;">
<div style="font-size:8.5px; text-align:center; line-height:15px;">
<br>
ACTA DE INVENTARIO DE BODEGA
</div>
</td>
<td style="background-color:white; width:108px; text-align:left; font-size:8px; border: 1px black solid; padding-left: px;">  Acta Nº: 01<br>  Fecha: 15 mayo  2019<br>  Versión: 01<br>  Paginas: 1 de 1		
</td>
</tr>
<tr>
<td style="width:540px"><div style="height: 5px; width: 100%; background-color: white"></div></td>
</tr>
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

$pdf->writeHTML($bloque1, false, false, false, false, '');

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
else
{

$bloque5 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

<tr>

<td style="border: 1px solid black; background-color:white; width:540px; text-align:center">
<center>No hay Insumos Registrados.</center>
</td>

</tr>

</table>


EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

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
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('ActadeInventario.pdf');

}
}

$genActaPDF = new generarActaInsumos();
$genActaPDF -> responsable = $_GET["responsable"];
$genActaPDF -> actaInventarioPDF();

?>