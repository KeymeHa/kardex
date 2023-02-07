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


	static public function ctrEditarRad($id_usr)
	{
		if ( isset($_POST["obsEdit"]) ) {
			

			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["obsEdit"]);
			$asunto = ControladorParametros::ctrValidarCaracteres($_POST["asuntoEdit"]);
			$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitEdit"]);
			$recibido = ControladorParametros::ctrValidarCaracteres($_POST["recEdit"]);
			$correo = ControladorParametros::ctrValidarCaracteres($_POST["correoEe"]);
			$direccion = ControladorParametros::ctrValidarCaracteres($_POST["direccionE"]);
			
			#26
			$titulo = "";
			$tipo = "";
			
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
/*
					if (isset($_GET["idCorte"])) 
					{
						$url = "index.php?ruta=verCorte&idCorte=".$_GET["idCorte"];
						#index.php?ruta=verCorte&idCorte=7
					}
					else
					{
						$url = "radicado";
					}
*/
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
		//traer el ultimo numero de corte
		$countRad = new ControladorRadicados;
		$count = $countRad->ctrContarRadicados("id_corte", 0);#solo pude generar corte si existe al menos un registro o más
		
		if ($count > 0)//si existe al menos un registro
		{
			$corte = ControladorParametros::ctrMostrarParametros(27);
			//actualizar todos los radicados con id_corte 0 a el numero de corte
			$tabla = "cortes";
			$genCorte = ModeloRadicados::mdlIngresarCorte($tabla, $corte["codigo"]);
			$id_corte = ModeloRadicados::mdlmostrarCorte($tabla, "corte", $corte["codigo"]);
			$indice = ControladorParametros::ctrIncrementarCodigo("nameRad");
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

			foreach ($radicados as $key => $value) 
			{
				for ($y=0; $y < count($id_per); $y++) 
				{ 
					$sw = 0; //dejar de buscar el id_pqr
					$x = 0; // movimiento de elemento 
					 /*
			                 Y
			                          x
			          "idpqr"  0 {1, 2, 3 }
			                            ["id"]
			                 1

			          id_per array(3) 
			          { 
			            [0]=> int(7)
			            [1]=> int(8) 
			            [2]=> int(6) 
			          } 

			          id_pqr array(3) 
			          { 
			            [0]=> array(1) { ["id_pqr"]=> array(4) 
			            { 
			                [0]=> array(1) 
			                { ["id"]=> string(1) "1" } 
			                [1]=> array(1) 
			                  { ["id"]=> string(1) "2" }
			                [2]=> array(1) 
			                  { ["id"]=> string(1) "3" } 
			                [3]=> array(1) 
			                  { ["id"]=> string(1) "4" } } 
			            } 

			            [1]=> array(1)  { ["id_pqr"]=> array(2) 
			            { 
			                [0]=> array(1) 
			                  { ["id"]=> string(1) "6" } 
			                [1]=> array(1) 
			                  { ["id"]=> string(1) "5" } } 
			            } 

			            [2]=> array(1)  { ["id_pqr"]=> array(2) 
			            { 
			                [0]=> array(1) 
			                    { ["id"]=> string(1) "8" } 
			                  [1]=> array(1) 
			                    { ["id"]=> string(1) "7" } } 
			            } 
			          }

			          */

					 while ( $x <= count($id_pqr[$y]["id_pqr"]) && $sw == 0) 
			          {
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

			    $id_usuario = ControladorPersonas::ctrMostrarIdPersonaPerfil("id_area", $value["id_area"], $per);
				
				$datos = array( 'id_radicado' => $value["id"],
								'id_area' => $value["id_area"],
								'id_usuario' => $id_usuario,
								'id_estado' => 5,
								'id_pqr' => $value["id_pqr"],
								'fecha_vencimiento' => $value["fecha_vencimiento"],
								'fecha_actualizacion' => $value["fecha"],
								'fecha' => $value["fecha"],
								'dias_habiles' => $value["dias"],
								'dias_restantes' => $value["dias"]);

				$registrar = ModeloRadicados::mdlNuevoRegistro("registropqr", $datos);

			}//foreach ($radicados as $key => $value)

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

/*
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
	}//ctrNuevoRegistro*/

	#							id del usuario 
	static public function ctrVerRegistrosPQR($id, $per, $fI, $fF, $es, $anio, $item, $valor)
	{
		$query = "";
		$tabla = "registropqr";

		if (is_null($valor)) 
		{

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
				$anio = $r->anioActual($anio);
				$query = $anio;
			}

			if (!is_null($es) || $es != 0) 
			{
				//si existe estado enviar, sino no enviar solo pendientes y vencidas
				$query.= " AND id_estado = ".$es;
			}

			

			$respuesta = ModeloRadicados::mdlmostrarRegistrosPQR($tabla, $query, $item);
		}
		else
		{

			$query = "WHERE ".$item." = ".$valor;
			$respuesta = ModeloRadicados::mdlmostrarRegistrosPQR($tabla, $query, $item);
		}

	
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




	static public function ctrAccesoRapidoRegistros($idRegistro, $sw)
	{
		$traer = new ControladorRadicados;
		$registro = $traer->ctrVerRegistrosPQR(0, 0, 0, null, 0, 0, "id", $idRegistro);
		$radicado = $traer->ctrMostrarRadicados("id", $registro["id_radicado"]);

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


		/*if ($interval2->format('%a') <= $interval->format('%a') ) 
		{
			if($interval->format('%a') != 0 && $interval2->format('%a') != 0)
			{
			}
			else
			{
				$registro["contador"] = 100;
				$radicado["contador"] = 100;
			}
		}
		else
		{
			$registro["contador"] = 100;
			$radicado["contador"] = 100;
		}*/
		$registro["diascontados"] = $iniActual->format('%a')-1;
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

		
	}

	static public function ctrActualizarRegistro()
	{
		
		if ( isset($_POST["idRegistro"]) && isset($_POST["accionReg"]) ) 
			{
				$traer = new ControladorRadicados;
				$registro = $traer->ctrAccesoRapidoRegistros($_POST["idRegistro"], 0);

				$error = 0;

				
				if (isset($_GET["idRegistro"])) 
				{
					$urlSW = 'index.php?ruta=verRegistro&idRegistro='.$_GET["idRegistro"];
				}
				else
				{
					$urlSW = 'registro';
				}

				$tipoSW = '';
				$titleSW = '';	

				if (!is_null($registro)) 
				{
					if (!empty($_POST["observacionesReg"])) 
				{
					$observacion_usuario = ControladorParametros::ctrValidarCaracteres($_POST["observacionesReg"]) ;
					$dJsonObs_usr = '[';
					$dJsonAcc = '[';

				 if (!is_null($registro["observacion_usuario"])) 
				 {
				 	try {
				 		$observaciones_usuario_his = json_decode($registro["observacion_usuario"], true);


					 		if ( !empty($observaciones_usuario_his) && count($observaciones_usuario_his) > 0) 
					 		{
					 			foreach ($observaciones_usuario_his as $key => $value) {
					 				$dJsonObs_usr .='{"fe":"'.$value["fe"].'","hr":"'.$value["hr"].'","id":"'.$value["id"].'","nom":"'.$value["nom"].'","obs":"'.$value["obs"].'"},';
					 			}

					 			$dJsonObs_usr .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","obs":"'.$observaciones_usuario_his.'"}]';

					 		}
					 		else
					 		{
					 			$dJsonObs_usr ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","obs":"'.$observaciones_usuario_his.'"}]';
					 		}


					 	} catch (Exception $error) {
					 		
					 	}

					 }
					 else
					 {
					 	$dJsonObs_usr .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'""obs":"'.$observaciones_usuario_his.'"}]';

					 }
				}
				else
				{
					$observaciones_usuario_his = json_decode($registro["observacion_usuario"], true);


						if ( !empty($observaciones_usuario_his) && count($observaciones_usuario_his) > 0) 
						{
							foreach ($observaciones_usuario_his as $key => $value) 
							{
								$dJsonObs_usr .='{"fe":"'.$value["fe"].'","hr":"'.$value["hr"].'","id":"'.$value["id"].'","nom":"'.$value["nom"].'","obs":"'.$value["obs"].'"},';
							}

						}
						else
						{
							$dJsonObs_usr = null;
						}

				}

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

					$estadoPQR = 5;

					if ($_POST["accionReg"] == 1) 
					{
						# interno...

						if (isset($_POST["listadoEngargadoReg"]) && !is_null($_POST["listadoEngargadoReg"])) 
						{

							try {

								if( isset($_POST["fechaReg"]) && (!is_null($_POST["fechaReg"]) || !empty($_POST["fechaReg"])) )
								{
									$fechaActual = $_POST["fechaReg"];
								}
								else
								{
									$fechaActual = date('d-m-Y');
								}

								if( isset($_POST["horaReg"]) && (!is_null($_POST["horaReg"]) || !empty($_POST["horaReg"])) )
								{
									$horaActual = $_POST["horaReg"];
								}
								else
								{
	    							$horaActual = date('h:i a');
								}

								//VALIDAR QUE NO ESTE VACIO LOS ENCARGADOS
								$encargados = json_decode($_POST["listadoEngargadoReg"], true);	

								$id_Encargado = $encargados[0]["id"];
								$nombre_Encargado = $encargados[0]["nom"];
								$id_Area_Encargado = $encargados[0]["idA"];

								if ($registro["id_estado"] == 5) 
								{
									$estadoPQR = 2;
								}
								elseif ($registro["id_estado"] == 3) 
								{
									$estadoPQR = $registro["id_estado"];
								}

								if ($id_Encargado == $registro["id_usuario"]) 
								{
									$idAccion = $_POST["accionReg"];
								}
								else
								{
									$idAccion = 3;
								}

								

								if (count($encargados) > 0) 
								{
									if (is_null($registro["acciones"])) 
									{

										 $dJsonAcc ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'",}}]';

									}
									else
									{

										$encargadosHistoria = json_decode($registro["acciones"], true);	 


										if (!empty($encargadosHistoria) && count($encargadosHistoria) > 0 ) 
										{
											//registrados

											for ($y=0; $y < count($encargadosHistoria); $y++) 
											{ 
												 $dJsonAcc .='{"fe":"'.$encargadosHistoria[$y]["fe"].'","hr":"'.$encargadosHistoria[$y]["hr"].'","acc":"'.$encargadosHistoria[$y]["acc"].'","da":{"id":"'.$encargadosHistoria[$y]["da"]["id"].'","nom":"'.$encargadosHistoria[$y]["da"]["nom"].'","idA":"'.$encargadosHistoria[$y]["da"]["idA"].'"}},';
											}

											 $dJsonAcc .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"}}]';

											//encargados
										}
										else
										{
											 $dJsonAcc ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"}}]';
										}
										

									}


									

								

								

			 					$datos = array( 
									'id_usuario' => $id_Encargado,
									'id_area' => $id_Area_Encargado,
									'id_estado' => $estadoPQR,
									'fecha_asignacion' => $fechaActual.' '.$horaActual,
									'acciones' => $dJsonAcc,
									'observacion_usuario' => $dJsonObs_usr,
									'id' => $_POST["idRegistro"]);
									

			 						$respuesta = ModeloRadicados::mdlAcualizarTrazabilidad("registropqr", $datos);

			 						var_dump($respuesta);

			 						

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

									

								}//if (count($encargados) > 0) 
								else
								{
									$error = "Lista de encargados vacia." ; 
								}
								
							} catch (Exception $e) {

								//VALIDAR FECHA DE ACCION

							

							}//catch

							//$acciones = json_decode($_POST["q"], true);	
							
						}//if (isset($_POST["listadoEngargadoReg"]) && !is_null($_POST["listadoEngargadoReg"]))	
						else
						{
							$tipoSW = 'error';
							$titleSW = 'se encontraron no se encontro un encargado en este registro';
						}


					}//if ($_POST["accionReg"] == 1) 	
					elseif ($_POST["accionReg"] == 2) 
					{
						/*

						[{"id":"4","rem":"ALCALDÍA DE B/QUILLA : CONTROL URBANO Y ESPACIO PÚBLICO "},{"id":"7","rem":"ALCALDIA DE BARRANQUILLA / SECRETARIO DE OBRAS PUBLICAS"},{"id":"9","rem":"AVP"}]

						listadoRemitentesReg
						fechaReg
						horaReg
						idRegistro
						accionReg
						editarArchivo
						observacionesReg
						listadoRemitentesReg

						*/
					}
					elseif ($_POST["accionReg"] == 3) 
					{
						$tipoSW = 'success';
						$titleSW = 'Faltan parametros';
					}
					elseif ($_POST["accionReg"] == 4) 
					{
						$tipoSW = 'success';
						$titleSW = 'Faltan parametros';
					}
					elseif ($_POST["accionReg"] == 5) 
					{
						$tipoSW = 'success';
						$titleSW = 'Faltan parametros';
					}
					elseif ($_POST["accionReg"] == 6) 
					{
						$tipoSW = 'success';
						$titleSW = 'Faltan parametros';
					}
					elseif ($_POST["accionReg"] == 7) 
					{
						$tipoSW = 'success';
						$titleSW = 'Faltan parametros';
					}
				
				}//si existe el registo a modificar



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



	}//function


	
}


