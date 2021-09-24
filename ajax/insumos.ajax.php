<?php
require_once "../controladores/categorias.controlador.php";
require_once "../controladores/insumos.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../modelos/insumos.modelo.php";
class AjaxInsumos
{	public $idInsumo;
	public function ajaxEditarInsumo()
	{	$item = "id";
		$valor = $this->idInsumo;
		$respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);
		$valor = $respuesta["id_categoria"];
		$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
		array_push($respuesta, $categorias["categoria"]);
		echo json_encode($respuesta);
	}#ajaxEditarInsumo
	public $validarInsumo;
	public function ajaxValidarInsumo(){
		$item = "codigo";
		$valor = $this->validarInsumo;
		$respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);
		echo json_encode($respuesta);
	}#ajaxValidarInsumo

	public function ajaxNwCodigoInsumo(){
		$item = "codigo";
        $valor = 1;
        do{$respuesta = ControladorInsumos::ctrMostrarInsumos($item, $valor);
          if($respuesta != null)
          {$valor++;}
        }while($respuesta != null);
		echo json_encode($valor);	
	}#ajaxNwCodigoInsumo
}
if(isset($_POST["idInsumo"]))
{	$editar = new AjaxInsumos();
	$editar -> idInsumo = $_POST["idInsumo"];
	$editar -> ajaxEditarInsumo();}
if(isset( $_POST["validarInsumo"]))
{	$valInsumo = new AjaxInsumos();
	$valInsumo -> validarInsumo = $_POST["validarInsumo"];
	$valInsumo -> ajaxValidarInsumo();}
if(isset( $_POST["nuevoCodigo"]))
{	$nuevoCodigo = new AjaxInsumos();
	$nuevoCodigo -> ajaxNwCodigoInsumo();}

