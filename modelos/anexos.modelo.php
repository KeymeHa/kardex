<?php

require_once "conexion.php";

class ModeloCarpetas
{
	static public function mdlMostrarCarpetas($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 AND :$item = $item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarArchivos($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 AND :$item = $item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlContarCarpetas($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND elim = 0");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetch();	
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlContarAnexos($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE :$item = $item AND elim = 0");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlCrearCarpeta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, id_prov) VALUES (:nombre, :id_prov)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}