<?php
require 'PHPExcel/IOFactory.php';
require_once "../../../modelos/conexion.php";
if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("importarRT.xlsx") ) 
	{
		$nombreArchivo = 'importarRT.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		for ($i = 1; $i <= $numRows; $i++) {
			$manzana = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
			$cantidad = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();

			$stmt = Conexion::conectar()->prepare("INSERT INTO rt(manzana, cantidad) VALUES (:manzana, :cantidad)");

			$stmt->bindParam(":manzana", $manzana, PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);

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
		
		unlink($nombreArchivo);
		echo "<script languaje='javascript' type='text/javascript'>
		window.open('http://localhost/rt?resultado=".$respuesta."', '_self');
		</script>";
	}
}
