<?php

require 'PHPExcel/IOFactory.php';
require_once "../../../modelos/conexion.php";

if ( isset($_GET["otro"]) ) 
{
	if ( file_exists("importarRQ.xlsx") ) 
	{
		$sw = 0;
		$nombreArchivo = 'importarRQ.xlsx';
		$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
		$objPHPExcel->setActiveSheetIndex(0);
		$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

		$stmt = Conexion::conectar()->prepare("ALTER TABLE tempinsumosrq AUTO_INCREMENT = 1; DELETE FROM tempinsumosrq;");

		if ($stmt->execute()) 
		{
			$stmt = null;
			for ($i = 7; $i <= $numRows; $i++) {

				$codigo = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
				$descripcion = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
				$entregar = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
				$solicitado = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();

				if(!$codigo == null)
				{
					if ( is_numeric($codigo) ) 
					{
						if($entregar == null)
						{
							$entregar  = 0;
						}

						if($solicitado == null)
						{
							$solicitado  = 1;
						} 
						
						$stmt = Conexion::conectar()->prepare("INSERT INTO tempinsumosrq(codigo, descripcion, entregar, solicitado) VALUES (:codigo, :descripcion, :entregar, :solicitado)");

						$stmt->bindParam(":codigo", $codigo, PDO::PARAM_INT);
						$stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
						$stmt->bindParam(":entregar", $entregar, PDO::PARAM_INT);
						$stmt->bindParam(":solicitado", $solicitado, PDO::PARAM_INT);

						if($stmt->execute()){
							$sw = 1;
							echo '<li>Importado '.$codigo.' '.$descripcion.'</li><br>';
						}else{
							echo '<li>Error al importar insumo '.$codigo.' '.$descripcion.'</li>';
							$sw = 0;
						}

						$stmt = null;
					}
				}

			}//for

			$f = 2;
			$n = 4;
			$fecha = "";
			$nombre = $objPHPExcel->getActiveSheet()->getCell('B'.$n)->getCalculatedValue();
			$fechatemp = $objPHPExcel->getActiveSheet()->getCell('D'.$f)->getCalculatedValue();

			date_default_timezone_set('America/Bogota');
			//$fechaActual = date("Y-m-d");

			if ($fechatemp == null) 
			{
				$aa = date("Y");
				$fechatemp.= "-".$aa;
			}
			else
			{
				$fecha = $fechatemp;
			}

			$fechatemp = $objPHPExcel->getActiveSheet()->getCell('C'.$f)->getCalculatedValue();

			if ($fechatemp == null) 
			{
				$mm = date("m");
				$fechatemp.= "-".$mm;
			}
			else
			{
				$fecha.= "-".$fechatemp;
			}

			$fechatemp = $objPHPExcel->getActiveSheet()->getCell('B'.$f)->getCalculatedValue();

			if ($fechatemp == null) 
			{
				$dd = date("d");
				$fechatemp = $dd;
			}
			else
			{
				$fecha.= "-".$fechatemp;
			}

			$observaciones = $objPHPExcel->getActiveSheet()->getCell('E'.$n)->getCalculatedValue();

			strval($observaciones);


			echo "nombre: ".$nombre." fecha: ".$fecha." observaciones ".$observaciones ;

			$stmt = Conexion::conectar()->prepare("UPDATE tempdatosrq SET nombre = :nombre, fecha = :fecha WHERE id = 1");
			
			$stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);


			if ($stmt->execute()) 
			{
				unlink($nombreArchivo);
				echo "<script languaje='javascript' type='text/javascript'>
				window.open('http://localhost/requisicionImportada?sw=".$sw."', '_self');
				</script>";
				echo "ok";
			}
			else
			{
				unlink($nombreArchivo);
				echo "<script languaje='javascript' type='text/javascript'>
				window.open('http://localhost/requisicionImportada?sw=".$sw."', '_self');
				</script>";
				echo "error";
				
			}
			$stmt = null;
			
			
		}
		else
		{
			echo '<li>Error al iniciar Importación.</li>';
		}

		$stmt = null;

	}
}
