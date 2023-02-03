static public function ctrActualizarRegistro()
	{
		if ( isset($_POST["idRegistro"]) && isset($_POST["accionReg"]) ) 
			{
				$traer = new ControladorRadicados;
				$registro = $traer->ctrAccesoRapidoRegistros($_POST["idRegistro"], 0);

				if (!is_null($registro)) 
				{
					if ($_POST["accionReg"] == 1) 
					{
						# interno...

						if (isset($_POST["listadoEngargadoReg"]) && !is_null($_POST["listadoEngargadoReg"])) 
						{
							$djson = "";

							if ($registro) {
								# code...
							}

							$acciones = json_decode($_POST["q"], true);	
							$encargados = json_decode($_POST["listadoEngargadoReg"], true);		

							if (count($encargados) > 0) 
							{
								foreach ($encargados as $key => $value) 
								{
									
								}
							}

						}	

						//isset["listadoEngargadoReg"]
						//si el encargado es igual al encargado registrado al momento de radicar
							//marcar  estado_pqr como pendiente y guardar  
							//guardar en accion registro_pqr: fecha {id, nombre, id_accionpqr, 1 pendiente(asignado)}
							//

						//sino, marcar estado pqr como pendiente, y guardar en accion registro_pqr:
								//fecha_radicado {id, nombre, id_accionpqr, 3 Devuelto para Reasignacion(Reasignado)}

						    //actualizar fecha_actualizacion registro pqr, realizar el conteo 
						//validar fecha radicado registro validar fecha actual
/*

					}
					elseif ($_POST["accionReg"] == 2) 
					{
						# externo...
					}elseif ($_POST["accionReg"] == 3) 
					{
						# reasignacion...
					}elseif ($_POST["accionReg"] == 4) 
					{
						# respondido por evaluar...
					}elseif ($_POST["accionReg"] == 5) 
					{
						# respondido y enviado...
					}else
					{
						# para enviar...
					}
				}*/

				//validar que accion se eligio

				//
				/*

				fechaReg
				horaReg
				idRegistro
				accionReg
				editarArchivo
				observacionesReg
				listadoEngargadoReg
				listadoRemitentesReg

				*/

				


				/*
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
			
			}*/
	}
