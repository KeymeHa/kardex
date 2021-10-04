<?php

require_once "conexion.php";

class ModeloCarpetas
{
	static public function mdlMostrarCarpetas($tabla, $item, $valor)
	{
		if ($item == "id") 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 AND :$item = $item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 AND :$item = $item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarArchivos($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 AND :$item = $item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlCrearCarpeta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, carpeta, id_prov) VALUES (:nombre, :carpeta, :id_prov)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":carpeta", $datos["carpeta"], PDO::PARAM_INT);
		$stmt->bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	static public function mdlBorrarCarpeta($idCar)
	{
		$stmt = Conexion::conectar()->prepare("DELETE anexosprov WHERE id_carpeta = id_carpeta");

		$stmt->bindParam(":id_carpeta", $idCar, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlBorrarAnexosCar($idCar)
	{
		$stmt = Conexion::conectar()->prepare("DELETE carpetasprov WHERE id = :id");
		$stmt->bindParam(":id", $idCar, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarCarpeta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre WHERE id = :id");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

}