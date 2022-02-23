<?php
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";

require_once "../controladores/proyectos.controlador.php";
require_once "../modelos/proyectos.modelo.php";

		
class Tablaareas
{	
	public $pro;

	public function mostrarTablaareas()
	{	  
		  $sw = $this->pro;
	      $areas = ControladorAreas::ctrMostrarAreas(null, null);
	      $dJson = '{"data": [';

	    if ( count($areas) == 0) 
	    {  	echo'{"data": []}';	return; }


			if ($sw == null) 
			{
				for( $i = 0; $i < count($areas); $i++)
				{	
					$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerArea' title='Ver Area' idArea='".$areas[$i]["id"]."'><i class='fa fa-book'></i></button></div><div class='col-md-4'><button class='btn btn-warning btnEditarArea'  title='Editar Area' data-toggle='modal' data-target='#modalEditarArea' idArea='".$areas[$i]["id"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarArea' nomArea='".$areas[$i]["nombre"]."' idArea='".$areas[$i]["id"]."'><i class='fa fa-times'></i></button></div></div>";

				    $countPer = ControladorPersonas::ctrContarPersonas("id_area", $areas[$i]["id"]);
				    $rq = ControladorRequisiciones::ctrContarRqdeArea("id_area", $areas[$i]["id"]);

				    $dJson .='[
			    		"'.($i + 1).'",
			    		"'.$areas[$i]["nombre"].'",
			    		"'.$areas[$i]["descripcion"].'",
			    		"'.$rq[0].'",
			    		"'.$countPer.'",
			    		"'.$acciones.'"
			    		],';
				}//For
			}
			else
			{
				$proyecto = ControladorProyectos::ctrMostrarAsignacionArea("id_proyecto", $sw);

				$sw2 = 0;

				if ($proyecto == "ok") 
				{
					$sw2 = 1;
				}
				else
				{
					if (isset($proyecto["id_areas"])) {
						if (is_null($proyecto["id_areas"])) 
					{
						$sw2 = 1;
					}
					else
					{
						if (empty($proyecto["id_areas"])) {
							$sw2 = 1;
						}
						else
						{
							$listadoAreas = json_decode($proyecto["id_areas"], true);

								foreach ($listadoAreas as $key => $value) 
								{
									for ($i=0; $i < count($areas); $i++) 
									{ 
										if ($value["id"] != $areas["id"]) 
										{
											$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnAddArea RegresarBoton' title='Asociar' idArea='".$areas[$i]["id"]."'><i class='fa fa-plus'></i></button></div></div>";
										}
										else
										{
											$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-danger btnAddArea RegresarBoton' title='Desasociar' idArea='".$areas[$i]["id"]."'><i class='fa fa-close'></i></button></div></div>";
										}

										$dJson .='[
							    		"'.($i + 1).'",
							    		"'.$areas[$i]["nombre"].'",
							    		"'.$acciones.'"
							    		],';
									}
								}
							}
						}
					}
					else
					{
						$sw2 = 1;
					}

				}

				if ($sw2 == 1) 
				{
					for( $i = 0; $i < count($areas); $i++)
					{	
						$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnAddArea RegresarBoton' title='Asociar' idArea='".$areas[$i]["id"]."'><i class='fa fa-plus'></i></button></div></div>";

						 $dJson .='[
				    		"'.($i + 1).'",
				    		"'.$areas[$i]["nombre"].'",
				    		"'.$acciones.'"
				    		],';
					}//For
				}
	
		}
		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}


if (isset($_GET["idProy"])) 
{
	$verareas = new Tablaareas();
	$verareas -> pro = $_GET["idProy"];
	$verareas -> mostrarTablaareas();
}
else
{
	$verareas = new Tablaareas();
	$verareas -> pro = null;
	$verareas -> mostrarTablaareas();
}