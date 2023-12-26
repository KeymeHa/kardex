<?php

class ControladorFacturas
{

	function anioActual($anio)
	{
	   $respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha) = '.$anio;
		return $respuesta;
	}

	function anioActualProv($anio)
	{
		$respuesta = ($anio == 0) ? '' : 'WHERE YEAR(facturas.fecha) = '.$anio;
		return $respuesta;

	}

	static public function ctrMostrarFacturasRango($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActual($anio);	
		$respuesta = ModeloFacturas::mdlMostrarFacturasRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas
	
	static public function ctrMostrarFacturas($item, $valor, $anio)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloFacturas::mdlMostrarFacturas($tabla, $item, $valor, $anio);
		return $respuesta;
	
	}//ctrMostrarFacturas

	static public function ctrContarFacturasProv($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActualProv($anio);
		$respuesta = ModeloFacturas::mdlAgruparFacturas($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	}

	static public function ctrContarFacProv($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "facturas";
		$r = new ControladorFacturas;
		$anio = $r->anioActualProv($anio);
		$respuesta = ModeloFacturas::mdlAgruparFacturasCan($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	}

	static public function ctrContarFacturas($item, $valor)
	{
		$tabla = "facturas";
		$respuesta = ModeloFacturas::mdlContarFacturas($tabla,$item, $valor);
		return $respuesta;
	}

	static public function ctrCrearFactura($idSession)
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

							$respuesta = ControladorParametros::ctrNombreArchivo("nameFac", $nombre);

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


			$parametro = ControladorParametros::ctrMostrarParametros(5);
			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionNF"]);

			$datos = array( 'codigoInt' => $parametro["codigo"],
							'codigo' => $codigoFac,
							'id_usr' => $_POST["idUsuario"],
							'id_proveedor' => $_POST["selecProveedor"],
							'soporte' => $directorio,
							'insumos' => $_POST["listaInsumos"],
							'inversion' => $_POST["valorSub"],
							'iva' => $_POST["valorIva"],
							'observacion' => $observacion,
							'fecha' => $_POST["fechaAprobacion"]);


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

						if($respuesta == "ok" && isset($value["can"]) && $value["can"] > 0 )
						{
							$temp = (intval($value["can"]) * intval($value["con"]));
							$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $value["id"], 4, $res["stock"], $temp, $nuevoStock, $parametro["codigo"]);
							echo ( $historial == "ok" )? '' :'<script>console.log("error create rm/fac");</script>';
						}

					}//foreach

					
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
					title: "¡Remisión Agregada!",
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

	static public function ctrEditarFactura($anio, $idSession)
	{
		if ( isset($_POST["idFactura"]) ) 
		{
			$verFactura = new ControladorFacturas;
			$factura = $verFactura->ctrMostrarFacturas("id", $_POST["idFactura"], $anio);
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
									$valores = ControladorInsumos::ctrTratarValores($valor, $precioCompra);
									$respuesta = ControladorInsumos::ctrActualizarStock($datos);

									if($respuesta == "ok")
									{
										$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 5, ($ant["can"] * $ant["con"]), $temp, $nuevoStock, $factura["codigoInt"]);
										echo ( $historial == "ok" )? '' :'<script>console.log("error edit rm/fac");</script>';
									}
								}
								$sw = true;							
							}
						}
							
						if($sw != true)
						{
							$nuevoStock = $insumo["stock"] + $edit["can"];
							$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
							$respuesta = ControladorInsumos::ctrActualizarStock($datos);
							if($respuesta == "ok")
							{
								$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 5, $insumo["stock"], $edit["can"], $nuevoStock, $factura["codigoInt"]);
								echo ( $historial == "ok" )? '' :'<script>console.log("error edit rm/fac");</script>';
							}
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
										if($respuesta == "ok")
										{
											$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 6, $insumo["stock"], ($value["can"] * $value["con"]), $nuevoStock, $factura["codigoInt"]);
											echo ( $historial == "ok" )? '' :'<script>console.log("error delete rm/fac");</script>';
										}
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
								'fecha' => $_POST["fechaAprobacion"],
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

	static public function ctrReporteXlsx($anio)
	{
		if(isset($_GET["r"])){

			$tabla = "facturas";
			$verFacturas = new ControladorFacturas();

			if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]))
			{
				$facturas = $verFacturas -> ctrMostrarFacturasRango($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"], $anio);
			}
			else
			{
				$facturas = $verFacturas -> ctrMostrarFacturasRango($tabla, null, null, $anio);
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


	static public function ctrTraerInsumosFacRango($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "facturas";

		$r = new ControladorFacturas;
		$anio = $r->anioActual($anio);	
		$respuesta = ModeloFacturas::MdlTraerInsumosFacRango($tabla, $fechaInicial, $fechaFinal, $anio);

		  return $respuesta;
	}


}