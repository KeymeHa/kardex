<?php

class ControladorFacturas
{

	function anioActual()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);
	    if ($anio["anio"] == 0) 
	    {$respuesta = '';}
	    else
	    {$respuesta = 'WHERE YEAR(fecha) = '.$anio["anio"];}
		return $respuesta;
	}

	function anioActualProv()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);

	    if ($anio["anio"] == 0) 
	    {
	    	$respuesta = '';
	    }
	    else
	    {
	    	$respuesta = 'WHERE YEAR(facturas.fecha) = '.$anio["anio"];
	    }


		return $respuesta;
	}

	static public function ctrMostrarFacturasRango($fechaInicial, $fechaFinal)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActual();	
		$respuesta = ModeloFacturas::mdlMostrarFacturasRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas
	
	static public function ctrMostrarFacturas($item, $valor)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActual();
		$respuesta = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor, $anio);
		return $respuesta;
	
	}//ctrMostrarFacturas

	static public function ctrContarFacturasProv($fechaInicial, $fechaFinal)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActualProv();
		$respuesta = ModeloFacturas::mdlAgruparFacturas($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	}

	static public function ctrContarFacProv($fechaInicial, $fechaFinal)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActualProv();
		$respuesta = ModeloFacturas::mdlAgruparFacturasCan($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	}

	static public function ctrContarFacturas($item, $valor)
	{
		$tabla = "facturas";
		$respuesta = ModeloFacturas::mdlContarFacturas($tabla,$item, $valor);
		return $respuesta;
	}

	static public function ctrCrearFactura()
	{
		if ( isset($_POST["codigoInterno"]) ) 
		{
			$item = "id";
			$tabla = "parametros";
			$res = ModeloParametros::mdlMostrarParamentros($tabla, $item);

		    date_default_timezone_set('America/Bogota');
			$actualY = date("Y");
			$actualM = date("m");

			try {

				$directorio = "";
			
				if ( isset($_FILES["soporteFactura"]["tmp_name"]) ) 
				{
					if ( !$_FILES["soporteFactura"]["tmp_name"] == null )
					{
							
						$directorio = "vistas/facturas/".strval($actualY)."/".strval($actualM);

						if (!file_exists($directorio)) 
						{
						    mkdir($directorio, 0755, true);
						}

						if($_FILES["soporteFactura"]["type"] == "application/pdf")
						{
							$tmp_name = $_FILES['soporteFactura']['tmp_name'];
							$nombre =  intval($res[9])  + 1;
							$nombreArchivo = $nombre.'.pdf';
							$i = $nombre;

							$datos = array("nameFac"=> $nombre,
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
							$error = $_FILES['soporteFactura']['error'];

								if($error)
								{
									echo '<script>

									swal({

										type: "error",
										title: "¡Error con el soporte Factura!",
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
						title: "¡Error al crear Soporte de Factura!",
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

			$tabla = "facturas";

			$codigoFac = ControladorParametros::ctrValidarCaracteres($_POST["codigoFactura"]);
			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionNF"]);

			date_default_timezone_set('America/Bogota');
			$hoy = date("Y-m-d");

			$datos = array( 'codigoInt' => $_POST["codigoInterno"],
							'codigo' => $codigoFac,
							'id_usr' => $_POST["idUsuario"],
							'id_proveedor' => $_POST["selecProveedor"],
							'soporte' => $directorio,
							'insumos' => $_POST["listaInsumos"],
							'inversion' => $_POST["valorSub"],
							'iva' => $_POST["valorIva"],
							'observacion' => $observacion,
							'fecha' => $hoy);


			$respuesta = ModeloFacturas::mdlRegistrarFactura($tabla, $datos);

			if ($respuesta == "ok") 
			{
				//--------------------------TRAZABILIDAD CON ORDEN DE COMPRA--------------------------------
				try {
					if(! $_POST["selectOC"] == 0)
					{
						$item = "codigoInt";
						$valor = $_POST["codigoInterno"];
						$facturaAgregada = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor);
						$tabla = "ordencompra";
						$datos = array( 'fac_asociada' => $facturaAgregada["id"],
										'id' => $_POST["selectOC"]);
						$respuesta = ModeloOrdenCompra::mdlEnlazarOC($tabla, $datos);
					}		
				} catch (Exception $e) {
					
				}

				//----------------------------------INCREMENTAR CODIGO FAC-------------------------------------
				try {

					$indiceCodigo = "codFac";
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
							
								window.location = "facturas";

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
							
								window.location = "facturas";

							}

						});
					

						</script>';

						return ;	
				}
				//-------------------------------FIN INCREMENTAR CODIGO FAC-------------------------------------
				//-------------------------------MOVIMIENTOS---------------------------------------------------
					try {

					$listaInsumos = json_decode($_POST["listaInsumos"], true);

					foreach ($listaInsumos as $key => $value) 
					{

						$tabla = "insumos";
						$item = "id";
						$valor = $value["id"];

						$res = ControladorInsumos::ctrMostrarInsumos($item, $valor);

						$nuevoStock = intval($res["stock"]) + (intval($value["can"]) * intval($value["con"])) ;
						$precioCompra = intval($value["pre"]);

						$datos = array( 'stock' => $nuevoStock, 'contenido' => $value["con"], 'precio_compra' => $precioCompra, 'id' => $valor);

						$respuesta = ControladorInsumos::ctrActualizarStock($datos);

						if ( !$respuesta == "ok" ) 
						{
							echo '<script>

							swal({

								type: "error",
								title: "¡Error al Actualizar stock!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
								
									window.location = "facturas";

								}

							});
						

							</script>';

							return ;	
						}
					}//foreach


				/*

					$entrada = 0;
					$respuesta = ControladorMovimientos::ctrVerificarMovimiento($_POST["listaInsumos"], $actualY, $actualM, $entrada);

					if ( !$respuesta == "ok" ) 
						{
							
								echo '<script>

								swal({

									type: "error",
									title: "¡Error al Actualizar Movimiento!",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"

								}).then(function(result){

									if(result.value){
									
										window.location = "facturas";

									}

								});
							

								</script>';

								return ;	

						}	*/			
					
				} catch (Exception $e) {
					echo '<script>

						swal({

							type: "error",
							title: "¡Error al actualizar inventario!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "facturas";

							}

						});
					

						</script>';

						return ;	
					
				}

				//--------------------------------FIN MOVIMIENTOS---------------------------------------------
				echo '<script>

				swal({

					type: "success",
					title: "¡Factura Agregada!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "facturas";

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
					
						window.location = "nuevaFactura";

					}

				});
			

				</script>';


			}
		
		}


	}//ctrCrearFactura

	static public function ctrEditarFactura()
	{
		if ( isset($_POST["idFactura"]) ) 
		{
			$verFactura = new ControladorFacturas;
			$factura = $verFactura->ctrMostrarFacturas("id", $_POST["idFactura"]);
			$directorio = "";
			if( !$factura == null)
			{
				$tabla = "parametros";
				$res = ModeloParametros::mdlMostrarParamentros($tabla, "id");

				if ( isset($_FILES["soporteFactura"]["tmp_name"]) ) 
				{
					if(!$_FILES["soporteFactura"]["tmp_name"] == "")
					{
						if (!$factura["soporte"] == "" || !$factura["soporte"] == null) 
						{
							# modificar
							if($_FILES["soporteFactura"]["type"] == "application/pdf")
							{
								$tmp_name = $_FILES['soporteFactura']['tmp_name'];
								copy($tmp_name,$factura["soporte"]);
							}

							
						}
						else
						{
							#crear
							if ( !$_FILES["soporteFactura"]["tmp_name"] == null )
							{

								$mes = substr($factura["fecha"],5,-3);
								$anio = substr($factura["fecha"],0,-6);
									
								$directorio = "vistas/facturas/".strval($anio)."/".strval($mes);

								if (!file_exists($directorio)) 
								{
								    mkdir($directorio, 0755, true);
								}

								if($_FILES["soporteFactura"]["type"] == "application/pdf")
								{
									$tmp_name = $_FILES['soporteFactura']['tmp_name'];
									$nombre =  intval($res[9])  + 1;
									$nombreArchivo = $nombre.'.pdf';
									$i = $nombre;

									$datos = array("nameFac"=> $nombre,
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
									$error = $_FILES['soporteFactura']['error'];

										if($error)
										{
											echo '<script>

											swal({

												type: "error",
												title: "¡Error con el soporte Factura!",
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
					}
				}

				if(!$_POST["listaInsumos"] == "")
				{
					$editLista = json_decode($_POST["listaInsumos"], true);
					$antLista = json_decode($factura["insumos"], true);
					$array_antLista = [];

					foreach ($antLista as $key => $value) 
					{
						array_push($array_antLista, $value["id"]);
					}
		
					foreach ($editLista as $key => $edit) 
					{
						$item = "id";
						$valor = $edit["id"];
						$insumo = ControladorInsumos::ctrMostrarInsumos($item, $valor);
						$sw = false;
						$nuevoStock = 0;
						$precioCompra = intval($edit["pre"]);

						foreach ($antLista as $k => $ant) 
						{

							if($edit["id"] == $ant["id"])
							{
								$clave = array_search($ant["id"], $array_antLista);
								unset($array_antLista[$clave]);

								if($edit["can"] != $ant["can"])
								{
									$temp = $insumo["stock"] - ($ant["can"] * $ant["con"]);
									$nuevoStock = $temp + ($edit["can"] * $edit["con"]);
									//$nuevoStock = $temp + ($edit["can"] - $ant["can"]);
									

									$datos = array( 'stock' => $nuevoStock, 'contenido' => $edit["con"], 'precio_compra' => $precioCompra, 'id' => $valor);
									$respuesta = ControladorInsumos::ctrActualizarStock($datos);
								}
								$sw = true;							
							}
						}
							
						if($sw != true)
						{
							$nuevoStock = $insumo["stock"] + $edit["can"];
							$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
							$respuesta = ControladorInsumos::ctrActualizarStock($datos);
						}
					}//foreach

					if( count($array_antLista) >= 1)
					{
						$mayor = 1;
						$mayor = max( array_keys($array_antLista) );

						for ( $i=0 ; $i < $mayor + 1 ; $i++) 
						{ 
							if( array_key_exists($i, $array_antLista) )
							{
								foreach ($antLista as $key => $value) 
								{
									if($array_antLista[$i] == $value["id"])
									{	
										$item = "id";
										$valor = $value["id"];
										$insumo = ControladorInsumos::ctrMostrarInsumos($item, $valor);
										$nuevoStock = $insumo["stock"] - ($value["can"] * $value["con"]);
										$precioCompra = $insumo["precio_compra"];
										$datos = array( 'stock' => $nuevoStock, 'contenido' => $value["con"], 'precio_compra' => $precioCompra, 'id' => $valor);
										$respuesta = ControladorInsumos::ctrActualizarStock($datos);
									}
								}
							}
						}
												
					}
				}

			}
			else
			{
				echo '<script>

				swal({

					type: "error",
					title: "¡Hubo un error al buscar la Factura para editarla!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "facturas";

					}

				});
			

				</script>';
			}
			
				#ACTUALIZAR FACTURA

				$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionNF"]);


				$datos = array( 'codigo' => $_POST["codigoFactura"],
								'id_usr' => $_POST["idUsuario"],
								'id_proveedor' => $_POST["selecProveedor"],
								'soporte' => $directorio,
								'insumos' => $_POST["listaInsumos"],
								'inversion' => $_POST["valorSub"],
								'iva' => $_POST["valorIva"],
								'observacion' => $observacion,
								'id' => $_POST["idFactura"]);

				$tabla = "facturas";
				$editado = ModeloFacturas::mdlEditarFactura($tabla, $datos);

				if ($editado == "ok") {
					echo '<script>

					swal({

						type: "success",
						title: "¡Factura Editada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

							if(result.value){
							
								window.location = "facturas";

							}

						});
						

					</script>';
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Error al Editar!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "facturas";

						}

					});
				

					</script>';
				}
		}
	}

	static public function ctrReporteXlsx()
	{
		if(isset($_GET["r"])){

			$tabla = "facturas";
			$verFacturas = new ControladorFacturas();

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]))
			{

				
				$facturas = $verFacturas -> ctrMostrarFacturasRango($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);

			}
			else
			{
				$facturas = $verFacturas -> ctrMostrarFacturasRango($tabla, null, null);

			}
			
			date_default_timezone_set('America/Bogota');

			$fechaActual = date("Y-m-d H_i_s");

			$filename = 'Reporte '.$fechaActual.'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$filename.'"');
			header("Content-Transfer-Encoding: binary");
			

			echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #000;'>COD_INT</td>
					<td style='font-weight:bold; border:1px solid #000;'>COD_EXT</td> 
					<td style='font-weight:bold; border:1px solid #000;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #000;'>NIT</td>
					<td style='font-weight:bold; border:1px solid #000;'>COD_INSUMO</td>
					<td style='font-weight:bold; border:1px solid #000;'>INSUMO</td>
					<td style='font-weight:bold; border:1px solid #000;'>CANTIDAD</td>		
					<td style='font-weight:bold; border:1px solid #000;'>PRECIO_UN</td>
					<td style='font-weight:bold; border:1px solid #000;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #000;'>SUB_TOTAL</td>
					<td style='font-weight:bold; border:1px solid #000;'>IVA</td>
					<td style='font-weight:bold; border:1px solid #000;'>TOTAL</td>	
					<td style='font-weight:bold; border:1px solid #000;'>FECHA</td>		
					</tr>");

			foreach ($facturas as $row => $item){

				$proveedor = ControladorProveedores::ctrMostrarProveedores("id", $item["id_proveedor"]);
				$nit = $proveedor["nit"]." - ".$proveedor["digitoNit"]; 

				$arrayCan = [];
				

				 echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>".$item["codigoInt"]."</td>
			 			<td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
			 			<td style='border:1px solid #eee;'>".$proveedor["razonSocial"]."</td>
			 			<td style='border:1px solid #eee;'>".$nit."</td>
			 			<td style='border:1px solid #eee;'>");

			 	$insumos =  json_decode($item["insumos"], true);

			 	foreach ($insumos as $key => $valueinsumos) 
			 	{
		 			$insumo = ControladorInsumos::ctrMostrarInsumos("id", $valueinsumos["id"]);
		 			echo utf8_decode($insumo["codigo"]."<br>");
			 	}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

			 	foreach ($insumos as $key => $valueinsumos) 
			 	{	
		 			echo utf8_decode($valueinsumos["des"]."<br>");
			 	}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");	

			 	foreach ($insumos as $key => $valueinsumos) 
			 	{	
					array_push($arrayCan, $valueinsumos["can"]);
		 			echo utf8_decode($valueinsumos["can"]."<br>");
			 	}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");

			 	foreach ($insumos as $key => $valueinsumos) 
			 	{	
		 			echo utf8_decode("$ ".$valueinsumos["pre"]."<br>");
			 	}

			 	echo utf8_decode("</td><td style='border:1px solid #eee;'>");

			 	foreach ($insumos as $key => $valueinsumos) 
			 	{	
			 		$neto = intval($valueinsumos["pre"]) * intval($arrayCan[$key]);
		 			echo utf8_decode("$ ".$neto."<br>");
			 	}

			 	$total = intval($item["inversion"]) + intval($item["iva"]);

		 		echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ ".$item["inversion"]."</td>
					<td style='border:1px solid #eee;'>$ ".$item["iva"]."</td>	
					<td style='border:1px solid #eee;'>$ ".$total."</td>
					<td style='border:1px solid #eee;'>".$item["fecha"]."</td>		
		 			</tr>");
			}
			echo "</table>";
		}
	}


	static public function ctrTraerInsumosFacRango($fechaInicial, $fechaFinal)
	{
		$tabla = "facturas";

		$r = new ControladorFacturas;
		$anio = $r->anioActual();	
		$respuesta = ModeloFacturas::MdlTraerInsumosFacRango($tabla, $fechaInicial, $fechaFinal, $anio);

		  return $respuesta;
	}


}