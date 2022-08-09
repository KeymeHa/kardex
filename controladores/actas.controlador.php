<?php
class ControladorActas
{

	function anioActual($anio)
	{

	    if ($anio == 0) 
	    {
	    	$respuesta = '';
	    }
	    else
	    {
	    	$respuesta = 'WHERE YEAR(fecha) = '.$anio;
	    }


		return $respuesta;
	}

	static public function ctrNuevaActa()
	{
		if(isset($_POST["nuevoAutorizador"]))
		{

			$tabla = "actas";

			$autorizado = ControladorParametros::ctrValidarCaracteres($_POST["nuevoAutorizador"]);
			$dependencia = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDependencia"]);
			$responsable = ControladorParametros::ctrValidarCaracteres($_POST["nuevoResponsable"]);
			$dependenciaR = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDependenciaR"]);
			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionACT"]);

			date_default_timezone_set('America/Bogota');
			$hoy = date("Y-m-d");
			
			$datos = array( 'codigoInt' => $_POST["codigoInterno"],
							'id_usr' => $_POST["idUsuario"],
							'tipo' => $_POST["tipoActa"],
							'fecha' => $_POST["nuevaFecha"],
							'autorizado' => $autorizado,
							'dependencia' => $dependencia,
							'responsable' => $responsable,
							'dependenciaR' => $dependenciaR,
							'motivo' => $_POST["selecMotivo"],
							'observacion' => $observacion,
							'listainsumos' => $_POST["listaInsumos"],
							'fecha' => $hoy);

			$respuesta = ModeloActas::mdlRegistrarActa($tabla, $datos);

			if ($respuesta == "ok") 
			{
				
				//----------------------------------INCREMENTAR CODIGO ACTA-------------------------------------
				try {

					$indiceCodigo = "codActa";
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
							
								window.location = "actas";

							}

						});
					
						</script>';

						return ;	
					}
					
				} catch (Exception $e) {
					echo '<script>

						swal({

							type: "error",
							title: "¡Error al incrementar codigo de Acta !",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "actas";

							}

						});
					

						</script>';

						return ;	
				}
				//-------------------------------FIN INCREMENTAR CODIGO 

				echo '<script>

						swal({

							type: "success",
							title: "¡Acta Generada!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "actas";
							}

						});

					


				</script>';

				
			}
			else
			{
				echo '<script>

				swal({

					type: "error",
					title: "¡Se ha presentado un error !",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "actas";

					}

				});
			

				</script>';


			}
			
		}
	}

	static public function ctrMostrarActas($item, $valor)
	{
		$tabla = "actas";
		$r = new ControladorActas;
		$anio = $r->anioActual();	
		$respuesta = ModeloActas::mdlMostrarActas($tabla, $item, $valor, $anio);
		return $respuesta;
	}

	static public function ctrMostrarActasRango($fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "actas";
		$r = new ControladorActas;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloActas::mdlMostrarActasRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas

	static public function ctrContarTipo($fechaInicial, $fechaFinal)
	{
		$tabla = "actas";
		$r = new ControladorActas;
		$anio = $r->anioActual();
		$respuesta = ModeloActas::mdlContarTipo($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	}

	static public function ctrVerMotivo($id_motivo)
	{
		if($id_motivo == 1)
		{
			$motivo = "Prestamo";
		}
		elseif ($id_motivo == 2) {
			$motivo = "Entrega";
		}
		elseif ($id_motivo == 3) {
			$motivo = "Devolución";
		}
		elseif ($id_motivo == 4) {
			$motivo = "Manto. o Reparación";
		}
		elseif ($id_motivo == 5) {
			$motivo = "Traslado";
		}
		return $motivo;
	}

	static public function ctrVerTipo($id_motivo)
	{
		 if ($id_motivo == 1) 
        {
          $tipo = "Salida";
        }
        elseif ($id_motivo == 2) 
        {
          $tipo = "Entrada";
        }
        elseif ($id_motivo == 3) 
        {
          $tipo = "Asignación";
        }
		return $tipo;
	}

	static public function ctrEditarActa()
	{
		if(isset($_POST["edtActa"]))
		{

			$autorizado = ControladorParametros::ctrValidarCaracteres($_POST["nuevoAutorizador"]);
			$dependencia = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDependencia"]);
			$responsable = ControladorParametros::ctrValidarCaracteres($_POST["nuevoResponsable"]);
			$dependenciaR = ControladorParametros::ctrValidarCaracteres($_POST["nuevaDependenciaR"]);
			$observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacionACT"]);

			$datos = array( 'autorizado' => $autorizado,
							'dependencia' => $dependencia,
							'responsable' => $responsable,
							'dependenciaR' => $dependenciaR,
							'motivo' => $_POST["selecMotivo"],
							'observacion' => $observacion,
							'listainsumos' => $_POST["listaInsumos"]);

			if ($_POST["tipoActa"] == 1) 
			{
				array_push($datos, $_POST["nuevaFecha"]);
			}
			elseif($_POST["tipoActa"] == 2) 
			{
				array_push($datos, $_POST["nuevaFecha"]);
			}
			else
			{
				array_push($datos, "0000-00-00");
			}

			$tabla = "actas";

			array_push($datos, $_POST["edtActa"]);
			

			$respuesta = ModeloActas::mdlEditarActa($tabla, $datos, $_POST["tipoActa"]);

			if ($respuesta == "ok") 
			{
				echo '<script>

						swal({

							type: "success",
							title: "¡Acta Editada!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "actas";
							}

						});

					


				</script>';

				
			}
			else
			{
				echo '<script>

				swal({

					type: "error",
					title: "¡Se ha presentado un error !",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "actas";

					}

				});
			

				</script>';


			}
		}
	}

	static public function ctrBorrarActa($id_usr)
	{
		if(isset($_GET["idActa"]))
		{
			if ($_GET["idActa"] != null) 
			{
				$idActa = $_GET["idActa"];
				$verActa = new ControladorActas;
				$ac = $verActa->ctrMostrarActas("id", $idActa);

				if($ac != null )
				{			
					$valorAnt = $ac["codigoInt"]." ".$ac["responsable"];
					$datos = array( "accion" => 4,
									"numTabla" => 10,
									"valorAnt" => $valorAnt,
									"valorNew" => "",
									"id_usr" => $id_usr
									 );

					$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);

					$respuesta = ModeloActas::mdlBorrarActa("requisiciones", $idRq);

					if($respuesta == "ok")
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Acta Eliminada",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "actas";

											}
										})

							</script>';
					}
					else
					{
						echo'<script>

							swal({
								  type: "error",
								  title: "No se pudo eliminar el Acta",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "actas";

											}
										})

							</script>';
					}
				}
				else
				{
					echo'<script>

						swal({
							  type: "error",
							  title: "Error al identificar Acta a eliminar",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "actas";

										}
									})

						</script>';
				}

				//Restaurar item tomados

				
			}

			
		}

	}
}