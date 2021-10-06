<?php

class ControladorParametros
{
	static public function ctrMostrarParametros($val)
	{
		if($val != null)
		{
			$item = "id";
			$tabla = "parametros";
			$respuesta = ModeloParametros::mdlMostrarParamentros($tabla, $item);

			try {
			    date_default_timezone_set('America/Bogota');
			} catch (Exception $e){	}

			$ActualY = date("Y");
			$radicar = new ControladorParametros;

			if( $respuesta[8] == $ActualY)
			{
				if($val == 4)
				{
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "RQ".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 5)
				{
					
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "FAC".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 6)
				{
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "PED".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 7)
				{
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "OC".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 20)
				{
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "ACT".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}
			}
			else
			{
				$i = 1;
				$datos = array("anioActual"=> $ActualY,
								"codRq"=> $i,
								"codFac"=> $i,
								"codPed"=> $i,
								"codOrdC"=> $i,
								"codActa"=> $i,
							   "id"=> $i );

				$respuesta2 = ModeloParametros::mdlActualizarYear($tabla, $datos);
		
				if($val == 4)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "RQ".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 5)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "NF".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 6)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "PED".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 7)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "OC".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

				if($val == 20)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "ACT".$r;
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}

			}

		}
		else{
			$parametro = array('codigo' => "Error", 'indice' => "Error");
			return $parametro;
		}
	}//ctrMostrarParametros

	static public function ctrJs_Files()
	{
		$tabla = "js_files";
		$respuesta = ModeloParametros::mdlJs_Files($tabla);
		return $respuesta;
	}

	static public function ctrSumatoria($valor1, $valor2)
	{
		if($valor2 != null)
		{
			$sumatoria = intval($valor1) + intval($valor2);
		}
		else
		{
			$sumatoria = $valor1;
		}
		$divSum = "$ <span class='cantidadEfectivo'>".$sumatoria."</span>";
		return $divSum;
	}

	static public function ctrContarInsumos($listaJson)
	{
		$lista = json_decode($listaJson, true);
        
        $can = 0;
        if( !$lista == null )
        {
          foreach ($lista as $k => $v) 
          {
            $can ++;
          }
        }

     	return $can; 

	}


	static public function ctrOrdenFecha($fechaI, $sw)
	{
		if($sw == 0)
		{
			$fecha = substr($fechaI,8,10);
            $fecha .= "-".substr($fechaI,5,-3);
            $fecha .= "-".substr($fechaI,0,-6);
		}
		elseif($sw == 1)
		{
			$fecha = substr($fechaI,8,10);
			$meses = substr($fechaI,5,-3);
			if($meses == "01")
				{
				$mes = "Enero";
				}elseif ($meses == "02"){
				$mes = "Febrero";
				}elseif ($meses == "03"){
				$mes = "Marzo";
				}elseif ($meses == "04"){
				$mes = "Abril";
				}elseif ($meses == "05"){
				$mes = "Mayo";
				}elseif ($meses == "06"){
				$mes = "Junio";
				}elseif ($meses == "07"){
				$mes = "Julio";
				}elseif ($meses == "08"){
				$mes = "Agosto";
				}elseif ($meses == "09"){
				$mes = "Septiembre";
				}elseif ($meses == "10"){
				$mes = "Octubre";
				}elseif ($meses == "11"){
				$mes = "Noviembre";
				}elseif ($meses == "12"){
				$mes = "Diciembre";
				}
				$fecha.= "-".$mes;
				$fecha .= "-".substr($fechaI,0,-6);
		}
		elseif($sw == 2)
		{
			$fecha = substr($fechaI,8,10);
            $fecha .= "/".substr($fechaI,5,-3);
            $fecha .= "/".substr($fechaI,0,-6);
		}
		elseif ($sw == 3) 
		{
			$fecha = substr($fechaI,8,-9);//dd
	        $fecha .= "/".substr($fechaI,5,-12);//mm
	        $fecha .= "/".substr($fechaI,0,-15);//YY
	        $fecha .= " - ".substr($fechaI,-9,-3);//YY
		}
		return $fecha;
	}

	static public function nombreMes($meses)
	{
		if($meses == 1)
		{
		$mes = "Enero";
		}elseif ($meses == 2){
		$mes = "Febrero";
		}elseif ($meses == 3){
		$mes = "Marzo";
		}elseif ($meses == 4){
		$mes = "Abril";
		}elseif ($meses == 5){
		$mes = "Mayo";
		}elseif ($meses == 6){
		$mes = "Junio";
		}elseif ($meses == 7){
		$mes = "Julio";
		}elseif ($meses == 8){
		$mes = "Agosto";
		}elseif ($meses == 9){
		$mes = "Septiembre";
		}elseif ($meses == 10){
		$mes = "Octubre";
		}elseif ($meses == 11){
		$mes = "Noviembre";
		}elseif ($meses == 12){
		$mes = "Diciembre";
		}

		return $mes;
	}

	static public function ctrJs_Terms()
	{
		$tabla = "js_terms";
		$respuesta = ModeloParametros::mdlJs_Terms($tabla);
	}

	function radicarNuevaFac($val, $ActualY)
	{
		if($val == 0)
			{
				return $r = "-001-".$ActualY;
			}
			else
			{
				if( $val < 10 && $val > 0 )
				{
					$r = "-00".$val."-".$ActualY;
					return $r;
				}
				elseif ($val < 100 && $val >= 10) 
				{
					//un cero
					$r = "-0".$val."-".$ActualY;
					return $r;
				}
				elseif( $val >= 100 )
				{
					//sincero :v
					$r = "-".$val."-".$ActualY ;
					return $r;
				}
			}

	}

	static public function ctrNombreFac($datos)
	{
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlNombreFac($tabla, $datos);
		return $respuesta;
	}

	static public function ctrMostrarTodosParam()
	{
		$tabla = "parametros";
		$item = "id";
		$respuesta = ModeloParametros::mdlMostrarParamentros($tabla, $item);
		return $respuesta;
	}

	static public function ctrIncrementarCodigo($indice)
	{
		$tabla = "parametros";
		$item = "id";
		$respuesta = ModeloParametros::mdlMostrarParamentros($tabla, $item);

		$valor = $respuesta[$indice] + 1;
		$respuesta = ModeloParametros::mdlIncrementarCodigo($tabla, $indice, $valor);
		return $respuesta;
	}

	static public function ctrMostrarLimInsumos($item, $valor)
	{
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlMostrarParamentros($tabla, $item);

		return $respuesta;
	}

	static public function ctrEditarLimInsumos()
	{

		if( isset($_POST["insumoBajo"]))
		{
			if(preg_match('/^[0-9]+$/', $_POST["insumoBajo"]) && preg_match('/^[0-9]+$/', $_POST["insumoModerado"]) && preg_match('/^[0-9]+$/', $_POST["insumoAlto"]) )
			{

				$tabla = "parametros";
				$datos = array('stMinimo' => $_POST["insumoBajo"],
								'stModerado' => $_POST["insumoModerado"],
								'stAlto' => $_POST["insumoAlto"],
								'id' => 1);

				$respuesta = ModeloParametros::mdlActualizarLimIns($tabla, $datos);

				if ($respuesta == "ok") 
				{
					echo '<script>

					swal({

						type: "success",
						title: "¡Limites Modificados!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "insumos";

						}

					});
				

					</script>';

					
				}
				else
				{
					echo '<script>

					swal({

						type: "error",
						title: "¡No se actualizaron los Limites!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "insumos";

						}

					});
				

					</script>';


				}
			}
		}
	}



	static public function ctrEditarDatosFac()
	{

		if( isset($_POST["editarRazonSFAC"]))
		{
			$tabla = "parametros";
			$datos = array('razonSocial' => $_POST["editarRazonSFAC"],
							'nit' => $_POST["editarNitFAC"],
							'direccion' => $_POST["editarDicFAC"],
							'tel' => $_POST["editarTelFAC"],
							'correo' => $_POST["editarCorreoFAC"],
							'direccionEnt' => $_POST["editarDicEFAC"],
							'repLegal' => $_POST["editarRepLFAC"],
							'id' => 1);

			$respuesta = ModeloParametros::mdlActualizarDatosFAC($tabla, $datos);

			if ($respuesta == "ok") 
			{
				echo '<script>

				swal({

					type: "success",
					title: "¡Datos Modificados!",
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
					title: "¡No se actualizaron los Datos de Facturación!",
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

	static public function ctrVerificarIns()
	{
		$item = "id";
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlMostrarParamentros($tabla, $item);
		return $respuesta["validarIns"];
	}

	static public function ctrActualizarIns()
	{
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlActualizarIns($tabla);
		return $respuesta;
	}

	static public function ctrValidarCaracteres($cadenaIn)
	{
		$comillas = array('"', "'");
		$cadenaOut = str_replace($comillas, "&quot", $cadenaIn);
		$cadenaOut = trim($cadenaOut, " \t.");
		return $cadenaOut;
	}

	static public function ctrValidarCaracteresEspeciales($cadenaIn)
	{
		$codigoAscii = array('&quot');
		$cadenaOut = str_replace($codigoAscii, '"', $cadenaIn);
		return $cadenaOut;
	}

	static public function ctrEditarValorIVA()
	{
		if(isset($_POST["evalorIVA"]))
		{
			$redirigir =  $_POST["paginaRedirigida"];
			if($redirigir == 1)
			{$pagina = "ordendecompras";}
			elseif ($redirigir == 2){$pagina = "facturas";}
			else{$pagina = "inicio";}
			$negativo = -1;
			if($_POST["evalorIVA"] != null || $_POST["evalorIVA"] > $negativo)
			{
				if( preg_match('/^[0-9]+$/', $_POST["evalorIVA"]) )
				{
					$datos = array(	"valorIVA" => $_POST["evalorIVA"],
									"id" => 1);
					$tabla = "parametros";
					$respuesta = ModeloParametros::mdlActualizarIVA($tabla, $datos);
					if( $respuesta == "ok")
					{
						echo '<script>
						swal({
							type: "success",
							title: "¡IVA actualizado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){	
								window.location = "'.$pagina.'";
							}
						});
						</script>';
					}
					else
					{
						echo '<script>
						swal({
							type: "error",
							title: "¡Ha ocurrido un error al actualizar el IVA!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result){
							if(result.value){
								window.location = "'.$pagina.'";
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
						title: "¡Se han introducido valores erroneos!",
						text: "Se aceptan solo números",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "'.$pagina.'";
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
					title: "¡No puede ir vacio o numeros negativos!",
					text: "Se aceptan solo números positivos",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
				}).then(function(result){
					if(result.value){
						window.location = "'.$pagina.'";
					}
				});
				</script>';
			}
		}	
	}
}//class