<?php


require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/ordencompra.controlador.php";
require_once "../../../modelos/ordenCompra.modelo.php";

require_once "../../../controladores/parametros.controlador.php";
require_once "../../../modelos/parametros.modelo.php";

require_once "../../../controladores/insumos.controlador.php";
require_once "../../../modelos/insumos.modelo.php";

class imprimirOCompra{

public $idOC;

public function traerImpresionOC(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemOC = "id";
$valorOC = $this->idOC;

$respuestaOC = ControladorOrdenCompra::ctrMostrarOrdenesdeCompras($itemOC, $valorOC);

$fecha = ControladorParametros::ctrOrdenFecha($respuestaOC["fecha"], 0);
$fechaEnt = ControladorParametros::ctrOrdenFecha($respuestaOC["fechaEntrega"], 0);
$insumos = json_decode($respuestaOC["insumos"], true);
$inversion = number_format($respuestaOC["inversion"],0);
$iva = number_format($respuestaOC["iva"],0);
$total = number_format((intval($respuestaOC["inversion"]) + intval($respuestaOC["iva"]) ), 0);

$itemProv = "id";
$valorProv = $respuestaOC["id_proveedor"];
$proveedor = ControladorProveedores::ctrMostrarProveedores($itemProv, $valorProv);

$respuestaParam = ControladorParametros::ctrMostrarTodosParam();

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
			<tr>
				<td style="width: 150px"><img src="images/logoEdubar.png"></td>
				<td style="text-align: center; width: 280px;"><br><br>ORDEN DE COMPRA</td>
				<td style="width: 110px; font-size: 8px; border: 1px solid black">
						<div style="width: 110px; text-align: center; border-bottom: 1px solid black">
						Orden de Compra
						</div>
						<div style="width: 60px; border-bottom: 1px solid black">
						  N°: $respuestaOC[codigoInt]
						</div><br>
						  Fecha: $fecha		
				</td>
			</tr>
		</table>

		<table style="font-size: 8px">
			<tr>
				<td style="height: 20px; width: 540px;"></td>
			</tr>
			<tr>
				
				<td>Razón Social: $proveedor[razonSocial]<br>Nit: $proveedor[nit] - $proveedor[digitoNit]<br>Tel: $proveedor[telefono]<br>Correo: $proveedor[correo]<br>Dirección: $proveedor[direccion]<br>Forma de Pago: $respuestaOC[formaPago]<br></td>
			</tr>
			<tr>
				<td style="height: 20px; width: 540px;"></td>
			</tr>
		</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table style="border: 1px solid black; text-align: center; font-size: 8px">
		<tr style="border: 1px solid black">
			<td style="border: 1px solid black; width: 50px"><b>Codigo</b></td>
			<td style="border: 1px solid black; width: 250px"><b>Descripción de los bienes o insumos</b></td>
			<td style="border: 1px solid black; width: 50px"><b>Cantidad</b></td>
			<td style="border: 1px solid black; width: 100px"><b>Precio U/N</b></td>
			<td style="border: 1px solid black; width: 90px"><b>Total</b></td>
		</tr>
	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');


foreach ($insumos as $key => $item) {

$itemProducto = "id";
$valorProducto = $item["id"];
$insumos = Controladorinsumos::ctrMostrarinsumos($itemProducto, $valorProducto);
$valorUni = number_format($item["pre"], 0);
$subT = number_format($item["sub"], 0);

$bloque3 = <<<EOF

	<table style="border: 1px solid black; text-align: center; font-size: 8px">
		<tr style="border: 1px solid black">
			<td style="border: 1px solid black; width: 50px">$insumos[codigo]</td>
			<td style="border: 1px solid black; width: 250px">$insumos[descripcion]</td>
			<td style="border: 1px solid black; width: 50px">$item[can]</td>
			<td style="border: 1px solid black; width: 100px">$valorUni</td>
			<td style="border: 1px solid black; width: 90px">$subT</td>
		</tr>
	</table>


EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

}


$bloque4 = <<<EOF

	<table style="text-align: center; font-size: 10px">
		<tr style="border: 1px solid black">
			<td style="width: 50px"></td>
			<td style="width: 250px"></td>
			<td style="width: 50px"></td>
			<td style="border: 1px solid black; width: 100px"><b>Sub Total</b></td>
			<td style="border: 1px solid black; width: 90px">$inversion</td>
		</tr>
	</table>

	<table style="text-align: center; font-size: 10px">
		<tr style="border: 1px solid black">
			<td style="width: 50px"></td>
			<td style="width: 250px"></td>
			<td style="width: 50px"></td>
			<td style="border: 1px solid black; width: 100px"><b>IVA $respuestaParam[valorIVA]%</b></td>
			<td style="border: 1px solid black; width: 90px">$iva</td>
		</tr>
	</table>

	<table style="text-align: center; font-size: 10px">
		<tr style="border: 1px solid black">
			<td style="width: 50px"></td>
			<td style="width: 250px"></td>
			<td style="width: 50px"></td>
			<td style="border: 1px solid black; width: 100px"><b>Total</b></td>
			<td style="border: 1px solid black; width: 90px">$total</td>
		</tr>
		<tr>
			<td style="height: 20px; width: 540px;"></td>
		</tr>
	</table>

	<table style="border: 1px solid black; font-size: 10px">
		
		<tr>
			<td style="text-align: center;  width: 540px">OBSERVACIONES</td>
		</tr>
		<tr>
			<td style="height: 40px">  $respuestaOC[observacion]</td>
		</tr>
	</table>

	<table style="font-size: 10px">
		<tr>
			<td style="height: 20px; width: 540px;"></td>
		</tr>
		<tr>
			<td style="width: 539px">Datos Facturación<br><br>
			Razón Social: $respuestaParam[razonSocial]<br>Nit: $respuestaParam[nit]<br>Dirección: $respuestaParam[direccion]<br>Telefono: $respuestaParam[tel]<br>Correo: $respuestaParam[correo]<br>Entregar en: $respuestaParam[direccionEnt]<br>Fecha Entrega: $fechaEnt<br>
			</td>
		</tr>
		<tr>
			<td style="height: 20px;"></td>
		</tr>
		<tr>
			<td style="width: 250px">Elaborado por: $respuestaOC[responsable]</td>
			<td style="width: 40px"></td>
			<td style="width: 250px">Autorizado Por: $respuestaParam[repLegal]</td>
		</tr>
	</table>



EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('ordendeCompra.pdf');

}

}

$ordenC = new imprimirOCompra();
$ordenC -> idOC = $_GET["idOC"];
$ordenC -> traerImpresionOC();

?>