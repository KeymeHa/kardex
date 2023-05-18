<?php

require_once "conexion.php";

class ModeloEquipos
{
	//LICENCIAS

	public static function mdlNuevaLicencia($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, productos, fecha_creacion) VALUES (:usuario, :password, :productos, :fecha_creacion)");
		$stmt ->bindParam( ":usuario", $datos["usuario"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":password", $datos["password"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":productos", $datos["productos"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":fecha_creacion", $datos["fecha_creacion"] , PDO::PARAM_STR );
		
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

	public static function mdlEditarLicencia($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, productos = :productos WHERE id = :id ");
		
		$stmt ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt ->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if( $stmt->execute() )
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

	public static function mdlMostrarLicencias($tabla, $item, $valor)
	{
		if ( !is_null($item) ) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam( ":".$item , $valor, PDO::PARAM_INT );
			$stmt->execute();
			return $stmt->fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
		
	}

	public static function mdlEditarLicencias($tabla, $item, $valor)
	{
		return 0;		
	}

	public static function mdlEliminarLicencias($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam( ":".$item , $valor , PDO::PARAM_INT );

		if ($stmt->execute()) 
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

	public static function mdlContarUsoLicencias($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE id_licencia = :id_licencia ");
		$stmt ->bindParam( ":id_licencia" , $valor , PDO::PARAM_INT );
		$stmt -> execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;		
	}


	//EQUIPOS
	public static function mdlDesvincularLicencia($tabla, $id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_licencia = 0 WHERE id_licencia = :id_licencia");
		$stmt -> bindParam(":id_licencia", $id, PDO::PARAM_INT);

		if($stmt->execute())
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