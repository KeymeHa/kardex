<?php

include "../controladores/equipos.controlador.php";
include "../modelos/equipos.modelo.php";

class TablaLicencias
{
	public static function mostrarTabla()
	{
		$licencias = ControladorEquipos::ctrMostrarLicencias(null, null);

		if (count($licencias) == 0) 
		{
			echo'{"data": []}';	return;
		}

		$dJson = '{"data": [';

		for ($i=0; $i < count($licencias) ; $i++) 
		{ 
		
			$contador = ControladorEquipos::ctrContarUsoLicencias($licencias[$i]["id"]);

			$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarLicencia' idLicencia='".$licencias[$i]["id"]."' title='Editar Licencia' data-toggle='modal' data-target='#modalLicencia'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarLicencia' idLicencia='".$licencias[$i]["id"]."' nombre='".$licencias[$i]["usuario"]."' title='Eliminar Licencia'><i class='fa fa-close'></i></button></div></div>";

			$fecha = new DateTime($licencias[$i]["fecha_creacion"]);

			$dJson .='[
			"'.($i + 1).'",
			"'.$licencias[$i]["usuario"].'",
			"'.$licencias[$i]["password"].'",
			"'.$contador[0].'",
			"'.$licencias[$i]["productos"].'",
			"'.$fecha->format("m-d-Y").'",
			"'.$acciones.'"
			],';	

		}

		$dJson = substr($dJson, 0 ,-1);
	    $dJson.= ']
		}';
		echo $dJson;

	}//mostrarTabla
}



$mostrar = new TablaLicencias();
$mostrar -> mostrarTabla();