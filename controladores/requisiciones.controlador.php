<?php



class ControladorRequisiciones
{

	function anioActual()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);

	    if ($anio["anio"] == 0) 
	    {
	    	$respuesta = '';
	    }
	    else
	    {
	    	$respuesta = 'WHERE YEAR(fecha_sol) = '.$anio["anio"];
	    }


		return $respuesta;
	}

	function anioActualArea()
	{
	    $anio = ControladorParametros::ctrVerAnio(true);

	    if ($anio["anio"] == 0) 
	    {
	    	$respuesta = '';
	    }
	    else
	    {
	    	$respuesta = 'WHERE YEAR(requisiciones.fecha_sol) = '.$anio["anio"];
	    }


		return $respuesta;
	}

	static public function ctrMostrarRequisiciones($item, $valor)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$respuesta = ModeloRequisiciones::mdlMostrarRequisiciones($tabla, $item, $valor, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas   Mercado$456

	static public function ctrMostrarRequisicionesRango($fechaInicial, $fechaFinal)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$respuesta = ModeloRequisiciones::mdlMostrarRequisicionesRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas


	static public function ctrContarRequisicionesFecha($sw)
	{
		date_default_timezone_set('America/Bogota');

		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$mes = date("m");
		$tabla = "requisiciones";
		$respuesta = ModeloRequisiciones::mdlContarRequisicionesFecha($tabla, $sw, $anio, $mes);

		if ($sw == 1) 
		{

			if ($anio != "") 
			{
				$mes = ControladorParametros::nombreMes($mes);
				$respuesta[0] = $mes." ".$respuesta[0];
			}
		}

		return $respuesta;
	}


	static public function ctrContarRqArea($sw, $fechaInicial, $fechaFinal)
	{
		$tabla = "requisiciones";

		$r = new ControladorRequisiciones;
		$anio = $r->anioActualArea();
		$respuesta = ModeloRequisiciones::MdlContarRqArea($tabla, $sw, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;

	}

	static public function ctrContarRqdeArea($item, $valor)
	{
		$tabla = "requisiciones";

		$respuesta = ModeloRequisiciones::MdlContarRqdeArea($tabla, $item, $valor);

		return $respuesta;

	}

	static public function ctrContarRqdePersonas($fechaInicial, $fechaFinal)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualArea();
		$respuesta = ModeloRequisiciones::MdlContarRqdePersonas($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;

	}


	static public function ctrCantidadMesAnioRq($sw, $fechaInicial, $fechaFinal)
	{
		$tabla = "requisiciones";

		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$respuesta = ModeloRequisiciones::MdlCantidadMesAnioRq($tabla, $sw, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	}

	static public function ctrTraerInsumosRq($sw)
	{

		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$respuesta = ModeloRequisiciones::MdlTraerInsumosRq($tabla, $sw, $anio);

		if ($respuesta != null) 
		{
				
             $array_id = array();
             $stock = 0;

             foreach ($respuesta as $key => $value) 
             {
               $insumo = json_decode($value["insumos"], true);

               for ($j=0; $j < count($insumo); $j++) 
               { 
                  if($array_id == null)
                   {
                    array_push($array_id, $insumo[$j]["id"]);
                    $stock+= $insumo[$j]["ent"];
                   }
                   else
                   {
                     $sw2 = 0;

                      for ($i=0; $i < count($array_id); $i++) 
                      { 
                        if ($array_id[$i] == $insumo[$j]["id"]) 
                        {
                          $stock+= $insumo[$j]["ent"];
                          $sw2 = 1;
                        }
                      }
                     if ($sw2 != 1) 
                     {
                     	$stock+= $insumo[$j]["ent"];
                        array_push($array_id, $insumo[$j]["id"]);
                     }
                   }
               }             
             }

         	if($sw == 3 || $sw == 4)
         	{
         		return $stock;
         	}
         	elseif($sw == 0 || $sw == 1)
         	{
				return count($array_id);
         	}

		}
		else
		{
			return 0;
		}
		
	}

	static public function ctrTraerInsumosRqRango($fechaInicial, $fechaFinal)
	{

		$tabla = "requisiciones";

		$r = new ControladorRequisiciones;
		$anio = $r->anioActual();
		$respuesta = ModeloRequisiciones::MdlTraerInsumosRqRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;

		
	}


	static public function ctrCrearRequisicion()
	{
		if ( isset($_POST["listadoInsumosRq"]) ) 
		{
			date_default_timezone_set('America/Bogota');

			if ( isset($_POST["importadoRq"]) ) 
			{
				if($_POST["importadoRq"] == 1)
				{
					$tabla = "tempinsumosrq";
					$respuesta = ModeloRequisiciones::mdlLimpiarTablaTemp($tabla);
				}	
			}

		   	$item = "id";
	        $valor = $_POST["id_persona"];
			$persona = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $_POST["id_persona"]);
			$perfil = ControladorUsuarios::ctrMostrarPerfil("id", $_POST["id_persona"]);
			$fechaSol = date("Y-m-d");
			
			if ($perfil != 4) 
			{
				$aprobado = 1;
				$fechaAp = date("Y-m-d");
				$tipoob = "observacion";
			}
			else
			{
				$fechaAp = "0000-00-00";
				$aprobado = 0;
				$tipoob = "observacionE";
			}
			$tabla = "requisiciones";
			$datos = array( 'id_area' => $persona["id_area"],  
							'id_persona' => $_POST["id_persona"],
							'id_usr' => $_POST["idUsuario"],
							'codigoInt' => $_POST["codigoInterno"],
							'insumos' => $_POST["listadoInsumosRq"],
							'fecha_sol' => $fechaSol,
							'observacion' => $_POST["observacionRq"],
							'fecha' => $fechaAp,
							'aprobado' => $aprobado);

			$respuesta = ModeloRequisiciones::mdlRegistrarRequisicion($tabla, $datos, $tipoob);

			if( $respuesta == "ok")
			{
				//----------------------------------------------------------------------------

				if ($perfil != 4) 
				{
					$listaInsumos = json_decode($_POST["listadoInsumosRq"], true);

					foreach ($listaInsumos as $key => $value) 
					{

						$tabla = "insumos";
						$item = "id";
						$valor = $value["id"];

						$res = ControladorInsumos::ctrMostrarInsumos($item, $valor);

						$nuevoStock = intval($res["stock"]) - intval($value["ent"]);
						$precioCompra = intval($res["precio_compra"]);

						$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);

						$respuesta = ControladorInsumos::ctrActualizarStock($datos);

					}//foreach
				}

					$indiceCodigo = "codRq";
					$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);

				echo '<script>

				swal({
					type: "success",
					title: "¡Requisicion Generada!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "requisiciones";

					}

				});
			

				</script>';
			}
			else
			{
				echo '<script>

				swal({

					type: "error",
					title: "¡Error al generar Requisición.!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "requisiciones";

					}

				});
			

				</script>';
			}

		}#isset($_POST["listadoProductosRq"]) 
	}#ctrCrearRequisicion

	
	static public function ctrImportarRq()
	{
		if ( isset($_POST["importacionGenerada"]) ) 
		{
			if ($_FILES['nuevaImpRq']['name'][0] != "")
			{
				if($_FILES["nuevaImpRq"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
				{


					$directorio = "extensiones/PHPExcel/Classes/importarRQ.xlsx";
			        $tmp_name = $_FILES["nuevaImpRq"]["tmp_name"];
			        move_uploaded_file($tmp_name, $directorio);

			        echo'<script>window.open("extensiones/PHPExcel/Classes/rqImportada.php?otro=1", "_self");</script>';

				}
			}//nuevaImpRq
		}//isset
	}//ctrImportarRq


	static public function ctrMostrartempRq()
	{
		$tabla = "tempinsumosrq";
		$item = null;
		$valor = null;
		$respuesta = ModeloRequisiciones::mdlMostrartempRq($tabla, $item, $valor);
		return $respuesta;
	}//ctrMostrartempRq

	static public function ctrMostrartempDatosRq()
	{
		$tabla = "tempdatosrq";
		$respuesta = ModeloRequisiciones::mdlMostrartempDatosRq($tabla);
		return $respuesta;
	}//ctrMostrartempRq

	static public function ctrEditarRequisicion()
	{
		

		if ( isset($_POST["editarRq"]) ) 
		{
			if ($_POST["editarRq"] != null) 
			{
				
				//actualizacion de inventario

				$verRq = new ControladorRequisiciones;
				$requisicion = $verRq->ctrMostrarRequisiciones("id", $_POST["editarRq"]);

				if(!$_POST["listadoInsumosRq"] == "")
				{
					$editLista = json_decode($_POST["listadoInsumosRq"], true);
					$antLista = json_decode($requisicion["insumos"], true);
					$array_antLista = [];

					foreach ($antLista as $key => $value) 
					{
						$array_antLista [] = $value["id"];
						//array_push($array_antLista, $value["id"]);
					}
		
					foreach ($editLista as $key => $edit) 
					{
						$item = "id";
						$valor = $edit["id"];
						$insumo = ControladorInsumos::ctrMostrarInsumos($item, $valor);
						$sw = false;
						$nuevoStock = 0;
						$precioCompra = intval($insumo["precio_compra"]);

						foreach ($antLista as $k => $ant) 
						{

							if($edit["id"] == $ant["id"])
							{
								$clave = array_search($ant["id"], $array_antLista);
								unset($array_antLista[$clave]);

								if($edit["ent"] != $ant["ent"])
								{
									if ($edit["ent"] > $ant["ent"]) 
									{
										$nuevoStock = $insumo["stock"] - ($edit["ent"] - $ant["ent"]);
									}
									else
									{
										$nuevoStock = $insumo["stock"] + ($ant["ent"] - $edit["ent"]);
									}

									$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
									$respuesta = ControladorInsumos::ctrActualizarStock($datos);
								}

								$sw = true;							
							}
						}
							
						if($sw != true)
						{
							$nuevoStock = $insumo["stock"] - $edit["ent"];
							$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
							$respuesta = ControladorInsumos::ctrActualizarStock($datos);
						}
					}//foreach


					#$datos = array( 'stock' => $nuevoStock, 'id' => $valor);
					#$respuesta = ControladorInsumos::ctrActualizarStock($tabla, $datos);



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
										$nuevoStock = intval($insumo["stock"]) + intval($value["ent"]);
										$precioCompra = $insumo["precio_compra"];
										$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
										$respuesta = ControladorInsumos::ctrActualizarStock($datos);
									}
								}
							}
						}
												
					}
				}

	            $persona = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $_POST["id_persona"]);

	            date_default_timezone_set('America/Bogota');
				$fechaAp = date("Y-m-d");
				#ACTUALIZAR REQUISICION
				$datos = array( 'id_persona' => $_POST["id_persona"],
								'id_area' => $persona["id_area"],
								'id_usr' => $_POST["idUsuario"],
								'insumos' => $_POST["listadoInsumosRq"],
								'fecha' => $fechaAp,
								'observacion' => $_POST["observacionRq"],
								'aprobado' => 1,
								'id' => $_POST["editarRq"]);

				$tabla = "requisiciones";
				$editado = ModeloRequisiciones::mdlEditarRq($tabla, $datos);

				if ($editado == "ok") {
					echo '<script>

					swal({

						type: "success",
						title: "¡Requisición Editada!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

							if(result.value){
							
								window.location = "requisiciones";

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
						
							window.location = "requisiciones";

						}

					});
				

					</script>';
				}

				//actualizacion de Rq


			}// $_POST["editarRq"] != null
		}
	}

	static public function ctrBorrarRq($id_usr)
	{
		if(isset($_GET["idRq"]))
		{
			if ($_GET["idRq"] != null) 
			{
				$idRq = $_GET["idRq"];
				$verRq = new ControladorRequisiciones;
				$rq = $verRq->ctrMostrarRequisiciones("id", $idRq);

				if($rq != null )
				{
					$listaInsumos = json_decode($rq["insumos"], true);

					if($listaInsumos != null)
					{
						foreach ($listaInsumos as $key => $value) 
						{
							$item = "id";
							$valor = $value["id"];
							$insumo = ControladorInsumos::ctrMostrarInsumos($item, $valor);
							$nuevoStock = intval($insumo["stock"]) + intval($value["ent"]);
							$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $insumo["precio_compra"], 'id' => $valor);
							$respuesta = ControladorInsumos::ctrActualizarStock($datos);
						}
					}
					
					$area = ControladorAreas::ctrMostrarAreas("id", $rq["id_area"]);
					$valorAnt = $rq["codigoInt"]." ".$area["nombre"];
					$datos = array( "accion" => 4,
									"numTabla" => 9,
									"valorAnt" => $valorAnt,
									"valorNew" => "",
									"id_usr" => $id_usr
									 );
					$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);

					$respuesta = ModeloRequisiciones::mdlBorrarRq("requisiciones", $idRq);

					if($respuesta == "ok")
					{
						echo'<script>

							swal({
								  type: "success",
								  title: "Requisición Eliminada",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "requisiciones";

											}
										})

							</script>';
					}
					else
					{
						echo'<script>

							swal({
								  type: "error",
								  title: "No se pudo eliminar la Requisción",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result) {
											if (result.value) {

											window.location = "requisiciones";

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
							  title: "Error al identificar Requisición a eliminar",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result) {
										if (result.value) {

										window.location = "requisiciones";

										}
									})

						</script>';
				}

				//Restaurar item tomados

				
			}

			
		}

	}

}