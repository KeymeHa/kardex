<?php
require_once "../controladores/areas.controlador.php";
require_once "../controladores/personas.controlador.php";
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/areas.modelo.php";
require_once "../modelos/personas.modelo.php";
require_once "../modelos/usuarios.modelo.php";
class AjaxPersonas
{	public $idPer;
	public function ajaxEditarPersona()
	{	$valor = $this->idPer;
		$item = "id_usuario";
		$persona = ControladorPersonas::ctrMostrarPersonas($item, $valor);
		$item = "id";
		$area = ControladorAreas::ctrMostrarNombreAreas($item, $persona["id_area"]);
		$usuario = ControladorUsuarios::ctrMostrarNombre($item, $persona["id_usuario"]);
		$respuesta["id_area"] =  $persona["id_area"];
		$respuesta["id"] =  $valor;
		$respuesta["area"] =  $area;
		$respuesta["nombre"] =  $usuario;
		echo json_encode($respuesta);
	}#ajaxEditarPersona


	public function ajaxLlamarPersonas()
	{	
		$respuesta = ControladorPersonas::ctrMostrarListaPersonas();
		echo json_encode($respuesta);
	}#ajaxEditarPersona

	public function ajaxTraerIdArea($id_persona)
	{	
		$respuesta = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $id_persona);
		echo json_encode($respuesta);
	}#ajaxEditarPersona
}
if(isset($_POST["idper"]))
{	$editar = new AjaxPersonas();
	$editar -> idPer = $_POST["idper"];
	$editar -> ajaxEditarPersona();}

if(isset($_POST["llamar"]))
{	$editar = new AjaxPersonas();
	$editar -> ajaxLlamarPersonas();}

if(isset($_POST["traerId_Area"]))
{	$traer = new AjaxPersonas();
	$traer -> ajaxTraerIdArea($_POST["traerId_Area"]);}

