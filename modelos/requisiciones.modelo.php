<?php

require_once "conexion.php";


class ModeloRequisiciones
{

	static public function mdlRegistrarRequisicion($tabla, $datos, $tipoob)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_area, id_persona, id_usr, codigoInt, insumos, fecha_sol, $tipoob, id_proyecto, fecha, aprobado, gen) VALUES (:id_area, :id_persona, :id_usr, :codigoInt, :insumos, :fecha_sol, :$tipoob, :id_proyecto, :fecha, :aprobado, :gen)");

		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		$stmt->bindParam(":codigoInt", $datos["codigoInt"], PDO::PARAM_STR);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_sol", $datos["fecha_sol"], PDO::PARAM_STR);
		$stmt->bindParam(":".$tipoob, $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proyecto", $datos["id_proyecto"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_INT);
		$stmt->bindParam(":gen", $datos["gen"], PDO::PARAM_INT);

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

		static public function mdlMostrarRequisicionesRangoIdUsr($tabla, $fechaInicial, $fechaFinal, $anio, $id)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio AND id_persona = $id ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha_sol, '%Y %m %d') = DATE_FORMAT('$fechaFinal', '%Y %m %d') AND id_persona = $id ORDER BY id DESC");

			//$stmt -> bindParam(":fecha_sol", $fechaFinal, PDO::PARAM_STR);

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND id_persona = $id ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' AND id_persona = $id ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlMostrarRequisicionesRango($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){


			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 1 or aprobado = 2 AND DATE_FORMAT(fecha_sol, '%Y %m %d') = DATE_FORMAT(:fecha_sol, '%Y %m %d') ORDER BY id DESC");

			$stmt -> bindParam(":fecha_sol", $fechaInicial, PDO::PARAM_STR);

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 1 or aprobado = 2 AND fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 1 or aprobado = 2  AND fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function mdlMostrarRequisicionesRangoAppr($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 0 AND DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') ORDER BY id DESC");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 0 AND fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE aprobado = 0 AND  fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function MdlContarRqdePersonas($tabla, $item, $valor, $item2, $valor2, $fechaInicial, $fechaFinal, $anio, $tipo_fecha)
	{

		if($fechaInicial == null){

			if (!is_null($valor2)) 
			{
				if ($anio != "") 
				{
					$anio.= ' AND ';
				}
				else
				{
					$anio = 'WHERE ';
				}

				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio $item = $valor AND $item2 = $valor2;");
				$stmt -> execute();
				return $stmt -> fetch();	
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre, COUNT(usuarios.nombre) FROM $tabla INNER JOIN usuarios ON $tabla.id_persona = usuarios.id $anio GROUP BY(usuarios.nombre) ORDER BY COUNT(usuarios.nombre) ASC");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}

		}else if($fechaInicial == $fechaFinal){

			if (!is_null($valor2)) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE DATE_FORMAT($tipo_fecha, '%Y %m %d') = DATE_FORMAT(:$tipo_fecha, '%Y %m %d') AND  $item = :$item AND  $item2 = :$item2 ");
				$stmt -> bindParam(":".$tipo_fecha, $fechaFinal, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre, COUNT(usuarios.nombre) FROM $tabla INNER JOIN usuarios ON $tabla.id_persona = usuarios.id WHERE DATE_FORMAT(fecha_sol, '%Y %m %d') = DATE_FORMAT(:fecha_sol, '%Y %m %d') GROUP BY(usuarios.nombre) ORDER BY COUNT(usuarios.nombre) ASC");
				$stmt -> bindParam(":fecha_sol", $fechaFinal, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();
			}
		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				if (!is_null($valor2)) 
				{
					$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $tipo_fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' AND  $item = :$item AND  $item2 = :$item2 ");
					$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
					$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
					$stmt -> execute();
					return $stmt -> fetch();
				}
				else
				{
					$stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre, COUNT(usuarios.nombre) FROM $tabla INNER JOIN usuarios ON $tabla.id_persona = usuarios.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY(usuarios.nombre) ORDER BY COUNT(usuarios.nombre) ASC");
					$stmt -> execute();
					return $stmt -> fetchAll();
				}

				

			}else{

				if (!is_null($valor2)) 
				{
					$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $tipo_fecha BETWEEN '$fechaInicial' AND '$fechaFinal' AND  $item = :$item AND  $item2 = :$item2 ");
					$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
					$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
					$stmt -> execute();
					return $stmt -> fetch();
				}
				else
				{
					$stmt = Conexion::conectar()->prepare("SELECT usuarios.nombre, COUNT(usuarios.nombre) FROM $tabla INNER JOIN usuarios ON $tabla.id_persona = usuarios.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY(usuarios.nombre) ORDER BY COUNT(usuarios.nombre) ASC");
					$stmt -> execute();
					return $stmt -> fetchAll();
				}
			}
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function MdlTraerInsumosRq($tabla, $sw, $anio)
	{
		date_default_timezone_set('America/Bogota');
		$mes = date("m");

		if ($sw == 0 || $sw == 3)#presente anio
		{

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla $anio");

			$stmt -> execute();
		}
		else #presente anio y mes
		{

			if ($anio != "") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla $anio AND MONTH(fecha_sol) = '$mes'");

				$stmt -> execute();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla");

				$stmt -> execute();
			}

			
		}

		return $stmt -> fetchAll();	

		$stmt -> close();

		$stmt = null;
	}

	static public function MdlContarRqdeArea($tabla, $item, $valor, $anio)
	{
		if($item != null)
		{


			if ($anio == "") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item AND aprobado = 1");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio AND $item = :$item AND aprobado = 1");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();
				return $stmt -> fetch();
			}
		}
		else
		{

			if ( $anio == "") 
			{
				# code...
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla");
				$stmt -> execute();
				return $stmt -> fetchAll();

			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio AND aprobado = 1 ");
				$stmt -> execute();
				return $stmt -> fetchAll();
			}


		}

		$stmt -> close();

		$stmt = null;
	}

	static public function MdlTraerInsumosRqRango($tabla,$fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla $anio");


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE DATE_FORMAT(fecha_sol, '%Y %m %d') = DATE_FORMAT(:fecha_sol, '%Y %m %d') ORDER BY id DESC");

			//$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha_sol = :fecha_sol");

			$stmt -> bindParam(":fecha_sol", $fechaFinal, PDO::PARAM_STR);

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		}
			$stmt -> execute();
			return $stmt -> fetchAll();
			$stmt -> close();
			$stmt = null;
	}





	static public function mdlContarRequisicionesFecha($tabla, $sw, $anio, $mes)
	{
		if ($sw == 0) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio");

			$stmt -> execute();

			
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio AND MONTH(fecha_sol) = '$mes'");

			$stmt -> execute();

		}

		return $stmt -> fetch();	

		$stmt -> close();

		$stmt = null;

	}

	static public function MdlContarRqArea($tabla, $sw, $fechaInicial, $fechaFinal, $anio)
	{
		if ($sw == 1) 
		{
			$stmt = Conexion::conectar() -> prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id $anio GROUP BY(areas.nombre) LIMIT 5");
			$stmt -> execute();
			return $stmt -> fetchAll();
			
		}
		else
		{
			if($fechaInicial == null){

				$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id $anio  GROUP BY(areas.nombre)");

				$stmt -> execute();

				return $stmt -> fetchAll();	


			}else if($fechaInicial == $fechaFinal){

				#SELECT areas.nombre, COUNT(areas.nombre) FROM requisiciones INNER JOIN areas ON requisiciones.id_area = areas.id WHERE fecha_sol like '%2021-09-22%' GROUP BY(areas.nombre);
				$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') GROUP BY(areas.nombre)");

				//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') ORDER BY id DESC");
				#$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id GROUP BY(areas.nombre) WHERE fecha_sol like '%$fechaFinal%'");

				$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

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

					$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY(areas.nombre)");

				}else{


					$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY(areas.nombre)");

				}
			
				$stmt -> execute();

				return $stmt -> fetchAll();

			}

		}

		
		$stmt -> close();
		$stmt = null;
	}

	static public function MdlCantidadMesAnioRq($tabla, $sw, $fechaInicial, $fechaFinal, $anio)
	{
		if ($sw == 1) 
		{
			$stmt = Conexion::conectar() -> prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones $anio GROUP BY MONTH(fecha_sol)  LIMIT 5 ORDER BY COUNT(MONTH(fecha_sol)) DESC");
			$stmt -> execute();
			return $stmt -> fetchAll();
			
		}
		else
		{
			

			if($fechaInicial == null){

				$stmt = Conexion::conectar() -> prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones $anio GROUP BY MONTH(fecha_sol) ORDER BY COUNT(MONTH(fecha_sol)) DESC");
				$stmt -> execute();
				return $stmt -> fetchAll();


			}else if($fechaInicial == $fechaFinal){


			//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') ORDER BY id DESC");

				#SELECT areas.nombre, COUNT(areas.nombre) FROM requisiciones INNER JOIN areas ON requisiciones.id_area = areas.id WHERE fecha_sol like '%2021-09-22%' GROUP BY(areas.nombre);
				$stmt = Conexion::conectar()->prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones WHERE DATE_FORMAT(fecha, '%Y %m %d') = DATE_FORMAT(:fecha, '%Y %m %d') GROUP BY MONTH(fecha_sol)");
				#$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id GROUP BY(areas.nombre) WHERE fecha_sol like '%$fechaFinal%'");

				$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

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

					$stmt = Conexion::conectar()->prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY MONTH(fecha_sol)");

				}else{


					$stmt = Conexion::conectar()->prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY MONTH(fecha_sol)");

				}
			
				$stmt -> execute();

				return $stmt -> fetchAll();

			}
			
		}

		
		$stmt -> close();
		$stmt = null;
	}
	
	

	static public function mdlContarRequisicionesAppr($tabla, $anio)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla $anio");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarRequisiciones($tabla, $item, $valor, $anio)
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
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarRequisicionesId($tabla, $item, $valor, $anio, $id)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND id_persona = $id");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else
		{
			if ($anio == "") 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_persona = $id ORDER BY id DESC");
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio AND id_persona = $id ORDER BY id DESC");
			}

			

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrartempRq($tabla, $item, $valor)
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

	static public function mdlMostrartempDatosRq($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = 1");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlLimpiarTablaTemp($tabla)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla");
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlBorrarRq($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

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

	static public function mdlEditarRq($tabla, $datos)
	{
		if (isset($datos["registro"])) 
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_persona = :id_persona, id_area = :id_area, id_usr = :id_usr, insumos = :insumos, fecha = :fecha, fecha_sol = :fecha_sol, observacion = :observacion, registro = :registro, aprobado = :aprobado WHERE id = :id");

			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
			$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
			$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_sol", $datos["fecha_sol"], PDO::PARAM_STR);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":registro", $datos["registro"], PDO::PARAM_STR);
			$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_persona = :id_persona, id_area = :id_area, id_usr = :id_usr, insumos = :insumos, fecha = :fecha, fecha_sol = :fecha_sol, observacion = :observacion, aprobado = :aprobado WHERE id = :id");

			$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
			$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
			$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
			$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_sol", $datos["fecha_sol"], PDO::PARAM_STR);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		}

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

}