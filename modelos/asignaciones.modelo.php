<?php

require_once "conexion.php";

class ModeloAsignaciones
{

	static public function mdlVerModulos($tabla, $id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_persona = :id_persona");

		$stmt->bindParam(":id_persona", $id, PDO::PARAM_STR);

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlVerAsignado($tabla, $id, $modulo)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_persona = :id_persona AND modulo = :modulo");

		$stmt->bindParam(":id_persona", $id, PDO::PARAM_STR);
		$stmt->bindParam(":modulo", $modulo, PDO::PARAM_STR);

		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;

	}#VerAsignado

	static public function mdlHabilitarUsuario($tabla, $id, $modulo)
	{
		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_persona, modulo) VALUES (:id_persona, :modulo)");
		
		$stmt->bindParam(":id_persona", $id, PDO::PARAM_STR);
		$stmt->bindParam(":modulo", $modulo, PDO::PARAM_STR);

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

	static public function mdlDeshabilitarUsuario($tabla, $id, $modulo)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_persona = :id_persona AND modulo = :modulo");
		
		$stmt->bindParam(":id_persona", $id, PDO::PARAM_STR);
		$stmt->bindParam(":modulo", $modulo, PDO::PARAM_STR);

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

#INSERT IGNORE INTO

}#class
