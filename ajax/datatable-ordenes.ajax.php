<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../controladores/parametros.controlador.php";
require_once "../controladores/ordencompra.controlador.php";
require_once "../modelos/proveedores.modelo.php";
require_once "../modelos/ordenCompra.modelo.php";

class TablaOrdenes
{	
	public $fechaInicial;
	public $fechaFinal;
	public function mostrarTablaOrdenes()
	{	
		$fechaIn = $this->fechaInicial;
		$fechaOut = $this->fechaFinal;

		if($fechaIn != null)
		{
			$ordenes = ControladorOrdenCompra::ctrMostrarOrdenesdeComprasRango($fechaIn, $fechaOut);
		}
		else
		{
			$ordenes = ControladorOrdenCompra::ctrMostrarOrdenesdeCompras(null, null);
		}

	    if ( count($ordenes) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';
   

		for( $i = 0; $i < count($ordenes); $i++)
		{	
			$item = "id";
		    $valor = $ordenes[$i]["id_proveedor"];
		    $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);
			$sumatoria = ControladorParametros::ctrSumatoria($ordenes[$i]["inversion"], $ordenes[$i]["iva"]);
			$acciones = "<div class='btn-group'><button class='btn btn-info btnVerOrden' sw='0' idOC='".$ordenes[$i]["id"]."' title='Ver Orden'><i class='fa fa-file-o'></i></button><button class='btn btn-success btnOrdenPDF' idOC='".$ordenes[$i]["id"]."' title='Descargar PDF'><i class='fa fa-download'></i></button><button class='btn btn-warning btnEditarOrden' idOC='".$ordenes[$i]["id"]."' title='Editar Orden'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarOrden' idOC='".$ordenes[$i]["id"]."' cd='".$ordenes[$i]["codigoInt"]."' pr='".$proveedor["nombreComercial"]."' title='Eliminar'><i class='fa fa-close'></i></button></div>";

		    $fecha = ControladorParametros::ctrOrdenFecha($ordenes[$i]["fecha"], 0);
		    $cantidadInsumos = ControladorParametros::ctrContarInsumos($ordenes[$i]["insumos"]);

	    	$dJson .='[
	    		"'.($i + 1).'",
	    		"OC N°-'.$ordenes[$i]["codigoInt"].'",
	    		"'.$proveedor["nombreComercial"].'",
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


$mostrarOrdenes = new TablaOrdenes();
if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{
	if($_GET["fechaInicial"] == "undefined")
	{
		$mostrarOrdenes -> fechaInicial = null;
		$mostrarOrdenes -> fechaFinal = null;
	}
	else
	{
		$mostrarOrdenes -> fechaInicial = $_GET["fechaInicial"];
		$mostrarOrdenes -> fechaFinal = $_GET["fechaFinal"];
	}
		$mostrarOrdenes -> mostrarTablaOrdenes();
}
else
{
	$mostrarOrdenes -> fechaInicial = null;
	$mostrarOrdenes -> fechaFinal = null;
	$mostrarOrdenes -> mostrarTablaOrdenes();
}
