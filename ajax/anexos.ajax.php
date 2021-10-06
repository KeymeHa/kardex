<?php
require_once "../controladores/anexos.controlador.php";
require_once "../modelos/anexos.modelo.php";
class ajaxAnexos
{	public $idCar;
	public function ajaxMostrarCarpeta()
	{	$item = "id";
		$valor = $this->idCar;
		$respuesta = ControladorAnexos::ctrMostrarCarpetas($item, $valor);
		echo json_encode($respuesta);
	}#ajaxMostrarCarpeta
	public $idCarElim;
	public function ajaxElimCarpeta()
	{	$item = "id_carpeta";
		$valor = $this->idCarElim;
		$respuesta = ControladorAnexos::ctrContarAnexos($item, $valor);
		echo json_encode($respuesta);
	}#ajaxElimCarpeta
	public $idAnexo;
	public function ajaxMostrarAnexo()
	{	$item = "id";
		$valor = $this->idAnexo;
		$respuesta = ControladorAnexos::ctrMostrarArchivos($item, $valor);
		echo json_encode($respuesta);
	}#ajaxMostrarAnexo
	public $idAnexoElim;
	public function ajaxEliminarAnexo()
	{	$item = "id";
		$valor = $this->idAnexoElim;
		$respuesta = ControladorAnexos::ctrEliminarAnexo($item, $valor);
		echo json_encode($respuesta);
	}#ajaxEliminarAnexo
}
if(isset($_POST["idCar"]))
{	$editarCar = new ajaxAnexos();
	$editarCar -> idCar = $_POST["idCar"];
	$editarCar -> ajaxMostrarCarpeta();}
if(isset($_POST["idCarElim"]))
{	$eliminarCar = new ajaxAnexos();
	$eliminarCar -> idCarElim = $_POST["idCarElim"];
	$eliminarCar -> ajaxElimCarpeta();}
if(isset($_POST["idAnexo"]))
{	$editarAnex = new ajaxAnexos();
	$editarAnex -> idAnexo = $_POST["idAnexo"];
	$editarAnex -> ajaxMostrarAnexo();}
if(isset($_POST["idAnexoElim"]))
{	$eliminarAnex = new ajaxAnexos();
	$eliminarAnex -> idAnexoElim = $_POST["idAnexoElim"];
	$eliminarAnex -> ajaxEliminarAnexo();}


