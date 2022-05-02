<?php
require_once "conexion.php";
class ModeloProveedores
{
	static public function mdlMostrarProveedores($tabla, $item, $valor)
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


	static public function mdlMostrarNit($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT nit FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
	}

	static public function mdlContarProveedores($tabla, $item, $valor)
	{
		if (!$item == null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetch();
		}

			$stmt -> close();

			$stmt = null;
	}


	static public function mdlRegistrarProveedor($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(razonSocial, nombreComercial, nit, digitoNit, descripcion, direccion, contacto, telefono, correo) VALUES (:razonSocial, :nombreComercial, :nit, :digitoNit, :descripcion, :direccion, :contacto, :telefono, :correo)");

		$stmt->bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreComercial", $datos["nombreComercial"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":digitoNit", $datos["digitoNit"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);

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

	static public function mdlEditarProveedor($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET razonSocial = :razonSocial, nombreComercial = :nombreComercial, descripcion = :descripcion, direccion = :direccion, contacto = :contacto, telefono = :telefono, correo = :correo WHERE nit = :nit AND digitoNit = :digitoNit");

		$stmt->bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreComercial", $datos["nombreComercial"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":contacto", $datos["contacto"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt->bindParam(":digitoNit", $datos["digitoNit"], PDO::PARAM_STR);

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

}#clase