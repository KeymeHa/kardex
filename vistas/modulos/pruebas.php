<?php

			try {

				$listaInsumos = json_decode($_POST["listaInsumos"], true);

				foreach ($listaInsumos as $key => $value) 
				{

					$tabla = "insumos";
					$item = "id";
					$valor = $value["id"];

					$res = ControladorInsumos::ctrMostrarInsumos($item, $valor);

					$nuevoStock = intval($res["stock"]) + intval($value["stock"]);

					$datos = array( 'stock' => $nuevoStock, 'id' => $valor);

					$respuesta = ControladorInsumos::ctrActualizarStock($tabla, $datos);

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

					try {

						$entrada = 0;

						$datos = array( 'entrYsal' => $entrada,
										'id_insumo' => $valor,
										'anio' => $actualA,
										'mes' => $actualM);

						$movimientos = ControladorMovimientos::ctrMostrarMovimiento($datos);

						if( $movimientos == null )
						{
							
							$datos = array( 'entrYsal' => $entrada,
									'id_insumo' => $valor,
									'cantidad' => $value["stock"],
									'anio' => $actualY,
									'mes' => $actualM);

							$respuesta = ControladorMovimientos::ctrRegistrarMovimiento($datos); 

							if(!$respuesta == "ok")
							{
								echo '<script>

								swal({

									type: "error",
									title: "¡Error al Registrar Movimiento!",
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
						}
						else
						{
							
							$nuevoStock = intval($movimientos["cantidad"]) + intval($value["stock"]) ;

							$datos = array( 'cantidad' => $nuevoStock,
											'entrYsal' => $entrada,
										    'id_insumo' => $valor,
											'anio' => $actualY,
											'mes' => $actualM);

							$respuesta = ControladorMovimientos::ctrActualizarMovimiento($datos); 

							if(!$respuesta == "ok")
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
							}
						}

					} catch (Exception $e) 
					{
						echo '<script>

						swal({

							type: "error",
							title: "¡Error al Consultar Movimientos!",
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
					

				}//foreach

				
			} catch (Exception $e) {
				echo '<script>

					swal({

						type: "error",
						title: "¡Error al realizar movimiento de inventario!",
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
