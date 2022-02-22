<?php


require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/personas.modelo.php";
class AjaxAreas
{

	public $idArea;

	public function ajaxEditarArea()
	{
		$item = "id";
		$valor = $this->idArea;
		$respuesta = ControladorAreas::ctrMostrarAreas($item, $valor);
		echo json_encode($respuesta);
	}


	public $idArea2;
	public function ajaxContarPer()
	{
		$item = "id_area";
		$valor = $this->idArea2;
		$respuesta = ControladorPersonas::ctrContarPersonas($item, $valor);
		echo json_encode($respuesta);
	}


	public function ajaxTraerAreas()
	{
		$respuesta = ControladorAreas::ctrMostrarAreas(null, null);
		echo json_encode($respuesta);
	}
	
}

if(isset($_POST["idArea"]))
{
	$editar = new AjaxAreas();
	$editar -> idArea = $_POST["idArea"];
	$editar -> ajaxEditarArea();
}

if(isset($_POST["idArea2"]))
{
	$contarPer = new AjaxAreas();
	$contarPer -> idArea2 = $_POST["idArea2"];
	$contarPer -> ajaxContarPer();
}

if(isset($_POST["traer"]))
{
	$contarPer = new AjaxAreas();
	$contarPer -> ajaxTraerAreas();
}