<?php
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

class TablaParametros
{
	
	static public function mostrarTablaModulos()
	{
		 $modulos = ControladorParametros::ctrVerModulos();
		 $dJson = '{"data": [';

	    if ( count($modulos) == 0) 
	    {  	echo'{"data": []}';	return; }


		for( $i = 0; $i < count($modulos); $i++)
		{	

			if ($modulos[$i]["sw"] == 0) 
			{
				$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-danger btn-param' title='Click para Activar' idPag='".$modulos[$i]["id"]."'>Desactivado</button></div></div>";
			}
			else
			{
				$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btn-param' title='Click para Desactivar' idPag='".$modulos[$i]["id"]."'>Activado</button></div></div>";
			}

			

		    $dJson .='[
	    		"'.$modulos[$i]["title"].'",
	    		"'.$modulos[$i]["descripcion"].'",
	    		"'.$acciones.'"
	    		],';
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;
	}
}

$params = new TablaParametros();

if (isset($_GET["verMod"])) 
{
	$params -> mostrarTablaModulos();
}
