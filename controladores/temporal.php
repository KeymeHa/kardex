<?php

$dJsonsoporte = ( !is_null($registro["soporte"]) ) ? $registro["soporte"] : null ; 
					try {

					//date_default_timezone_set('America/Bogota');
					//$actualY = date("Y");
					$directorio = "";
				
					if ( isset($_FILES["editarArchivo"]["tmp_name"]) ) 
					{
						if ( !$_FILES["editarArchivo"]["tmp_name"] == null )
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
								$CONTADOR = ControladorParametros::ctrcontarArchivosEn( $directorio."/", 'pdf' );
								$nombre = ( $CONTADOR == 0 ) ? "1" : $CONTADOR+1 ;

								$directorio.='/'.strval($nombre).'.pdf';
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

												if (!is_null($registro["soporte"])) 
												{
										 			$soporte_his = json_decode($registro["soporte"], true);
											 		if (!is_null($soporte_his) && !empty($soporte_his) && count($soporte_his) > 0) 
											 		{
											 			if (!empty($registro["soporte"])) 
											 			{
											 				$dJsonsoporte = substr($dJsonsoporte, 0 ,-1);
											 				$dJsonsoporte .=',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","sop":"'.$nombre.'"}]';
											 			}
											 			else
											 			{
											 				$dJsonsoporte ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","sop":"'.$nombre.'"}]';
											 			}
											 		}//if (!is_null($soporte_his) && !empty($soporte_his) && count($soporte_his) > 0) 
											 		else
											 		{

											 			if (empty($registro["soporte"])) 
											 			{
											 				$dJsonsoporte = "";
											 			}
											 			else
											 			{
											 				$dJsonsoporte ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","sop":"'.$nombre.'"}]';
											 			}

											 			
											 		}//else

												}
												else
												{
												 	$dJsonsoporte .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","sop":"'.$nombre.'.pdf"}]';
												}

											}
											else
											{
												//$dJsonsoporte .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","sop":"'.$directorio.'"}]';
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

					$id_Area_Encargado = $registro["id_area"];
					$id_Encargado = $registro["id_usuario"];

					if (isset($_GET["idRegistro"])) 
					{
						$urlSW = 'index.php?ruta=verRegistro&idRegistro='.$_GET["idRegistro"];
					}
					else
					{
						$urlSW = 'registros';
					}

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

					//observaciones

					if (!is_null($registro["observacion_usuario"])) 
					{
			 			$observaciones_usuario_his = json_decode($registro["observacion_usuario"], true);
				 		if (!is_null($observaciones_usuario_his) && !empty($observaciones_usuario_his) && count($observaciones_usuario_his) > 0) 
				 		{
				 			if (!empty($registro["observacion_usuario"])) 
				 			{
				 				$dJsonObs_usr = substr($dJsonObs_usr, 0 ,-1);
				 				$dJsonObs_usr .=',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","obs":"'.$observacion_usuario.'"}]';
				 			}
				 			else
				 			{
				 				$dJsonObs_usr ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","obs":"'.$observacion_usuario.'"}]';
				 			}
				 		}//if (!is_null($observaciones_usuario_his) && !empty($observaciones_usuario_his) && count($observaciones_usuario_his) > 0) 
				 		else
				 		{

				 			if (empty($registro["observacion_usuario"])) 
				 			{
				 				$dJsonObs_usr = "";
				 			}
				 			else
				 			{
				 				$dJsonObs_usr ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'","obs":"'.$observacion_usuario.'"}]';
				 			}

				 			
				 		}//else

					}
					else
					{
					 	$dJsonObs_usr .='{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","id":"'.$_SESSION["id"].'","nom":"'.$_SESSION["nombre"].'""obs":"'.$observacion_usuario.'"}]';
					}
						if ($_POST["accionReg"] == 1) 
						{
							$estadoPQR = $registro["id_estado"];
							# interno...
							if (isset($_POST["listadoEngargadoReg"]) && !is_null($_POST["listadoEngargadoReg"])) 
							{
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

									if ($id_Encargado != $registro["id_usuario"]) 
									{
										$idAccion = 2;
									}
								}

								

								if (count($encargados) > 0) 
								{
									if (is_null($registro["acciones"])) 
									{
										 $dJsonAcc ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"}}]';
									}
									else
									{

										$encargadosHistoria = json_decode($registro["acciones"], true);	 
										if (!empty($encargadosHistoria) && count($encargadosHistoria) > 0 ) 
										{
											//registrados
											$dJsonAcc = substr($registro["acciones"], 0 ,-1);
											$dJsonAcc .=',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"}}]';
											//encargados
										}
										else
										{
											 $dJsonAcc ='[{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{"id":"'.$id_Encargado.'","nom":"'.$nombre_Encargado.'","idA":"'.$id_Area_Encargado.'"}}]';
										}
									}
								}//if (count($encargados) > 0) 
								else
								{
									$error = "Lista de encargados vacia." ; 
								}
							}//if (isset($_POST["listadoEngargadoReg"]) && !is_null($_POST["listadoEngargadoReg"]))	
							else
							{
								$error = 'se encontraron no se encontro un encargado en este registro';
							}
						}//if ($_POST["accionReg"] == 1) 	
						elseif ($_POST["accionReg"] == 2) 
						{
							/*
							listadoRemitentesReg
							fechaReg
							horaReg
							idRegistro
							accionReg
							editarArchivo
							observacionesReg
							listadoRemitentesReg
							*/
							if (isset($_POST["listadoRemitentesReg"]) && !is_null($_POST["listadoRemitentesReg"])) 
							{
								$estadoPQR = 6;
								
								$remitentes = json_decode($_POST["listadoRemitentesReg"], true);	

								if (!is_null($remitentes) && count($remitentes) > 0) 
								{
										$dJsonAcc = substr($registro["acciones"], 0 ,-1);
										$dJsonAccTemp = "";

										for ($i=0; $i < count($remitentes); $i++) 
										{ 
											$dJsonAccTemp.= '"'.$i.'":{"id":"'.$remitentes[$i]["id"].'","rem":"'.$remitentes[$i]["rem"].'"},';
										}

										$dJsonAccTemp = substr($dJsonAccTemp, 0 ,-1);
										$dJsonAcc .= ',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"'.$idAccion.'","da":{'.$dJsonAccTemp.'}}';

										$fecha_respuesta = $fechaActual.' '.$horaActual;

										$dJsonAcc .= ',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"2","es":"'.$estadoPQR.'"}]';

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
							if (isset($_POST["listadoPQR"]) && !is_null($_POST["listadoPQR"])) 
							{
								$estadoPQR = $registro["id_estado"];
								
								$accionesPQR = json_decode($_POST["listadoPQR"], true);	

								if (!is_null($accionesPQR) && count($accionesPQR) > 0) 
								{
										$dJsonAcc = substr($registro["acciones"], 0 ,-1);
										$dJsonAccTemp = "";

										// id = id del pqr elegido
										// pqr = nombre del pqr elegido
										// ter = termino del pqr elegido
										// pqra = nombre del pqr anterior
										// tera = termino del pqr anterior

										for ($i=0; $i < count($accionesPQR); $i++) 
										{ 
											$dJsonAccTemp.= '"'.$i.'":{"id":"'.$accionesPQR[$i]["id"].'","pqr":"'.$accionesPQR[$i]["pqr"].'","ter":"'.$accionesPQR[$i]["ter"].'","ida":"'.$registro["id_pqr"].'","tera":"'.$registro["dias_habiles"].'"},';
										}

										$dJsonAccTemp = substr($dJsonAccTemp, 0 ,-1);
										$dJsonAcc .= ',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"7","da":{'.$dJsonAccTemp.'}}]';

								}//if (count($encargados) > 0) 
								else
								{
									$error = "Lista de remitentes vacia." ; 
								}
							}//if (isset($_POST["listadoPQR"]) && !is_null($_POST["listadoPQR"]))	
							else
							{
								$error = 'se encontraron no se encontro al menos un remitente en este registro';
							}


							$tipoSW = 'success';
							$titleSW = 'Faltan parametros';
						}
						elseif ($_POST["accionReg"] == 8) 
						{

							if ($registro["id_estado"] == 3) 
							{
								$estadoPQR = 4;
							}
							else
							{
								$estadoPQR = 1;
							}

							//	fecha_respuesta

							$fecha_respuesta = $fechaActual.' '.$horaActual;

							$dJsonAcc = substr($registro["acciones"], 0 ,-1);
										$dJsonAccTemp = "";

							$dJsonAcc .= ',{"fe":"'.$fechaActual.'","hr":"'.$horaActual.'","acc":"8","es":"'.$estadoPQR.'"}]';

							$tipoSW = 'success';
							$titleSW = 'Se Ha Marcado el oficio Radicado con #'.$radicado["radicado"].'  Como Resuelto';
						}
						else
						{
							$tipoSW = 'error';
							$error = "No se encontro la acción asociada." ; 
							$titleSW = 'No se encontro la acción asociada.';
						}