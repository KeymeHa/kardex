<?php
require 'PHPExcel/IOFactory.php';
require_once "../../../modelos/conexion.php";
if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("importarIns.xlsx") ) 
	{
		$nombreArchivo = 'importarIns.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
		for ($i = 4; $i <= $numRows; $i++) {
			$id_categoria = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
			$codigo = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
			$descripcion = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
			$observacion = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
			$stock = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();
			$precio_compra = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue();
			$estante = $objPHPExcel->getActiveSheet()->getCell('H'.$i)->getCalculatedValue();
			$nivel = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getCalculatedValue();
			$seccion = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getCalculatedValue();
			$prioridad = $objPHPExcel->getActiveSheet()->getCell('K'.$i)->getCalculatedValue();
			$stmt = Conexion::conectar()->prepare("INSERT INTO insumos(id_categoria, codigo, descripcion, observacion, stock, precio_compra, estante, nivel, seccion, prioridad) VALUES (:id_categoria, :codigo, :descripcion, :observacion, :stock, :precio_compra, :estante, :nivel, :seccion, :prioridad)");
			$stmt->bindParam(":id_categoria", $id_categoria, PDO::PARAM_INT);
			$stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
			$stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
			$stmt->bindParam(":observacion", $observacion, PDO::PARAM_STR);
			$stmt->bindParam(":stock", $stock, PDO::PARAM_INT);
			$stmt->bindParam(":precio_compra", $precio_compra, PDO::PARAM_INT);
			$stmt->bindParam(":estante", $estante, PDO::PARAM_INT);
			$stmt->bindParam(":nivel", $nivel, PDO::PARAM_INT);
			$stmt->bindParam(":seccion", $seccion, PDO::PARAM_INT);
			$stmt->bindParam(":prioridad", $prioridad, PDO::PARAM_INT);
			if($stmt->execute()){
				echo "<script languaje='javascript' type='text/javascript'>
					console.log('ok');
					</script>";
				$respuesta = "ok";
			}else{
				echo "<script languaje='javascript' type='text/javascript'>
					console.log('Error');
					</script>";
				$respuesta = "error";
			}
			$stmt = null;
		}
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
