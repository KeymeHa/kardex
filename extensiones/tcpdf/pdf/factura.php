<?php

require_once "../../../controladores/facturas.controlador.php";
require_once "../../../modelos/facturas.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/insumos.controlador.php";
require_once "../../../modelos/insumos.modelo.php";

class imprimirFactura{

public $codigoInt;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$item = "codigoInt";
$valor = $this->codigoInt;

$respuestaFac = ControladorFacturas::ctrMostrarFacturas($item, $valor);

$fecha = $respuestaFac["fecha"];
$insumos = json_decode($respuestaFac["insumos"], true);
$subT = number_format($respuestaFac["inversion"],0);
$iva = number_format($respuestaFac["iva"],0);
$total = number_format((intval($subT)+intval($iva)),0);

//TRAEMOS LA INFORMACIÓN DEL PROVEEDOR

$itemProv = "id";
$valorProv = $respuestaFac["id_proveedor"];

$respuestaProv = ControladorProveedores::ctrMostrarProveedores($itemProv, $valorProv);

//TRAEMOS LA INFORMACIÓN DEL USUARIO

$itemUsr = "id";
$valorUsr = $respuestaFac["id_usr"];

$respuestaUsr = ControladorUsuarios::ctrMostrarUsuarios($itemUsr, $valorUsr);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Fecha: $fecha

				<br><br>
				EDUBAR S.A.
				
				<br>
				NIT: 800.091.140 - 4

				<br>
				Dirección: Via 40 # 73 - 290 Piso 9

				<br>
				Teléfono: 3822088

				<br>
				FACTURA N.$valor

				<br><br>					
				Proveedor: $respuestaProv[razonSocial]

				<br>
				Generado por: $respuestaUsr[nombre]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


foreach ($insumos as $key => $item) {

$valorUnitario = number_format($item["pre"], 0);

$precioTotal = number_format($item["sub"], 0);

$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		$item[des] 
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		$ $valorUnitario Und * $item[can]  = $ $precioTotal
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

}

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 subT: 
		</td>

		<td style="width:80px;">
			$ $subT
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 iva: 
		</td>

		<td style="width:80px;">
			$ $iva
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 --------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Generado Automaticamente.
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigoInt = $_GET["codigoInt"];
$factura -> traerImpresionFactura();

?>