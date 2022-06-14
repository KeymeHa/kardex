<?php

require_once "../../../controladores/radicados.controlador.php";
require_once "../../../modelos/radicados.modelo.php";

require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";

class imprimirRadicado{

public $id;
public $forma;

public function formaUno(){

$item = "id";
$valor = $this->id;
$formas = $this->forma;

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



//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------
if ($formas != 2) 
{


$pdf->setPageOrientation('P');
$pdf->startPageGroup();

$pdf->AddPage();


$bloque1 = <<<EOF

	<table style="border: 1px white; ">
		
		<tr>
			
			<td style="width:175px;"></td>

			<td style="background-color:white; width:165px; font-size:5.5px;">
				<span style="color:white;">____</span><strong><u>NOTAS</u></strong>:
				<p style="text-align: justify;">
					<ul>
					 <li>Para Cualquier información cite el <strong>Número del Radicado.</strong></li>
					 <li>El recibido de la correspondencia <strong>NO significa la Aceptación,</strong> sino para su revisión.</li>
					</ul>
				</p>
			</td>

			<td style="background-color:white; width:100px; text-align:right;">
				<div>
					<div style="font-size:14px; line-height:-2px;">
						<img src="images/logoEdubar.png" width="80" height="auto">
					</div>
				
						
					<div style="font-size:8px; text-align:center; line-height:0px;">
						<img src="images/FIRMA.jpg" width="60" height="auto">
					</div>
				</div>
			</td>

			<td style="background-color:white; width:110px;">

				<div>
					<div style="font-size:14px; text-align:center; line-height:4px;">
						$corte
					</div>
					<div style="text-align:center; line-height:10px;">
						<img src="images/mano.png" width="8" height="auto"><b style="font-size:8px;  color:rgb(37, 90, 142);">  $radicado[radicado]</b>
						<br style="line-height:5px;">
						<span style="font-size:6px;">Fecha: $fecha</span>
					</div>
				</div>


			</td>

		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

	# code...
}
else
{

$pdf->setPageOrientation('L');
$pdf->startPageGroup();
$pdf->AddPage();

$bloque2 = <<<EOF

		<table style="border: 1px white; ">
		
		<tr>
			
			<td style="width:785px; height: 460px;">
			</td>


		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


$bloque1 = <<<EOF

		<table style="border: 1px white;">
		
		<tr>
			
			<td style="width:410px;"></td>

			<td style="background-color:white; width:165px; font-size:5.5px;">
				<span style="color:white;">____</span><strong><u>NOTAS</u></strong>:
				<p style="text-align: justify;">
					<ul>
					 <li>Para Cualquier información cite el <strong>Número del Radicado.</strong></li>
					 <li>El recibido de la correspondencia <strong>NO significa la Aceptación,</strong> sino para su revisión.</li>
					</ul>
				</p>
			</td>

			<td style="background-color:white; width:100px; text-align:right;">
				<div>
					<div style="font-size:14px; line-height:-2px;">
						<img src="images/logoEdubar.png" width="80" height="auto">
					</div>
				
						
					<div style="font-size:8px; text-align:center; line-height:0px;">
						<img src="images/FIRMA.jpg" width="60" height="auto">
					</div>
				</div>
			</td>

			<td style="background-color:white; width:110px;">

				<div>
					<div style="font-size:14px; text-align:center; line-height:4px;">
						$corte
					</div>
					<div style="text-align:center; line-height:10px;">
						<img src="images/mano.png" width="8" height="auto"><b style="font-size:8px;  color:rgb(37, 90, 142);">  $radicado[radicado]</b>
						<br style="line-height:5px;">
						<span style="font-size:6px;">Fecha: $fecha</span>
					</div>
				</div>


			</td>

		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


}

// ---------------------------------------------------------

// ---------------------------------------------------------


// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$impRadicado = new imprimirRadicado();
$impRadicado -> id = $_GET["id_rad"];
$impRadicado -> forma = $_GET["f"];

$impRadicado -> formaUno();

?>