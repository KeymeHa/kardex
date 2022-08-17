<?php

class ControladorRadicados
{
	function anioActual($anio)
	{
	    if ($anio == 0) 
	    {$respuesta = '';}
	    else
	    {$respuesta = 'WHERE YEAR(fecha) = '.$anio;}
		return $respuesta;
	}


	public static function ctrMostrarRadicadoRango($fechaInicial, $fechaFinal, $id_area, $sw)
	{
		$tabla = "radicados";
		$r = new ControladorFacturas;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloRadicados::mdlMostrarRadicadoRango($tabla, $fechaInicial, $fechaFinal, $anio, $id_area, $sw);
		return $respuesta;
	}


	public static function ctrMostrarRadicados($item, $valor)
	{
		$tabla = "radicados";
		$respuesta = ModeloRadicados::mdlMostrarRadicados($tabla, $item, $valor);

		if (isset($respuesta["id_remitente"])) 
		{
			$r = new ControladorRadicados;
			$remitente = $r -> ctrValidarRemitente($respuesta["id_remitente"]);
			$respuesta["id_remitente"] = $remitente;
		}

		return $respuesta;
	}


	public static function ctrMostrarRadicadosCorte($item, $valor)
	{
		$tabla = "radicados";
		$respuesta = ModeloRadicados::mdlMostrarRadicadosCorte($tabla, $item, $valor);
		return $respuesta;
	}


	static public function ctrMostrarCortesRango($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "cortes";
		$r = new ControladorRadicados;
		$anio = $r->anioActual($anio);	
		$respuesta = ModeloRadicados::mdlMostrarCortesRango($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	
	}//ctrMostrarCortesRango

	static public function ctrMostrarCortes($item, $valor)
	{
		$tabla = "cortes";
		$respuesta = ModeloRadicados::mdlMostrarCortes($tabla, $item, $valor);
		return $respuesta;
	
	}//ctrMostrarCortesRango


	static public function ctrValidarRemitente($valor)
	{
		if ( !is_integer($valor) ) 
		{
			$remitente = ControladorParametros::ctrmostrarRegistros("remitente", "id", $valor);

			if (isset($remitente["nombre"])) 
			{
				return $remitente["nombre"];
			}
			else
			{
				return $valor;
			}
		}
		else
		{
			return $valor;
		}
	}

	static public function ctrRegistrarRemitente($tabla, $valor)
	{
		if (!empty($valor)) 
		{

			$remitente = ControladorParametros::ctrmostrarRegistros("remitente", "nombre", $valor);

			if (isset($remitente["nombre"])) 
			{
				return 0;
			}
			else
			{
				$remitente = ControladorParametros::ctrValidarCaracteres($valor);
				$respuesta = ModeloRadicados::mdlRegistrarRemitente($tabla,$remitente);
			}
			return 0;
		}
		return 0;
	}

	static public function ctrContarRadicados($item, $valor)
	{
		$tabla = "radicados";
		$consulta = ModeloRadicados::mdlContarRadicados($tabla, $item, $valor);
		$respuesta = $consulta[0];
		return $respuesta;
	}

	static public function ctrRadicar()
	{
		if ( isset($_POST["codigoInterno"]) ) 
			{
				$item = "id";
				$tabla = "parametros";
				$res = ModeloParametros::mdlMostrarParamentros($tabla, $item);

			    date_default_timezone_set('America/Bogota');
				$actualY = date("Y");
				$actualM = date("m");
				$actualD = date("d");

				try {

					$directorio = "";
				
					if ( isset($_FILES["soporteRadicado"]["tmp_name"]) ) 
					{
						if ( !$_FILES["soporteRadicado"]["tmp_name"] == null )
						{
								
							$directorio = "vistas/radicados/".strval($actualY)."/".strval($actualM)."/".strval($actualD);

							if (!file_exists($directorio)) 
							{
							    mkdir($directorio, 0755, true);
							}

							if($_FILES["soporteRadicado"]["type"] == "application/pdf")
							{
								$tmp_name = $_FILES['soporteRadicado']['tmp_name'];
								$nombre =  intval($res[29]) + 1;
								$nombreArchivo = $nombre.'.pdf';

								$respuesta = ControladorParametros::ctrNombreArchivo("nameRad", $nombre);

								if ( !$respuesta == "ok" )
								{
									echo '<script>

										console.log("Error al actualizar nombre en DB");

									</script>';

									return ;	
								}

								$directorio.='/'.$nombreArchivo;
								$error = $_FILES['soporteRadicado']['error'];

									if($error)
									{
										echo '<script>

										console.log("Error al copiar el archivo");
									

										</script>';

										return ;	
									}
									else
									{
											if(!file_exists($directorio))
											{
												copy($tmp_name,$directorio);
											}
									}
							}
						}//si exite algo
		
							
					}
					
				} catch (Exception $e) {
					echo '<script>

						console.log("Error Validar formato en el archivo");
					

						</script>';

						return ;	
					
				}

				$tabla = "radicados";

				$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observaciones"]);
				$asunto = ControladorParametros::ctrValidarCaracteres($_POST["asunto"]);
				


				$objeto = ControladorParametros::ctrValidarTermino($_POST["fechaRad"],$_POST["id_objeto"]);

				if ($_POST["remitenteID"] != 0) 
				{

					$rem = ControladorParametros::ctrmostrarRegistros("remitente", "id", $_POST["remitenteID"]);

					if (isset($rem["nombre"])) 
					{
						$remitente = $_POST["remitenteID"];
					}
					else
					{
						$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitente"]);
					}
	
				}
				else
				{
					$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitente"]);
				}

				$correo = ControladorParametros::ctrValidarCaracteres($_POST["correoE"]);
				$direccion = ControladorParametros::ctrValidarCaracteres($_POST["direccion"]);

				
				$datos = array( 'radicado' => $_POST["codigoInterno"],
								'id_usr' => $_POST["idUsuario"],
								'fecha' => $_POST["fechaRad"],
								'id_accion' => $_POST["id_accion"],
								'id_pqr' => $_POST["id_pqr"],
								'id_objeto' => $_POST["id_objeto"],
								'id_articulo' => $_POST["id_articulo"],
								'id_remitente' => $remitente,
								'asunto' => $asunto,
								'id_area' => $_POST["id_area"],
								'cantidad' => $_POST["cantidad"],
								'recibido' => $_POST["recibido"],
								'dias' => $objeto["dias"],
								'fecha_vencimiento' => $objeto["fecha_vencimiento"],
								'soporte' => $directorio,
								'observaciones' => $observacion,
								'correo' => $correo,
								'direccion' => $direccion);


				$respuesta = ModeloRadicados::mdlRadicar($tabla, $datos);

				if ($respuesta == "ok") 
				{

					//----------------------------------INCREMENTAR CODIGO RAD-------------------------------------
					try {

						$indiceCodigo = "codRad";
						$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);

						if ( !$indice == "ok" ) 
						{
							echo '<script>

							swal({

								type: "error",
								title: "¡Error al Actualizar incrementar codigo!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "radicado";

								}

							});
						
							</script>';

							return ;	
						}
						
					} catch (Exception $e) {
						echo '<script>

							swal({

								type: "error",
								title: "¡Error al incrementar Factura!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "radicado";

								}

							});
						

							</script>';

							return ;	
					}

					echo '<script>

					swal({

						type: "success",
						title: "Correspondencia Radicada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "radicado";

						}

					});
				

					</script>';

					
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Se ha presentado un error!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "radicado";

						}

					});
				

					</script>';


				}
			
			}

	}//ctrRadicar


	static public function ctrEditarRad()
	{
		if ( isset($_POST["obsEdit"]) ) {
			$tabla = "radicados";

			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["obsEdit"]);
			$asunto = ControladorParametros::ctrValidarCaracteres($_POST["asuntoEdit"]);
			$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitEdit"]);
			$recibido = ControladorParametros::ctrValidarCaracteres($_POST["recEdit"]);
			$correo = ControladorParametros::ctrValidarCaracteres($_POST["correoEe"]);
			$direccion = ControladorParametros::ctrValidarCaracteres($_POST["direccionE"]);

			$objeto = ControladorParametros::ctrValidarTermino($_POST["fechaEdit"], $_POST["objetoEdit"]);


			$remit = ModeloParametros::mdlmostrarRegistros("remitente", "nombre", $remitente);

			if (isset($remit["id"])) 
			{
				$remitente = $remit["id"];
			}

			/*

				soporteEdit traido de la bd

				soporteRadicadoEdit files

			*/

			try {

				$datos = array(	'id_usr' => $_POST["id_usrEdit"],
							'id_accion' => $_POST["accionEdit"],
							'id_pqr' => $_POST["pqrEdit"],
							'id_objeto' => $_POST["objetoEdit"],
							'id_articulo' => $_POST["articuloEdit"],
							'id_remitente' => $remitente,
							'asunto' => $asunto,
							'id_area' => $_POST["areaEdit"],
							'cantidad' => $_POST["cantEdit"],
							'recibido' => $recibido,
							'dias' => $objeto["dias"],
							'fecha_vencimiento' => $objeto["fecha_vencimiento"],
							'soporte' => "",
							'observaciones' => $observacion,
							'correo' => $correo,
							'direccion' => $direccion,
							'id' => $_POST["id_radEdit"]);


			$respuesta = ModeloRadicados::mdlEditarRad($tabla, $datos);

			if ($respuesta == "ok") 
			{
				$titulo = "¡Radicado #".$_POST["numRadEdit"]." se ha editado!";
				$tipo = "success";

				if (isset($_GET["idCorte"]) && isset($_GET["verCorte"])) 
				{
					$url = "index.php?ruta=verCorte&idCorte=".$_GET["idCorte"];
					#index.php?ruta=verCorte&idCorte=7
				}
				else
				{
					$url = "radicado";
				}
			}
			else
			{
				$titulo = "¡Ha ocurrido un error al editar!";
				$tipo = "error";
			}

					echo '<script>

					swal({

						type: "'.$tipo.'",
						title: "'.$titulo.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "'.$url.'";

						}

					});
				

					</script>';


				
			} catch (Exception $e) {

				echo '<script> alert('.$e.');<script>';
				
			}

		}
	}//ctrEditarRad

	static public function ctrGenerarCorte($id_usuario_o)
	{
		//traer el ultimo numero de corte
		$countRad = new ControladorRadicados;
		$count = $countRad->ctrContarRadicados("id_corte", 0);#solo pude generar corte si existe al menos un registro o más
		
		if ($count > 0)//si existe al menos un registro
		{
			$corte = ControladorParametros::ctrMostrarParametros(29);
			//actualizar todos los radicados con id_corte 0 a el numero de corte
			$tabla = "cortes";
			$genCorte = ModeloRadicados::mdlIngresarCorte($tabla, $corte["codigo"]);
			$id_corte = ModeloRadicados::mdlmostrarCorte($tabla, "corte", $corte["codigo"]);
			$indice = ControladorParametros::ctrIncrementarCodigo("nameRad");
			$tabla = "radicados";
			
			$radicados = $countRad->ctrMostrarRadicados("id_corte", 0);

			date_default_timezone_set('America/Bogota');
			$fechaActual = date("Y-m-d H:i:s");

			$id_area_o = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $id_usuario_o);
		

			/*
			foreach ($radicados as $key => $value) 
			{
				$modulo = 7;

				if ($value["id_pqr"] == 5 || $value["id_pqr"] == 6) 
				{
					$modulo = 3;//tesoreria
				}//$value["id_pqr"] != 5 && $value["id_pqr"] != 6

				$datos = array( 'dias' => 0,
								'id_corte' => $id_corte["id"],
								'id_radicado' => $value["id"],
								'id_area_o' => $id_area_o["id_area"],
								'id_usuario_o' => $id_usuario_o,
								'id_area_d' => $value["id_area"],
								'id_usuario_d' => 0,
								'id_accion' => 2,
								'fecha' => $value["fecha"],
							 	'vigencia' => 1,
							 	'observacion' => $value["observaciones"],
							 	'soporte' => $value["soporte"],
							 	'sw' => 1,
							 	'indicativo' => 1,
							 	'modulo' => $modulo);


				$registrar = ModeloRadicados::mdlNuevoRegistro("registropqr", $datos);
				//$trazabilidad = ModeloRadicados::mdlNuevaTrazabilidad("registro", $value["id"], $value["fecha"], $modulo);


			}//foreach ($radicados as $key => $value) */

			$respuesta = ModeloRadicados::mdlGenerarCorte($tabla, $id_corte["id"]);
			

			if ($genCorte == "ok" && $respuesta == "ok")
			{
				//subir numero de corte
				return "ok";
			}
			else
			{
				if ($genCorte != "ok") 
				{
					return "e1";
				}
				else
				{
					return "e2";
				}
			}
		}//if ($count > 0)
		else
		{
			return "e3";
		}
			
	}//ctrGenerarCorte()


	static public function ctrNuevoRegistro()
	{#INCOMPLETO
		if (isset($_POST["actualizacion"])) 
		{
			$id_radicado = "";
		
			//Trae el ultimo indicativo de un radicado para aumentar y actualizar
			$registro = ModeloRadicados::mdlVerIndicativo("registro", $id_radicado);

			$id_indicativo = ($registro["id_indicativo"]+1);

			$datosD = array( 'id_indicativo' => $id_indicativo,
							 'sw' => 1,
							 'id_radicado' => $id_radicado);

			$actualizar = ModeloRadicados::mdlAcualizarTrazabilidad("registro", $datosD);

			$datos = array( 'dias' => 0,
							'id_corte' => "",
							'id_radicado' => 0,
							'id_area_o' => 0,
							'id_usuario_o' => 0,
							'id_area_d' => 0,
							'id_usuario_d' => 0,
							'id_accion' => 2,
							'fecha' => 0,
						 	'vigencia' => 1,
						 	'observacion' => "",
						 	'vigencia' => 1,
						 	'soporte' => "",
						 	'sw' => 1,
						 	'indicativo' => $id_indicativo);

			$registrar = ModeloRadicados::mdlNuevoRegistro("registropqr", $datos);
		}//if isset
	}//ctrNuevoRegistro

	#							id del usuario 
	static public function ctrVerRegistrosPQR($id, $per, $mod, $fI, $fF, $es, $anio)
	{

		$query = "";

		if ($fI != null) 
		{

			if ( validateDate($fI) && validateDate($fF) ) 
			{
				if($fI == $fF)
				{
					$query = "WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT('".$fF."', '%Y %m %d') ";
					#ORDER BY fecha DESC
				}
				else
				{
					$fechaActual = new DateTime();
					$fechaActual ->add(new DateInterval("P1D"));
					$fechaActualMasUno = $fechaActual->format("Y-m-d");

					$fechaFinal2 = new DateTime($fF);
					$fechaFinal2 ->add(new DateInterval("P1D"));
					$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

					if($fechaFinalMasUno == $fechaActualMasUno){

						$query = Conexion::conectar()->prepare("WHERE fecha BETWEEN '".$fI."' AND '".$fechaFinalMasUno."'");

					}else{

						$query = Conexion::conectar()->prepare("WHERE fecha BETWEEN '".$fI."' AND '".$fF."'");

					}
				
				}
			}
			else
			{
				$r = new ControladorRadicados;
				$anio = $r->anioActual($anio);
				$query = $anio;
			}

		}//$fI != null
		else
		{
			$r = new ControladorRadicados;
			$anio = $r->anioActual();
			$query = $anio;
		}

		if ($per != 7) 
		{
			if ($id != 0) 
			{
				$query.= " AND id_usuario_o = ".$id."OR id_usuario_d = ".$id;
			}
		}

		if ($es == 1 || $es == 0) 
		{
			$query.= " AND sw = ".$es;
		}
		else
		{
			$query.= " AND sw = 1";
		}

		if ($mod == 7 || $mod == 8) 
		{
			$query.= " AND modulo = ".$mod." ORDER BY fecha DESC";
		}
		else
		{
			$query.= " AND modulo = 7 ORDER BY fecha DESC";
		}

		$tabla = "registropqr";

		$respuesta = ModeloRadicados::mdlmostrarRegistrosPQR($tabla, $query);

		return $respuesta;

	}//ctrVerRegistros($id, $per, $mod, $fI, $fF, $es)



	static public function ctrVerRegistroPQR($id)
	{
		$query = "WHERE id = ".$id;

		$tabla = "registropqr";
		$respuesta = ModeloRadicados::mdlmostrarRegistroPQR($tabla, $query);
		return $respuesta;
	}


	static public function ctrAnularRadicado($idSESSION)
	{
		if(isset($_GET["deleteRad"]))
		{

			$tabla = "usuarios";
			$idUsr = $_GET["idUsuario"];
			$respuesta = ModeloUsuarios::mdlModificarCampo($tabla,"elim",$idUsr);

			if($respuesta == "ok")
			{
				$tabla = "historial";

				$datos = array( "accion" => 4,
								"numTabla" => 5,
								"valorAnt" => $_GET["nombreusr"],
								"valorNew" => "",
								"id_usr" => $idSESSION
								 );

				$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

				echo'<script>

					swal({
						  type: "success",
						  title: "Usuario Eliminado",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
			}
			else
			{
				echo'<script>

					swal({
						  type: "error",
						  title: "No se pudo eliminar el Usuario",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
			}
		}

	}

}


