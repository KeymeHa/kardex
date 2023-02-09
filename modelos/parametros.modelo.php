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

	static public function mdlModoMantenimiento()
	{
		$stmt = Conexion::conectar()->prepare("SELECT modomanto FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static function mdlConsultarAi($tabla)
	{
		$info = new Conexion();
		$basededatos = $info ->getDatabase();

		$stmt = Conexion::conectar()->prepare('SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES
		WHERE TABLE_SCHEMA = "'.$basededatos.'" AND   TABLE_NAME   = "'.$tabla.'"');

		if ($stmt->execute()) 
		{
			return $stmt -> fetch();
		}
		else
		{
			return $stmt->error();
		}


		;
	}

	static public function mdlMostrarFechaRegis($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT fechaRegistroPqr FROM $tabla WHERE id = 1");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}	

	static public function mdlmostrarRegistrosEspecifico($tabla, $item, $valor)
	{
	
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlmostrarRegistros($tabla, $item, $valor)
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

	static public function mdlVerAnio($tabla, $valor)
	{

		if( $valor == false )
		{
			$stmt = Conexion::conectar()->prepare("SELECT anio FROM $tabla");
			$stmt -> execute();

			return $stmt -> fetchAll();
			$stmt -> close();
			$stmt = null;
		}
		elseif( $valor == true )
		{
			$stmt = Conexion::conectar()->prepare("SELECT anio FROM $tabla WHERE id = 1");
			$stmt -> execute();

			return $stmt -> fetch();
			$stmt -> close();
			$stmt = null;
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT anio FROM $tabla WHERE anio = $valor");
			$stmt -> execute();

			return $stmt -> fetch();
			$stmt -> close();
			$stmt = null;
		}

		
	}

	static public function mdlActualizaranio($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlNuevoyear($tabla, $ActualY)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (anio) VALUES (:anio)");

		$stmt -> bindParam(":anio", $datos["ActualY"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlTraerCampo($tabla, $item, $valor, $item2)
	{
		$stmt = Conexion::conectar()->prepare("SELECT $item2 FROM $tabla WHERE $item = $valor LIMIT 1");
		$stmt -> execute();

		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}


	static public function mdlJs_Files($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE habilitado = 1");
		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlJs_data($ruta, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE page = :page");
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

	static public function mdlCrearFiltroPQR($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("INSERT IGNORE $tabla SET id_per = :id_per ");

		$stmt->bindParam(":id_per", $valor, PDO::PARAM_STR);

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

	static public function mdlMostrarFiltroPQR($tabla, $item, $valor)
	{

		if ($item != null) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT id_pqr FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			$existe = $stmt->rowCount();
			if ($existe <= 0) {
			   $crear = new ModeloParametros;
			   $res = $crear -> mdlCrearFiltroPQR($tabla, $valor);
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

	static public function mdlAsignacionFiltroPQR($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_pqr = :id_pqr WHERE id_per = :id_per");

		$stmt -> bindParam(":id_pqr", $datos["id_pqr"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_per", $datos["id_per"], PDO::PARAM_INT);

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

	static public function mdlNombreArchivo($tabla, $item, $valor)
	{
		if ($item == "nameRad" || $item == "nameFac") 
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = 1");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			if($stmt -> execute()){
				return "ok";	
			}else{
				return "error";	
			}
			$stmt -> close();
			$stmt = null;
		}
	}


	static public function mdlFechaRegistrosActualizada($tabla, $fecha)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fechaRegistroPqr = :fechaRegistroPqr WHERE id = 1");

		$stmt -> bindParam(":fechaRegistroPqr", $fecha, PDO::PARAM_STR);

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

	static public function mdlMostrarUnidades($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();

		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarUnidad($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT unidad FROM $tabla WHERE id=$valor");
		$stmt -> execute();

		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlVerPerfil($tabla, $valor)
	{
		if($valor != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT perfil FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}
	static public function ctrNuevoPermiso($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, permisos) VALUES (:id_usuario, :permisos)");

		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR); 
		$stmt->bindParam(":permisos", $datos["permisos"], PDO::PARAM_STR);

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

	static public function mdlBuscarPermiso($tabla, $item, $valor)
	{
		if($valor != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT permisos FROM $tabla WHERE $item = :$item");

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

		$stmt->close();
		$stmt = null;
	}


	static public function mdlMostrarImpuestos($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarModulos($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE ver = 1 ORDER BY title ASC");
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarModulosInfo($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlmostrarFestivos()
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM festivos");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlrAlmacenarAccion($tabla, $id_mensaje, $valor, $ip_cliente)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_mensaje, valor, ip_cliente) VALUES (:id_mensaje, :valor, :ip_cliente)");

		$stmt -> bindParam(":id_mensaje", $id_mensaje, PDO::PARAM_INT);
		$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":ip_cliente", $ip_cliente, PDO::PARAM_STR);

		if ( $stmt -> execute() ) 
		{
			return "ok";
		}
		else
		{
			return false;
		}

		$stmt -> close();
		$stmt = null;

	}

	static public function mdlContarEstados($query)
	{
		$stmt = Conexion::conectar()->prepare("SELECT estado_pqr.id, estado_pqr.nombre, COUNT(registropqr.id_estado) FROM estado_pqr INNER JOIN registropqr ON estado_pqr.id = registropqr.id_estado $query GROUP BY(estado_pqr.nombre)");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();

		$stmt = null;


	}
}
