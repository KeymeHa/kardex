<?php

require_once "conexion.php";

class ModeloRadicados
{

	static public function mdlMostrarRadicados($tabla, $item, $valor)
	{
		if($item != null)
		{

			if ($item == "id_corte") 
			{
				if ($valor == null) 
				{
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = 0 ORDER BY fecha DESC");

					$stmt -> execute();

					return $stmt -> fetchAll();
				}
				else
				{
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

					$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

					$stmt -> execute();

					return $stmt -> fetchAll();
				}
				
			}
			elseif($item == "id") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();
			}

			

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


	static public function mdlRegistrarRemitente($tabla,$remitente)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre) VALUES (:nombre)");

		$stmt->bindParam(":nombre", $remitente, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarRadicadosCorte($tabla, $item, $valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id_area");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarCortes($tabla, $item, $valor)
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
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlmostrarRegistroPQR($tabla, $query)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $query");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlmostrarRegistrosPQR($tabla, $query)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $query");
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarCortesRango($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') ORDER BY id DESC");

			$stmt -> bindParam(":fecha", $fechaInicial, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlRadicar($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(radicado,id_usr,fecha,id_accion,id_pqr,id_objeto,id_articulo,id_remitente,asunto,id_area,cantidad,recibido,dias,fecha_vencimiento,soporte,observaciones, correo, direccion) VALUES (:radicado,:id_usr,:fecha,:id_accion,:id_pqr,:id_objeto,:id_articulo,:id_remitente,:asunto,:id_area,:cantidad,:recibido,:dias,:fecha_vencimiento,:soporte,:observaciones, :correo, :direccion)");

		$stmt->bindParam(":radicado", $datos["radicado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":id_accion", $datos["id_accion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pqr", $datos["id_pqr"], PDO::PARAM_INT);
		$stmt->bindParam(":id_objeto", $datos["id_objeto"], PDO::PARAM_INT);
		$stmt->bindParam(":id_articulo", $datos["id_articulo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_remitente", $datos["id_remitente"], PDO::PARAM_STR);
		$stmt->bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":recibido", $datos["recibido"], PDO::PARAM_STR);
		$stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":soporte", $datos["soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlIngresarCorte($tabla, $numCorte)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(corte) VALUES (:corte)");

		$stmt->bindParam(":corte", $numCorte, PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlContarRadicados($tabla, $item, $valor)
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


	static public function mdlmostrarCorte($tabla, $item, $valor)
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

	static public function mdlGenerarCorte($tabla, $id_corte)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_corte = :id_corte WHERE id_corte = 0");

		$stmt -> bindParam(":id_corte", $id_corte, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlEditarRad($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_usr = :id_usr, id_accion = :id_accion, id_pqr = :id_pqr, id_objeto = :id_objeto, id_remitente = :id_remitente, id_articulo = :id_articulo, asunto = :asunto, id_area = :id_area, cantidad = :cantidad, recibido = :recibido, dias = :dias, fecha_vencimiento = :fecha_vencimiento, soporte = :soporte, observaciones = :observaciones, correo = :correo, direccion = :direccion WHERE id = :id");

		

		$stmt -> bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_accion", $datos["id_accion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_pqr", $datos["id_pqr"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_objeto", $datos["id_objeto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_remitente", $datos["id_remitente"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_articulo", $datos["id_articulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":asunto", $datos["asunto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_area", $datos["id_area"], PDO::PARAM_STR);
		$stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt -> bindParam(":recibido", $datos["recibido"], PDO::PARAM_STR);
		$stmt -> bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":soporte", $datos["soporte"], PDO::PARAM_STR);
		$stmt -> bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

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

	static public function mdlVerUsuarioDeArea($tabla, $id_area)
	{
		$stmt = Conexion::conectar()->prepare("SELECT asignaciones.id_persona FROM $tabla INNER JOIN asignaciones ON $tabla.id_usuario = asignaciones.id_persona WHERE $tabla.id_area = $id_area LIMIT 1");

		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlNuevoRegistro($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(dias, id_corte, id_radicado, id_area_o, id_usuario_o, id_area_d, id_usuario_d, id_accion, fecha, vigencia, observacion,soporte, sw, indicativo, modulo) VALUES (:dias, :id_corte, :id_radicado, :id_area_o, :id_usuario_o, :id_area_d, :id_usuario_d, :id_accion, :fecha, :vigencia, :observacion, :soporte, :sw, :indicativo, :modulo)");

		$stmt->bindParam(":dias", $datos["dias"], PDO::PARAM_STR);
		$stmt->bindParam(":id_corte", $datos["id_corte"], PDO::PARAM_STR);
		$stmt->bindParam(":id_radicado", $datos["id_radicado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_area_o", $datos["id_area_o"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_o", $datos["id_usuario_o"], PDO::PARAM_STR);
		$stmt->bindParam(":id_area_d", $datos["id_area_d"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usuario_d", $datos["id_usuario_d"], PDO::PARAM_STR);
		$stmt->bindParam(":id_accion", $datos["id_accion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":vigencia", $datos["vigencia"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":soporte", $datos["soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":sw", $datos["sw"], PDO::PARAM_STR);
		$stmt->bindParam(":indicativo", $datos["indicativo"], PDO::PARAM_STR);
		$stmt->bindParam(":modulo", $datos["modulo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}



	static public function mdlVerIndicativo($tabla, $id_radicado)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_radicado = :id_radicado");

		$stmt -> bindParam(":id_radicado", $id_radicado, PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}


	static public function mdlAcualizarTrazabilidad($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_indicativo = :id_indicativo, sw = :sw  WHERE id_radicado = :id_radicado");

		$stmt->bindParam(":id_indicativo", $datos["id_indicativo"], PDO::PARAM_STR);
		$stmt->bindParam(":sw", $datos["sw"], PDO::PARAM_STR);
		$stmt->bindParam(":id_radicado", $datos["id_radicado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarRadicadoRango($tabla, $fechaInicial, $fechaFinal, $anio, $id_area, $sw)
	{
		if($fechaInicial == null){

			if ($id_area == null) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio AND sw = $sw ORDER BY id DESC LIMIT 500");
				$stmt -> execute();
			}
			else
			{
				if ($anio != "") 
				{
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio AND id_area = $id_area AND sw = $sw ORDER BY id DESC LIMIT 500");
					$stmt -> execute();
				}
				else
				{
					$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_area = $id_area ORDER BY id DESC LIMIT 500");
					$stmt -> execute();
				}

				
			}

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') ORDER BY id DESC");

			$stmt -> bindParam(":fecha", $fechaInicial, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

}