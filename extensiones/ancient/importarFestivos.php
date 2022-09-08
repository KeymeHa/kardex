<?php
require 'PHPExcel/IOFactory.php';
require_once "../../../modelos/conexion.php";
if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("festivosxlsx.xlsx") ) 
	{
		$nombreArchivo = 'festivosxlsx.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$dJson = '{"data": [';

		for ($i = 1; $i <= $numRows; $i++) {
			$fecha = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();

				$dJson .='["'.$fecha.'"],';

		}

			$dJson = substr($dJson, 0 ,-1);  
		    $dJson.= ']
			}';

		$stmt = Conexion::conectar()->prepare("UPDATE parametros SET festivos = :festivos WHERE id = 1");

		$stmt -> bindParam(":festivos", $dJson, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
		
		unlink($nombreArchivo);
		echo "<script languaje='javascript' type='text/javascript'>
		window.open('http://localhost/parametros', '_self');
		</script>";
	}
}
