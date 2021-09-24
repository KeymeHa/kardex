<?php
class ControladorInsumos
{

	static public function ctrCrearInsumo(){

		if(isset($_POST["nuevaDescripcion"]))
		{

			if(preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"])){

			   	$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["eImagenP"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["eImagenP"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					$directorio = "vistas/img/productos/".$_POST["nuevoCodigo"];

					mkdir($directorio, 0755);

					if($_FILES["eImagenP"]["type"] == "image/jpeg"){

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["eImagenP"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["eImagenP"]["type"] == "image/png"){

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodigo"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["eImagenP"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "insumos";

				date_default_timezone_set('America/Bogota');

				$fecha = date('Y-m-d');
				$hora = date('H:i:s');

				$fechaActual = $fecha.' '.$hora;

				$desValidada = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDescripcion"]);

				if($_POST["nuevaObserInsu"] != null || $_POST["nuevaObserInsu"] != "")
				{
					$obsValidada = ControladorParametros::ctrValidarCaracteres($_POST["nuevaObserInsu"]);
				}
				else
				{
					$obsValidada = "";
				}



				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
							   "codigo" => $_POST["nuevoCodigo"],
							   "descripcion" => $desValidada,
							   "observacion" => $obsValidada,
							   "precio_compra" => $_POST["nuevoPrecioCompra"],
							   "estante" => $_POST["nuevoEstante"],
							   "nivel" => $_POST["nuevoNivel"],
							   "seccion" => $_POST["nuevaSeccion"],
							   "imagen" => $ruta,
							   "fecha" => $fechaActual,
							   "prioridad" => $_POST["nuevaPrioridad"]);

				$respuesta = ModeloInsumos::mdlIngresarInsumo($tabla, $datos);

				if($respuesta == "ok")
				{
					$tabla = "historial";

					$datos = array( "accion" => 1,
									"numTabla" => 2,
									"valorAnt" => $_POST["nuevaDescripcion"],
									"valorNew" => "",
									"id_usr" => $_POST["idUsr"]
									 );

					$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

					echo'<script>

						swal({
							  type: "success",
							  title: "El insumo ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})

						</script>';




				}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Error al registrar el nuevo insumo!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales (Comillas, comas, puntos) !",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "insumos";

							}
						})

			  	</script>';
			}
		}

	}//ctrCrearInsumo

	/*=============================================
				EDITAR INSUMO
	=============================================*/
	static public function ctrEditarInsumo()
	{
		if ( isset($_POST["eIdP"]) ) 
		{

			if($_POST["eEstanteP"] == null || $_POST["eEstanteP"] == "")
			{
				$eEstanteP = 0;
			}
			else
			{
				$eEstanteP = $_POST["eEstanteP"];
			}

			if($_POST["eNivelP"] == null || $_POST["eNivelP"] == "")
			{
				$eNivelP = 0;
			}
			else
			{
				$eNivelP = $_POST["eNivelP"];
			}

			if($_POST["eSeccionP"] == null || $_POST["eSeccionP"] == "")
			{
				$eSeccionP = 0;
			}
			else
			{
				$eSeccionP = $_POST["eSeccionP"];
			}
			/*
			if($_POST["ePrecioCompra"] == null || $_POST["ePrecioCompra"] == "")
			{
				$ePrecioCompra = 0;
			}
			else
			{
				$ePrecioCompra = $_POST["ePrecioCompra"];
			}*/

			if( preg_match('/^[0-9]+$/', $_POST["eIdP"]) && preg_match('/^[0-9]+$/', $_POST["EsCategoria"]) && preg_match('/^[0-9]+$/', $_POST["eCodigoP"]) && preg_match('/^[0-9]+$/', $_POST["eEstanteP"]) &&	preg_match('/^[0-9]+$/', $_POST["eNivelP"]) && preg_match('/^[0-9]+$/', $_POST["eSeccionP"]))
			{
				$tabla = "insumos";

				$desValidada = ControladorParametros::ctrValidarCaracteres($_POST["eDescripcionP"]);

				if($_POST["eObservacionP"] != null || $_POST["eObservacionP"] != "")
				{
					$obsValidada = ControladorParametros::ctrValidarCaracteres($_POST["eObservacionP"]);
				}
				else
				{
					$obsValidada = "";
				}

				
				$datos = array( "id_categoria" => $_POST["EsCategoria"],
								"codigo" => $_POST["eCodigoP"],
								"descripcion" => $desValidada,
								"observacion" => $obsValidada,
								"estante" => $eEstanteP,
								"nivel" => $eNivelP,
								"seccion" => $eSeccionP,
								"prioridad" => $_POST["ePrioridadP"],
								"precio_compra" => $ePrecioCompra,
								"id" => $_POST["eIdP"]);

				$respuesta = ModeloInsumos::mdlEditarInsumo($tabla, $datos);

				if($respuesta == "ok")
				{

					if( isset($_GET["idCategoria"]) )
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Insumo Editado",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
										if (result.value) {

										window.location = "index.php?ruta=verCategoria&idCategoria='.$_GET["idCategoria"].'";

										}
									})

						</script>';
					}
					else
					{
						echo'<script>

						swal({
							  type: "success",
							  title: "Insumo Editado",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})

						</script>';
					}
				}
			}
		}
	}//ctrEditarInsumo

	/*=============================================
				MOSTRAR INSUMOS
	=============================================*/
	static public function ctrMostrarInsumos($item, $valor)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlMostrarInsumos($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrContarInsumosCat()
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlAgruparInsumos($tabla);
		return $respuesta;
	}


	/*=============================================
	BORRAR INSUMO
	=============================================*/


	static public function ctrVerDescripcion($id)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlVerDescripcion($tabla, $id);
		return $respuesta;
	}

	static public function ctrVerImagen($id)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlVerImagen($tabla, $id);
		return $respuesta;
	}

	

	static public function ctrBorrarInsumo()
	{
		if(isset($_GET["idInsumo"]))
		{
			$tabla = "insumos";
			$datos = $_GET["idInsumo"];

			$respuesta = ModeloInsumos::mdlBorrarInsumo($tabla, $datos);

			if($respuesta == "ok")
				{
					$tabla = "historial";

					$datos = array( "accion" => 4,
									"numTabla" => 2,
									"valorAnt" => $_GET["descripcion"],
									"valorNew" => "",
									"id_usr" => $_GET["accionId"]
									 );

					$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

					if( isset($_GET["idCategoria"]) )
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Insumo Eliminado Eliminado",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
										if (result.value) {

										window.location = "index.php?ruta=verCategoria&idCategoria='.$_GET["idCategoria"].'";

										}
									})

						</script>';
					}
					else
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Insumo Eliminado Eliminado",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})

						</script>';
					}

					
				}
				else
				{
					echo'<script>

							swal({
								  type: "error",
								  title: "Error al eliminar",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
										if (result.value) {

										window.location = "insumos";

										}
									})

						</script>';
				}
		}
	}

	static public function ctrActualizarStock($datos)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlActualizarStock($tabla, $datos);
		return $respuesta;
	}

	static public function ctrActualizarPrecio($tabla, $datos)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlActualizarPrecio($tabla, $datos);
		return $respuesta;
	}

	static public function ctrMostrarInsumosDeCat($item, $valor)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlMostrarInsumosDeCategoria($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrImportarIns()
	{
		if ( isset($_POST["importacionGenerada"]) ) 
		{
			if ($_FILES['nuevaImpIns']['name'][0] != "")
			{
				if($_FILES["nuevaImpIns"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
				{
					$directorio = "extensiones/PHPExcel/Classes/importarIns.xlsx";
			        $tmp_name = $_FILES["nuevaImpIns"]["tmp_name"];
			        move_uploaded_file($tmp_name, $directorio);

			        echo'<script>window.open("extensiones/PHPExcel/Classes/insImportada.php?otro=1", "_self");</script>';
				}
			}//nuevaImpIns
		}//isset
	}//ctrImportarRq

	static public function ctrVerificarInsAgotados($item, $valor)
	{
		$tabla = "insumos";
		$consulta = ModeloInsumos::mdlVerificarInsAgotados($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}//ctrVerificarInsAgotados($tabla)

	static public function ctrVerificarInsEscasos($item, $valor)
	{
		$tabla = "insumos";
		$consulta = ModeloInsumos::mdlVerificarInsEscasos($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}//ctrVerificarInsEscasos($tabla)

	static public function ctrContarStockTotal($item, $valor)
	{
		$tabla = "insumos";
		$consulta = ModeloInsumos::mdlContarStockTotal($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}//ctrVerificarCanInsumos($tabla)
	

}#ControladorInsumos