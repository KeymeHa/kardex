<?php
require 'PHPExcel/IOFactory.php';
require_once "../../../modelos/conexion.php";
require_once "../../../modelos/insumos.modelo.php";
require_once "../../../modelos/parametros.modelo.php";
require_once "../../../modelos/categorias.modelo.php";
require_once "../../../controladores/categorias.controlador.php";
require_once "../../../controladores/insumos.controlador.php";
require_once "../../../controladores/parametros.controlador.php";

if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("importarIns.xlsx") ) 
	{
		$nombreArchivo = 'importarIns.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		for ($i = 4; $i <= $numRows; $i++) 
		{

			$id_categoria = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			$codigo = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
			$descripcion = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
			$observacion = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
			$stock  = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
			$stockIn  = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
			$precio_compra = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
			$precio_unidad  = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
			$precio_por_mayor  = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
			$estante = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
			$nivel = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
			$seccion = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getCalculatedValue();
			$prioridad = $objPHPExcel->getActiveSheet()->getCell('M'.$i)->getCalculatedValue();
			$unidad = $objPHPExcel->getActiveSheet()->getCell('N'.$i)->getCalculatedValue();
			$unidadSal = $objPHPExcel->getActiveSheet()->getCell('O'.$i)->getCalculatedValue();
			$contenido = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();
			$habilitado  = $objPHPExcel->getActiveSheet()->getCell('P'.$i)->getCalculatedValue();

			$item = "id";

			if (ControladorParametros::ctrValidarTipoDato($id_categoria)) 
			{
				if(!ControladorParametros::ctrBuscarCategoria($item, $id_categoria))
				{
					$id_categoria = ControladorCategorias::ctrValidarOtros();
				}
			}
			else
			{
				$id_categoria = ControladorCategorias::ctrValidarOtros();
			}

			if (!ControladorParametros::ctrValidarTipoDato($stock)) 
			{
				$stock = 0;
			}

			if (!ControladorParametros::ctrValidarTipoDato($stockIn)) 
			{
				$stockIn = 0;
			}

			if (!ControladorParametros::ctrValidarTipoDato($precio_compra)) 
			{
				$precio_compra = 0;
			}

			if (!ControladorParametros::ctrValidarTipoDato($precio_unidad)) 
			{
				$precio_unidad = 0;
			}

			if (!ControladorParametros::ctrValidarTipoDato($precio_por_mayor)) 
			{
				$precio_por_mayor = 0;
			}

			if (!ControladorParametros::ctrValidarTipoDato($prioridad)) 
			{
				$prioridad = 3;
			}
			else
			{
				if (!ControladorInsumos::ctrBuscarInsumoUnidad($item, $valor)) 
				{
					$prioridad = 3;
				}
			}

			if (ControladorParametros::ctrValidarTipoDato($unidad)) 
			{
				if(!ControladorInsumos::ctrBuscarInsumoUnidad($item, $unidad))
				{
					$unidad = ControladorInsumos::ctrValidarSinDefinir();
				}
			}
			else
			{
				$unidad = ControladorInsumos::ctrValidarSinDefinir();
			}

			if (ControladorParametros::ctrValidarTipoDato($unidadSal)) 
			{
				if(!ControladorInsumos::ctrBuscarInsumoUnidad($item, $unidadSal))
				{
					$unidadSal = ControladorInsumos::ctrValidarSinDefinir();
				}
			}
			else
			{
				$unidadSal = ControladorInsumos::ctrValidarSinDefinir();
			}

			if (!ControladorParametros::ctrValidarTipoDato($contenido)) 
			{
				$contenido = 1;
			}

			if (!ControladorParametros::ctrValidarTipoDato($habilitado)) 
			{
				if ($habilitado != 1 AND !$habilitado != 0) 
				{
					$habilitado = 1;
				}
			}
			else
			{
				$habilitado = 1;
			}

			//buscar si no esta repetido el codigo

			//Buscar si no esta repetido la descripcion

			$tabla = "insumos";
			$datos = array("id_categoria" => $id_categoria,
						   "codigo" => $codigo,
						   "descripcion" => $descripcion,
						   "observacion" => $$observacion,
						   "stock" => $stock,
						   "stockIn" => $stockIn,
						   "precio_compra"	=> $precio_compra,
						   "precio_unidad"	=> $precio_unidad,
						   "precio_por_mayor"	=> $precio_por_mayor,
						   "estante"	=> $estante,
						   "nivel"	=> $nivel,
						   "seccion"	=> $seccion,
						   "prioridad"	=> $prioridad, 
						   "unidad"	=> $unidad,
						   "unidadSal"	=> $unidadSal, 
						   "contenido"	=> $contenido,
						   "habilitado"	=> $habilitado);
			$respuesta = ModeloInsumos::mdlImportarInsumo($tabla, $datos);

/*
			id(INT)	
			id_categoria(INT)
			codigo(VARCHAR)
			descripcion(TEXT)
			observacion(TEXT)
			imagen(TEXT)
			stock(INT)
			stockIn(INT)
			precio_compra(FLOAT)	
			precio_unidad(FLOAT)
			precio_por_mayor(FLOAT)	
			fecha(DATETIME)
			elim(INT)
			estante(CHAR)
			nivel(CHAR)
			seccion(CHAR)
			prioridad(INT)
			unidad(INT)
			unidadSal(INT)	
			contenido(INT)	
			habilitado(INT)	
*/

		}//for

		if($respuesta == "ok")
		{
			$stmt = Conexion::conectar()->prepare("UPDATE parametros SET validarIns = 1 WHERE id = 1");
			$stmt = null;
		}
		unlink($nombreArchivo);
		echo "<script languaje='javascript' type='text/javascript'>
		window.open('http://localhost/insumos?resultado=".$respuesta."', '_self');
		</script>";
	}
}
