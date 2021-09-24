<?php

require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
require_once "../controladores/parametros.controlador.php";

class TablaFacturas
{	
	public $fechaInicial;
	public $fechaFinal;
	public function mostrarTablaFacturas()
	{	
		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;


		if($fechaIn != null)
		{
			$facturas = ControladorFacturas::ctrMostrarFacturasRango($fechaIn, $fechaOut);
		}
		else
		{
			$facturas = ControladorFacturas::ctrMostrarFacturas(null, null);
		}

	    if ( count($facturas) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';
   

		for( $i = 0; $i < count($facturas); $i++)
		{	
			$sumatoria = ControladorParametros::ctrSumatoria($facturas[$i]["inversion"], $facturas[$i]["iva"]);
			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerFactura' idFactura='".$facturas[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarFactura' idFactura='".$facturas[$i]["id"]."' title='Editar Factura'><i class='fa fa-pencil'></i></button></div></div>";

			$item = "id";
		    $valor = $facturas[$i]["id_proveedor"];
		    $fecha = ControladorParametros::ctrOrdenFecha($facturas[$i]["fecha"], 0);
		    $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);
		    $cantidadInsumos = ControladorParametros::ctrContarInsumos($facturas[$i]["insumos"]);
	    	$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$facturas[$i]["codigoInt"].'",
	    		"'.$facturas[$i]["codigo"].'",
	    		"'.$proveedor["razonSocial"].'",
	    		"'.$cantidadInsumos.'",
	    		"'.$sumatoria.'",
	    		"'.$fecha.'",
	    		"'.$acciones.'"
	    		],';

		}//For
		$dJson = substr($dJson, 0 ,-1);
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

$verFacturas = new TablaFacturas();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$verFacturas -> fechaInicial = null;
		$verFacturas -> fechaFinal = null;
	}
	else
	{
		$verFacturas -> fechaInicial = $_GET["fechaInicial"];
		$verFacturas -> fechaFinal = $_GET["fechaFinal"];
	}
		$verFacturas -> mostrarTablaFacturas();
}
else
{
	$verFacturas -> fechaInicial = null;
	$verFacturas -> fechaFinal = null;
	$verFacturas -> mostrarTablaFacturas();
}

