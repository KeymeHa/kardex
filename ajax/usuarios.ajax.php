<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
class AjaxUsuarios
{

	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

		echo json_encode($respuesta);

	}

	public $validarUsuario;
	public function ajaxValidarUsuario(){
		$item = "usuario";
		$valor = $this->validarUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);
	}#validarUsuario

	public $activarUsuario;
	public $activarId;
	public function ajaxActivarUsuario(){

		$tabla = "usuarios";
		$item1 = "estado";
		$valor1 = $this->activarUsuario;
		$item2 = "id";
		$valor2 = $this->activarId;
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, "try", 0, $item2, $valor2);

	}
	
}

/*

	OBJETOS EDITAR USUARIO

 */

if(isset($_POST["idUsuario"]))
{
	$editar = new AjaxUsuarios();
	$editar -> idUsuario = $_POST["idUsuario"];
	$editar -> ajaxEditarUsuario();
}

if(isset( $_POST["validarUsuario"]))
{	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();}

if(isset($_POST["activarUsuario"])){
	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}