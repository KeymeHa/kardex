<?php

require_once "conexion.php";

class ModeloHistorial
{
	static public function mdlInsertarHistorial($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(accion, numTabla, valorAnt, valorNew, id_usr, id_otro) VALUES (:accion, :numTabla, :valorAnt, :valorNew, :id_usr, :id_otro)");

		$stmt->bindParam(":accion", $datos["accion"], PDO::PARAM_INT);
		$stmt->bindParam(":numTabla", $datos["numTabla"], PDO::PARAM_INT);
		$stmt->bindParam(":valorAnt", $datos["valorAnt"], PDO::PARAM_STR);
		$stmt->bindParam(":valorNew", $datos["valorNew"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		
		if (isset($datos["id_otro"])) 
		{
			$stmt->bindParam(":id_otro", $datos["id_otro"], PDO::PARAM_INT);
		}
		else
		{
			$stmt->bindParam(":id_otro", 0, PDO::PARAM_INT);
		}

		if($stmt->execute())
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

	static public function mdlMostrarFechas($tabla, $numTabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT fecha FROM historial WHERE numTabla = :numTabla GROUP BY fecha ORDER BY id DESC");

		$stmt -> bindParam(":numTabla", $numTabla, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}


	static public function mdlMostrarHistoria($tabla, $item, $valor, $numTabla)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND numTabla = :numTabla");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":numTabla", $numTabla, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

}