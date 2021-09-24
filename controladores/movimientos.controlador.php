<?php

class ControladorMovimientos
{

	
	static public function ctrMostrarMovimiento($datos)
	{

		$tabla = "movimientos";

		$respuesta = ModeloMovimientos::mdlMostrarMovimiento($tabla, $datos);

		return $respuesta;

	}

	static public function ctrActualizarMovimiento($datos)
	{
		$tabla = "movimientos";

		$respuesta = ModeloMovimientos::mdlActualizarMovimiento($tabla, $datos);

		return $respuesta;
	}


	static public function ctrRegistrarMovimiento($datos)
	{
		$tabla = "movimientos";

		$respuesta = ModeloMovimientos::mdlRegistrarMovimiento($tabla, $datos);

		return $respuesta;
	}

	static public function ctrVerificarMovimiento($lista, $actualY, $actualM, $entrYsal)
	{
		$datos = array( 'entrYsal' => $entrYsal,
						'anio' => $actualY,
						'mes' => $actualM );

		$verMov = new ControladorMovimientos;
		$res = $verMov->ctrMostrarMovimiento($datos);
		$dJson = '[';

		if(!$res == null)
		{
			$listaArray = json_decode($lista, true);
			$listaMov = json_decode($res["insumos"], true);

			$dJsonTemp = "";

			foreach ($listaArray as $key => $value) 
			{
				$sw = 0;
				
				foreach ($listaMov as $key => $val) 
				{
					if( $value["id"] == $val["id"])
					{
						if($entrYsal == 0)
						{
							# in...
							$nuevoStock = intval($value["can"]) + intval($val["can"]);
						}
						elseif ($entrYsal == 1) {
							# out...
							$nuevoStock = intval($value["can"]) + intval($val["ent"]);
						}
						$dJson .='{"id":"'.$value["id"].'", "can":"'.$nuevoStock.'"},';
						$sw = 1;
					}
				}//foreach

				if( !$sw == 1 )
					{
						if($entrYsal == 0)
						{
							# in...
							$dJsonTemp .='{"id":"'.$value["id"].'", "can":"'.$value["can"].'"},';
						}
						elseif ($entrYsal == 1) {
							# out...
							$dJsonTemp .='{"id":"'.$value["id"].'", "can":"'.$value["ent"].'"},';
						}
					}

			}//foreach

			$dJson .= $dJsonTemp;
			$dJson = substr($dJson, 0 ,-1);
			$dJson .= ']';

			$datos = array( 'insumos' => $dJson, 
							'entrYsal' => $entrYsal,
							'anio' => $actualY,
							'mes' => $actualM);

			$actMov = new ControladorMovimientos;
			$respuesta = $actMov->ctrActualizarMovimiento($datos); 

			return $respuesta ;

		}
		else
		{
			$listaArray = json_decode($lista, true);
			foreach ($listaArray as $key => $value) {
				if($entrYsal == 0)
				{
					# in...
					$dJson .='{"id":"'.$value["id"].'", "can":"'.$value["can"].'"},';
				}
				elseif ($entrYsal == 1) 
				{
					# out...
					$dJson .='{"id":"'.$value["id"].'", "can":"'.$value["ent"].'"},';
				}
			}

			$dJson = substr($dJson, 0 ,-1);
			$dJson .= ']';

			$datos = array( 'entrYsal' => $entrYsal,
							'insumos' => $dJson,
							'anio' => $actualY,
							'mes' => $actualM);

			$regMov = new ControladorMovimientos;
			$respuesta = $regMov->ctrRegistrarMovimiento($datos);

			return $respuesta ;
		}	


	}//ctrVerificarMovimiento


	static public function ctrCompararJsonFac($jsonUno, $jsonDos)
	{
		$verificar = json_decode($jsonUno, true);
		$almacenado = json_decode($jsonDos, true);

		$sw0 = 0;
		$dJson = "";

		foreach ($verificar as $key => $value) {
			$sw1 = 0;
			foreach ($almacenado as $k => $val) 
			{
				if($verificar["id"] == $almacenado["id"])
				{
					if(!$verificar["can"] == $almacenado["can"])
					{

						if($sw0 == 0)
						{
							$dJson = '[';
							$sw0 = 1;
						}

						$mov = intval($verificar["can"]) -  intval($almacenado["can"]); 

						if($mov < 0)
						{
							$mov = $mov * (-1);
							$sw = 0;//fueron menos
						}
						elseif ($mov > 0) {
							$sw = 1;//eran mas
						}
						else
						{
							$sw = 2;//se elimino
						}
					}
					$sw1 = 1;
				}
			}
				if($sw1 == 1)
				{
					$dJson .='{"id":"'.$verificar["id"].'", "can":"'.$mov.'", "sw":"'.$sw.'"},';
				}
				else
				{
					
					$dJson .='{"id":"'.$verificar["id"].'", "can":"'.$verificar["can"].'", "sw":"'. 1 .'"},';
				}
		}

		if($sw0 == 1)
		{
			$dJson = substr($dJson, 0 ,-1);
			$dJson .= ']';
		}
		return $dJson;
	}
}