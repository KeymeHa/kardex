<?php
require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class TablaDispositivos
{	public function mostrarDispositivos()
	{	  
		  $item = null;
	      $valor = null;
	      $dispositivos = ControladorEquipos::ctrMostrarDispositivos($item, $valor);
	      $dJson = '{"data": [';

	    if ( count($dispositivos) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($dispositivos); $i++)
		{	
			
		    $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarDevice'  title='Editar Dispositivo' data-toggle='modal' data-target='#modalEditarDevice' idDevice='".$dispositivos[$i]["id"]."' nombre='".$dispositivos[$i]["modelo"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarDispositivo' idDevice='".$dispositivos[$i]["id"]."' nombreDispositivo='".$dispositivos[$i]["nombre"]."' title='Dar de baja'><i class='fa fa-user-times'></i></button></div></div>";

		    $dJson .='[
	    		"'.($i + 1).'",
	    		"'.ControladorEquipos::ctrMostrarParametros("id", $dispositivos[$i]["tipo_dispositivo"], 1).'",
	    		"'.$dispositivos[$i]["n_serie"].'",
	    		"'.$dispositivos[$i]["modelo"].'",
	    		"'.$dispositivos[$i]["caracteristicas"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$mostrar = new TablaDispositivos();
$mostrar -> mostrarDispositivos();