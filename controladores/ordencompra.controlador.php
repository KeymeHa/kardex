<?php

class ControladorOrdenCompra
{
	static public function ctrMostrarOrdenesdeComprasRango($fechaInicial, $fechaFinal)
	{
		$tabla = "ordenCompra";

		$respuesta = ModeloOrdenCompra::mdlMostrarOrdenesCRango($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
	
	}//ctrMostrarFacturas
	
	static public function ctrMostrarOrdenesdeCompras($item, $valor)
	{
		$tabla = "ordenCompra";

		$respuesta = ModeloOrdenCompra::mdlMostrarOrdenesdeCompras($tabla, $item, $valor);

		return $respuesta;
	
	}//ctrMostrarOrdenesdeCompras

	static public function ctrMostrarOrdenesdeComprasFAC($item, $valor)
	{
		$tabla = "ordenCompra";

		$respuesta = ModeloOrdenCompra::mdlMostrarOrdenesdeComprasFAC($tabla, $item, $valor);

		return $respuesta;
	
	}//ctrMostrarOrdenesdeCompras

	static public function ctrContarOrdenes($item, $valor)
	{
		$tabla = "ordenCompra";

		$respuesta = ModeloOrdenCompra::mdlContarOrdenes($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrGenerarOrdenC()
	{

		if ( isset($_POST["codigoInterno"])) {

			$tabla = "ordenCompra";


			$formaPago = ControladorParametros::ctrValidarCaracteres($_POST["nuevaFormaPago"]);
			$responsable = ControladorParametros::ctrValidarCaracteres($_POST["nuevoResponsable"]);
			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionOC"]);

			$datos = array( 'codigoInt' => $_POST["codigoInterno"],
							'id_proveedor' => $_POST["selecProveedor"],
							'id_usr' => $_POST["idUsuario"],
							'insumos' => $_POST["listaInsumos"],
							'inversion' => $_POST["valorSub"],
							'iva' => $_POST["valorIva"],
							'formaPago' => $formaPago,
							'responsable' => $responsable,
							'fechaEntrega' => $observacion,
							'observacion' => $_POST["observacionOC"]);


			$respuesta = ModeloOrdenCompra::mdlRegistrarOrdenCompra($tabla, $datos);

			if ($respuesta == "ok") 
			{

				try {

					$listaInsumos = json_decode($_POST["listaInsumos"], true);

					foreach ($listaInsumos as $key => $value) 
					{
						$item = "id";
						$valor = $value["id"];

						$res = ControladorInsumos::ctrMostrarInsumos($item, $valor);

						$precioCompra = intval($value["pre"]);
						$datos = array('precio_compra' => $precioCompra, 'id' => $valor);
						$respuesta = ControladorInsumos::ctrActualizarPrecio($tabla, $datos);

					}//foreach
					
				} catch (Exception $e) {
					echo '<script>

						swal({

							type: "error",
							title: "¡Error al actualizar precio inventario!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						})					

						</script>';

					
				}

				echo '<script>

						swal({

							type: "success",
							title: "¡Orden Generada!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "ordendecompras";
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
					
						window.location = "ordendecompras";

					}

				});
			

				</script>';


			}
		
		}


	}//ctrGenerarOrdenCompra


	static public function ctrEditarOC()
	{
		if ( isset($_POST["idOCedit"]) ) 
		{
			if ($_POST["idOCedit"] != "") 
			{

				$tabla = "ordencompra";

				$formaPago = ControladorParametros::ctrValidarCaracteres($_POST["nuevaFormaPago"]);
				$responsable = ControladorParametros::ctrValidarCaracteres($_POST["nuevoResponsable"]);
				$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionOC"]);
				
				$datos = array( 'codigoInt' => $_POST["codigoInterno"],
								'id_usr' => $_POST["idUsuario"],
								'id_proveedor' => $_POST["selecProveedor"],
								'insumos' => $_POST["listaInsumos"],
								'inversion' => $_POST["valorSub"],
								'iva' => $_POST["valorIva"],
								'formaPago' => $formaPago,
								'responsable' => $responsable,
								'fechaEntrega' => $_POST["nuevaFechaEntrOC"],
								'observacion' => $observacion,
								'id' => $_POST["idOCedit"]);

				$respuesta = ModeloOrdenCompra::mdlEditarOrdenCompra($tabla, $datos);

				if ($respuesta == "ok") 
				{

					try {

						$listaInsumos = json_decode($_POST["listaInsumos"], true);

						foreach ($listaInsumos as $key => $value) 
						{
							$item = "id";
							$valor = $value["id"];

							$res = ControladorInsumos::ctrMostrarInsumos($item, $valor);

							$precioCompra = intval($value["pre"]);
							$datos = array('precio_compra' => $precioCompra, 'id' => $valor);
							$respuesta = ControladorInsumos::ctrActualizarPrecio($tabla, $datos);

						}//foreach
						
					} catch (Exception $e) {
						echo '<script>

							swal({

								type: "error",
								title: "¡Error al actualizar precio inventario!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							})					

							</script>';

						
					}


					echo '<script>

					swal({

						type: "success",
						title: "¡Orden de Compra editada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "ordendecompras";

						}

					});
				

					</script>';

				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡Error al Identificar Orden de compra para su edición!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "ordendecompras";

						}

					});
				

					</script>';
				}
			}
		}
	}


	static public function ctrBorrarOrden($id_usr)
	{
		if(isset($_GET["idOC"]))
		{
			if ($_GET["idOC"] != null && $_GET["cd"] != null && $_GET["pr"] != null) 
			{
				$tabla = "ordencompra";
				$idOC = $_GET["idOC"];
				$respuesta = ModeloOrdenCompra::mdlBorrarOrden($tabla, $idOC);

				if($respuesta == "ok")
				{
					$tabla = "historial";

					$valorAnt = "N° ".$_GET["cd"]." para ".$_GET["pr"] ;

					$datos = array( "accion" => 4,
									"numTabla" => 8,
									"valorAnt" => $valorAnt,
									"valorNew" => "",
									"id_usr" => $id_usr
									 );

					$respuesta = ModeloHistorial::mdlInsertarHistorial($tabla, $datos);

					echo'<script>

						swal({
							  type: "success",
							  title: "Orden de Compra Eliminada",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "ordendecompras";

										}
									})

						</script>';
				}
				else
				{
					echo'<script>

						swal({
							  type: "error",
							  title: "No se pudo eliminar la Orden de Compra",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "ordendecompras";

										}
									})

						</script>';
				}
			}

			
		}

	}//ctrBorrarOrden

}