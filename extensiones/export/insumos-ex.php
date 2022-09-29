<?php

require '../../vendor/autoload.php';
require_once '../../controladores/insumos.controlador.php';
require_once '../../modelos/insumos.modelo.php';
use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//NUEVO OBJETO
$spreadsheet = new Spreadsheet();
//INSTANCIAS
$hoja = $spreadsheet->getActiveSheet();
$respuesta = ControladorInsumos::ctrMostrarInsumos(null, null);
//PROPIEDADES
$hoja->setTitle("LISTADO DE INSUMOS");
//CELDAS
# Celda de encabezado


if (!is_null($respuesta) || empty($respuesta)) 
{
	if (count($respuesta) > 0) 
	{
		$point = 1;
		$hoja->setCellValue('A'.$point, '#');
		$hoja->setCellValue('B'.$point, 'CODIGO');
		$hoja->setCellValue('C'.$point, 'DESCRIPCION');
		$hoja->setCellValue('D'.$point, 'STOCK');
		for ( $i = 0 ; $i < count($respuesta) ; $i++) 
		{ 	
			$point+= 1;
			$hoja->setCellValue('A'.$point, $i+1 );
			$hoja->setCellValue('B'.$point, $respuesta[$i]['codigo']);
			$hoja->setCellValue('C'.$point, $respuesta[$i]['descripcion']);
			$hoja->setCellValue('D'.$point, $respuesta[$i]['stock']);
		}

		date_default_timezone_set('America/Bogota');
		$fecha = date('d-m-Y');

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Listado Insumos '.$fecha.' .xlsx"');
		header('Cache-Control: max-age=0');

		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save('php://output');
	}
	else
	{
		echo'<script>window.location = "insumos";</script>';
	}
	
}
else
{
	echo'<script>window.location = "insumos";</script>';
}
