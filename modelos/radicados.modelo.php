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
			else
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
	//											 $tabla, $query, $fechaInicial, $fechaFinal, $item, $valor
	static public function mdlmostrarRegistrosPQR($tabla, $query, $fechaInicial, $fechaFinal, $item, $valor)
	{

		if($fechaInicial == null)
		{

			if (is_null($item)) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $query;");
				$stmt -> execute();
				return $stmt -> fetchAll();	
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();	
			}

		}elseif($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT('$fechaInicial', '%Y %m %d') $query");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' $query");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' $query");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlInsertarRegistrosPQREncargado($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_registro, id_usuario, fecha, sw, id_estado) VALUES ( :id_registro, :id_usuario, :fecha, :sw, :id_estado)");

			$stmt->bindParam(":id_registro", $datos["id_registro"], PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":sw", $datos["sw"], PDO::PARAM_INT);
			$stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;

	}

	static public function mdlmostrarRegistrosPQREncargado($tabla, $query, $fechaInicial, $fechaFinal, $idRegistro, $idUsuario)
	{
		if (!is_null($idRegistro)) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_registro = :id_registro AND id_usuario = :id_usuario;");

			$stmt->bindParam(":id_registro", $idRegistro, PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);

			$stmt -> execute();

			return $stmt -> fetch();

		}elseif($fechaInicial == null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $query;");
			$stmt -> execute();
			return $stmt -> fetchAll();	

		}elseif($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT('$fechaInicial', '%Y %m %d') $query");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' $query");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' $query");

			}
		
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
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_radicado, id_area, id_usuario,	id_estado,	id_pqr, fecha_vencimiento, fecha_actualizacion, fecha, dias_habiles, dias_contados) VALUES (:id_radicado, :id_area, :id_usuario, :id_estado, :id_pqr, :fecha_vencimiento, :fecha_actualizacion, :fecha, :dias_habiles, :dias_contados)");

		$stmt->bindParam(":id_radicado", $datos["id_radicado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
		$stmt->bindParam(":id_pqr", $datos["id_pqr"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_actualizacion", $datos["fecha_actualizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_habiles", $datos["dias_habiles"], PDO::PARAM_STR);
		$stmt->bindParam(":dias_contados", $datos["dias_contados"], PDO::PARAM_STR);

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


	static public function mdlActualizarRegistros($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET dias_contados = :dias_contados, id_estado = :id_estado, fecha_actualizacion = :fecha_actualizacion WHERE id = :id");

		$stmt->bindParam(":dias_contados", $datos["dias_contados"], PDO::PARAM_INT);
		$stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_actualizacion", $datos["fecha_actualizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlAcualizarItemTrazabilidad($tabla, $idRegistro, $item, $valor )
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE id = :id");

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":id", $idRegistro, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;

	}


	static public function mdlAcualizarTrazabilidad($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_usuario = :id_usuario, id_area = :id_area, id_estado = :id_estado, acciones = :acciones WHERE id = :id");

		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_STR);
		$stmt->bindParam(":id_estado", $datos["id_estado"], PDO::PARAM_STR);
		$stmt->bindParam(":acciones", $datos["acciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

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

	static public function mdlContarRad($tabla, $tablaD,  $itemD, $campoD, $item, $valor, $otro, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			#"pqr", "id", "nombre", "id_pqr", null, $fechaInicial, $fechaFinal, WHERE YEAR(fecha) = fecha
			if ($tablaD != null ) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT $tablaD.$campoD, $tablaD.$itemD, COUNT($tablaD.$itemD) FROM $tabla INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD $anio $otro GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC ");
				$stmt -> execute();
			}
			else
			{
				if ($valor == null) 
				{
					$stmt = Conexion::conectar()->prepare("SELECT $tablaD.$campoD, $tablaD.$itemD, COUNT($tablaD.$itemD) FROM $tabla INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD $otro GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC ");
					$stmt -> execute();
				}
			}

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT $tablaD.$campoD, $tablaD.$itemD, COUNT($tablaD.$itemD) FROM $tabla INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC");

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

				$stmt = Conexion::conectar()->prepare("SELECT $tablaD.$campoD, $tablaD.$itemD, COUNT($tablaD.$itemD) FROM $tabla INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT($fechaFinalMasUno, '%Y %m %d') GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT $tablaD.$campoD, $tablaD.$itemD, COUNT($tablaD.$itemD) FROM $tabla INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC");

			}

			$stmt -> execute();
			return $stmt -> fetchAll();
	
		}
	}//mdlContarRad

	static public function mdlNotificacionesEncargado($tabla, $idUsuario)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id_usuario) FROM $tabla WHERE id_usuario = :id_usuario AND sw = 1");
		$stmt->bindParam(":id_usuario", $idUsuario, PDO::PARAM_INT);
		$stmt -> execute();
		return $stmt -> fetch();
	}


	static public function mdlContarAreaRegistros($query, $tabla, $anio, $fechaInicial, $fechaFinal)
	{

		if($fechaInicial == null){

			if ($anio != "") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.id_area, areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id $query GROUP BY(areas.nombre) ORDER BY(areas.nombre) ASC");
				$stmt -> execute();
				//INNER JOIN $tablaD ON $tabla.$item = $tablaD.$itemD $anio $otro GROUP BY ($tablaD.$campoD) ORDER BY COUNT($tablaD.$itemD) ASC
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT $tabla.id_area,  areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id $query GROUP BY(areas.nombre) ORDER BY(areas.nombre) ASC");
				$stmt -> execute();
			}

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT $tabla.id_area,  areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') $query GROUP BY(areas.nombre) ORDER BY(areas.nombre) ASC ");

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

				$stmt = Conexion::conectar()->prepare("SELECT $tabla.id_area,  areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' $query GROUP BY(areas.nombre) ORDER BY(areas.nombre) ASC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT $tabla.id_area,  areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' $query GROUP BY(areas.nombre) ORDER BY(areas.nombre) ASC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}


	}//mdlContarAreaRegistros

}