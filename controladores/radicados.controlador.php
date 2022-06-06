<?php

class ControladorRadicados
{
	public static function ctrMostrarRadicados($item, $valor)
	{
		$tabla = "radicados";
		$respuesta = ModeloRadicados::mdlMostrarRadicados($tabla, $item, $valor);
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
			
				if ( isset($_FILES["soporteRad"]["tmp_name"]) ) 
				{
					if ( !$_FILES["soporteRad"]["tmp_name"] == null )
					{
							
						$directorio = "vistas/radicados/".strval($actualY)."/".strval($actualM)."/".strval($actualD);

						if (!file_exists($directorio)) 
						{
						    mkdir($directorio, 0755, true);
						}

						if($_FILES["soporteRad"]["type"] == "application/pdf")
						{
							$tmp_name = $_FILES['soporteRad']['tmp_name'];
							$nombre =  intval($res[9])  + 1;
							$nombreArchivo = $nombre.'.pdf';
							$i = $nombre;

							$datos = array("nameRad"=> $nombre,
										   "id"=> $i );

							$respuesta = ControladorParametros::ctrNombreFac($datos);

							if ( !$respuesta == "ok" )
							{
								echo '<script>

								swal({

									type: "error",
									title: "¡Error al Actualizar Nombre en la tabla!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "nuevaFactura";

									}

								});
							

								</script>';

								return ;	
							}

							$directorio.='/'.$nombreArchivo;
							$error = $_FILES['soporteRad']['error'];

								if($error)
								{
									echo '<script>

									swal({

										type: "error",
										title: "¡Error con el soporte Radicado!",
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

					swal({

						type: "error",
						title: "¡Error al crear Soporte de Radicado!",
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

			$tabla = "radicados";

			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observaciones"]);
			$asunto = ControladorParametros::ctrValidarCaracteres($_POST["asunto"]);
			$remitente = ControladorParametros::ctrValidarCaracteres($_POST["remitente"]);


			date_default_timezone_set('America/Bogota');
			$hoy = date("Y-m-d");

			$objeto = ControladorParametros::ctrValidarTermino($_POST["fechaRad"],$_POST["id_objeto"]);

			
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
							'observaciones' => $observacion);


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


	static public function ctrGenerarCorte()
	{
		//traer el ultimo numero de corte
		$corte = ControladorParametros::ctrMostrarParametros(29);

		//actualizar todos los radicados con id_corte 0 a el numero de corte
		$tabla = "cortes";
		$genCorte = ModeloRadicados::mdlIngresarCorte($tabla, $corte["codigo"]);
		$id_corte = ModeloRadicados::mdlmostrarCorte($tabla, "corte", $corte["codigo"]);

		$tabla = "radicados";
		$respuesta = ModeloRadicados::mdlGenerarCorte($tabla, $id_corte["id"]);


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
	}//ctrGenerarCorte()
}