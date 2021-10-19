<?php

require_once "conexion.php";

class ModeloUsuarios
{
	static public function mdlMostrarUsuarios($tabla, $item, $valor)
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
		$stmt->close();
		$stmt = null;
	}

	static public function mdlIncrementarintento($tabla,$usuario,$intento)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET try = :try WHERE usuario = :usuario");
		$stmt->bindParam(":try", $intento, PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}

		$stmt -> close();
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario, password, perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

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
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
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

	static public function mdlBorrarUsuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET elim = 1 WHERE id = :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

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
}