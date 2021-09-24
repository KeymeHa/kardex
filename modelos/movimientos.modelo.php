<?php

require_once "conexion.php";

class ModeloMovimientos
{
	
	static public function mdlMostrarMovimiento($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE entrYsal = :entrYsal AND
		anio = :anio AND mes = :mes");


		$stmt -> bindParam(":entrYsal", $datos["entrYsal"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlActualizarMovimiento($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET insumos = :insumos WHERE entrYsal = :entrYsal AND anio = :anio AND mes = :mes");

		$stmt -> bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt -> bindParam(":entrYsal", $datos["entrYsal"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt -> bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		if($stmt -> execute())
		{
			return "ok";
		}
		else
		{

			return "errorAct";	
		}
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlRegistrarMovimiento($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(entrYsal, insumos, anio, mes) VALUES (:entrYsal, :insumos, :anio, :mes)");
	

		$stmt->bindParam(":entrYsal", $datos["entrYsal"], PDO::PARAM_INT);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);
		$stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return "errorReg";
		}
		$stmt->close();
		$stmt = null;

	}
}