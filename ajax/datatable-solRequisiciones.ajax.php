<?php
require_once "../controladores/requisiciones.controlador.php";
require_once "../modelos/requisiciones.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/proyectos.controlador.php";
require_once "../modelos/proyectos.modelo.php";

class TablaRequisiciones
{
	public $fechaInicial;
	public $fechaFinal;
	public $iduser;
	public $anioActual;

	public function mostrarTablaRq()
	{

		$sw = $this->iduser;

		if($this->fechaInicial != null)
		{
			$requisiciones = ControladorRequisiciones::ctrMostrarRequisicionesRangoId($this->fechaInicial, $this->fechaFinal, $sw);
		}
		else
		{
			$requisiciones = ControladorRequisiciones::ctrMostrarRequisicionesId(null, null, $sw);
		}

	    $dJson = '{
	    	"data": [';

	    if ( count($requisiciones) == 0) 
	    {
	    	echo'{"data": []}';
	    	return;
	    }

	    for ($i=0; $i < count($requisiciones); $i++) 
	    {
           	$item = "id";
            $valor =  $requisiciones[$i]["id_persona"];
            $usuario = ControladorUsuarios::ctrMostrarNombre($item, $valor);
            $valor = $requisiciones[$i]["id_area"];
            $area = ControladorAreas::ctrMostrarAreas($item, $valor);

            $cantidadInsumos = ControladorParametros::ctrContarInsumos($requisiciones[$i]["insumos"]);
            $proyecto = ControladorProyectos::ctrMostrarNombreProyectos("id",$requisiciones[$i]["id_proyecto"]);
            $acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerSoli' idRq='".$requisiciones[$i]["id"]."' title='Ver'><i class='fa fa-book'></i> Ver</button></div></div>";

            if ($requisiciones[$i]["aprobado"] == 0) 
            {
            	$estado = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-warning' title='Falta aprobación por parte de compras'>En espera</button></div></div>";
            }
            else
            {
            	$estado = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success' title='Ya fue aprobada esta requisición'>Aprobado</button></div></div>";
            }


		  	$fecha = ControladorParametros::ctrOrdenFecha($requisiciones[$i]["fecha_sol"], 0);

	    	$dJson .='[
	    		"'.($i + 1).'",
	    		"'.$requisiciones[$i]["codigoInt"].'",
	    		"'.$proyecto['nombre'].'",
	    		"'.$area['nombre'].'",
	    		"'.$cantidadInsumos.'",
	    		"'.$fecha.'",
	    		"'.$estado.'",
	    		"'.$acciones.'"
	    		],';

	    }
	    
	    $dJson = substr($dJson, 0 ,-1);
	    
	    $dJson.= ']

		}';

		echo $dJson;

	}
}

$mostrarRq = new TablaRequisiciones();

if( isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]) )
{

	if($_GET["fechaInicial"] == "undefined")
	{
		$mostrarRq -> fechaInicial = null;
		$mostrarRq -> fechaFinal = null;
		if ( isset($_GET["actual"]) ) 
	    {
	      $mostrarRq -> anioActual = $_GET["actual"];
	    }
	}
	else
	{
		$mostrarRq -> fechaInicial = $_GET["fechaInicial"];
		$mostrarRq -> fechaFinal = $_GET["fechaFinal"];
	}
}
else
{
	if ( isset($_GET["actual"]) ) 
    {
      $mostrarRq -> anioActual = $_GET["actual"];
    }
	$mostrarRq -> fechaInicial = null;
	$mostrarRq -> fechaFinal = null;
	
}

if (isset($_GET["iduser"])) 
{
	$mostrarRq -> iduser = $_GET["iduser"];
}
else
{
	$mostrarRq -> iduser = null;
}

$mostrarRq -> mostrarTablaRq();