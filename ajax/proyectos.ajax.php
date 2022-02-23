<?php
require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../controladores/proyectos.controlador.php";
require_once "../modelos/proyectos.modelo.php";
class AjaxProyecto
{
	public $idProy;
	public function ajaxEditarProyecto()
	{
		$item = "id";
		$valor = $this->idProy;
		$respuesta = ControladorProyectos::ctrMostrarProyectos($item, $valor);
		echo json_encode($respuesta);
	}

	public function ajaxAddAreaProyecto($idArea, $idProy, $sw)
	{
		$respuesta = ControladorProyectos::ctrAsignarAreaaProyectos($idArea, $idProy, $sw);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idProy"]))
{
	$editar = new AjaxProyecto();
	$editar -> idProy = $_POST["idProy"];
	$editar -> ajaxEditarProyecto();
}
if(isset($_POST["idArea"]))
{
	$add = new AjaxProyecto();
	$add -> ajaxAddAreaProyecto($_POST["idArea"], $_POST["idProy"], $_POST["sw"]);
}

