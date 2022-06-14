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

	static public function mdlMostrarCortesRango($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha = :fecha ORDER BY id DESC");

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
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(radicado,id_usr,fecha,id_accion,id_pqr,id_objeto,id_articulo,id_remitente,asunto,id_area,cantidad,recibido,dias,fecha_vencimiento,soporte,observaciones) VALUES (:radicado,:id_usr,:fecha,:id_accion,:id_pqr,:id_objeto,:id_articulo,:id_remitente,:asunto,:id_area,:cantidad,:recibido,:dias,:fecha_vencimiento,:soporte,:observaciones)");

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

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_usr = :id_usr, id_accion = :id_accion, id_pqr = :id_pqr, id_objeto = :id_objeto, id_remitente = :id_remitente, id_articulo = :id_articulo, asunto = :asunto, id_area = :id_area, cantidad = :cantidad, recibido = :recibido, dias = :dias, fecha_vencimiento = :fecha_vencimiento, soporte = :soporte, observaciones = :observaciones WHERE id = :id");

		

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

}