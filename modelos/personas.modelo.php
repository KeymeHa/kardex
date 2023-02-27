<?php

require_once "conexion.php";

/**
 * 
 */
class ModeloPersonas
{
	static public function mdlMostrarPersonas($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarIdPersonaPerfil($tabla, $item, $valor, $perfil)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_usuario, id_area FROM $tabla WHERE $item = :$item AND id_perfil = :id_perfil AND sw = 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id_perfil", $perfil, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarPersonasArea($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarPersona($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_area, id_usuario) VALUES (:id_area, :id_usuario)");

		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


	static public function mdlAgruparPersonas($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id GROUP BY(areas.nombre)");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlContarEncargado($tabla, $item, $valor)
	{
		if (!$item == null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND sw = 1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");

			$stmt -> execute();
		}
			return $stmt -> fetch();

			$stmt -> close();

			$stmt = null;
	}

	static public function mdlContarPerArea($tabla, $item, $valor)
	{
		if (!$item == null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");

			$stmt -> execute();
		}
			return $stmt -> fetch();

			$stmt -> close();

			$stmt = null;


	}

	static public function mdlEditarPersona($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_area = :id_area WHERE id_usuario = :id_usuario");
		
		$stmt -> bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);

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


	static public function mdlBorrarPersona($tabla, $id)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");
		$stmt -> bindParam(":id_usuario", $id, PDO::PARAM_INT);

		if($stmt -> execute())
		{
			return "ok";	
		}else{
			return "error";	
		}

		$stmt -> close();
		$stmt = null;
	}

}