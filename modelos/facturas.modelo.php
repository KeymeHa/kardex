<?php

require_once "conexion.php";

class ModeloFacturas
{
	static public function mdlMostrarFacturasRango($tabla, $fechaInicial, $fechaFinal, $anio)
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

	static public function mdlAgruparFacturas($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null)
		{

			$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, SUM(inversion), SUM(iva) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor = proveedores.id $anio GROUP BY(proveedores.nombreComercial) ORDER BY inversion DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, SUM(inversion), SUM(iva) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor = proveedores.id WHERE $tabla.fecha like '%$fechaFinal%' GROUP BY(proveedores.nombreComercial) ORDER BY inversion DESC");

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

				$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, SUM(inversion), SUM(iva) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor = proveedores.id WHERE $tabla.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY(proveedores.nombreComercial) ORDER BY inversion DESC");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, SUM(inversion), SUM(iva) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor = proveedores.id WHERE $tabla.fecha BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY(proveedores.nombreComercial) ORDER BY inversion DESC");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
	}

	static public function mdlContarFacturas($tabla, $item, $valor)
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

	static public function mdlAgruparFacturasCan($tabla, $fechaInicial, $fechaFinal, $anio)
	{
		if ($fechaInicial == null) 
		{
		$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, COUNT(proveedores.nombreComercial) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor	 = proveedores.id $anio GROUP BY(proveedores.nombreComercial) ORDER BY COUNT(proveedores.nombreComercial)");

		$stmt -> execute();
		return $stmt -> fetchAll();	

		}elseif($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, COUNT(proveedores.nombreComercial) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor	 = proveedores.id WHERE $tabla.fecha like '%$fechaFinal%' GROUP BY(proveedores.nombreComercial) ORDER BY COUNT(proveedores.nombreComercial)");

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

				$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, COUNT(proveedores.nombreComercial) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor	 = proveedores.id WHERE $tabla.fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' GROUP BY(proveedores.nombreComercial) ORDER BY COUNT(proveedores.nombreComercial)");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT proveedores.nombreComercial, COUNT(proveedores.nombreComercial) FROM $tabla INNER JOIN proveedores ON $tabla.id_proveedor	 = proveedores.id WHERE $tabla.fecha BETWEEN '$fechaInicial' AND '$fechaFinal' GROUP BY(proveedores.nombreComercial) ORDER BY COUNT(proveedores.nombreComercial)");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();
		$stmt = null;
	}

	
	static public function mdlMostrarFacturas($tabla, $item, $valor, $anio)
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

	static public function mdlRegistrarFactura($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigoInt, codigo, id_usr,	id_proveedor, soporte, insumos, inversion, iva, observacion, fecha) VALUES (:codigoInt, :codigo, :id_usr, :id_proveedor, :soporte, :insumos, :inversion, :iva, :observacion, :fecha)");

		$stmt->bindParam(":codigoInt", $datos["codigoInt"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_INT);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":soporte", $datos["soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":inversion", $datos["inversion"], PDO::PARAM_INT);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

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

	static public function mdlEditarFactura($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, id_usr = :id_usr, id_proveedor = :id_proveedor, soporte = :soporte, insumos = :insumos, inversion = :inversion, iva = :iva, observacion = :observacion WHERE id = :id");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usr", $datos["id_usr"], PDO::PARAM_STR);
		$stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_INT);
		$stmt->bindParam(":soporte", $datos["soporte"], PDO::PARAM_STR);
		$stmt->bindParam(":insumos", $datos["insumos"], PDO::PARAM_STR);
		$stmt->bindParam(":inversion", $datos["inversion"], PDO::PARAM_INT);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			return "ok";
		}
		else
		{
			return $stmt->error();
		}
		$stmt->close();
		$stmt = null;
	}


	static public function MdlTraerInsumosFacRango($tabla,$fechaInicial, $fechaFinal, $anio)
	{
		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla $anio");


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT insumos FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		}
			$stmt -> execute();
			return $stmt -> fetchAll();
	}

}
