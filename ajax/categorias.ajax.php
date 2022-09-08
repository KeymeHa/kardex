<?php


require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

/**
 * 
 */
class AjaxCategorias
{
	/*
	
	VARIABLES PUBLICAS

	 */
	
	public $idCategoria;

	

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	public function ajaxContarInsumos(){

		$item = "id_categoria";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrContarInsumos($item, $valor);

		echo json_encode($respuesta);

	}

	public function ajaxAddAreaCategoria($idArea, $idCat, $sw)
	{
		$respuesta = ControladorCategorias::ctrAsignarAreaaCategorias($idArea, $idCat, $sw);
		echo json_encode($respuesta);
	}
	
	public function ajaxMostrarCat(){

		$item = null;
		$valor = null;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		echo json_encode($respuesta);

	}
	
}

if(isset($_POST["idCategoria"]))
{
	$editar = new AjaxCategorias();
	$editar -> idCategoria = $_POST["idCategoria"];
	$editar -> ajaxEditarCategoria();
}

if(isset($_POST["idArea"]))
{
	$add = new AjaxCategorias();
	$add -> ajaxAddAreaCategoria($_POST["idArea"], $_POST["idCategoria"], $_POST["sw"]);
}

if(isset($_POST["idCategoria2"]))
{
	$verificarIns = new AjaxCategorias();
	$verificarIns -> idCategoria = $_POST["idCategoria2"];
	$verificarIns -> ajaxContarInsumos();
}

if(isset($_POST["traerCat"]))
{
	$mostrarCat = new AjaxCategorias();
	$mostrarCat -> ajaxMostrarCat();
}