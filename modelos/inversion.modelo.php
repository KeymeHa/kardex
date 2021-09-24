<?php

require_once "conexion.php";

class ModeloInversiones
{
	
	static public function mdlMostrarInversiones($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_prov = :id_prov AND anio = :anio AND mes = :mes");

		$stmt -> bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlRegistrarInversion($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_prov, invertido, anio, mes) VALUES (:id_prov, :invertido, :anio, :mes)");

		$stmt->bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);
		$stmt->bindParam(":invertido", $datos["invertido"], PDO::PARAM_INT);
		$stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}


	static public function mdlActualizaInversion($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET invertido = :invertido WHERE id_prov = :id_prov AND anio = :anio");

		$stmt -> bindParam(":invertido", $datos["invertido"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);

		if($stmt -> execute())
		{
			return "ok";
		}
		else
		{

			return "error";	
		}
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlRangoFechasInversion($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	//-------------------------------IVA-----------------------------------------------------
	
	static public function mdlMostrarIva($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE anio = :anio AND mes = :mes");

		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_INT);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlRegistrarIva($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(sumatoria, anio, mes) VALUES (:sumatoria, :anio, :mes)");

		$stmt->bindParam(":sumatoria", $datos["sumatoria"], PDO::PARAM_INT);
		$stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlActualizaIva($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET sumatoria = :sumatoria WHERE anio = :anio AND mes = :mes");

		$stmt -> bindParam(":sumatoria", $datos["sumatoria"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		if($stmt -> execute())
		{
			return "ok";
		}
		else
		{

			return "error";	
		}
		$stmt -> close();
		$stmt = null;

	}
}