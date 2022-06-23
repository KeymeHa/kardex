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
			$ActualRad = date("Ym");
			$ActualCor = date("ymd");
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

				if($val == 26)
				{
					$r = $radicar->radicarNuevaFac($respuesta[$val], $ActualY);
					$r = "VNT".$r;
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

				if($val == 28)
				{
					$r = $radicar->radicar($respuesta[$val], $ActualRad);
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}
				if($val == 29)
				{
					$r = $radicar->corte($respuesta[$val], $ActualCor);
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
								"codVen"=> $i,
							   "id"=> $i );


				$respuesta2 = ModeloParametros::mdlActualizarYear($tabla, $datos);
				$respuesta3 = ModeloParametros::mdlNuevoyear("anios", $ActualY);
		
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

				if($val == 26)
				{
					$r = $radicar->radicarNuevaFac($i, $ActualY);
					$r = "VNT".$r;
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

				if($val == 28)
				{
					$r = $radicar->radicar($i, $ActualRad);
					$parametro = array('codigo' => $r, 'indice' => $respuesta[$val]);
					return $parametro;
				}
				if($val == 29)
				{
					$r = $radicar->corte($i, $ActualCor);
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

	static public function ctrJs_data($ruta)
	{
		$tabla = "js_data";
		$respuesta = ModeloParametros::mdlJs_data($ruta,$tabla);
		return $respuesta;
	}

	static public function ctrValidarTipoDato($dato)
	{
		if (is_integer($dato) || is_float($dato) ) 
		{
			return true;
		}

		return false;
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
			if(strlen($fechaI) == 10)
		    {
		        $fecha = substr($fechaI,8,10);
		        $fecha .= "-".substr($fechaI,5,-3);
		        $fecha .= "-".substr($fechaI,0,-6);
		    }
		    else
		    {
		        $fecha = substr($fechaI,8,-9);
		        $fecha .= "-".substr($fechaI,5,-12);
		        $fecha .= "-".substr($fechaI,0,-15);
		    }
		}
		elseif($sw == 1)
		{
			if(strlen($fechaI) == 10)
			    {
			       $fecha = substr($fechaI,8,10);
				   $meses = substr($fechaI,5,-3);
			    }
			    else
			    {
			        $fecha = substr($fechaI,8,-9);
			        $meses .= "-".substr($fechaI,5,-12);
			    }

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
				$fecha .= "-".substr($fechaI,0,-15);
		}
		elseif($sw == 2)
		{
			if(strlen($fechaI) == 10)
		    {
		        $fecha = substr($fechaI,8,10);
		        $fecha .= "/".substr($fechaI,5,-3);
		        $fecha .= "/".substr($fechaI,0,-6);
		    }
		    else
		    {
		        $fecha = substr($fechaI,8,-9);
		        $fecha .= "/".substr($fechaI,5,-12);
		        $fecha .= "/".substr($fechaI,0,-15);
		    }

		}
		elseif ($sw == 3) 
		{
			$fecha = substr($fechaI,8,-9);//dd
	        $fecha .= "/".substr($fechaI,5,-12);//mm
	        $fecha .= "/".substr($fechaI,0,-15);//YY
	        $hora = substr($fechaI,-9,-6);

	        settype($hora, "integer");

	        if ($hora < 12) 
	        {
	        	$fecha.= " - ".substr($fechaI,-9,-3);//hh-mm
	        	$fecha.= " am"; 
	        }
	        else
	        {
	        	if ($hora == 12) 
	        	{
	        		$fecha.= " - ".substr($fechaI,-9,-3);//hh-mm
	        		$fecha.= " pm"; 
	        	}
	        	else
	        	{
	        		$hora-= 12;
	        		$fecha.= " - ".$hora.":".substr($fechaI,14,2)." pm";
	        	}
	        }
		}
		elseif ($sw == 4) 
		{
			$fecha = substr($fechaI,8,-9);//dd
	        $fecha .= "/".substr($fechaI,5,-12);//mm
	        $fecha .= "/".substr($fechaI,0,-15);//YY
	        $fecha .= " - ".substr($fechaI,-9,0);//hh-mm:ss
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

	function radicar($val, $ActualY)
	{
		if($val == 0)
		{
			return $r = $ActualY."00001";
		}
		else
		{
			if ($val < 10) 
			{
				return $r = $ActualY."0000".$val;
			}
			elseif($val > 10 && $val < 100)
			{
				return $r = $ActualY."000".$val;
			}
			elseif($val >= 100 && $val < 1000)
			{
				return $r = $ActualY."00".$val;
			}
			elseif($val >= 1000 && $val < 10000)
			{
				return $r = $ActualY."0".$val;
			}
			elseif($val >= 10000)
			{
				return $r = $ActualY.$val;
			}
		}
	}

	function corte($val, $ActualY)
	{
		if($val == 0)
		{
			return $ActualY."0001";
		}
		else
		{
			if ($val < 10) 
			{
				return $ActualY."000".$val;
			}
			elseif($val > 10 && $val < 100)
			{
				return $ActualY."00".$val;
			}
			elseif($val >= 100 && $val < 1000)
			{
				return $ActualY."0".$val;
			}
			elseif($val >= 1000)
			{
				return $ActualY.$val;
			}
		}
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

	static public function ctrNombreArchivo($item, $valor)
	{
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlNombreArchivo($tabla, $item, $valor);
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
		$respuestas = ModeloParametros::mdlIncrementarCodigo($tabla, $indice, $valor);
		return $respuestas;
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


	static public function ctrVerAnio($valor)
	{
		$tabla = "anios";
		$respuesta = ModeloParametros::mdlVerAnio($tabla, $valor);
		return $respuesta;
	}

	static public function ctrActualizarAnio($item, $valor)
	{
		$tabla = "anios";
		$respuesta = ModeloParametros::mdlActualizaranio($tabla, $item, $valor);
		return $respuesta;
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

	static public function ctrActualizarIns($valor)
	{
		$tabla = "parametros";
		$respuesta = ModeloParametros::mdlActualizarIns($tabla, $valor);
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

	public static function ctrMostrarUnidades()
	{
		$tabla = "insumosunidad";
		$respuesta = ModeloParametros::mdlMostrarUnidades($tabla);
		return $respuesta;
	}


	public static function ctrMostrarUnidad($valor)
	{
		$tabla = "insumosunidad";
		$respuesta = ModeloParametros::mdlMostrarUnidad($tabla, $valor);
		return $respuesta["unidad"];
	}

	public static function ctrVerPerfil($valor)
	{
		$tabla = "perfiles";
		$respuesta = ModeloParametros::mdlVerPerfil($tabla, $valor);
		return $respuesta;
	}

	public static function ctrValidarPermiso($perfil, $jdata)
	{
		$sw = 0;
		$permiso = array(1 => "pUno",
						2 => "pDos",
						3 => "pTres",
						4 => "pCuatro");

        if ($jdata[$permiso[$perfil]] == $perfil) 
        {
          $sw = 1;
        }
        else
        {
          $sw = 0;
        }
        
		return $sw;
	}

	static public function ctrVerImpuestos($valor)
	{
		$tabla = "impuestos";
		$respuesta = ModeloParametros::mdlMostrarImpuestos($tabla);
		return $respuesta;
	}

	static public function ctrVerModulos()
	{
		$tabla = "js_data";
		$respuesta = ModeloParametros::mdlMostrarModulos($tabla);
		return $respuesta;
	}

	//Radicados
	static public function ctrmostrarRegistros($tabla, $item, $valor)
	{
		$respuesta = ModeloParametros::mdlmostrarRegistros($tabla, $item, $valor);
		return $respuesta;
	}

	static public function ctrValidarTermino($fecha, $id)
	{
		  $response = ModeloParametros::mdlmostrarRegistros("objeto","id", $id);
          $festivo = ModeloParametros::mdlmostrarFestivos();
          $fecha_v = new DateTime($fecha);
          $count = $response["termino"];
          
          while ($count != 0 && $count >= 0) 
          {
            $sws = false;
            $fecha_v->add(new DateInterval('P1D'));

            if ($fecha_v->format('l') != "Saturday" && $fecha_v->format('l') != "Sunday") 
            {
                 foreach ($festivo as $key => $value) 
                  {
                    if ($value["fecha"] == $fecha_v->format('Y-m-d')) 
                    {
                      $sws = true;
                    }
                  }

                  if ($sws != true) 
                  {
                    $count--;
                  }
            }
            else
            {
              if ( $fecha_v->format('l') == "Saturday" ) 
              {
                 $fecha_v->add(new DateInterval('P1D'));
              }
            }
          }//while

          $respuesta = ["dias" => $response["termino"],
                 "fecha_vencimiento" => $fecha_v->format('Y-m-d')];

        return $respuesta;

	}//ctrValidarTermino($fecha, $id)

	static public function ctrImportarFestivos()
	{
		if ( isset($_POST["festivosxlsx"]) ) 
		{
			if ($_FILES['festivosxlsx']['name'][0] != "")
			{
				if($_FILES["festivosxlsx"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
				{
					$directorio = "extensiones/PHPExcel/Classes/importarIns.xlsx";
			        $tmp_name = $_FILES["festivosxlsx"]["tmp_name"];

			        

			        move_uploaded_file($tmp_name, $directorio);

			        echo'<script>window.open("extensiones/PHPExcel/Classes/importarFestivos.php?otro=1", "_self");</script>';
				}
			}//festivosxlsx
		}//isset
	}


}//class