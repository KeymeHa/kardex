<?php

require_once "../../../controladores/actas.controlador.php";
require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/actas.modelo.php";

class generarActaPDF{

public $responsable;
public $anioActual;

public function actaEnPDF(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$acta = ControladorActas::ctrMostrarActas("id", $_GET["idActa"], $this->anioActual);
date_default_timezone_set('America/Bogota');

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

<table>
<tr>
<td style="width:540px"><div style="height: 200px; width: 100%; background-color: white"></div></td>
</tr>
<tr>
<td style="width:540px"><div style="height: 200px; width: 100%; background-color: white"></div></td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

if( !$acta == null )
{

$canInsumos = json_decode($acta["listainsumos"], true);

if(count($canInsumos) > 1)
{

	$texto = array(0 => "s", 1 => "los", 2 => "n", 3 => "os", 4 => "algún",  5 => "de los",  6 => "");
}
else
{
	$texto = array(0 => "", 1 => "el", 2 => "", 3 => "e", 4 => "el",  5 => "del",  6 => "");
}

if($acta["tipo"] == 1)
{
	$textoDos = array(0 => "ENTREGA", 1 => "hace la entrega", 2 => "entrega", 3 => "estará");
	$dia = substr($acta["fechaSal"],8,10);
	$meses = substr($acta["fechaSal"],5,-3);
	$anio = substr($acta["fechaSal"],0,-6);
}
elseif($acta["tipo"] == 2)
{
	$textoDos = array(0 => "RECIBO", 1 => "recibe", 2 => "recibe", 3 => "estaba");
	$dia = substr($acta["fechaEnt"],8,10);
	$meses = substr($acta["fechaEnt"],5,-3);
	$anio = substr($acta["fechaEnt"],0,-6);
}
else
{
	$textoDos = array(0 => "ASIGNACIÓN", 1 => "hace la entrega", 2 => "entrega", 3 => "estará");
	$dia = substr($acta["fechaEnt"],8,10);
	$meses = substr($acta["fechaEnt"],5,-3);
	$anio = substr($acta["fechaEnt"],0,-6);
}

$mes = ControladorParametros::nombreMes($meses);

$motivo = ControladorActas::ctrVerMotivo($acta["motivo"]);

$bloque2 = <<<EOF

<table style="font-size:12px; padding:5px 10px;">

<tr>

<td style="width:540px; text-align:center"><b>ACTA DE $textoDos[0] DE EQUIPO</b></td>

</tr>

</table>


EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque3 = <<<EOF

<table style="font-size:10px;">
	<tr>
		<td style="width:540px"><div style="height: 40px; width: 100%; background-color: white"></div></td>
	</tr>

	<tr>	
		<td style="background-color:white; width:540px; font-size:10px; text-align: justify;">Por medio de la presente acta se deja constancia que el dia $dia de $mes $anio, se $textoDos[1]$texto[6] $texto[5] siguiente$texto[0] equipo$texto[0] por motivo de $motivo.</td>
	</tr>

	<tr>
		<td style="width:540px"><div style="height: 40px; width: 100%; background-color: white"></div></td>
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

$bloque4 = <<<EOF
<strong>
<table style="font-size:11px; text-align: center;">
	<tr>
		<td style="width:40px; border: 1px black solid;">#</td>
		<td style="width:90px; border: 1px black solid;">Serial</td>
		<td style="width:90px; border: 1px black solid;">Marca</td>
		<td style="width:130px; border: 1px black solid;">Descripción</td>
		<td style="width:70px; border: 1px black solid;">Cantidad</td>
		<td style="width:120px; border: 1px black solid;">Observaciones</td>
	</tr>
</table>
</strong>
EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');

foreach ($canInsumos as $key => $value) 
{
$item = $key + 1;
$serie = ControladorParametros::ctrValidarCaracteresEspeciales($value["sn"]);
$des = ControladorParametros::ctrValidarCaracteresEspeciales($value["des"]);
$obs = ControladorParametros::ctrValidarCaracteresEspeciales($value["obs"]);
$bloque5 = <<<EOF

<table style="font-size:11px; text-align: center;">
	<tr>
		<td style="width:40px; border: 1px black solid;">$item</td>
		<td style="width:90px; border: 1px black solid;">$serie</td>
		<td style="width:90px; border: 1px black solid;">$value[mc]</td>
		<td style="width:130px; border: 1px black solid;">$des</td>
		<td style="width:70px; border: 1px black solid;">$value[can]</td>
		<td style="width:120px; border: 1px black solid;">obs</td>
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

}

$bloque6 = <<<EOF

<table style="font-size:10px;">
	<tr>
		<td style="width:540px"><div style="height: 40px; width: 100%; background-color: white"></div></td>
	</tr>

	<tr>	
		<td style="background-color:white; width:540px; font-size:10px; text-align: justify;">De acuerdo con lo anterior, se hace constar que $texto[1] equipo$texto[0] se encuentra$texto[2] en perfecto estado para recibirlo$texto[0]. Est$texto[3] equipo$texto[0] se $textoDos[2]$texto[2] en condición de trabajo, $texto[1] mismo$texto[0] que $textoDos[3]$texto[2] bajo su responsabilidad y cuidado.</td>

	</tr>
</table>

EOF;
$pdf->writeHTML($bloque6, false, false, false, false, '');

if($acta["tipo"] == 1 || $acta["tipo"] == 3)
{
$bloque7 = <<<EOF

<table style="font-size:10px;">
	<tr>	
		<td style="background-color:white; width:540px; font-size:10px; text-align: justify;">Así mismo, en caso de tener $texto[4] equipo un daño, perjuicio por mal uso de operación o perdida, este será bajo su responsabilidad y costo.</td>

	</tr>
</table>

EOF;
$pdf->writeHTML($bloque7, false, false, false, false, '');
}


$bloque8 = <<<EOF

<table style="font-size:10px;">
	<tr>
		<td style="width:540px"><div style="height: 60px; width: 100%; background-color: white"></div></td>
	</tr>
	<tr>
		<td style="width:540px"><div style="height: 60px; width: 100%; background-color: white"></div></td>
	</tr>
	<tr>
		<td style="width: 160px; border-top: 1px solid black; padding-top: 5px;">$acta[autorizado]<br>Entrega el equipo<br>C.C</td>
		<td style="width: 20px;"></td>
		<td style="width: 160px;"></td>
		<td style="width: 20px;"></td>
		<td style="width: 170px; border-top: 1px solid black; padding-top: 5px;">$acta[responsable]<br>Recibe el equipo<br>C.C</td>
	</tr>
</table>

EOF;

$pdf->writeHTML($bloque8, false, false, false, false, '');
}
else
{
$bloque1 = <<<EOF

<table style="font-size:10px;">
	<tr>
		<td style="width:540px">No hay información para mostrar</td>
	</tr>

</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');
}

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('ActadeInventario.pdf');

}
}

$genActaPDF = new generarActaPDF();
$genActaPDF -> anioActual = $_GET["anioActual"];
$genActaPDF -> actaEnPDF();

?>