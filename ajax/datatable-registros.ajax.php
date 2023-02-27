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
	public $anioActual;
	public function mostrarTabla()
	{	  

		//traer todo los registrospqr solo si su id_pqr es el mismo que al registro con el id_perfil

		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $this->idUsuario);

		if (isset($usuario["perfil"])) 
		{

			$dJson = '{"data": [';

			if ($this->perfil == 7 || $this->perfil == 3 || $this->perfil == 8) 
			{

				//traer la correspondencia de registrospqr

				$registrosPQR = ControladorRadicados::ctrVerRegistrosPQR($this->idUsuario, $usuario["perfil"], $this->fechaInicial, $this->fechaFinal, $this->estado, $this->anioActual, null , null);

				if ( count($registrosPQR) == 0 || count($registrosPQR[0]) == 0) 
	    		{  	echo'{"data": []}';	return; }


				//traer los pqr filtrados

				$traer_filtro = ControladorParametros::ctrMostrarFiltroPQR("id_per", $usuario["perfil"]);
				$id_pqr = json_decode($traer_filtro["id_pqr"], true);

				

				for ($i=0; $i < count($registrosPQR) ; $i++) 
				{ 

					$sw = 0; //dejar de buscar el id_pqr
					$x = 0;

					 while ( $x < count($id_pqr) && $sw == 0) 
			          {
			              if ($id_pqr[$x]["id"] == $registrosPQR[$i]["id_pqr"] ) 
			              {
			                $sw = 1;
			              }
			              $x++;
			          }//while

					if ($sw == 1) 
					{
						//traer información del radicado
						$radicado = ControladorRadicados::ctrMostrarRadicados("id", $registrosPQR[$i]["id_radicado"]);
						$estadoNombre = ControladorParametros::ctrmostrarRegistros("estado_pqr", "id", $registrosPQR[$i]["id_estado"]);

						$estado = "<button class='btn btn-".$estadoNombre["html"]."' title='".$estadoNombre["nombre"]."'>".$estadoNombre["nombre"]."</button>";

						$areaNombre = ControladorAreas::ctrMostrarNombreAreas("id", $registrosPQR[$i]["id_area"]);
						$usuarioNombre = ControladorUsuarios::ctrMostrarNombre("id", $registrosPQR[$i]["id_usuario"]);

						if (is_null($registrosPQR[$i]["fecha_respuesta"])) 
						{
							$fecha_respuesta = "Pendiente por Responder";
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
							$acciones .= "<div class='col-md-4'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div> <div class='col-md-4'><button class='btn btn-info btnFastRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Acceso Rapido' data-toggle='modal' data-target='#modalRegistroPQR'><i class='fa fa-bolt'></i></button></div>";
						}
						else
						{

							$acciones .= "<div class='col-md-4'><button class='btn btn-success btnVerRegistro' idRegistro='".$registrosPQR[$i]["id"]."' title='Ver'><i class='fa fa-file-o'></i></button></div>";
						}

						if (!is_null($radicado["soporte"]) && $radicado["soporte"] != "") 
						{
							$acciones .= "<div class='col-md-4'><a href='".$radicado["soporte"]."'; target='_blank'><button class='btn btn-primary' title='Adjunto'><i class='fa fa-paperclip'></i></button></a></div>";
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
				    		"'.$areaNombre["nombre"].'",
				    		"'.$usuarioNombre["nombre"].'",
				    		"'.$fecha_respuesta.'",
				    		"'.$fecha_vencimiento.'",
				    		"'.$htmldias.'",
				    		"'.$acciones.'"
				    		],';

					}//if ($sw == 1)
				}//for

				$dJson = substr($dJson, 0 ,-1);
			    $dJson.= ']
				}';

				echo $dJson;

			}
			else
			{
				//espeficificar si alguien tiene permiso para ingresar a ese modulo
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
		if (is_integer($_GET["es"]) ) 
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
}
else
{
	echo'{"data": [nada]}';	return;
}

$mostrar -> mostrarTabla();
