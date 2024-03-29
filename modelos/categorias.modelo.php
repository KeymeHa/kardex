<?php

require_once "conexion.php";


/**
 * 
 */
class ModeloCategorias
{

	static public function mdlRegistrarCategoria($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(categoria, descripcion) VALUES (:categoria, :descripcion)");

		$stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

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


	static public function mdlMostrarCantidadInsumos($tabla, $item, $valor)
	{
		if (!$item == null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND elim = 0");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetch();
		}

			$stmt -> close();

			$stmt = null;
	}


	static public function mdlBuscarCategoria($tabla, $item, $valor)
	{

		if ($item == "id") 
		{
			$stmt = Conexion::conectar()->prepare("SELECT $item FROM $tabla WHERE $item = $valor");
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT id, $item FROM $tabla WHERE $item LIKE '%$valor%'");
		}

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlContarCat($tabla, $item, $valor)
	{
		if (!$item == null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND elim = 0");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetch();
		}

			$stmt -> close();

			$stmt = null;
	}

	static public function mdlNombreCategoria($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT categoria FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			$stmt -> close();

			$stmt = null;
	}

	static public function mdlMostrarCategorias($tabla, $item, $valor)
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
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0 ORDER BY categoria ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

		static public function mdlMostrarCategoriasConFiltro($tabla, $item, $valor)
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

	static public function mdlEditarCategoria($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria, descripcion = :descripcion WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlBorrarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET elim = 1 WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

		static public function mdlBorrarCat($tabla, $datos){

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

	static public function mdlCrearAsignacionArea($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT IGNORE $tabla SET id_categorias = :id_categorias");

		$stmt->bindParam(":id_categorias", $datos, PDO::PARAM_STR);

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

	static public function mdlMostrarAsignacionArea($tabla, $item, $valor)
	{

		if ($item != null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT id_areas FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			$existe = $stmt->rowCount();
			if ($existe <= 0) {
			   $crear = new ModeloCategorias;
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
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_areas = :id_areas WHERE id_categorias = :id_categorias");

		$stmt -> bindParam(":id_areas", $datos["id_areas"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_categorias", $datos["id_categorias"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}
}