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
{	$nombreCar = new ajaxAnexos();
	$nombreCar -> idCar = $_POST["idCar"];
	$nombreCar -> ajaxMostrarCarpeta();}
if(isset($_POST["idCarElim"]))
{	$nombreCar = new ajaxAnexos();
	$nombreCar -> idCarElim = $_POST["idCarElim"];
	$nombreCar -> ajaxElimCarpeta();}
if(isset($_POST["idAnexo"]))
{	$nombreCar = new ajaxAnexos();
	$nombreCar -> idAnexo = $_POST["idAnexo"];
	$nombreCar -> ajaxMostrarAnexo();}
if(isset($_POST["idAnexoElim"]))
{	$nombreCar = new ajaxAnexos();
	$nombreCar -> idAnexoElim = $_POST["idAnexoElim"];
	$nombreCar -> ajaxEliminarAnexo();}


