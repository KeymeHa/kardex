<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/ventas.controlador.php";
require_once "../modelos/ventas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaClientes
{
	
	static public function mostrarTablaClientes()
	{
		 $clientes = ControladorClientes::ctrMostrarClientes(null, null);
		 $dJson = '{"data": [';

	    if ( count($clientes) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($clientes); $i++)
				{	
					$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerCliente' title='Ver Cliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-book'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarCliente'  title='Editar Cliente' data-toggle='modal' data-target='#modalEditarCliente' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarCliente' nomCliente='".$clientes[$i]["nombre"]."' idCliente='".$clientes[$i]["id"]."'><i class='fa fa-times'></i></button></div></div>";

					$count = ControladorVentas::ctrContarVentasxCliente("id_cli", $clientes[$i]["id"]);


				    $dJson .='[
			    		"'.($i + 1).'",
			    		"'.$clientes[$i]["nombre"].'",
			    		"'.$clientes[$i]["sid"].'",
			    		"'.$clientes[$i]["telefono"].'",
			    		"'.$clientes[$i]["correo"].'",
			    		"'.$count.'",
			    		"'.$acciones.'"
			    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;
	}
}


$verCliente = new TablaClientes();
$verCliente -> mostrarTablaClientes();