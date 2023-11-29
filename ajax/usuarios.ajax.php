<?php
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";
class AjaxUsuarios
{

	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		$respuestad = ControladorParametros::ctrVerPerfil($respuesta["perfil"]);
		$respuesta["nomperfil"] = $respuestad["perfil"];
		echo json_encode($respuesta);

	}

	public $validarUsuario;
	public function ajaxValidarUsuario($item, $valor){
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

$usuarioVal = new AjaxUsuarios();

if(isset($_POST["idUsuario"]))
{
	$usuarioVal -> idUsuario = $_POST["idUsuario"];
	$usuarioVal -> ajaxEditarUsuario();
}

if(isset( $_POST["validarUsuario"]))
{
	$usuarioVal -> ajaxValidarUsuario("usuario", $_POST["validarUsuario"]);
}


if(isset( $_POST["validarDNI"]))
{	
	$usuarioVal -> ajaxValidarUsuario("dni", $_POST["validarDNI"]);
}

if(isset($_POST["activarUsuario"]))
{
	$usuarioVal -> activarUsuario = $_POST["activarUsuario"];
	$usuarioVal -> activarId = $_POST["activarId"];
	$usuarioVal -> ajaxActivarUsuario();
}