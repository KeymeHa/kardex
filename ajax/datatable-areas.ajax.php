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

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

		
class Tablaareas
{	
	public $id_fk;
	public $tipo;
	public $anioActual;

	public function mostrarTablaareas()
	{	  
		  $sw = $this->id_fk;
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
				    $rq = ControladorRequisiciones::ctrContarRqdeArea("id_area", $areas[$i]["id"], $this->anioActual);

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

				if ($this->tipo == "pro") 
				{
					$datos = ControladorProyectos::ctrMostrarAsignacionArea("id_proyecto", $sw);
				}//if id_fk
				else
				{
					$datos = ControladorCategorias::ctrMostrarPermisoArea("id_categorias", $sw);
				}//else

				$sw2 = 0;

				if ($datos == "ok") 
				{
					$sw2 = 1;
				}
				else
				{
					if (isset($datos["id_areas"])) {
						if (is_null($datos["id_areas"])) 
					{
						$sw2 = 1;
					}
					else
					{
						if (empty($datos["id_areas"])) {
							$sw2 = 1;
						}
						else
						{
							$arrayId = [];

							$listadoAreas = json_decode($datos["id_areas"], true);

								for ($i=0; $i < count($areas); $i++) 
								{ 
									$j = 0;
					                  $sw3 = false;

					                  while ($j < count($listadoAreas) && $sw3 == false) 
					                  {
					                    if ($areas[$i]["id"] == $listadoAreas[$j]["id"]) 
					                    {
					                      $sw3 = true;
					                    }
					                    else
					                    {
					                      $j++;
					                    }
					                  }

					                  if ($sw3 != true) 
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

			
	
			}//else
		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verareas = new Tablaareas();

if (isset($_GET["idProy"])) 
{
	$verareas -> id_fk = $_GET["idProy"];
	$verareas -> tipo = "pro";
}
else
{
	$verareas -> tipo = null;
	$verareas -> id_fk = null;
}

if (isset($_GET["idCategoria"])) 
{
	$verareas -> id_fk = $_GET["idCategoria"];
	$verareas -> tipo = "cat";
}
else
{
	$verareas -> tipo = null;
	$verareas -> id_fk = null;
}

if (isset($_GET["actual"])) 
{
	$verareas -> anioActual = $_GET["actual"];
}
else
{
	$verareas -> anioActual = 0;
}

$verareas -> mostrarTablaareas();