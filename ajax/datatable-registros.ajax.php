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

	public function mostrarTabla()
	{	  
		//validar usuario y su perfil, ademas si tiene permiso
		$usuario = ControladorUsuarios::ctrMostrarUsuarios("id", $this->idUsuario);
		$modulo = 7;//juridica

		if ($usuario["perfil"] == $modulo) 
		{
			$registros = ControladorRadicados::ctrVerRegistros(0, $usuario["perfil"], $modulo, $this->fechaInicial, $this->fechaFinal, $this->estado);
			
		}
		elseif ($usuario["perfil"] == 8) 
		{
			$registros = ControladorRadicados::ctrVerRegistros(0, $usuario["perfil"], $modulo, $this->fechaInicial, $this->fechaFinal, $this->estado);
		}
		else
		{
			//buscar que si tenga habilitado el modulo de juridica, correspondencia
			$permiso = ControladorAsignaciones::ctrVerAsignado($this->idUsuario, $modulo);

			if (isset($permiso["modulo"])) 
			{
				if ($permiso["modulo"] == $modulo) 
				{
					//traer registros que sean del usuario y sigan en proceso
					//usuario, modulo, estado, fecha, fecha
					$registros = ControladorRadicados::ctrVerRegistros($this->idUsuario, $usuario["perfil"], $modulo, $this->fechaInicial, $this->fechaFinal, $this->estado);

					 if ( count($registros) == 0) 
	   				 { echo'{"data": []}';	return; }

	   				
				}
				else
				{
					echo'{"data": [sinpermiso]}';	return;
				}
			}
			else
			{
				echo'{"data": [permisonoexiste]}';	return;
			}

			//
		}

		if (isset($registros)) 
		{

			if (count($registros) > 0) 
			{
				$dJson = '{"data": [';

				for( $i = 0; $i < count($registros); $i++)
				{
					$acciones = "<div class='btn-group'><div class='col-md-4'><button class='btn btn-success btnVerRegistro' idRegistro='".$registros[$i]["id"]."' title='Consultar'><i class='fa fa-file-o'></i></button></div></div>";	

					$radicado = ControladorRadicados::ctrMostrarRadicados("id", $registros[$i]["id_radicado"]);

					if ( $registros["sw"] == 0 ) 
					{
						$vigencia = "<td><button class='btn btn-success btn-xs'>Finalizado</button></td>";
					}
					else if ( $registros["sw"] == 1 ) 
					{
						$vigencia = "<td><button class='btn btn-info btn-xs'>Vigente</button></td>";
					}
					else
					{
						$vigencia = "<td><button class='btn btn-danger btn-xs'>Vencido</button></td>";
					}

					$fechaUno = ControladorParametros::ctrOrdenFecha($radicado["fecha"], 0);
					$fechaDos = ControladorParametros::ctrOrdenFecha($radicado["fecha_vencimiento"], 0);


			           if ($usuario["perfil"] == $modulo || $usuario["perfil"] == 8 ) 
			           {

			           	$area = ControladorAreas::ctrMostrarAreas("id", $radicado["id_area_o"]);

			           		$dJson .='[
				    		"'.($i + 1).'",
				    		"'.$fechaUno.'",
				    		"'.$vigencia.'",
				    		"'.$fechaDos.'",
				    		"'.$radicado["radicado"].'",
				    		"'.$radicado["asunto"].'",
				    		"'.$radicado["id_remitente"].'",
				    		"'.$area["nombre"].'",
				    		"'.$acciones.'"
				    		],';
			           }
			           else
			           {
			           		$dJson .='[
				    		"'.($i + 1).'",
				    		"'.$fechaUno.'",
				    		"'.$vigencia.'",
				    		"'.$fechaDos.'",
				    		"'.$radicado["radicado"].'",
				    		"'.$radicado["asunto"].'",
				    		"'.$radicado["id_remitente"].'",
				    		"'.$acciones.'"
				    		],';
			           }

						
				}//For

				$dJson = substr($dJson, 0 ,-1);
			    $dJson.= ']
				}';

				echo $dJson;
			}// es nulo
			else
			{
				echo'{"data": []}';	return;
			}

			
		}
		else
		{
			echo'{"data": []}';	return;
		}



		//tesoreria

		//Juridica

		//usuario tesoreria

		//usuario Juridica

	}
}

$mostrar = new TablaRegistros();

/*

	idusr
	p
	es
	fechaInicial
	fechaFinal


*/

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
		$mostrar -> fechaInicial = null;
		$mostrar -> fechaFinal = null;
	}

	if (isset($_GET["p"]) && $_GET["p"] != "null") 
	{
		$mostrar -> perfil = $_GET["p"];
	}
	else
	{
		$mostrar -> perfil = null;
	}

	if (isset($_GET["es"]) && $_GET["es"] != "null") 
	{
		$mostrar -> estado = $_GET["es"];
	}
	else
	{
		$mostrar -> estado = 1;
	}

}
else
{
	echo'{"data": [nada]}';	return;
}

$mostrar -> mostrarTabla();