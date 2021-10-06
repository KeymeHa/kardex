<?php
require_once "../controladores/anexos.controlador.php";
require_once "../modelos/anexos.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

		
class tablaCarpetas
{	
	public $idProv;
	public function mostrarTablaCarpetas()
	{	  
		$valor = $this->idProv;
		$item = "id_prov";
	    $carpetas = ControladorAnexos::ctrMostrarCarpetas($item, $valor);
	      
	    if ( count($carpetas) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';
		
		for( $i = 0; $i < count($carpetas); $i++)
		{	

		   $acciones = "<button class='btn btn-success btnVerArchivos' title='Ver Archivos' id_carpeta='".$carpetas[$i]["id"]."' nombre_carpeta='".$carpetas[$i]["nombre"]."'><i class='fa fa-folder'></i></button><button class='btn btn-warning btnEditarCarpeta' id_carpeta='".$carpetas[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCarpeta'  nombre_carpeta='".$carpetas[$i]["nombre"]."' title='Editar'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCarpeta' id_carpeta='".$carpetas[$i]["id"]."' nombre_carpeta='".$carpetas[$i]["nombre"]."' title='Eliminar'><i class='fa fa-trash'></i></button>";

		   	$cantidadArchivos = ControladorAnexos::ctrContarAnexos("id_carpeta", $carpetas[$i]["id"]);
		   	$fecha = ControladorParametros::ctrOrdenFecha($carpetas[$i]["fecha"], 3);

		   		$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$carpetas[$i]["nombre"].'",
	    		"'.$cantidadArchivos[0].'",
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

$verCarpetas = new tablaCarpetas();

if( isset($_GET["idProv"]))
{
	$verCarpetas -> idProv = $_GET["idProv"];
	$verCarpetas -> mostrarTablaCarpetas();
}