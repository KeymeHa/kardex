<?php

require_once "conexion.php";


class ModeloRequisiciones
{

	static public function mdlRegistrarRequisicion($tabla, $datos, $tipoob)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_area, id_persona, id_usr,	codigoInt, insumos, fecha_sol, $tipoob, fecha, aprobado) VALUES (:id_area, :id_persona, :id_usr, :codigoInt, :insumos, :fecha_sol, :$tipoob, :fecha, :aprobado)");

		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		$stmt->bindParam(":codigoInt", $datos["codigoInt"], PDO::PARAM_STR);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_sol", $datos["fecha_sol"], PDO::PARAM_STR);
		$stmt->bindParam(":".$tipoob, $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_INT);

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

	static public function mdlMostrarRequisicionesRango($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla $anio ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_sol like '%$fechaFinal%' ORDER BY id DESC");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	static public function MdlContarRqdePersonas($tabla, $fechaInicial, $fechaFinal, $anio)
	{

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT personas.nombre, COUNT(personas.nombre) FROM $tabla INNER JOIN personas ON $tabla.id_persona = personas.id $anio GROUP BY(personas.nombre) ORDER BY COUNT(personas.nombre) DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			#SELECT personas.nombre, COUNT(personas.nombre) FROM requisiciones INNER JOIN personas ON requisiciones.id_persona = personas.id WHERE fecha_sol like '%2021-09-22%' GROUP BY(personas.nombre);
			$stmt = Conexion::conectar()->prepare("SELECT personas.nombre, COUNT(personas.nombre) FROM $tabla INNER JOIN personas ON $tabla.id_persona = personas.id WHERE fecha_sol like '%$fechaFinal%' GROUP BY(personas.nombre) ORDER BY COUNT(personas.nombre) DESC");
			#$stmt = Conexion::conectar()->prepare("SELECT personas.nombre, COUNT(personas.nombre) FROM $tabla INNER JOIN personas ON $tabla.id_persona = personas.id GROUP BY(personas.nombre) WHERE fecha_sol like '%$fechaFinal%'");

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

				$stmt = Conexion::conectar()->prepare("SELECT personas.nombre, COUNT(personas.nombre) FROM $tabla INNER JOIN personas ON $tabla.id_persona = personas.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY(personas.nombre) ORDER BY COUNT(personas.nombre) DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT personas.nombre, COUNT(personas.nombre) FROM $tabla INNER JOIN personas ON $tabla.id_persona = personas.id WHERE fecha_sol BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY(personas.nombre) ORDER BY COUNT(personas.nombre) DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

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

	static public function MdlContarRqdeArea($tabla, $item, $valor)
	{
		if($item != null)
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

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function MdlTraerInsumosRqRango($tabla,$fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla $anio");


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha_sol like '%$fechaFinal%'");

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
				$stmt = Conexion::conectar()->prepare("SELECT areas.nombre, COUNT(areas.nombre) FROM $tabla INNER JOIN areas ON $tabla.id_area = areas.id WHERE fecha_sol like '%$fechaFinal%' GROUP BY(areas.nombre)");
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

				#SELECT areas.nombre, COUNT(areas.nombre) FROM requisiciones INNER JOIN areas ON requisiciones.id_area = areas.id WHERE fecha_sol like '%2021-09-22%' GROUP BY(areas.nombre);
				$stmt = Conexion::conectar()->prepare("SELECT YEAR(fecha_sol), MONTH(fecha_sol), COUNT(MONTH(fecha_sol)) FROM requisiciones WHERE fecha_sol like '%$fechaFinal%' GROUP BY MONTH(fecha_sol)");
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
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_persona = :id_persona, id_area = :id_area, id_usr = :id_usr, insumos = :insumos, fecha_sol = :fecha_sol, observacion = :observacion, aprobado = :aprobado WHERE id = :id");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_area", $datos["id_area"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_sol", $datos["fecha_sol"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

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