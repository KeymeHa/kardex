<?php
class ControladorInsumos
{
	static public function ctrCrearInsumo(){

		if(isset($_POST["nuevaDescripcion"]))
		{

			if(preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"])){

			   	$ruta = "vistas/img/productos/default/anonymous.png";

			   	if(isset($_FILES["eImagenP"]["tmp_name"])){

			   		if (!is_null($_FILES["eImagenP"]["tmp_name"]) || empty($_FILES["eImagenP"]["tmp_name"])) {
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
			   		else
			   		{
			   			$ruta = "";
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

				

				if (isset($_POST["nuevaHabilitado"])) 
				{
					$habilitado = 0;
				}
				else
				{
					$habilitado = 1;
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
							   "prioridad" => $_POST["nuevaPrioridad"],
							   "unidad" => $_POST["nuevaUnidadEnt"],
							   "unidadSal" => $_POST["nuevaUnidadSal"],
							   "contenido" => $_POST["nuevoContenido"],
								"habilitado" => $habilitado);

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
				$eEstanteP = "SINF";
			}
			else
			{
				$eEstanteP = $_POST["eEstanteP"];
			}

			if($_POST["eNivelP"] == null || $_POST["eNivelP"] == "")
			{
				$eNivelP = "SINF";
			}
			else
			{
				$eNivelP = $_POST["eNivelP"];
			}

			if($_POST["eSeccionP"] == null || $_POST["eSeccionP"] == "")
			{
				$eSeccionP = "SINF";
			}
			else
			{
				$eSeccionP = $_POST["eSeccionP"];
			}
			
			if($_POST["ePrecioCompra"] == "")
			{
				$ePrecioCompra = 0;
			}
			else
			{
				$ePrecioCompra = $_POST["ePrecioCompra"];
			}

			$ejecutar = new ControladorInsumos(); 
			$valores = $ejecutar->ctrTratarValores($_POST["eIdP"], $ePrecioCompra);

			if( preg_match('/^[0-9]+$/', $_POST["eIdP"]) && preg_match('/^[0-9]+$/', $_POST["EsCategoria"]) )
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

				

				if (isset($_POST["editarHabilitado"])) 
				{
					$habilitado = 0;
				}
				else
				{
					$habilitado = 1;
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
								"habilitado" => $habilitado,
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

	static public function ctrmostrarRegistros($item, $valor, $tipo)
	{
		$tabla = "valores";
		$respuesta = ModeloInsumos::mdlmostrarRegistros($tabla , $item, $valor, $tipo);
		return $respuesta;
	}

	static public function ctrTratarValores($id, $precioE)
	{
		$tabla = "valores";
		$ejecutar = new ControladorInsumos();
		$res = $ejecutar -> ctrMostrarInsumos("id", $id);

		$historia = ModeloInsumos::mdlmostrarRegistros($tabla,"id_insumo", $id, 1);

		if($res["precio_compra"] != $precioE)
		{
			date_default_timezone_set('America/Bogota');
			$fechaActual = date("Y-m-d");
			$hoy = "".$fechaActual;

			if(isset($historia["registro"]) && $historia["registro"] != null)
			{
				$dJson = substr($historia["registro"], 0 ,-1);
				$dJson.= ',{"val":"'.$precioE.'","fe":"'.$hoy.'"}]';
				$datos = array("registro" => $dJson, "id_insumo" => $id, "tipo" => 1);
				$respuesta = ModeloInsumos::MdlActualizarH($tabla, $datos);
			}
			else
			{
				$dJson = '[{"val":"'.$res["precio_compra"].'","fe":"'.$res["fecha"].'"},{"val":"'.$precioE.'","fe":"'.$hoy.'"}]';
				$datos = array("id_insumo" => $id,
							   "registro" => $dJson,
								"tipo" => 1); 
				$respuesta = ModeloInsumos::mdlNuevaHistoriaPro($tabla, $datos);
			}
		}

		return 0;
	}

	/*=============================================
				MOSTRAR INSUMOS
	=============================================*/
	static public function ctrMostrarInsumos($item, $valor)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlMostrarInsumos($tabla, $item, $valor, 0);
		return $respuesta;
	}

	static public function ctrMostrarInsumosCat($item, $valor, $sw)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlMostrarInsumos($tabla, $item, $valor, $sw);
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

	static public function ctrBuscarInsumo($item, $valor)
	{
		$tabla = "insumos";
		$respuesta = ModeloInsumos::mdlBuscarInsumo($tabla, $item, $valor);

		if (isset($respuesta[0])) 
        {
        	return true;
        }
        else
        {
          	return false;
        }	
	}

	static public function ctrBuscarInsumoUnidad($item, $valor)
	{
		$tabla = "insumosunidad";
		$respuesta = ModeloInsumos::mdlBuscarInsumo($tabla, $item, $valor);

		if (isset($respuesta[0])) 
        {
        	return true;
        }
        else
        {
          	return false;
        }	
	}

	static public function ctrUnidadSinDefinir()
	{
		$respuesta = ModeloInsumos::mdlCrearSinDefinir("insumosunidad", "Sin Definir");
		return $respuesta;
	}

	static public function ctrValidarSinDefinir()
	{
		$valor = "Sin Definir";
		$ejecutar = new ControladorInsumos();
		$unidad = $ejecutar -> ctrBuscarInsumoUnidad("unidad", $valor);

		if (isset($unidad["id"])) 
		{
			if ($unidad["id"] != "" || $unidad["id"] != null) {
				$id = $unidad["id"];
				$sw = 1;
			}
		}

		if ($sw == 0) 
		{
			$unidad = $ejecutar -> ctrUnidadSinDefinir();
			$unidad = $ejecutar -> ctrBuscarInsumoUnidad("unidad", $valor);
			$id = $unidad["id"];
		}

		return $id;
	}


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


	static public function ctrSumarStock($id)
	{

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
	

	static public function ctrInforStock($id, $fechaInicial ,$fechaFinal, $anio)
	{
		//traer datos de requisiciones
		$requisiciones = ControladorRequisiciones::ctrTraerInsumosRqRango($fechaInicial, $fechaFinal, $anio);
		$facturas = ControladorFacturas::ctrTraerInsumosFacRango($fechaInicial, $fechaFinal, $anio);

		$arrayInfo = array();

	    //Requerido
		$arrayInfo["rq"] = 0;
		//Ingresado
		$arrayInfo["ing"] = 0;
		//Ingresado Total
		$arrayInfo["ing_t"] = 0;
		//Egresado Total
		$arrayInfo["ing_e"] = 0;
		//invertido
		$arrayInfo["inv"] = 0;

		if ( count($requisiciones) == 0) 
        {
          return $arrayInfo;
        }
        else
        {
         foreach ($requisiciones as $key => $value) 
         {

           $insumo = json_decode($value["insumos"], true);

	         $sw = 0;

	          for ($i=0; $i < count($insumo); $i++) 
	          { 
	            if ($id == $insumo[$i]["id"]) 
	            {
	            	$arrayInfo["rq"]+=1;
	            	$arrayInfo["ing_e"]+=$insumo[$i]["ent"];
	            }
	          }   
		 }
		     
		}
		//recorrer requisiciones

		//traer datos de facturas
		if ( count($facturas) == 0) 
        {
          return $arrayInfo;
        }
        else
        {
         foreach ($facturas as $key => $value) 
         {

           $insumo = json_decode($value["insumos"], true);

	         $sw = 0;

	          for ($i=0; $i < count($insumo); $i++) 
	          { 
	            if ($id == $insumo[$i]["id"]) 
	            {
	            	$arrayInfo["ing"]+=1;
	            	$arrayInfo["ing_t"]+=$insumo[$i]["can"];
	            	$arrayInfo["inv"]+=$insumo[$i]["sub"];
	            }
	          }   
		 }
		     
		}
		//recorrer facturas
		return $arrayInfo;
	}

}#ControladorInsumos