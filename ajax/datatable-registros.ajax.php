<?php

require_once "../controladores/radicados.controlador.php";
require_once "../modelos/radicados.modelo.php";

require_once "../controladores/parametros.controlador.php";
require_once "../modelos/parametros.modelo.php";

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

require_once "../controladores/areas.controlador.php";
require_once "../modelos/areas.modelo.php";

require_once "../controladores/asignaciones.controlador.php";
require_once "../modelos/asignaciones.modelo.php";

		
class TablaRegistros
{	
	public $idUsuario;
	public $perfil;
	public $fechaInicial;
	public $fechaFinal;
	public $estado;
	public $idA;
	public $anioActual;
	public function mostrarTabla()
	{	  

		//traer todo los registrospqr solo si su id_pqr es el mismo que al registro con el id_perfil
		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $this->idUsuario);

		if (isset($usuario["perfil"])) 
		{

			$dJson = '{"data": [';

			$sw2 = 0;

			if ($usuario["perfil"] == 7 || $usuario["perfil"] == 3 || $usuario["perfil"] == 8 || $usuario["perfil"] == 11) 
			{
				//traer la correspondencia de registrospqr
				$registrosPQR = ControladorRadicados::ctrVerRegistrosPQR($this->idUsuario, $usuario["perfil"], $this->fechaInicial, $this->fechaFinal, $this->estado, $this->anioActual, null , null, $this->idA);

				if (is_null($registrosPQR)) 
				{
					echo'{"data": []}';	return;
				}
				elseif ( !is_countable($registrosPQR) )
				{
					echo'{"data": []}';	return;
				
				}
				elseif (count($registrosPQR) == 0 || count($registrosPQR[0]) == 0)
				{
					echo'{"data": []}';	return;
				}

				//traer los pqr filtrados

				$per = $usuario["perfil"];

				if ($per == 11) 
				{
					$per = 7;
				}

				$traer_filtro = ControladorParametros::ctrMostrarFiltroPQR("id_per", $per);
				$id_pqr = json_decode($traer_filtro["id_pqr"], true);



				for ($i=0; $i < count($registrosPQR) ; $i++) 
				{ 
					$sw = 0; //dejar de buscar el id_pqr
					$x = 0;

					if( !is_countable($id_pqr) )
					{
						echo'{"data": []}';	return;
					}
					else
					{
						while ( $x < count($id_pqr) && $sw == 0) 
				          {
				              if ($id_pqr[$x]["id"] == $registrosPQR[$i]["id_pqr"] ) 
				              {
				                $sw = 1;
				                $sw2 = 1;
				              }
				              $x++;
				          }//while

						if ($sw == 1) 
						{
							//traer información del radicado
							$radicado = ControladorRadicados::ctrMostrarRadicados("id", $registrosPQR[$i]["id_radicado"]);
							$estadoNombre = ControladorParametros::ctrmostrarRegistros("estado_pqr", "id", $registrosPQR[$i]["id_estado"]);

							$areaNombre = ControladorAreas::ctrMostrarNombreAreas("id", $registrosPQR[$i]["id_area"]);
							$usuarioNombre = ControladorUsuarios::ctrMostrarNombrea("id", $registrosPQR[$i]["id_usuario"]);

							$estado = "";

							//si es por asignar
							if ($registrosPQR[$i]["id_estado"] == 5) 
							{
								$estado = "<button class='btn btn-".$estadoNombre["html"]." btn-agr' idReg='".$registrosPQR[$i]["id"]."' nombre='".$usuarioNombre."' rad='".$radicado["radicado"]."' title='".$estadoNombre["nombre"]."'>".$estadoNombre["nombre"]."</button>";
							}
							else
							{
								$estado = "<button class='btn btn-".$estadoNombre["html"]."' title='".$estadoNombre["nombre"]."'>".$estadoNombre["nombre"]."</button>";
							}

							if (is_null($registrosPQR[$i]["fecha_respuesta"])) 
							{
								$fecha_respuesta = "<strong>Pendiente por Responder</strong>";
							}
							else
							{
								$fecha_respuesta = ControladorParametros::ctrOrdenFecha($registrosPQR[$i]["fecha_respuesta"], 0);
							}

								$fecha_vencimiento  = ControladorParametros::ctrOrdenFecha($registrosPQR[$i]["fecha_vencimiento"], 0);


							//traer información del registropqr

							//buscar estad

							//buscar nombre id_usuario QUIEN RECIBE

							/**

								fecha registropqr    			ok
								numero radicado      			ok
								estado registropqr   			ok
								asunto radicado      			ok
								id_area registroqpr  			ok
								id_usuario registropqr 		    ok	
								fecha_respuesta registropqr     ok
								fecha_vencimiento registropqr   ok
								dias_restantes registropqr      ok
								acciones                        ok
				
							*/

							$acciones = "<div class='btn-group'>";

							 if($registrosPQR[$i]["id_estado"] != 1 && $registrosPQR[$i]["id_estado"] != 4 && $registrosPQR[$i]["id_estado"] != 6)
							{
								$acciones .= "<div class='col-lg-4 col-md-3'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div>";
							}
							else
							{

								$acciones .= "<div class='col-md-4'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div>";
							}

							if ($this->perfil == 7 && ($registrosPQR[$i]["id_estado"] == 2 || $registrosPQR[$i]["id_estado"] == 3 || $registrosPQR[$i]["id_estado"] == 5)) 
							{
								$acciones .= "<div class='col-lg-4 col-md-3'><button class='btn btn-info btnFastRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Acceso Rapido' data-toggle='modal' data-target='#modalRegistroPQR'><i class='fa fa-bolt'></i></button></div>";
							}

							if (!is_null($radicado["soporte"]) && $radicado["soporte"] != "") 
							{
								$acciones .= "<div class='col-lg-3 col-md-4 col-xs-2'><a href='".$radicado["soporte"]."'; target='_blank'><button class='btn btn-primary' title='Adjunto'><i class='fa fa-paperclip'></i></button></a></div>";
							}

							$acciones .= "</div>";

							$fInicial = date_create($radicado["fecha"]);
							$fechaActual = date('d-m-Y');
							$fActual = date_create($fechaActual);
							$iniActual = date_diff($fInicial, $fActual);//fecha

							//concatenar al json

								if ($registrosPQR[$i]["dias_contados"] <= $registrosPQR[$i]["dias_habiles"]) 
								{
									$htmldias = $registrosPQR[$i]["dias_contados"]."/".$registrosPQR[$i]["dias_habiles"];
								}
								else
								{
									$htmldias = "<strong>".$registrosPQR[$i]["dias_contados"]."/".$registrosPQR[$i]["dias_habiles"]."</strong>";
								}

								$dJson .='[
					    		"'.$radicado["fecha"].'",
					    		"'.$radicado["radicado"].'",
					    		"'.$estado.'",
					    		"'.$radicado["asunto"].'",
					    		"'.$radicado["id_remitente"].'",
					    		"'.$areaNombre.'",
					    		"'.$usuarioNombre.'",
					    		"'.$fecha_respuesta.'",
					    		"'.$fecha_vencimiento.'",
					    		"'.$htmldias.'",
					    		"'.$acciones.'"
					    		],';

						}//if ($sw == 1)
					}//si es contable

					 
				}//for
			}
			else
			{
				//espeficificar si alguien tiene permiso para ingresar a ese modulo

		        $idmodulo = 7;
		        $verModulo = ControladorAsignaciones::ctrVerAsignado($usuario["id"], $idmodulo);

		        if ( !isset($verModulo["modulo"]) ) 
		        {
					echo'{"data": []}';	return;
				}
				else
				{
					//traer todos los registros de la tabla registropqrencargado donde sea el usuario

					$registros = ControladorRadicados::ctrVerRegistrosPQREncargado($this->idUsuario, $this->fechaInicial, $this->fechaFinal, $this->estado, $this->anioActual, 1);

					if (is_countable($registros) && count($registros) > 0 && isset($registros[0]["id_registro"]) ) 
					{
						$sw2 = 1;

						for ($i=0; $i < count($registros); $i++) 
						{ 
							$registrosPQR = ControladorRadicados::ctrAccesoRapidoRegistros($registros[$i]["id_registro"], 0);
							$radicado = ControladorRadicados::ctrMostrarRadicados("id", $registrosPQR["id_radicado"]);
							$estadoNombre = ControladorParametros::ctrmostrarRegistros("estado_pqr", "id", $registrosPQR["id_estado"]);

							$areaNombre = ControladorAreas::ctrMostrarNombreAreas("id", $registrosPQR["id_area"]);
							$usuarioNombre = ControladorUsuarios::ctrMostrarNombre("id", $registrosPQR["id_usuario"]);

							$estado = "";

							//si es por asignar
							if ($registrosPQR["id_estado"] == 5) 
							{
								$estado = "<button class='btn btn-".$estadoNombre["html"]." btn-agr' idReg='".$registrosPQR["id"]."' nombre='".$usuarioNombre."' rad='".$radicado["radicado"]."' title='".$estadoNombre["nombre"]."'>".$estadoNombre["nombre"]."</button>";
							}
							else
							{
								$estado = "<button class='btn btn-".$estadoNombre["html"]."' title='".$estadoNombre["nombre"]."'>".$estadoNombre["nombre"]."</button>";
							}

							if (is_null($registrosPQR["fecha_respuesta"])) 
							{
								$fecha_respuesta = "<strong>Pendiente por Responder</strong>";
							}
							else
							{
								$fecha_respuesta = ControladorParametros::ctrOrdenFecha($registrosPQR["fecha_respuesta"], 0);
							}

								$fecha_vencimiento  = ControladorParametros::ctrOrdenFecha($registrosPQR["fecha_vencimiento"], 0);


							//traer información del registropqr

							//buscar estad

							//buscar nombre id_usuario QUIEN RECIBE

							/**

								fecha registropqr    			ok
								numero radicado      			ok
								estado registropqr   			ok
								asunto radicado      			ok
								id_area registroqpr  			ok
								id_usuario registropqr 		    ok	
								fecha_respuesta registropqr     ok
								fecha_vencimiento registropqr   ok
								dias_restantes registropqr      ok
								acciones                        ok
				
							*/

							$acciones = "<div class='btn-group'>";

							 if($registrosPQR["id_estado"] != 1 && $registrosPQR["id_estado"] != 4 && $registrosPQR["id_estado"] != 6)
							{
								$acciones .= "<div class='col-lg-4 col-md-3'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div>";
							}
							else
							{

								$acciones .= "<div class='col-md-4'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div>";
							}

							if ($registrosPQR["id_estado"] == 2 || $registrosPQR["id_estado"] == 3 || $registrosPQR["id_estado"] == 5) 
							{
								$acciones .= "<div class='col-lg-4 col-md-3'><button class='btn btn-info btnFastRegistro' idRegistro='".$registrosPQR["id"]."' title='Acceso Rapido' data-toggle='modal' data-target='#modalRegistroPQR'><i class='fa fa-bolt'></i></button></div>";
							}

							if (!is_null($radicado["soporte"]) && $radicado["soporte"] != "") 
							{
								$acciones .= "<div class='col-lg-3 col-md-4 col-xs-2'><a href='".$radicado["soporte"]."'; target='_blank'><button class='btn btn-primary' title='Adjunto'><i class='fa fa-paperclip'></i></button></a></div>";
							}

							$acciones .= "</div>";

							$fInicial = date_create($radicado["fecha"]);
							$fechaActual = date('d-m-Y');
							$fActual = date_create($fechaActual);
							$iniActual = date_diff($fInicial, $fActual);//fecha

							//concatenar al json

								if ($registrosPQR["dias_contados"] <= $registrosPQR["dias_habiles"]) 
								{
									$htmldias = $registrosPQR["dias_contados"]."/".$registrosPQR["dias_habiles"];
								}
								else
								{
									$htmldias = "<strong>".$registrosPQR["dias_contados"]."/".$registrosPQR["dias_habiles"]."</strong>";
								}

								/*

								"'.$areaNombre["nombre"].'",
					    		"'.$usuarioNombre.'",

								*/

								$dJson .='[
					    		"'.$radicado["fecha"].'",
					    		"'.$radicado["radicado"].'",
					    		"'.$estado.'",
					    		"'.$radicado["asunto"].'",
					    		"'.$radicado["id_remitente"].'",
					    		"'.$fecha_respuesta.'",
					    		"'.$fecha_vencimiento.'",
					    		"'.$htmldias.'",
					    		"'.$acciones.'"
					    		],';	
						}//$registros PQR

					}//si hay al menos un registroPQR
					else
					{
						echo'{"data": []}';	return;
					}
					//tomar cada resultado anterior y buscarlo en registropqr
					//traer toda la información de registro pqr y concatenarlo con dJson para retornarlo

				}

			}

			if ($sw2 != 0) 
			{
				$dJson = substr($dJson, 0 ,-1);
			    $dJson.= ']
				}';

				echo $dJson;
			}
			else
			{
				echo'{"data": []}';	return;
			}
		}

	}
}

$mostrar = new TablaRegistros();

if (isset($_GET["idusr"])) 
{
	$mostrar -> idUsuario = $_GET["idusr"];

	if (isset($_GET["fechaInicial"]) && $_GET["fechaInicial"] != "null") 
	{
		$mostrar -> fechaInicial = $_GET["fechaInicial"];
		$mostrar -> fechaFinal = $_GET["fechaFinal"];
	}
	else
	{
		if ( isset($_GET["actual"]) ) 
		{
			$mostrar -> anioActual = $_GET["actual"];
		}
		$mostrar -> fechaInicial = null;
		$mostrar -> fechaFinal = null;
	}

	if (isset($_GET["p"]) && $_GET["p"] != "null" && ($_GET["p"] == 3 || $_GET["p"] == 7)) 
	{
		$mostrar -> perfil = $_GET["p"];
	}
	else
	{
		$mostrar -> perfil = null;
	}

	if (isset($_GET["es"]) && $_GET["es"] != "null"  ) 
	{
		if (is_string($_GET["es"]) && $_GET["es"] != 'undefined' ) 
		{
			$mostrar -> estado = $_GET["es"];
		}
		else
		{
			$mostrar -> estado = null;
		}
	}
	else
	{
		$mostrar -> estado = null;
	}

	if (isset($_GET["idA"]) && $_GET["idA"] != "null"  ) 
	{
		if (is_string($_GET["idA"]) && $_GET["idA"] != 'undefined' ) 
		{
			$mostrar -> idA = $_GET["idA"];
		}
		else
		{
			$mostrar -> idA = null;
		}
	}
	else
	{
		$mostrar -> idA = null;
	}
}
else
{
	echo'{"data": []}';	return;
}

$mostrar -> mostrarTabla();
