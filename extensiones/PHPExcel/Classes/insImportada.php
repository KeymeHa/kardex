<?php

$rrta = "../../../";

require 'PHPExcel/IOFactory.php';
require_once $rrta."modelos/conexion.php";
require_once $rrta."modelos/insumos.modelo.php";
require_once $rrta."modelos/parametros.modelo.php";
require_once $rrta."modelos/categorias.modelo.php";
require_once $rrta."controladores/categorias.controlador.php";
require_once $rrta."controladores/insumos.controlador.php";
require_once $rrta."controladores/parametros.controlador.php";


class ImportarInsumos
{
	public $arhivoErrores = "tmp/listado_errores.txt";

	public function getArchivoError(){
		return $this->arhivoErrores;
	}

	static public function archivoError($cadena)
	{
		$fileError = new ImportarInsumos;

		if ( file_exists($fileError->getArchivoError()) )
		{
			$archivo = fopen($fileError->getArchivoError(), "a");
			fwrite($archivo, PHP_EOL ."$cadena");
			fclose($archivo);
		}
		else
		{
			$archivo = fopen($fileError->getArchivoError(), "w");
			fwrite($archivo, PHP_EOL ."$cadena");
			fclose($archivo);
		}
	}
}


if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("importarIns.xlsx") ) 
	{
		$nombreArchivo = 'importarIns.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$cadenaDeErrores = "";

		for ($i = 2; $i <= $numRows; $i++) 
		{
			$sw = 0;
			$id_categoria = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			$codigo 	  = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
			$descripcion  = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
			$observacion  = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
			$stock 		  = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
			$estante 	  = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
			$nivel 		  = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
			$seccion 	  = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
			$unidad 	  = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
			$contenido 	  = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();

			$item = "id";
			$valCategoria = ControladorCategorias::ctrMostrarCategoriasConFiltro($item, $id_categoria);

			if (!isset($valCategoria["categoria"])) 
			{
				$id_categoria = ControladorCategorias::ctrValidarOtros();
				$cadenaDeErrores = 'No se encontro la Categoria con ID: $id_categoria , para el insumo $descripcion con codigo $codigo. CELDA A$i';
				$ejecutar = new ImportarInsumos();
				$ejecutar -> archivoError($cadenaDeErrores);
			}

			unset ($valCategoria);
			$valInsumos = ControladorInsumos::ctrMostrarInsumos("codigo", $codigo);

			if (isset($valInsumos["id"])) 
			{
				$cadenaDeErrores = 'El codigo $codigo ya existe para el insumo '.$valInsumos["descripcion"].'. CELDA B$i';
				$sw = 1;
				$ejecutar = new ImportarInsumos();
				$ejecutar -> archivoError($cadenaDeErrores);
			}
			else
			{
				$codigo = ControladorParametros::ctrValidarCaracteres($codigo);
			}

			unset ($valInsumos);

			if ($descripcion == "") 
			{
				$cadenaDeErrores = 'La Descripcion no puede ir vacia '.$valInsumos["descripcion"].'. CELDA C$i';
				$ejecutar = new ImportarInsumos();
				$ejecutar -> archivoError($cadenaDeErrores);
			}
			else
			{
				$descripcion = ControladorParametros::ctrValidarCaracteres($descripcion);
				$valInsumos = ControladorInsumos::ctrMostrarInsumos("descripcion", $descripcion);
				$sw = 1;
				if (isset($valInsumos["id"]) ) 
				{
					$cadenaDeErrores = 'El insumo $descripcion Ya existe. CELDA C$i';
					$ejecutar = new ImportarInsumos();
					$ejecutar -> archivoError($cadenaDeErrores);
				}
				unset ($valInsumos);
			}

			if ($observacion != "") 
			{
				$observacion = ControladorParametros::ctrValidarCaracteres($observacion);
			}

			if (!is_integer($stock) || $stock < 0) 
			{
				$stock = 0;
				$cadenaDeErrores = 'El Insumo '.$descripcion.' debe ser numero, entero y de valor cero o positivo. CELDA E$i';
				$ejecutar = new ImportarInsumos();
				$ejecutar -> archivoError($cadenaDeErrores);
			}


			if ($estante != "") 
			{
				$estante = ControladorParametros::ctrValidarCaracteres($estante);
			}
			else
			{
				$estante = "SINF";
			}

			if ($nivel != "") 
			{
				$nivel = ControladorParametros::ctrValidarCaracteres($nivel);
			}
			else
			{
				$nivel = "SINF";
			}

			if ($seccion != "") 
			{
				$seccion = ControladorParametros::ctrValidarCaracteres($seccion);
			}
			else
			{
				$seccion = "SINF";
			}

			date_default_timezone_set('America/Bogota');
			$fechaActual = date("Y-m-d");

			if ($sw != 1) 
			{
				$datos = array(		"id_categoria" => $id_categoria,
									"codigo" => $codigo,
									"descripcion" => $descripcion,
									"observacion" => $observacion,
									"stock" => $stock,
									"stockIn" => 0,
									"precio_compra" => 0,
									"precio_unidad" => 0,
									"precio_por_mayor" => 0,
									"fecha" => $fechaActual,
									"elim" => 0,
									"estante" => $estante,
									"nivel" => $nivel,
									"seccion" => $seccion,
									"prioridad" => 2,
									"unidad" => 0,
									"unidadSal" => 0,
									"contenido" => 1,
									"habilitado" => 1,
									"imp" => 0
								);

				$envio = ModeloInsumos::mdlIngresarInsumoIMP("insumos", $datos);
			}
			else
			{
				$cadenaDeErrores = 'FILA $i no fue ingresada, valide los errores anteriores e intente nuevamente.';
				$ejecutar = new ImportarInsumos();
				$ejecutar -> archivoError($cadenaDeErrores);
			}

		}//for celdas

		$fileError = new ImportarInsumos;
		

		unlink($nombreArchivo);

		if (file_exists($fileError->getArchivoError())) 
		{
			readfile($fileError->getArchivoError());
		}

		echo "<script languaje='javascript' type='text/javascript'>
		window.open('http://localhost/insumos?resultado=".$respuesta."', '_self');
		</script>";
	}
}
