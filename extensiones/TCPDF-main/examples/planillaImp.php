<?php

require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";

require_once "../../../controladores/areas.controlador.php";
require_once "../../../modelos/areas.modelo.php";

class imprimirCorte {

public $id;

public function imprimir(){

$item = "id";
$valor = $this->id;

$corte = ControladorRadicados::ctrMostrarCortes($item, $valor);
$radicados = ControladorRadicados::ctrMostrarRadicadosCorte($item."_corte", $corte["id"]);
$fecha = ControladorParametros::ctrOrdenFecha($corte["fecha"], 3);
$numCorte = substr($corte["corte"], 6 , 4);
//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------

$pdf->setPageOrientation('L');
$pdf->startPageGroup();

$pdf->AddPage();


$bloque1 = <<<EOF

	<table style="font-size:5px; border: 1px white;">	
		<tr>		
			<td style="width:10px;"></td>
			<td style="width:120px;">Archivo N°: $corte[corte]-EDU-RADICACIÓN</td>
			<td style="width:525px;"></td>
			<td style="width:30px;text-align: right;"><strong>Fec.Rep:</strong></td>
			<td style="width:60px;text-align: right;">$fecha</td>
			<td style="width:40px;text-align: right;">Cite: $numCorte</td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

$bloque2 = <<<EOF

	<table style="font-size:5px; text-align: center;">
		<tr>
			<th></th>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

$bloque3 = <<<EOF

	<table>	
		<tr>		
			<td rowspan="3" style="width:10px;"></td>
			<td rowspan="3" style="width:120px; border: 1px solid black; text-align:center; font-size:5px; line-height: 1;"><img src="images/logoEdubar2.png" width="80" height="auto"></td>
			<td rowspan="3" style="width:555px; border: 1px solid black; text-align: center; font-size:8px;"><span style="line-height:5px;">CONTROL DE GESTIÓN</span> <br> OFICINA DE RADICACIÓN</td>
			<td style="width:50px; border: 1px solid black; text-align: right; font-size:7px;" >
			Código&nbsp;&nbsp;
			</td>
			<td style="width:50px; border: 1px solid black; text-align: center; font-size:7px;">
			GD-FA-17
			</td>
		</tr>
		<tr>
			<td style="width:50px; border: 1px solid black; text-align: right; font-size:7px;">
			Versión:&nbsp;&nbsp;
			</td>
			<td style="width:50px; border: 1px solid black; text-align: center; font-size:7px;">
			1
			</td>	
		</tr>
		<tr>
			<td style="width:50px; border: 1px solid black; text-align: right; font-size:7px;">
			Páginas:&nbsp;&nbsp;
			</td>
			<td style="width:50px; border: 1px solid black; text-align: center; font-size:7px;">
			2
			</td>	
		</tr>
	</table>

	<table style="font-size:5px; text-align: center;">
		<tr>
			<th></th>
		</tr>
	</table>
	
	<table  style="font-size:5px; text-align: center;">
		<tr>
			<th style="width:10px;">
			</th>
			<th style="width:80px;" border="1">
			Número Radicado
			</th>
			<th style="width:75px;" border="1">
			Fecha Radicado
			</th>
			<th style="width:80px;" border="1">
			Tipo
			</th>
			<th style="width:120px;" border="1">
			Remitido A:
			</th>
			<th style="width:120px;" border="1">
			Remitente
			</th>
			<th style="width:110px;" border="1">
			Asunto:
			</th>
			<th style="width:50px;" border="1">
			Enviado Por:
			</th>
			<th style="width:70px;" border="1">
			Recepcionado Por:
			</th>
			<th style="width:70px;" border="1">
			Fecha Recepcionado
			</th>
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

if (count($radicados) != 0) 
{
	foreach ($radicados as $key => $value) 
	{

		$contar = ($key+1);
		$areas = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);
		$pqr = ControladorParametros::ctrmostrarRegistros("pqr", "id", $value["id_pqr"]);
		$fechaRad = ControladorParametros::ctrOrdenFecha($value["fecha"], 3);


		$bloque4 = <<<EOF
			<table  style="font-size:5px; line-height: 25px; text-align: center;">
				<tr>
					<td style="width:10px; height:25px;">
					$contar
					</td>
					<td style="width:80px;" border="1">
					$value[radicado]
					</td>
					<td style="width:75px;" border="1">
					$fechaRad
					</td>
					<td style="width:80px;" border="1">
					$pqr[id]-$pqr[nombre]
					</td>
					<td style="width:120px; text-transform: uppercase;" border="1">
					$areas[nombre]-GRAL
					</td>
					<td style="width:120px;" border="1">
					$value[id_remitente]
					</td>
					<td style="width:110px;" border="1">
					$value[asunto]
					</td>
					<td style="width:50px;" border="1">
					0
					</td>
					<td style="width:70px;" border="1">
					$value[recibido]
					</td>
					<td style="width:70px;" border="1">
					
					</td>
				</tr>
			</table>
		EOF;


		$pdf->writeHTML($bloque4, false, false, false, false, '');
		
	}
}
else
{
	$bloque3 = <<<EOF


	<table style="font-size:5px; text-align: center;">
		<tr>
			<th>Sin Información.</th>
		</tr>
	</table>
	
EOF;
}

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}
$impCorte = new imprimirCorte();

if ( isset($_GET["idC"]) ) 
{
	$impCorte -> id = $_GET["idC"];
	$impCorte -> imprimir();
}
else
{
	echo '<h1>No se encontro información Asocidada.</h1>';
}

?>