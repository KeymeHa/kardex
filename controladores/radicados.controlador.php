<?php

class ControladorRadicados
{
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

	function anioActual()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);
	    if ($anio["anio"] == 0) 
	    {$respuesta = '';}
	    else
	    {$respuesta = 'WHERE YEAR(fecha) = '.$anio["anio"];}
		return $respuesta;
	}

	static public function ctrMostrarCortesRango($fechaInicial, $fechaFinal)
	{
		$tabla = "cortes";
		$r = new ControladorRadicados;
		$anio = $r->anioActual();	
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

	static public function ctrGenerarCorte()
	{
		//traer el ultimo numero de corte

		$countRad = new ControladorRadicados;
		$count = $countRad->ctrContarRadicados("id_corte", 0);#solo pude generar corte si existe al menos un registro o más
		
		if ($count > 0) 
		{
			$corte = ControladorParametros::ctrMostrarParametros(29);

			//actualizar todos los radicados con id_corte 0 a el numero de corte
			$tabla = "cortes";
			$genCorte = ModeloRadicados::mdlIngresarCorte($tabla, $corte["codigo"]);
			$id_corte = ModeloRadicados::mdlmostrarCorte($tabla, "corte", $corte["codigo"]);

			$tabla = "radicados";
			
			$radicados = $countRad->ctrMostrarRadicados("id_corte", 0);

			date_default_timezone_set('America/Bogota');
			

			foreach ($radicados as $key => $value) 
			{
				$fechaActual = date("Y-m-d H:i:s");

				#trae el id_area del usuario origen
				$area_o = ControladorPersonas::ctrMostrarPersonas("id_usuario", $value["id_usr"]);

				$datos = array( 'dias' => 0,
							'id_corte' => $id_corte["id"],
							'id_radicado' => $value["id"],
							'id_area_o' => $area_o["id_area"],
							'id_usuario_o' => $value["id_usr"],
							'id_area_d' => $value["id_area"],
							'id_usuario_d' => $countRad->mdlVerUsuarioDeArea("personas", $id_area),
							'id_accion' => 2,
							'fecha' => $fechaActual);



				$registrar = ModeloRadicados::mdlNuevoRegistro("registropqr", $datos);
				$trazabilidad = ModeloRadicados::mdlNuevaTrazabilidad("registro", $value["id"]);
			}

			//Corte generado
			$respuesta = ModeloRadicados::mdlGenerarCorte($tabla, $id_corte["id"]);

			//enviar los registros con "id_corte = 0 ", con el id del nuevo corte
			//tomar cada uno e ir insertantandolo en el nuevo la tabla registros pqr

			if ($genCorte == "ok" && $respuesta == "ok")
			{
				//subir numero de corte
				$indiceCodigo = "nameRad";
				$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);
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

		}
		else
		{
			return "e3";
		}

	}//ctrGenerarCorte()


	static public function ctrNuevoRegistro()
	{

	}



}


