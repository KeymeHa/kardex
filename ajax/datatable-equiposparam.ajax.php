<?php

require_once "../controladores/equipos.controlador.php";
require_once "../modelos/equipos.modelo.php";

class TablaParametros
{
	static public function mostrarTablaParametros($campo, $tipo)
	{
		 $parametro = ControladorEquipos::ctrMostrarParametros($campo, $tipo);
		 $dJson = '{"data": [';

	    if ( count($parametro) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($parametro); $i++)
		{	

			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btn-Parametro' title='Editar Parametro' data-toggle='modal' data-target='#modalParametro' nombreParam='".$parametro[$i]["nombre"]."' tipoAcc='1' tipoId='".$parametro[$i]["id"]."' tipo='".$tipo."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btn-ParametroElim' title='Eliminar Parametro' tipoId='".$parametro[$i]["id"]."' nombreParam='".$parametro[$i]["nombre"]."' tipo='".$tipo."'><i class='fa fa-close'></i></button></div></div>";			

		    $dJson .='[
	    		"'.($i+1).'",
	    		"'.$parametro[$i]["nombre"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

$paramE = new TablaParametros();
$paramE -> mostrarTablaParametros($_GET["item"], $_GET["id"]);