<?php

require_once "conexion.php";

class ModeloClientes
{
	
	static public function mdlMostrarClientes($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlCrearCliente($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, sid, correo, telefono) VALUES (:nombre, :sid, :correo, :telefono)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":sid", $datos["sid"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_INT);
		
		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;
	}

	
	static public function mdlValidarCliente($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT sid FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return "error";
		}
	}
}