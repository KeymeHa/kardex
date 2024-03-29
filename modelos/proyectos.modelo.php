<?php

require_once "conexion.php";

class ModeloProyectos
{

	static public function mdlRegistrarProyecto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, descripcion, fecha_inicio, fecha_fin) VALUES (:nombre, :descripcion, :fecha_inicio, :fecha_fin)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);

		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return "eror";
		}

		$stmt->close();
		$stmt = null;
	}


	static public function mdlMostrarProyectosArea($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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

	static public function mdlMostrarProyectos($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

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

	static public function mdlMostrarProyectosa($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

	}

	static public function mdleditarProyecto($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_fin = :fecha_fin WHERE id = :id");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlMostrarProyectosConFiltro($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla WHERE $item = :$item AND elim = 0");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlBorrarProyecto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}


	static public function mdlContarAreas($tabla, $item, $valor)
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

	static public function mdlMostrarAsignacionArea($tabla, $item, $valor)
	{

		if ($item != null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT id_areas FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			$existe = $stmt->rowCount();
			if ($existe <= 0) {
			   $crear = new ModeloProyectos;
			   $res = $crear -> mdlCrearAsignacionArea($tabla, $valor);
			  return "ok";
			}else{return $stmt -> fetch();}
			$stmt -> close();
			$stmt = null;
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
			$stmt = null;
		}


	}

	static public function mdlAsignacionArea($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_areas = :id_areas WHERE id_proyecto = :id_proyecto");

		$stmt -> bindParam(":id_areas", $datos["id_areas"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlCrearAsignacionArea($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT IGNORE $tabla SET id_proyecto = :id_proyecto");

		$stmt->bindParam(":id_proyecto", $datos, PDO::PARAM_STR);

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
}