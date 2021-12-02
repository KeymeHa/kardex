<?php

require_once "conexion.php";

class ModeloParametros
{
	
	static public function mdlMostrarParamentros($tabla, $item)
	{
		$valor = 1;

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

	static public function mdlActualizarYear($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET anioActual = :anioActual, codRq = :codRq, codFac = :codFac, codPed = :codPed, codOrdC = :codOrdC, codActa = :codActa WHERE id = :id");

		$stmt -> bindParam(":anioActual", $datos["anioActual"], PDO::PARAM_INT);
		$stmt -> bindParam(":codRq", $datos["codRq"], PDO::PARAM_INT);
		$stmt -> bindParam(":codFac", $datos["codFac"], PDO::PARAM_INT);
		$stmt -> bindParam(":codPed", $datos["codPed"], PDO::PARAM_INT);
		$stmt -> bindParam(":codOrdC", $datos["codOrdC"], PDO::PARAM_INT);
		$stmt -> bindParam(":codActa", $datos["codActa"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlJs_Files($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlJs_data($ruta, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT page, num FROM $tabla WHERE page = :page");
		$stmt -> bindParam(":page", $ruta, PDO::PARAM_STR);
		$stmt -> execute();

		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlJs_Terms($tabla)
	{
		$stmt = Conexion::conectarRead()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlActualizarIns($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET validarIns = 1 WHERE id = :id");

		$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlNuevoAnioInversion($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_prov, invertido, anio) VALUES (:id_prov, :invertido, :anio)");

		$stmt->bindParam(":id_prov", $datos["id_prov"], PDO::PARAM_INT);
		$stmt->bindParam(":invertido", $datos["invertido"], PDO::PARAM_INT);
		$stmt->bindParam(":anio", $datos["anio"], PDO::PARAM_INT);

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

	static public function mdlNombreFac($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nameFac = :nameFac WHERE id = :id");

		$stmt -> bindParam(":nameFac", $datos["nameFac"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlIncrementarCodigo($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlActualizarLimIns($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stMinimo = :stMinimo, stModerado = :stModerado, stAlto = :stAlto WHERE id = :id");

		$stmt -> bindParam(":stMinimo", $datos["stMinimo"], PDO::PARAM_INT);
		$stmt -> bindParam(":stModerado", $datos["stModerado"], PDO::PARAM_INT);
		$stmt -> bindParam(":stAlto", $datos["stAlto"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlActualizarDatosFAC($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET razonSocial = :razonSocial, nit = :nit, direccion = :direccion, tel = :tel, correo = :correo, direccionEnt = :direccionEnt, repLegal = :repLegal WHERE id = :id");

		$stmt -> bindParam(":razonSocial", $datos["razonSocial"], PDO::PARAM_STR);
		$stmt -> bindParam(":nit", $datos["nit"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":tel", $datos["tel"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccionEnt", $datos["direccionEnt"], PDO::PARAM_STR);
		$stmt -> bindParam(":repLegal", $datos["repLegal"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlActualizarIVA($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET valorIVA = :valorIVA WHERE id = :id");

		$stmt -> bindParam(":valorIVA", $datos["valorIVA"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

}
