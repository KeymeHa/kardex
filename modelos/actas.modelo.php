<?php
require_once "conexion.php";

class ModeloActas
{
	static public function mdlRegistrarActa($tabla, $datos)
	{
		if($datos["tipo"] == 1)
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigoInt, id_usr, tipo, fechaSal, autorizado, dependencia, responsable, dependenciaR, motivo, observacion, listainsumos) VALUES (:codigoInt, :id_usr, :tipo, :fechaSal, :autorizado, :dependencia, :responsable, :dependenciaR, :motivo, :observacion, :listainsumos)");

			$stmt->bindParam(":codigoInt", $datos["codigoInt"], PDO::PARAM_STR);
			$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
			$stmt->bindParam(":fechaSal", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":autorizado", $datos["autorizado"], PDO::PARAM_STR);
			$stmt->bindParam(":dependencia", $datos["dependencia"], PDO::PARAM_STR);
			$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
			$stmt->bindParam(":dependenciaR", $datos["dependenciaR"], PDO::PARAM_STR);
			$stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":listainsumos", $datos["listainsumos"], PDO::PARAM_STR);
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigoInt, id_usr, tipo, fechaEnt, autorizado, dependencia, responsable, dependenciaR, motivo, observacion, listainsumos) VALUES (:codigoInt, :id_usr, :tipo, :fechaEnt, :autorizado, :dependencia, :responsable, :dependenciaR, :motivo, :observacion, :listainsumos)");

			$stmt->bindParam(":codigoInt", $datos["codigoInt"], PDO::PARAM_STR);
			$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
			$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
			$stmt->bindParam(":fechaEnt", $datos["fecha"], PDO::PARAM_STR);
			$stmt->bindParam(":autorizado", $datos["autorizado"], PDO::PARAM_STR);
			$stmt->bindParam(":dependencia", $datos["dependencia"], PDO::PARAM_STR);
			$stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
			$stmt->bindParam(":dependenciaR", $datos["dependenciaR"], PDO::PARAM_STR);
			$stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
			$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt->bindParam(":listainsumos", $datos["listainsumos"], PDO::PARAM_STR);
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

	static public function mdlMostrarActasRango($tabla, $fechaInicial, $fechaFinal)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%' ORDER BY id DESC");

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

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' ORDER BY id DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' ORDER BY id DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


	static public function mdlMostrarActas($tabla, $item, $valor)
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
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarActa($tabla, $datos, $tipo)
	{
		if ($tipo == 1) 
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET autorizado = :autorizado, dependencia = :dependencia, responsable = :responsable, dependenciaR = :dependenciaR, motivo = :motivo, observacion = :observacion, listainsumos = :listainsumos, fechaEnt = :fechaEnt  WHERE id = :id");

			$stmt -> bindParam(":autorizado", $datos["autorizado"], PDO::PARAM_STR);
			$stmt -> bindParam(":dependencia", $datos["dependencia"], PDO::PARAM_STR);
			$stmt -> bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
			$stmt -> bindParam(":dependenciaR", $datos["dependenciaR"], PDO::PARAM_STR);
			$stmt -> bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
			$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":listainsumos", $datos["listainsumos"], PDO::PARAM_STR);
			$stmt -> bindParam(":fechaEnt", $datos[0], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datos[1], PDO::PARAM_INT);

		}
		elseif($tipo == 2)
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET autorizado = :autorizado, dependencia = :dependencia, responsable = :responsable, dependenciaR = :dependenciaR, motivo = :motivo, observacion = :observacion, listainsumos = :listainsumos, fechaSal = :fechaSal  WHERE id = :id");

			$stmt -> bindParam(":autorizado", $datos["autorizado"], PDO::PARAM_STR);
			$stmt -> bindParam(":dependencia", $datos["dependencia"], PDO::PARAM_STR);
			$stmt -> bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
			$stmt -> bindParam(":dependenciaR", $datos["dependenciaR"], PDO::PARAM_STR);
			$stmt -> bindParam(":motivo", $datos["motivo"], PDO::PARAM_INT);
			$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
			$stmt -> bindParam(":listainsumos", $datos["listainsumos"], PDO::PARAM_STR);
			$stmt -> bindParam(":fechaSal", $datos[0], PDO::PARAM_STR);
			$stmt -> bindParam(":id", $datos[1], PDO::PARAM_INT);
		}

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlBorrarActa($tabla, $datos)
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

}