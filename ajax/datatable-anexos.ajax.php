<?php
require_once "../controladores/anexos.controlador.php";
require_once "../modelos/anexos.modelo.php";
		
class tablaAnexos
{	
	public $idCar;
	public function mostrarTablaAnexos()
	{	  
		$valor = $this->idCar;
		$item = "id_carpeta";

		if($valor != 0)
		{
	    	$anexos = ControladorAnexos::ctrMostrarArchivos($item, $valor);
		}
		else
		{
			echo'{"data": []}';	return;
		}

	      
	    if ( count($anexos) == 0) 
	    {  	echo'{"data": []}';	return; }

	    $dJson = '{"data": [';
		
		for( $i = 0; $i < count($anexos); $i++)
		{	

		   $acciones = "<a href='vistas/documentos/".$anexos[$i]["ruta"]."'><button class='btn btn-success btnVerAnexo' title='Ver Archivos' id_anexo='".$anexos[$i]["id"]."' nombre_anexo='".$anexos[$i]["nombre"]."'><i class='fa fa-folder'></i></button></a><button class='btn btn-warning btnEditarAnexo' id_anexo='".$anexos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarAnexo' title='Editar'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarAnexo' id_anexo='".$anexos[$i]["id"]."' nombre_anexo='".$anexos[$i]["nombre"]."' title='Eliminar'><i class='fa fa-trash'></i></button>";

		 
	   		$dJson .='[
    		"'.($i + 1).'",
    		"'.$anexos[$i]["nombre"].'",
    		"'.$anexos[$i]["fecha"].'",
    		"'.$acciones.'"
    		],';
		    
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verCarpetas = new tablaAnexos();

if( isset($_GET["idCar"]))
{
	$verCarpetas -> idCar = $_GET["idCar"];
	$verCarpetas -> mostrarTablaAnexos();
}