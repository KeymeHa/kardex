<?php
require_once "../controladores/areas.controlador.php";
require_once "../controladores/personas.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../modelos/personas.modelo.php";
class AjaxPersonas
{	public $idPer;
	public function ajaxEditarPersona()
	{	$valor = $this->idPer;
		$item = "id";
		$respuesta = ControladorPersonas::ctrMostrarPersonas($item, $valor);
		$area = ControladorAreas::ctrMostrarAreas($item, $respuesta["id_area"]);
		array_push($respuesta, $area["nombre"]);
		echo json_encode($respuesta);
	}#ajaxEditarPersona
}
if(isset($_POST["idper"]))
{	$editar = new AjaxPersonas();
	$editar -> idPer = $_POST["idper"];
	$editar -> ajaxEditarPersona();}