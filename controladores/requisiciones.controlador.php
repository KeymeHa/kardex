<?php

class ControladorRequisiciones
{

	function anioActual($anio)
	{
		$respuesta = ($anio == 0) ? 'WHERE aprobado = 1' : 'WHERE YEAR(fecha_sol) = '.$anio.' AND aprobado = 1';
		return $respuesta;
	}

	function anioActualSinAppr($anio)
	{
	    $respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha_sol) = '.$anio;
		return $respuesta;
	}

	function anioActualConAppr($anio)
	{
	    $respuesta = ($anio == 0) ? '' : 'WHERE YEAR(fecha) = '.$anio.' aprobado = 1 ';
		return $respuesta;
	}

	function anioActualAppr($anio)
	{
		$respuesta = ($anio == 0) ? 'WHERE aprobado = 0 or  aprobado = 3' : 'WHERE YEAR(fecha_sol) = '.$anio.' AND aprobado = 0 or  aprobado = 3';
		return $respuesta;
	}

	function anioActualArea($anio)
	{
		$respuesta = ($anio == 0) ? 'WHERE aprobado = 1' : 'WHERE YEAR(requisiciones.fecha_sol) = '.$anio.' AND  aprobado = 1';
		return $respuesta;
	}

	static public function ctrMostrarRequisiciones($item, $valor, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloRequisiciones::mdlMostrarRequisiciones($tabla, $item, $valor, $anio);

		return $respuesta;
	
	}//ctrMostrarFacturas

	static public function ctrMostrarRequisicionesId($item, $valor, $id, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualSinAppr($anio);
		$respuesta = ModeloRequisiciones::mdlMostrarRequisicionesId($tabla, $item, $valor, $anio, $id);

		return $respuesta;
	
	}//ctrMostrarRequisicionesId


	static public function ctrContarInsumoAreaPersona( $sw0, $fechaInicial, $fechaFinal, $anio, $idInsumo )
	{

		$r = new ControladorRequisiciones;
		$requisiciones = $r -> ctrMostrarRequisicionesRango(null, null, $fechaInicial, $fechaFinal, $anio);

		$arrayInsumo = [[]];
		$arrayId = [];
		$count = 0;

	    foreach ($requisiciones as $key => $value) 
	    {
    		$lista = json_decode($value["insumos"], true);

    		$sw = 0;
    		$j = 0;

    		if(is_countable($lista) && count($lista) > 0 )
    		{
    			while ( $j < count($lista) && $sw == 0) 
    			{
    				if ($lista[$j]["id"] == $idInsumo) 
	    			{

	    				if ( $lista[$j]["ent"] > 0 ) 
	    				{
		    				if( empty($arrayId) )
	    					{
		    					if ($sw0 == 1) 
		    					{
		    						$area = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);
			    					$arrayId[$count] = $value["id_area"] ;
			  						$arrayInsumo[$count]["nombre"] = $area["nombre"] ;
		    					}
		    					else
		    					{
		    						$usuario = ControladorUsuarios::ctrMostrarNombre("id", $value["id_persona"]);
		    						$arrayId[$count] = $value["id_persona"] ;
			  						$arrayInsumo[$count]["nombre"] = $usuario["nombre"] ;
		    					}

		    					
		    					$arrayInsumo[$count]["ent"] = $lista[$j]["ent"] ;
		    					$count++;
		    				}
		    				else
		    				{

		    					$clave = 0;
		    					$sw2 = 0;
		    					$i = 0;

		    					do {

		    						if ($sw0 == 1) 
		    						{
		    							if( $value["id_area"] === $arrayId[$i] ){
			    							$clave = $i;
			    							$sw2 = 1;
			    						}
		    						}
		    						else
		    						{
		    							if( $value["id_persona"] === $arrayId[$i] ){
			    							$clave = $i;
			    							$sw2 = 1;
			    						}
		    						}

		    						

		    						$i++;

		    					} while ( $i < count($arrayId) && $sw2 == 0 );

	    						//echo in_array($idInsumo, $arrayId);
		    					if ( $sw2 == 1 ) 
		    					{
		    						$arrayInsumo[$clave]["ent"] = $arrayInsumo[$clave]["ent"] + $lista[$j]["ent"] ;
								}
								else
								{

									if ($sw0 == 1) 
		    						{
		    							$area = ControladorAreas::ctrMostrarAreas("id", $value["id_area"]);
				    					$arrayId[$count] = $value["id_area"] ;
				  						$arrayInsumo[$count]["nombre"] = $area["nombre"] ;	
		    						}
		    						else
		    						{
		    							$usuario = ControladorUsuarios::ctrMostrarNombre("id", $value["id_persona"]);
		    							$arrayId[$count] = $value["id_persona"] ;
				  						$arrayInsumo[$count]["nombre"] = $usuario["nombre"] ;
		    						}
									
			    					$arrayInsumo[$count]["ent"] = $lista[$j]["ent"] ;
			    					$count++;
								}
		    				}

		    				$sw == 1;
	    				}// > 0

	    			}

    				$j++;

    			}//while

    		}//is countable

	    }//foreach

	    if ( empty($arrayInsumo) )
	    {
	    	return 0;
	    }
	    else
	    {
	    	return $arrayInsumo;
	    }

	}//ctrContarInsumoArea

	static public function ctrContarInsumoPersona( $idPersona, $fechaInicial, $fechaFinal, $anio )
	{

		$r = new ControladorRequisiciones;
		$requisiciones = $r -> ctrMostrarRequisicionesRango("id_persona", $idPersona, $fechaInicial, $fechaFinal, $anio);

		//tomar cada insumo

		$arrayInsumo = [[]];
		$arrayId = [];
		$count = 0;

	    foreach ($requisiciones as $key => $value) 
	    {
    		$lista = json_decode($value["insumos"], true);

    		$sw = 0;
    		$j = 0;

    		if(is_countable($lista) && count($lista) > 0 )
    		{
    			while ( $j < count($lista) ) 
    			{
    				if ( $lista[$j]["ent"] > 0 ) 
    				{
    					if (empty($arrayId)) 
    					{
    						if (array_key_exists("ent", $lista[$j]) && array_key_exists("des", $lista[$j])) 
    						{
    							$arrayId[$count] = $lista[$j]["id"] ;
		    					$arrayInsumo[$count]["ent"] = $lista[$j]["ent"];
		    					$arrayInsumo[$count]["des"] = $lista[$j]["des"];
		    					$count++;
    						}
    					}
    					else{
    						$clave = 0;
	    					$sw2 = 0;
	    					$i = 0;

	    					while ( $i < count($arrayId) && $sw2 === 0 ) 
	    					{
	    						if ($arrayId[$i] === $lista[$j]["id"]) {
	    							$arrayInsumo[$i]["ent"] += $lista[$j]["ent"];
	    							$sw2 = 1;
	    						}

	    						$i++;
	    					}

	    					if ($sw2 === 0) 
	    					{
	    						if (array_key_exists("ent", $lista[$j]) && array_key_exists("des", $lista[$j])) 
	    						{
	    							$arrayId[$count] = $lista[$j]["id"] ;
			    					$arrayInsumo[$count]["ent"] = $lista[$j]["ent"];
			    					$arrayInsumo[$count]["des"] = $lista[$j]["des"];
			    					$count++;
	    						}
	    					}
    					}
    				}
    				$j++;
    			}
    		}//is countable

	    }//foreach

	    if ( empty($arrayInsumo) )
	    {
	    	return 0;
	    }
	    else
	    {
	    	return $arrayInsumo;
	    }
	}

	static public function ctrContarRequisicionesAppr($anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualAppr($anio);
		$respuesta = ModeloRequisiciones::mdlContarRequisicionesAppr($tabla, $anio);
		return $respuesta[0];
	
	}//ctrContarRequisicionesAppr   Mercado$456

	static public function ctrMostrarRequisicionesAppr($item, $valor, $sw, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualAppr($anio);
		$respuesta = ModeloRequisiciones::mdlMostrarRequisiciones($tabla, $item, $valor, $anio);

		return $respuesta;
	
	}//ctrMostrarRequisicionesAppr   Mercado$456

	static public function ctrMostrarRequisicionesRangoId($fechaInicial, $fechaFinal, $id, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualSinAppr($anio);
 		$respuesta = ModeloRequisiciones::mdlMostrarRequisicionesRangoIdUsr($tabla, $fechaInicial, $fechaFinal, $anio, $id);

		return $respuesta;
	
	}//ctrMostrarRequisicionesRangoId

	static public function ctrMostrarRequisicionesRango($columna, $idFiltro, $fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual($anio);

		if (!is_null($columna) && is_null($fechaInicial)) 
		{
			$anio .= " AND ".$columna." = ".$idFiltro;
		}
		elseif (!is_null($columna) && !is_null($fechaInicial)) {
			$idFiltro = " AND ".$columna." = ".$idFiltro;
		}
		else {
			$idFiltro = "";
		}

		$respuesta = ModeloRequisiciones::mdlMostrarRequisicionesRango($tabla, $fechaInicial, $fechaFinal, $anio, $idFiltro);

		return $respuesta;
	
	}//ctrMostrarRequisicionesRango

	static public function ctrMostrarRequisicionesRangoAppr($fechaInicial, $fechaFinal, $sw, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualAppr($anio);
		$respuesta = ModeloRequisiciones::mdlMostrarRequisicionesRangoAppr($tabla, $fechaInicial, $fechaFinal, $anio);
		return $respuesta;
	
	}//ctrMostrarRequisicionesRangoAppr


	static public function ctrContarRequisicionesFecha($sw, $anio)
	{
		date_default_timezone_set('America/Bogota');

		$r = new ControladorRequisiciones;
		$anio = $r->anioActual($anio);
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


	static public function ctrContarRqArea($sw, $fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "requisiciones";

		$r = new ControladorRequisiciones;
		$anio = $r->anioActualArea($anio);
		$respuesta = ModeloRequisiciones::MdlContarRqArea($tabla, $sw, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;

	}

	static public function ctrContarRqdeArea($item, $valor, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActualArea($anio);
		$respuesta = ModeloRequisiciones::MdlContarRqdeArea($tabla, $item, $valor, $anio);
		return $respuesta;

	}

	static public function ctrContarRqdePersonas($item, $valor, $item2, $valor2, $fechaInicial, $fechaFinal, $anio)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		
		$tipo_fecha = "";

		if (is_null($item2)) 
		{
			$anio = $r->anioActualArea($anio);
		}
		else
		{
			if ($item2 == "aprobado" && $valor2 == 0) 
			{
				$tipo_fecha = "fecha_sol";
				$anio = $r->anioActualSinAppr($anio);
			}
			else
			{
				$tipo_fecha = "fecha";
				$anio = $r->anioActualConAppr($anio);
			}
		}

		$respuesta = ModeloRequisiciones::MdlContarRqdePersonas($tabla, $item, $valor, $item2, $valor2, $fechaInicial, $fechaFinal, $anio, $tipo_fecha);

		if (is_null($valor2)) 
		{
			return $respuesta;
		}
		else
		{
			return $respuesta[0];
		}

	}


	static public function ctrCantidadMesAnioRq($sw, $fechaInicial, $fechaFinal, $anio, $id)
	{
		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;

		$anio = $r->anioActual($anio);	

		if ($id != 0 and $fechaInicial != null) 
		{
			$anio .=" AND id_persona = ".$id." AND ";
		}
		elseif ($id != 0 and $fechaInicial == null)
		{
			$anio .=" AND id_persona = ".$id." ";
		}
		elseif($fechaInicial != null)
		{
			$anio .= " AND ";
		}

		$respuesta = ModeloRequisiciones::MdlCantidadMesAnioRq($tabla, $sw, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;
	}

	static public function ctrTraerInsumosRq($sw, $anio)
	{

		$tabla = "requisiciones";
		$r = new ControladorRequisiciones;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloRequisiciones::MdlTraerInsumosRq($tabla, $sw, $anio);

		if ($respuesta != null) 
		{
				
             $array_id = array();
             $stock = 0;

             foreach ($respuesta as $key => $value) 
             {
               $insumo = json_decode($value["insumos"], true);

               if (is_countable($insumo)) 
               {
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
               }//countable

             
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

	static public function ctrTraerInsumosRqRango($fechaInicial, $fechaFinal, $anio)
	{

		$tabla = "requisiciones";

		$r = new ControladorRequisiciones;
		$anio = $r->anioActual($anio);
		$respuesta = ModeloRequisiciones::MdlTraerInsumosRqRango($tabla, $fechaInicial, $fechaFinal, $anio);

		return $respuesta;

		
	}


	static public function ctrCrearRequisicion($perfil, $idSession)
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
			$fechaSol = "";

			$fechaAp = null;
			
			if ($perfil == 3) 
			{
				$aprobado = 1;
				$fechaAp = $_POST["fechaAprobacion"]." ".$_POST["horaAprobacion"];
				$fechaSol = $_POST["fechaAprobacion"]." ".$_POST["horaAprobacion"];
				$tipoob = "observacion";
				$gen = 0;
			}
			else
			{
				$fechaAp = null;
				$fechaSol = date("Y-m-d H:i:s");
				$aprobado = 0;
				$tipoob = "observacionE";
				$gen = 1;
			}

			$parametro = ControladorParametros::ctrMostrarParametros(4);
			

			$tabla = "requisiciones";
			$datos = array( 'id_area' => $persona["id_area"],  
							'id_persona' => $_POST["id_persona"],
							'id_usr' => $_POST["idUsuario"],
							'codigoInt' => $parametro["codigo"],
							'insumos' => $_POST["listadoInsumosRq"],
							'fecha_sol' => $fechaSol,
							'observacion' => $_POST["observacionRq"],
							'id_proyecto' => $_POST["id_proyecto"],
							'fecha' => $fechaAp,
							'aprobado' => $aprobado,
							'gen' => $gen);

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

						$ent = (isset($value["ent"]))? intval($value["ent"]) : 0 ;


						$nuevoStock = intval($res["stock"]) - $ent;
						$precioCompra = intval($res["precio_compra"]);

						$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
						$respuesta = ControladorInsumos::ctrActualizarStock($datos);

						if($respuesta == "ok" && isset($value["ent"]) && $value["ent"] > 0 )
						{
							$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $value["id"], 1, $res["stock"], $ent, $nuevoStock, $parametro["codigo"]);
							echo ( $historial == "ok" )? '' :'<script>console.log("error create rq");</script>';
						}

					}//foreach
				}

					$indiceCodigo = "codRq";
					$indice = ControladorParametros::ctrIncrementarCodigo($indiceCodigo);

					if ($perfil == 3) 
					{
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
							type: "success",
							title: "¡Requisicion Generada!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "hisRequisicion";

							}

						});
					

						</script>';
					}

				
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
					
						window.location = "inicio";

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

	static public function ctrEditarRequisicion($anio, $idSession)
	{
		if ( isset($_POST["editarRq"]) ) 
		{
			if ($_POST["editarRq"] != null) 
			{
				$valorAnt = "";
				$titulo = "";
				$tipo = "";

				//actualizacion de inventario
				$verRq = new ControladorRequisiciones;
				$requisicion = $verRq->ctrMostrarRequisiciones("id", $_POST["editarRq"], $anio);

				if ($requisicion["aprobado"] != 2) 
				{
					if (!isset($_POST["btnAnularRq"])) 
					{
						if(!$_POST["listadoInsumosRq"] == "")
						{
							$editLista = json_decode($_POST["listadoInsumosRq"], true);
							$antLista = json_decode($requisicion["insumos"], true);

							if ($_POST["listadoInsumosRq"] != $requisicion["insumos"]) 
							{
								$valorAnt = "Modificada lista de insumos. ";
							}

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

											if($respuesta == "ok")
											{
												$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 2, $ant["ent"], $edit["ent"], $nuevoStock, $requisicion["codigoInt"]);
												echo ( $historial == "ok" )? '' :'<script>console.log("error create rq");</script>';
											}
										}

										$sw = true;							
									}
								}
									
								if($sw != true)
								{
									$nuevoStock = $insumo["stock"] - $edit["ent"];
									$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
									$respuesta = ControladorInsumos::ctrActualizarStock($datos);

									if($respuesta == "ok")
									{
										$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 2, $insumo["stock"], $edit["ent"], $nuevoStock, $requisicion["codigoInt"]);
										echo ( $historial == "ok" )? '' :'<script>console.log("error create rq");</script>';
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
												$nuevoStock = intval($insumo["stock"]) + intval($value["ent"]);
												$precioCompra = $insumo["precio_compra"];
												$datos = array( 'stock' => $nuevoStock, 'precio_compra' => $precioCompra, 'id' => $valor);
												$respuesta = ControladorInsumos::ctrActualizarStock($datos);
												if($respuesta == "ok")
												{
													$historial = ControladorInsumos::ctrHistoriaInsumo($idSession, $valor, 3, $insumo["stock"], $value["ent"], $nuevoStock, $requisicion["codigoInt"]);
													echo ( $historial == "ok" )? '' :'<script>console.log("error create rq");</script>';
												}
											}
										}
									}
								}
														
							}
						}
					}

					 $perfil = ControladorUsuarios::ctrMostrarPerfil("id", $_POST["id_persona"]);
					 $persona = ControladorPersonas::ctrMostrarIdPersona("id_usuario", $_POST["id_persona"]);

					 $fechaAp = $_POST["fechaAprobacion"]." ".$_POST["horaAprobacion"];
					 $fechaSol = ($requisicion["gen"] == 1) ? $requisicion["fecha_sol"] : $_POST["nuevaFechaSolRq"]." ".$_POST["nuevaHoraSolRq"];

					 if(isset($_POST["observacion"]))
					 {
					 	 $observacion = ControladorParametros::ctrValidarCaracteres($_POST["observacion"]) ;

					 	 if ($requisicion["observacion"] != $observacion) 
					 	 {
					 	 	$valorAnt .= "Compras Modifico el Comentario. ";
					 	 }
					 }
					 else
					 {
					 	 $observacion = $requisicion["observacion"] ;
					 }

					  if(isset($_POST["observacionE"]))
					 {
					 	 $observacionE = ControladorParametros::ctrValidarCaracteres($_POST["observacionE"]) ;
					 	 if ($requisicion["observacionE"] != $observacionE) 
					 	 {
					 	 	$valorAnt .= "El Encargado Modifico el Comentario. ";
					 	 }
					 }
					 else
					 {
					 	 $observacionE = $requisicion["observacionE"] ;
					 }

					 $datosE = array( 'id_persona' => $_POST["id_persona"],
									'id_area' => $persona["id_area"],
									'id_usr' => $_POST["idUsuario"],
									'insumos' => $_POST["listadoInsumosRq"],
									'fecha' => $fechaAp,
									'fecha_sol' => $fechaSol,
									'observacion' =>  $observacion,
									'observacionE' =>  $observacionE,
									'id' => $_POST["editarRq"]);

					 $apro = 0;
					 if ($requisicion["aprobado"] == 0) 
					 {
					 	if ($_POST["perEditar"] == 3) 
					 	{
					 		$apro = (isset($_POST["btnAnularRq"])) ? 2 : 1;
					 	}
					 		
					 	$datosE['registro'] = $_POST["editarRegistro"];
					 }
					 else
					 {
					 	if ($_POST["perEditar"] != 3) 
					 	{
					 		$apro = 3;
					 		$valorAnt .= "Solicitó Aprobación de Modificación. ";
					 	}
					 	else
					 	{
					 		$valorAnt .= "Aprobó la Modificación. ";
					 		$apro = 1;
					 	}
					 }

					$datosE['aprobado'] = $apro;

					#ACTUALIZAR REQUISICION
					$tabla = "requisiciones";
					$editado = ModeloRequisiciones::mdlEditarRq($tabla, $datosE);

					$datos = array( "accion" => 3,
									"numTabla" => 9,
									"valorAnt" => $valorAnt,
									"valorNew" => "",
									"id_usr" => $_POST["idUsuario"],
									"id_otro" => $_POST["editarRq"]
									 );
					$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);

					if ($editado == "ok") 
					{
						$titulo = "¡Requisición Editada!";
						$tipo = "success";
					}
					else
					{
						$titulo = "¡Error al Editar!";
						$tipo = "error";
					}

				}//Solo si no esta anulado
				else
				{
					$titulo = "¡Error al Editar!";
					$tipo = "error";
				}

				$url = ($_POST["perEditar"] != 3) ? 'hisRequisicion' : 'requisiciones' ;

				

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

				//actualizacion de Rq


			}// $_POST["editarRq"] != null
		}
	}

	static public function ctrBorrarRq($id_usr, $anio)
	{
		if(isset($_GET["idRq"]))
		{
			if ($_GET["idRq"] != null) 
			{
				$idRq = $_GET["idRq"];
				$verRq = new ControladorRequisiciones;
				$rq = $verRq->ctrMostrarRequisiciones("id", $idRq, $anio);

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
					//$respuesta = ModeloHistorial::mdlInsertarHistorial("historial", $datos);

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