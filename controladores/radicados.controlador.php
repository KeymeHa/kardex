<?php

class ControladorRadicados
{
	public static function anioActual($anio)
	{
		$respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha) = '.$anio;
		return $respuesta;
	}


	public static function ctrMostrarRadicadoRango($fechaInicial, $fechaFinal, $id_area, $sw)
	{
		$tabla = "radicados";
		$r = new ControladorRadicados;
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
							$directorio = "vistas/radicados/".strval($actualY)."/".$_POST["codigoInterno"];

							if (!file_exists($directorio)) 
							{
							    mkdir($directorio, 0755, true);
							}

							if($_FILES["soporteRadicado"]["type"] == "application/pdf")
							{
								$tmp_name = $_FILES['soporteRadicado']['tmp_name'];
								/*$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio."/", 'pdf' );
								$nombre = ( $CONTADOR == 0 ) ? "1" : $CONTADOR */
								$directorio.='/soporte'.strval($_POST["codigoInterno"]).'.pdf';
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


	static public function ctrEditarRad($id_usr)
	{
		if ( isset($_POST["obsEdit"]) ) {
			

			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["obsEdit"]);
			$asunto = ControladorParametros::ctrValidarCaracteres($_POST["asuntoEdit"]);
			$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitEdit"]);
			$recibido = ControladorParametros::ctrValidarCaracteres($_POST["recEdit"]);
			$correo = ControladorParametros::ctrValidarCaracteres($_POST["correoEe"]);
			$direccion = ControladorParametros::ctrValidarCaracteres($_POST["direccionE"]);
			$soporte = "";
			#26
			$titulo = "";
			$tipo = "";
			$directorio = "";
			
			$objeto = ControladorParametros::ctrValidarTermino($_POST["fechaEdit"], $_POST["objetoEdit"]);


			$remit = ModeloParametros::mdlmostrarRegistros("remitente", "nombre", $remitente);

			if (isset($remit["id"])) 
			{
				$remitente = $remit["id"];
			}

			$traer = new ControladorRadicados;
			$radicado = $traer->ctrMostrarRadicados( "id" , $_POST["id_radEdit"] );

			if (isset($radicado["id"]) && !is_null($radicado["id"])) 
			{
				if (!is_null( $radicado["soporte"] ) && !empty($radicado["soporte"]) ) 
				{
					$soporte = $radicado["soporte"];

					if ( isset($_FILES["soporteRadicadoEdit"]["tmp_name"]) ) 
						{
							if ( !$_FILES["soporteRadicadoEdit"]["tmp_name"] == null )
							{
								$tmp_name = $_FILES['soporteRadicadoEdit']['tmp_name'];

								
								if (file_exists($soporte)) 
								{
									unlink($soporte);
								}

								copy($tmp_name,$soporte);
							}
						}


				}//radicado soporte no esta vacio ni es nulo
				else
				{
					try {

						//date_default_timezone_set('America/Bogota');
						//$anio = date($radicado["fecha"]);
						
					
						if ( isset($_FILES["soporteRadicadoEdit"]["tmp_name"]) ) 
						{
							if ( !$_FILES["soporteRadicadoEdit"]["tmp_name"] == null )
							{
								$anio = new DateTime($radicado["fecha"]);
								$directorio = "vistas/radicados/".strval($anio->format("Y"))."/".$radicado["radicado"];

								if (!file_exists($directorio)) 
								{
								    mkdir($directorio, 0755, true);
								}

								if($_FILES["soporteRadicadoEdit"]["type"] == "application/pdf")
								{
									$tmp_name = $_FILES['soporteRadicadoEdit']['tmp_name'];
									$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio, 'pdf' );

									$CONTADOR +=1;

									$directorio.='/'.$CONTADOR.'.pdf';

									$error = $_FILES['soporteRadicadoEdit']['error'];

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

												$soporte = $directorio;
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
				}// soporte si esta vacio o es nulo
			}


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
							'soporte' => $soporte,
							'observaciones' => $observacion,
							'correo' => $correo,
							'direccion' => $direccion,
							'id' => $_POST["id_radEdit"]);

			//	var_dump($datos);

			//historial

			#26
			#Consultar Radicado
			$ejecutar = new ControladorRadicados();
			$verRadicado = $ejecutar -> ctrMostrarRadicados("id", $_POST["id_radEdit"]);
			#ver Que Datos Cambiaron

			if (isset($verRadicado["radicado"]) && $verRadicado["radicado"] != null) 
			{
			
				#26 START
				$llaves = ['id_usr',
							'id_accion',
							'id_pqr',
							'id_objeto',
							'id_articulo',
							'id_remitente',
							'asunto',
							'id_area',
							'cantidad',
							'recibido',
							'dias',
							'fecha_vencimiento',
							'soporte',
							'observaciones',
							'correo',
							'direccion',
							'id'];

				$valAnterior = '[';
				$valNuevo = '[';

				for ($i=0; $i < count($llaves) ; $i++) 
				{ 
					if ( $verRadicado[$llaves[$i]] != $datos[$llaves[$i]] ) 
					{
						#ca es campo, atributo del registro para consultar
						#val es el valor, tanto el nuevo como el anterior
						if ($llaves[$i] == "id_remitente") 
						{
							$remitente = $ejecutar -> ctrValidarRemitente($datos[$llaves[$i]]);

							if ( $remitente != $datos[$llaves[$i]] ) 
							{
								$valAnterior.= '{"ca":"'.$i.'","val":"'.$remitente.'"},';
								$valNuevo.= '{"ca":"'.$i.'","val":"'.$datos[$llaves[$i]].'"},';
							}

						}
						else
						{
							$valAnterior.= '{"ca":"'.$i.'","val":"'.$verRadicado[$llaves[$i]].'"},';
							$valNuevo.= '{"ca":"'.$i.'","val":"'.$datos[$llaves[$i]].'"},';
						}

						
					}

					//se envia historial

				}

				#26 END
				 $valAnterior = substr($valAnterior, 0 ,-1);
		         $valAnterior.= '],[{"id":"'.$_POST["id_radEdit"].'"}]';
		         $valNuevo = substr($valNuevo, 0 ,-1);
		         $valNuevo.= '],[{"id":"'.$_POST["id_radEdit"].'"}]';

				$tabla = "radicados";
				$respuesta = ModeloRadicados::mdlEditarRad($tabla, $datos);

				if ($respuesta == "ok") 
				{
					#26
					$datos2 = array( "accion" => 3,
									"numTabla" => 15,
									"valorAnt" => $valAnterior,
									"valorNew" => $valNuevo,
									"id_usr" => $id_usr,
									"id_otro" => 0
									 );
					#26
					$respuesta2 = ModeloHistorial::mdlInsertarHistorial("historial", $datos2);

					$titulo = "¡Radicado #".$_POST["numRadEdit"]." se ha editado!";
					$tipo = "success";

					

					$url = (isset($_GET["idCorte"])) ? "index.php?ruta=verCorte&idCorte=".$_GET["idCorte"] : "radicado";  

					if (isset($_GET["idCorte"])) 
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
			}
			else
			{
				$titulo = "¡Radicado #".$_POST["numRadEdit"]." no se logro editar!";
				$tipo = "error";
			}


			#Enviar Al historial

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
		//contar cuantos radicados tienen id_corte = 0
		$countRad = new ControladorRadicados;
		$count = $countRad->ctrContarRadicados("id_corte", 0);#solo pude generar corte si existe al menos un registro o más
		
		if ($count > 0)//si existe al menos un registro
		{

			$corte = ControladorParametros::ctrCodigocorte();
			#$corte = ControladorParametros::ctrMostrarParametros(29);
			//actualizar todos los radicados con id_corte 0 a el numero de corte
			$tabla = "cortes";
			$genCorte = ModeloRadicados::mdlIngresarCorte($tabla, $corte);
			$id_corte = ModeloRadicados::mdlmostrarCorte($tabla, "corte", $corte);
			

			$tabla = "radicados";
			
			$radicados = $countRad->ctrMostrarRadicados("id_corte", 0);

			date_default_timezone_set('America/Bogota');
			$fechaActual = date("Y-m-d H:i:s");

			//llamar pqrfiltro


			$traer_filtro = ControladorParametros::ctrMostrarFiltroPQR(null, null);

            $id_per = [];
            $id_pqr  = [[]];

            foreach ($traer_filtro as $key => $value) 
            {

              if(!is_null($value["id_pqr"]))
              {
                 $id_per[$key] = $value["id_per"];
                 $id_pqr[$key]["id_pqr"] = json_decode($value["id_pqr"], true);
              }

            }
            //perfil para buscar una persona encargada de esa correspondencia
            $per = 3;

            //toma todos los radicados y para validar su id a que juridicción pertenece
            //juridica

            $id_area = 0;

            // al encenderse este sw enviara la información al regitrospqr
            $registrar = 0;

			foreach ($radicados as $key => $value) 
			{
				$registrar = 0;

				$id_area = $value["id_area"];

				for ($y=0; $y < count($id_per); $y++) 
				{ 
					$sw = 0; //dejar de buscar el id_pqr
					$x = 0; // movimiento de elemento 

					//genera un ciclo hasta encontrar a que juridiccion pertenece dependiendo si el id_pqr es igual al radicado
					 while ( $x < count($id_pqr[$y]["id_pqr"]) && $sw == 0) 
			          {
			          	//si existe la llave valor x puede validar si el id_pqr es igual
			            if (array_key_exists($x, $id_pqr[$y]["id_pqr"])) 
			            {
			              if ($id_pqr[$y]["id_pqr"][$x]["id"] == $value["id_pqr"] ) 
			              {
			                $per = $id_per[$y];
			                $sw = 1;
			              }
			              else
			              {
			                $x++;
			              }
			            }else
			            {
			              $x++;
			            }
			          }//while

				}//for

				//buscar el id del usuario que peternecezca a un área y sea el encargado predeterminado de ella
			    $id_usuario = ControladorPersonas::ctrMostrarIdPersonaPerfil("id_area", $id_area, $per);       

		          if ($id_usuario != 0 )
		          {
		          $registrar = 1; 
		          }
		          else
		          {
		          //buscar todos los usuarios con perfil juridica,
		            $usuarioContigente = ControladorUsuarios::ctrMostrarUsuarios("perfil", $per);

		             if ($per == 7) 
		              {
		                if ($id_usuario != 0 )
		                {
		                  $registrar = 1; 
		                }
		                else
		                {
		                //buscar todos los usuarios con perfil juridica, tesoreria o correspondencia
		                  $usuarioContigente = ControladorUsuarios::ctrMostrarUsuarios("perfil", $per);
		                  var_dump($usuarioContigente);

		                  if (is_countable($usuarioContigente) && count($usuarioContigente) != 0 && count($usuarioContigente[0]) != 0)
		                  {
		                    //buscar a que área pertenecen
		                    foreach ($usuarioContigente as $k => $val) 
		                    {
		                      $id_area = ControladorPersonas::ctrMostrarIdPersonaPerfil("id_usuario", $val["id"], $per);

		                      if ($id_area != 0) 
		                      {
		                        $registrar = 1;
		                      }
		                    }
		                    //validar que sea el predeterminado
		                  }
		                }
		              }
		              else
		              {
		                 $usuarioContigente = ControladorUsuarios::ctrMostrarUsuarios("perfil", $per);

		                 if (is_countable($usuarioContigente) && count($usuarioContigente) != 0 && count($usuarioContigente[0]) != 0)
		                  {
		                      if (array_key_exists(0, $usuarioContigente)) 
		                      {
		                         $id_area_temp = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $usuarioContigente[0]["id"]);
		                         $id_area = $id_area_temp["id_area"];
		                         $id_usuario = $usuarioContigente[0]["id"];
		                         $registrar = 1;
		                      }
		                  }
		              }

		            
		          }

			    if ($registrar == 1) 
			    {
			    	$datos = array( 'id_radicado' => $value["id"],
								'id_area' => $id_area,
								'id_usuario' => $id_usuario,
								'id_estado' => 5,
								'id_pqr' => $value["id_pqr"],
								'fecha_vencimiento' => $value["fecha_vencimiento"],
								'fecha_actualizacion' => $value["fecha"],
								'fecha' => $value["fecha"],
								'dias_habiles' => $value["dias"],
								'dias_contados' => 0);
			    	$registrar = ModeloRadicados::mdlNuevoRegistro("registropqr", $datos);
			    }
				
			}//foreach ($radicados as $key => $value)

			$respuesta = ModeloRadicados::mdlGenerarCorte($tabla, $id_corte["id"]);
			$indiceCodigo = "nameRad";
			$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);
			

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

	function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	//										   0,   0,        0,           null,      0,     0, "id",   $idRegistro
	static public function ctrVerRegistrosPQR($id, $per, $fechaInicial, $fechaFinal, $es, $anio, $item, $valor)
	{
		$query = "";
		$tabla = "registropqr";

		if ($fechaInicial != null) 
		{
			$query.= ( !is_null($es) ) ? "AND " : "";

			$validar = new ControladorRadicados;
			if ( !$validar->validateDate($fechaInicial , 'Y-m-d') && !$validar->validateDate($fechaFinal , 'Y-m-d') ) 
			{
				return 0;
			}
		}
		else
		{
			if ($anio != 0) 
			{
				$r = new ControladorRadicados;
				$query = $r->anioActual($anio);
				$query.= ( !is_null($es) ) ? " AND " : "";
			}
		}

		if ( $es == "c1" ) 
		{
			$query.= "id_estado = 1 or id_estado = 6";

		}elseif ( $es == "c2" ) {

			$query.= "id_estado = 4";
		}
		elseif ( $es == "c3" ) {

			$query.= "id_estado = 2 or id_estado = 5";
		}
		elseif ( $es == "c6" ) {//por asignar

			$query.= "id_estado = 5";
		}
		elseif ( $es == "c4" ) 
		{
			$query.= "id_estado = 3";
		}

		return ModeloRadicados::mdlmostrarRegistrosPQR($tabla, $query, $fechaInicial, $fechaFinal, $item, $valor);
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

	static public function ctrContarRad($tablaD,  $itemD, $campoD, $item, $valor, $otro, $fechaInicial, $fechaFinal, $anio)
	{


		if ($anio != 0) 
		{
			$r = new ControladorRadicados;
			$anio = $r->anioActual($anio);

			if ($valor != null) 
			{
				$anio.= " AND '".$item."' = '".$valor."' ".$otro;		
			}			
		}
		else
		{
			if ($valor != null) 
			{
				$anio = " WHERE '".$item."' = '".$valor."' ".$otro;		
			}
			else
			{
				$anio = '';
			}
		}

		$tabla = "radicados";

		$respuesta = ModeloRadicados::mdlContarRad($tabla, $tablaD,  $itemD, $campoD, $item, $valor, $otro, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	}


	static public function ctrIntervaloFechas($fI, $ff, $diash)
	{

		$respuesta = [];

		$fInicial = date_create($fI);
		$fFinal = date_create($ff);
		$fechaActual = date('d-m-Y');
		$fActual = date_create($fechaActual);

		$iniFin = date_diff($fInicial, $fFinal);//fecha inicio fecha fin
		$actFin = date_diff($fActual, $fFinal);//fecha actual fecha fin
		$iniActual = date_diff($fInicial, $fActual);//fecha

		if ( $iniActual->format('%a') <= $iniFin->format('%a') ) 
		{
			$porcentaje = ((float)$iniActual->format('%a')  /  $diash)*100; // Regla de tres
			$respuesta["contador"] = round($porcentaje, 0);  // Quitar los decimales
		}
		else
		{
			$respuesta = 100;
		}

		$respuesta["diascontados"] = $iniActual->format('%a')-1;

    	return $respuesta ;
	}


	static public function ctrAccesoRapidoRegistros($idRegistro, $sw)
	{
		$traer = new ControladorRadicados;
		$registro = $traer->ctrVerRegistrosPQR(0, 0, 0, null, 0, 0, "id", $idRegistro);
		$radicado = $traer->ctrMostrarRadicados("id", $registro["id_radicado"]);

		if ( $registro["dias_contados"] <= $registro["dias_habiles"] ) 
		{
			$porcentaje = ((float)$registro["dias_contados"] /  $registro["dias_habiles"])*100; // Regla de tres
			$radicado["contador"] = round($porcentaje, 0);  // Quitar los decimales
			$registro["contador"] = $radicado["contador"];
		}
		else
		{
			$registro["contador"] = 100;
			$radicado["contador"] = 100;
		}

		$radicado["diascontados"] = $registro["dias_contados"];
		$hora = new DateTime($registro["fecha"]);
    	$registro["hora"] = $hora->format('h:i a');
    	$radicado["hora"] = $registro["hora"];

		if ($sw == 1) 
		{
			return $radicado;
		}
		else
		{
			return $registro;
		}


/*
		$fInicial = date_create($registro["fecha"]);
		$fFinal = date_create($registro["fecha_vencimiento"]);
		$fechaActual = date('d-m-Y');
		$fActual = date_create($fechaActual);
		

		$iniFin = date_diff($fInicial, $fFinal);//fecha inicio fecha fin
		$actFin = date_diff($fActual, $fFinal);//fecha actual fecha fin
		$iniActual = date_diff($fInicial, $fActual);//fecha


		if ( $iniActual->format('%a') <= $iniFin->format('%a') ) 
		{
			$porcentaje = ((float)$iniActual->format('%a')  /  $registro["dias_habiles"])*100; // Regla de tres
			$radicado["contador"] = round($porcentaje, 0);  // Quitar los decimales
			$registro["contador"] = $radicado["contador"];
		}
		else
		{
			$registro["contador"] = 100;
			$radicado["contador"] = 100;
		}

		$registro["diascontados"] = $iniActual->format('%a');
		$radicado["diascontados"] = $registro["diascontados"];
		$hora = new DateTime($registro["fecha"]);
    	$registro["hora"] = $hora->format('h:i a');

    	$radicado["hora"] = $registro["hora"];

		if ($sw == 1) 
		{
			return $radicado;
		}
		else
		{
			return $registro;
		}

		*/
	}

	static public function ctrActualizarRegistro($idSESSION)
	{
		
		if ( isset($_POST["idRegistro"]) && isset($_POST["accionReg"]) ) 
			{
				$traer = new ControladorRadicados;
				$registro = $traer->ctrAccesoRapidoRegistros($_POST["idRegistro"], 0);
				$radicado = $traer->ctrMostrarRadicados( "id" , $registro["id_radicado"] );
				$estadoPQR = $registro["id_estado"];
				$tabla = "registropqr";
				$id_Encargado = $registro["id_usuario"];
 				$id_Area_Encargado = $registro["id_area"];
				$directorio = '';
				$error = 0;
				$soporte = '';
				$contar = 1; //id para cada nueva accion
				$dJsonAcc = '';//json para almacenar en DB
				$dJsonAccTemp = ""; //almacena una cadena tipo json para luego ser insertado en otro json
				$tipoSW = '';
				$titleSW = '';
				$fechaActual = "";
				$horaActual = "";
				$idAccion = $_POST["accionReg"];
				$observacion_usuario = ControladorParametros::ctrValidarCaracteres($_POST["observacionesReg"]);
				$urlSW = "";

				if (is_null($registro)) 
				{
					$error = "No se encontro el registro a modificar";
				}
				else
				{//registro encontrado

					#
					#fecha y hora
					if( isset($_POST["fechaReg"]) && (!is_null($_POST["fechaReg"]) || !empty($_POST["fechaReg"])) )
					{	$fechaActual = $_POST["fechaReg"];	}
					else
					{	$fechaActual = date('d-m-Y');	}

					if( isset($_POST["horaReg"]) && (!is_null($_POST["horaReg"]) || !empty($_POST["horaReg"])) )
					{	$horaActual = $_POST["horaReg"];     }
					else
					{	$horaActual = date('h:i a');		}

					if (!is_null($registro["acciones"])) 
					{
						$arrayacciones = json_decode($registro["acciones"], true);
						$contar = count($arrayacciones) + 1;
					}

					#soporte
					if ( isset($_FILES["editarArchivo"]["tmp_name"]) ) 
					{
						if ( !is_null($_FILES["editarArchivo"]["tmp_name"]) )
						{
							$anio = new DateTime($radicado["fecha"]);
							$directorio = "vistas/radicados/".strval($anio->format("Y"))."/".$radicado["radicado"];

							if (!file_exists($directorio)) 
							{
							    mkdir($directorio, 0755, true);
							}

							if($_FILES["editarArchivo"]["type"] == "application/pdf")
							{
								$tmp_name = $_FILES['editarArchivo']['tmp_name'];
								/*$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio."/", 'pdf' );
								$nombre = ( $CONTADOR == 0 ) ? "1" : $CONTADOR + 1 ;*/

								$soporte = $contar;

								$directorio.='/'.strval($soporte).'.pdf';
								$error = $_FILES['editarArchivo']['error'];

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
						else{
							$soporte = '';
						}	
					}//if ( isset($_FILES["editarArchivo"]["tmp_name"]) ) 
					else
					{
						$soporte = '';
					}

					switch ($idAccion) 
					{//switch ($_POST["accionReg"])
					    case 1:
					    //Traslado Interno

					    //VALIDAR QUE NO ESTE VACIO LOS ENCARGADOS
						$encargados = json_decode($_POST["listadoEngargadoReg"], true);	
						$id_Encargado = $encargados[0]["id"];
						$nombre_Encargado = $encargados[0]["nom"];
						$id_Area_Encargado = $encargados[0]["idA"];

						if ($registro["id_estado"] == 3) 
						{
							$estadoPQR = $registro["id_estado"];
						}
						else
						{
							if ($registro["id_estado"] == 5) 
							{
								$estadoPQR = 2;
							}
							elseif ($registro["id_estado"] == 3) 
							{
								$estadoPQR = 3;
							}
						}

						if (count($encargados) > 0) 
						{
							$dJsonAccTemp = '"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"';
							$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $_POST["idRegistro"], "fecha_asignacion", $fechaActual." ".$horaActual );
						}//if (count($encargados) > 0) 
						else
						{
							$error = "Lista de encargados vacia." ; 
						}
					        break;
					    case 2:
					    //Traslado por Competencia
					    if (isset($_POST["listadoRemitentesReg"]) && !is_null($_POST["listadoRemitentesReg"])) 
							{
								$estadoPQR = 6;
								$remitentes = json_decode($_POST["listadoRemitentesReg"], true);	

								if (!is_null($remitentes) && count($remitentes) > 0) 
								{
									for ($i=0; $i < count($remitentes); $i++) 
									{ 
										$dJsonAccTemp.= '"'.$i.'":{"id":"'.$remitentes[$i]["id"].'","rem":"'.$remitentes[$i]["rem"].'"},';
									}
									$dJsonAccTemp = substr($dJsonAccTemp, 0 ,-1);


									$fecha_respuesta = $fechaActual.' '.$horaActual;
									$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $_POST["idRegistro"], "fecha_respuesta",$fecha_respuesta );

								}//if (count($encargados) > 0) 
								else
								{
									$error = "Lista de remitentes vacia." ; 
								}
							}//if (isset($_POST["listadoRemitentesReg"]) && !is_null($_POST["listadoRemitentesReg"]))	
							else
							{
								$error = 'se encontraron no se encontro al menos un remitente en este registro';
							}


					        break;
					    case 3:
					    //Devuelto para Reasignación
					        break;
					    case 4:
					    //Respondido por Evaluar
					        break;
					    case 5:
					    //Respondido y Enviado
					        break;
					    case 6:
					    //Para Enviar
					        break;
					    case 7:
					    //Cambiar Tipo PQR
					    	if (isset($_POST["listadoPQR"]) && !is_null($_POST["listadoPQR"])) 
							{
								$estadoPQR = $registro["id_estado"];
								$accionesPQR = json_decode($_POST["listadoPQR"], true);	

								if (!is_null($accionesPQR) && count($accionesPQR) > 0) 
								{

									if ($registro["id_pqr"] != $accionesPQR[0]["id"]) 
									{
										$pqr = ControladorParametros::ctrmostrarRegistros("pqr", "id", $registro["id_pqr"]);

										$pqrTermino = ControladorParametros::ctrValidarTerminoPQR($registro["fecha"], $accionesPQR[0]["id"]);
										$dJsonAccTemp = '"id":"'.$accionesPQR[0]["id"].'","pqr":"'.$accionesPQR[0]["pqr"].'","pqra":"'.$pqr["nombre"].'","ter":"'.$accionesPQR[0]["ter"].'","ida":"'.$registro["id_pqr"].'","tera":"'.$registro["dias_habiles"].'","fechaVa":"'.$registro["fecha_vencimiento"].'","fechav":"'.$pqrTermino["fecha_vencimiento"].'"';

										$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $_POST["idRegistro"], "dias_habiles", $pqrTermino["dias"] );
										$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $_POST["idRegistro"], "fecha_vencimiento", $pqrTermino["fecha_vencimiento"] );

										$hoy = date('Y-m-d');
										$fechaV = new DateTime($pqrTermino["fecha_vencimiento"]);

										//fecha Actual es menor a fecha vencimiento y es estado vencido
										if ($hoy < $fechaV->format('Y-m-d')  && $estadoPQR == 3) 
										{
											$estadoPQR = 2;
											//estado pendiente
										}
										elseif($hoy > $fechaV->format('Y-m-d') )
										{
											$estadoPQR = 3;
										}
									}
									else
									{
										$error = "No se efectuo algun cambio" ; 
										$tipoSW = "success"; 
									}

										// id = id del pqr elegido
										// pqr = nombre del pqr elegido
										// pqra = Anterior nombre del pqr
										// ter = termino del pqr elegido
										// ida = Anterior termino
										// tera = Anterior termino del pqr 
										// fechaVa = Anterior Fecha de Vencimiento
										// fechav = Nueva Fecha Vencimiento

								}//if (count($encargados) > 0) 
								else
								{
									$error = "No Se logro cambiar los terminos y el tipo de PQR." ; 
								}
							}
							else
							{
								$error = 'No se logro acceder a la lista de PQR';
							}
					        break;
					    case 8:
					    //Marcar Como Resuelto
					    	if ($registro["id_estado"] == 3) 
							{	$estadoPQR = 4;	}
							else
							{	$estadoPQR = 1;	}
							//	fecha_respuesta
							$fecha_respuesta = $fechaActual.' '.$horaActual;
							$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $_POST["idRegistro"], "fecha_respuesta",$fecha_respuesta );
							$tipoSW = 'success';
							$titleSW = 'Se Ha Marcado el oficio Radicado con #'.$radicado["radicado"].'  Como Resuelto';

					        break;
					    default:
					    	$error = "No se encontro la acción seleccionada";
					    	$tipoSW = 'error';
							$titleSW = $error;
       					break;


					}//switch ($_POST["accionReg"])

				}//registro encontrado

				if(is_int($error))
				{
					if (is_null($registro["acciones"])) 
					{
						 $dJsonAcc ='[{"id":"'.$contar.'"';
					}
					else
					{
						$dJsonAcc = substr($registro["acciones"], 0 ,-1);
						$dJsonAcc .= ',{"id":"'.$contar.'"';
					}
						$dJsonAcc .= ',"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{'.$dJsonAccTemp.'},"obs":"'.$observacion_usuario.'","sop":"'.$soporte.'","idS":"'.$idSESSION.'","sw":"1"}]';

					$datos = array( 
					'id_usuario' => $id_Encargado,
					'id_area' => $id_Area_Encargado,
					'id_estado' => $estadoPQR,
					'acciones' => $dJsonAcc,
					'id' => $_POST["idRegistro"]);

					$respuesta = ModeloRadicados::mdlAcualizarTrazabilidad($tabla, $datos);

					if($respuesta == "ok")
					{

						$tipoSW = 'success';
						$titleSW = 'Acción Realizada';

					}
					else
					{
						$tipoSW = 'error';
						$titleSW = 'Ha Ocurrido un error';
						
					}
				}
				else
				{

					if (file_exists($directorio)) 
					{
						unlink($directorio);
					}

					$tipoSW = 'error';
					$titleSW = $error;
				}

					

				echo'<script>

				swal({
					  type: "'.$tipoSW.'",
					  title: "'.$titleSW.'",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result) {
								if (result.value) {

								window.location = "'.$urlSW.'";

								}
							})

				</script>';

			}//	if ( isset($_POST["idRegistro"]) && isset($_POST["accionReg"]) ) 
	}//ctrActualizarRegistro()


	static public function ctractualizarRegistros($idUsuario, $idPerfil, $anio)
	{
		$traer = new ControladorRadicados ;
		$registrosPQR = $traer -> ctrVerRegistrosPQR($idUsuario, $idPerfil, null, null, null, $anio, null , null);

		date_default_timezone_set('America/Bogota');
		$fechaActual = date("Y-m-d");
		$fechaHoraActual = date("Y-m-d H:i:s");

		foreach ($registrosPQR as $key => $value) 
		{
								//resuelto					//extemporaneo					//trasladado
			if ($value["id_estado"] != 1 && $value["id_estado"] != 4 && $value["id_estado"] != 6) 
			{

				$fecha_act = new DateTime($value["fecha_actualizacion"]);

				if ($fecha_act->format("Y-m-d") != $fechaActual ) 
				{
					//contar dias y enviar
					$diascontados = ControladorParametros::ctrContarDias($value["fecha"],$value["fecha_vencimiento"], $value["id_estado"]);
					//marcar como vencido de la fecha radicado es menor a fecha_vencimiento

					$datos = array( 
						'dias_contados' => $diascontados["dias_contados"],
						'id_estado' => $diascontados["id_estado"],
						'fecha_actualizacion' => $fechaActual,
						'id' => $value["id"]);

					$respuesta = ModeloRadicados::mdlActualizarRegistros("registropqr", $datos);
				}
			}

		}
		$resp = ControladorParametros::ctrFechaRegistrosActualizada($fechaHoraActual);
		return $registrosPQR;
	}


	static public function ctrCuadrantesRegistros($perfil, $anio, $fechaInicial, $fechaFinal)
	{
		if ($_SESSION["perfil"] == 11 || $_SESSION["perfil"] == 7) 
	    {
	    	$estados_pqr = ControladorParametros::ctrContarEstados(7, $_SESSION["anioActual"], $fechaInicial, $fechaFinal);
	    }
	    else
	    {
	      $estados_pqr = ControladorParametros::ctrContarEstados($_SESSION["perfil"], $_SESSION["anioActual"], $fechaInicial, $fechaFinal);
	    }

	    $porcentaje = [[]];
	    $sumatoria = 0;
	    $porcentaje["cuad1"][0] = 0 ; // 1 resuelto, 6trasladado
	    $porcentaje["cuad2"][0] = 0 ; //4 extemporaneo
	    $porcentaje["cuad3"][0] = 0 ; //2 pendiente, 5 por asignar 
	    $porcentaje["cuad4"][0] = 0 ; //3 vencido
	    $porcentaje["contarCuadSu"][0] = 0 ;
		$porcentaje["contarCuadIn"][0] = 0 ;

		//kpi
		$porcentaje["pri_pendi"][0] = 0;
		$porcentaje["pri_venci"][0] = 0;
		$porcentaje["his_resuelta"][0] = 0;
		$porcentaje["his_extemporanea"][0] = 0;

	    if (!is_null($estados_pqr) && is_countable($estados_pqr) ) 
	    {
	        $sumatoria = 0;

	        for ($i=0; $i < count($estados_pqr) ; $i++) 
	        { 
	          $sumatoria+=$estados_pqr[$i]["COUNT(registropqr.id_estado)"];
	        }

	        for ($i=0; $i < count($estados_pqr); $i++) 
	        {
	          $porcentaje[ $estados_pqr[$i]["id"] ]["id"] = $estados_pqr[$i]["id"]; 
	          $porcentaje[ $estados_pqr[$i]["id"] ]["nombre"] = $estados_pqr[$i]["nombre"];
	          $porcentaje[ $estados_pqr[$i]["id"] ]["contar"] = $estados_pqr[$i]["COUNT(registropqr.id_estado)"];
	          $porcentaje[ $estados_pqr[$i]["id"] ]["per"] = bcdiv( ($estados_pqr[$i]["COUNT(registropqr.id_estado)"]/$sumatoria) *100, '1', 2) ;
	        }

	      $porcentaje["percentCuad1"][0] = 0;
	      $porcentaje["percentCuad3"][0] = 0;

	      //cuadrante 1
	      if (isset($porcentaje[1])) 
	      {
	        if (isset($porcentaje[6])) 
	        {$porcentaje["cuad1"][0] = $porcentaje[1]["contar"] + $porcentaje[6]["contar"];$porcentaje["percentCuad1"][0]+=$porcentaje[1]["per"]+$porcentaje[6]["per"];}
	        else
	        {$porcentaje["cuad1"][0] = $porcentaje[1]["contar"];$porcentaje["percentCuad1"][0]+=$porcentaje[1]["per"];}
	      }
	      elseif (isset($porcentaje[6])) 
	      {$porcentaje["cuad1"][0] = $porcentaje[6]["contar"];$porcentaje["percentCuad1"][0]+=$porcentaje[6]["per"];}

	      //cuadrante 2
	      if (isset($porcentaje[4])) 
	      {$porcentaje["cuad2"][0] = $porcentaje[4]["contar"];}

	      //cuadrante 3
	      if (isset($porcentaje[2])) 
	      {
	        if (isset($porcentaje[5])) 
	        {$porcentaje["cuad3"][0] = $porcentaje[2]["contar"] + $porcentaje[5]["contar"];$porcentaje["percentCuad3"][0]+=$porcentaje[2]["per"]+$porcentaje[5]["per"];}
	        else
	        {$porcentaje["cuad3"][0] = $porcentaje[2]["contar"];$porcentaje["percentCuad3"][0]+=$porcentaje[2]["per"];}
	      }
	      elseif (isset($porcentaje[5])) 
	      {$porcentaje["cuad3"][0] = $porcentaje[5]["contar"];$porcentaje["percentCuad3"][0]+=$porcentaje[5]["per"];}

	      //cuadrante 4
	      if (isset($porcentaje[3])) 
	      {$porcentaje["cuad4"][0] = $porcentaje[3]["contar"];}

	      $porcentaje["contarCuadSu"][0] = $porcentaje["cuad3"][0] + $porcentaje["cuad4"][0];
	      $porcentaje["contarCuadIn"][0] = $porcentaje["cuad1"][0] + $porcentaje["cuad2"][0];

	      if (($porcentaje["cuad3"][0]+$porcentaje["cuad4"][0]) != 0) 
		  {
		      $porcentaje["pri_pendi"][0]  = bcdiv( ($porcentaje["cuad3"][0]/($porcentaje["cuad3"][0]+$porcentaje["cuad4"][0])) *100, '1', 2);              
		      $porcentaje["pri_venci"][0] = bcdiv( ($porcentaje["cuad4"][0]/($porcentaje["cuad3"][0]+$porcentaje["cuad4"][0])) *100, '1', 2);    
		  }

		   if (($porcentaje["cuad1"][0]+$porcentaje["cuad2"][0]) != 0) 
		  {
		      $porcentaje["his_resuelta"][0] = bcdiv( ($porcentaje["cuad1"][0]/($porcentaje["cuad1"][0]+$porcentaje["cuad2"][0])) *100, '1', 2);              
		      $porcentaje["his_extemporanea"][0] = bcdiv( ($porcentaje["cuad2"][0]/($porcentaje["cuad1"][0]+$porcentaje["cuad2"][0])) *100, '1', 2); 
		  }

	     // $contarCuadSu = $cuad3 + $cuad4;
	     // $contarCuadIn = $cuad1 + $cuad2;
	  	}
	      return $porcentaje;
	}


	static public function ctrAsignarRegistro($idRegistro, $idUser)
	{
		$resultado = array('tipo' => "error",
						   'estado' => 2);

			$traer = new ControladorRadicados;
			$registro = $traer->ctrVerRegistrosPQR(0, 0, 0, null, 0, 0, "id", $idRegistro);

			if ( isset($registro["id"]) && !is_null($registro["id"]) ) 
			{
				if(is_null($registro["acciones"]))
				{	
					$tabla = "registropqr";
					$fechaActual = date('Y-m-d');
					$horaActual = date('h:i a');
					$usuarioNombre = ControladorUsuarios::ctrMostrarNombre("id", $registro["id_usuario"]);
					$fechacompleta = date ('Y-m-d H:i:s');

					$estadoPQR = $registro["id_estado"];
					if ($registro["id_estado"] == 3) 
					{
						$estadoPQR = $registro["id_estado"];
					}
					else
					{
						if ($registro["id_estado"] == 5) 
						{
							$estadoPQR = 2;
						}
						elseif ($registro["id_estado"] == 3) 
						{
							$estadoPQR = 3;
						}
					}

					$resultado["estado"] = $estadoPQR;

					$dJsonAccTemp = '"id":"'.$registro["id_usuario"].'","nom":"'.$usuarioNombre["nombre"].'","idA":"'.$registro["id_area"].'"';

					$actualizar = ModeloRadicados::mdlAcualizarItemTrazabilidad($tabla, $idRegistro, "fecha_asignacion", $fechacompleta );

					$dJsonAcc = '[{"id":"1","fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"1","da":{'.$dJsonAccTemp.'},"obs":"","sop":"","idS":"'.$idUser.'","sw":"1"}]';

					$datos = array( 
					'id_usuario' => $registro["id_usuario"],
					'id_area' => $registro["id_area"],
					'id_estado' => $estadoPQR,
					'acciones' => $dJsonAcc,
					'id' => $idRegistro);

					#var_dump($datos);

					//var_dump($datos);
					$respuesta = ModeloRadicados::mdlAcualizarTrazabilidad($tabla, $datos);

					$respuesta = "ok";

					if ($respuesta == "ok") 
					{
						$resultado["tipo"] = $respuesta;
					}
				}
			}

		return $resultado;

	}



	static public function ctrContarAsignaciones($anio, $fechaInicial, $fechaFinal)
	{

		$respuesta = [[]];

		$r = new ControladorRadicados;
		$anio = $r->anioActual($anio);

		if (!is_null($fechaInicial)) 
		{
			if ( !$r->validateDate($fechaInicial , 'Y-m-d') && !$r->validateDate($fechaFinal , 'Y-m-d') ) 
			{
				return 0;
			}
		}
		else
		{
			$tabla = "registropqr";
			$count  = 0;
			//el limite es 4, haciendo referencia de los 4 cuadrantes
			for ($i=1; $i <= 4; $i++) 
			{ 
				$consulta = ModeloRadicados::mdlContarAreaRegistros($i, $tabla, $anio, $fechaInicial, $fechaFinal);

				for ($x=0; $x < count($consulta); $x++) 
				{ 
					if (is_null($respuesta)) 
					{
						$respuesta [$count]["nombre"] = $consulta[$x]["nombre"];
						$respuesta [$count][1] = 0;
						$respuesta [$count][2] = 0;
						$respuesta [$count][3] = 0;
						$respuesta [$count][4] = 0;
						$respuesta [$count][$i] = $consulta[$x]["COUNT(areas.nombre)"];
					}
					else
					{
						$sw = 0;
						$key = 0;

						for ($k=0; $k < count($respuesta) ; $k++) 
						{ 

							if (array_key_exists("nombre", $respuesta [$k])) 
							{
								if ($respuesta [$k]["nombre"] == $consulta[$x]["nombre"] && $sw == 0) 
								{
									$key = $k;
									$sw = 1;
								}
							}
						}

						if ($sw == 0) 
						{
							$count++;
							$respuesta [$count]["nombre"] = $consulta[$x]["nombre"];
							$respuesta [$count][1] = 0;
							$respuesta [$count][2] = 0;
							$respuesta [$count][3] = 0;
							$respuesta [$count][4] = 0;
							$respuesta [$count][$i] = $consulta[$x]["COUNT(areas.nombre)"];
						}
						else
						{
							$respuesta [$key][$i] = $consulta[$x]["COUNT(areas.nombre)"];
						}
					}
				}

			}
			return $respuesta;
		}	

	}//ctrContarAsignaciones
	
}


