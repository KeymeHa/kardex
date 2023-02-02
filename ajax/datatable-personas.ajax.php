<?php
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

		
class Tablapersonas
{	
	public $idArea;
	public $anioActual;
	public $gatillo;
	public function mostrarTablapersonas()
	{	  
		$sw = $this->gatillo;

		$valor = $this->idArea;

			if ($valor == null) 
			{
				$personas = ControladorPersonas::ctrMostrarPersonas(null, null);	
			}
			else
			{
				$item = "id_area";
				$sw = 1;
			    $personas = ControladorPersonas::ctrMostrarPersonasArea($item, $valor);
			}


	      
	      $dJson = '{"data": [';

	    if (count($personas) == 0 || count($personas[0]) == 0) 
	    {  	echo'{"data": []}';	return; }

		for( $i = 0; $i < count($personas); $i++)
		{	
           $areas = ControladorAreas::ctrMostrarAreas("id", $personas[$i]["id_area"]);
           $usuario = ControladorUsuarios::ctrMostrarNombre("id", $personas[$i]["id"]);
		   $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning btnEditarPer'  title='Editar persona' data-toggle='modal' data-target='#modalEditarPersona' idper='".$personas[$i]["id"]."' idAr='".$personas[$i]["id_area"]."'><i class='fa fa-pencil'></i></button></div><div class='col-md-4'><button class='btn btn-danger btnEliminarPer' title='Eliminar' idper='".$personas[$i]["id"]."' nomper='".$usuario["nombre"]."'><i class='fa fa-times'></i></button></div></div>";

		   $rq = ControladorRequisiciones::ctrContarRqdeArea("id_persona", $personas[$i]["id"], $this->anioActual);


		   if ($sw == 0) 
		   {
		   		$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$usuario["nombre"].'",
	    		"'.$areas["nombre"].'",
	    		"'.$rq[0].'",
	    		"'.$acciones.'"
	    		],';
		   }
		   elseif($sw == 1)
		   {
		   		$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$personas[$i]["nombre"].'",
	    		"'.$rq[0].'",
	    		"'.$acciones.'"
	    		],';
		   }
		   elseif($sw == 4)
		   {

		   		$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success agregarPersona RegresarBotonE' type='button' encargado='".$personas[$i]["nombre"]."'  title='Seleccionar a ".$personas[$i]["nombre"]."'  idper='".$personas[$i]["id"]."' idAr='".$personas[$i]["id_area"]."'><i class='fa fa-check'></i></button></div></div>";

		   		$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$personas[$i]["nombre"].'",
	    		"'.$areas["nombre"].'",
	    		"'.$acciones.'"
	    		],';
		   }

		    
		}//For

		$dJson = substr($dJson, 0 ,-1);  
	    $dJson.= ']
		}';
		echo $dJson;

	}
}

$verpersonas = new Tablapersonas();

if( isset($_GET["idArea"]))
{
	$verpersonas -> idArea = $_GET["idArea"];
}
else
{
	$verpersonas -> idArea = null;
}

if (isset($_GET["actual"])) 
{
	$verpersonas -> anioActual = $_GET["actual"];
}
else
{
	$verpersonas -> anioActual = 0;
}


//sirve para omitir ciertas columnas como requisiciones y acciones
if (isset($_GET["sw"])) 
{
	$verpersonas -> gatillo = $_GET["sw"];
}
else
{
	$verpersonas -> gatillo = 0;
}

$verpersonas -> mostrarTablapersonas();