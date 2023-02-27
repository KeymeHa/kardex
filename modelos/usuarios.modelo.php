<?php

require_once "conexion.php";

class ModeloUsuarios
{
	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{
		if($item != null)
		{
			if ($item == "id_area" || $item == "perfil") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT id, nombre FROM $tabla WHERE $item = :$item AND elim = 0");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetchAll();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlVerSID($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT sid FROM usuarios WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return $stmt->error();
		}
	}

	static public function MdlMostrarNombre($item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM usuarios WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return $stmt->error();
		}

	}

	static public function mdlRegistrarUsuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto, correo) VALUES (:nombre, :usuario, :password, :perfil, :foto, :correo)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);

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

	
	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEditarUsuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto, correo = :correo WHERE usuario = :usuario");
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

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

	static public function mdlHoraUsuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET ultimo_login = :ultimo_login, sid = :sid WHERE usuario = :usuario");

		$stmt -> bindParam(":ultimo_login", $datos["ultimo_login"], PDO::PARAM_STR);
		$stmt -> bindParam(":sid", $datos["sid"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

			/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlModificarCampo($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
		if($stmt -> execute())
		{
			return "ok";	
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlasignacionArea($tabla, $valor,$id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_area = :id_area WHERE id = :id");
		$stmt -> bindParam(":id_area", $valor, PDO::PARAM_INT);
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
		if($stmt -> execute())
		{
			return "ok";	
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlIngresarUsuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

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

	static public function mdMostrarPerfil($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT perfil FROM usuarios WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return $stmt->error();
		}
	}

	static public function mdlValidarEncargado($item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT usuarios.id, usuarios.nombre FROM personas INNER JOIN usuarios ON personas.id_usuario = usuarios.id WHERE personas.$item = :$item AND sw = 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return $stmt->error();
		}
	}

	static public function mdlLimpiarEncargado($tabla, $item1, $valor1){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET sw = 0 WHERE $item1 = :$item1 AND sw = 1");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		if($stmt -> execute())
		{return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;

	}

	static public function mdlActualizarEncargado($tabla, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET sw = 1 WHERE $item2 = :$item2");
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		if($stmt -> execute())
		{return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;

	}
}