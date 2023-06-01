<?php

require_once "conexion.php";

class ModeloEquipos
{
	//LICENCIAS

	public static function mdlNuevaLicencia($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, password, productos, fecha_creacion) VALUES (:usuario, :password, :productos, :fecha_creacion)");
		$stmt ->bindParam( ":usuario", $datos["usuario"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":password", $datos["password"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":productos", $datos["productos"] , PDO::PARAM_STR );
		$stmt ->bindParam( ":fecha_creacion", $datos["fecha_creacion"] , PDO::PARAM_STR );
		
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

	public static function mdlEditarLicencia($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, productos = :productos WHERE id = :id ");
		
		$stmt ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt ->bindParam(":id", $datos["id"], PDO::PARAM_STR);

		if( $stmt->execute() )
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

	public static function mdlMostrarLicencias($tabla, $item, $valor)
	{
		if ( !is_null($item) ) 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam( ":".$item , $valor, PDO::PARAM_INT );
			$stmt->execute();
			return $stmt->fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
		
	}

	public static function mdlEditarLicencias($tabla, $item, $valor)
	{
		return 0;		
	}

	public static function mdlEliminarLicencias($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam( ":".$item , $valor , PDO::PARAM_INT );

		if ($stmt->execute()) 
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

	public static function mdlContarUsoLicencias($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE id_licencia = :id_licencia ");
		$stmt ->bindParam( ":id_licencia" , $valor , PDO::PARAM_INT );
		$stmt -> execute();
		return $stmt->fetch();
		$stmt->close();
		$stmt = null;		
	}

	//ACTAS

	public static function mdlMostrarActasFecha($tabla, $query, $fechaInicial, $fechaFinal, $item, $valor)
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

	public static function mdlMostrarActas($tabla, $item, $valor)
	{
		if ($item == "id") 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item , $valor , PDO::PARAM_INT);

			if ($stmt->execute()) 
			{
				return $stmt->fetch();
			}
			else
			{
				return null;
			}

		}
		else
		{
			if (!is_null($item) ) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

				$stmt->bindParam(":".$item , $valor , PDO::PARAM_STR);

				if ($stmt->execute()) 
				{
					return $stmt->fetchAll();
				}
				else
				{
					return null;
				}
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				if ($stmt->execute()) 
				{
					return $stmt->fetchAll();
				}
				else
				{
					return null;
				}
			}
		}

		$stmt->close();

		$stmt = null;

	}


	public static function mdlNuevaActaEquipo($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(fecha, tipo, cantidad, observaciones, file) VALUES (:fecha, :tipo, :cantidad, :observaciones, :file) ");
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":file", $datos["file"], PDO::PARAM_STR);

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

	public static function mdlEditarActaEquipo($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha = :fecha, tipo = :tipo, cantidad = :cantidad, observaciones = :observaciones, file = :file WHERE id = :id");

		$stmt->bindParam(":fecha" , $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo" , $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad" , $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":observaciones" , $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":file" , $datos["file"], PDO::PARAM_STR);
		$stmt->bindParam(":id" , $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) 
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

	//EQUIPOS
	public static function mdlDesvincularLicencia($tabla, $id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_licencia = 0 WHERE id_licencia = :id_licencia");
		$stmt -> bindParam(":id_licencia", $id, PDO::PARAM_INT);

		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}

		$stmt -> close();
		$stmt = null;

	}//mdlDesvincularLicencia($tabla, $id)

	//PARAMETROS	

	public static function mdlMostrarParametros($tabla, $item, $valor, $item2)
	{
		if ($item == "id") 
		{
			if (!is_null($item2)) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
				if ($stmt->execute()) 
				{
					return $stmt->fetch();
				}
				else
				{
					return null;
				}
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
				if ($stmt->execute()) 
				{
					return $stmt->fetch();
				}
				else
				{
					return null;
				}
			}
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY nombre ASC");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);
			if ($stmt->execute()) 
			{
				return $stmt->fetchAll();
			}
			else
			{
				return null;
			}
		}

		
		$stmt->close();
		$stmt = null;
	}//mdlMostrarParametros($tabla, $id)

	public static function mdlNuevoParametro($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, tipo, fecha_creacion, id_usr) VALUES (:nombre, :tipo, :fecha_creacion, :id_usr)");

		$stmt->bindParam(":nombre" , $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo" , $datos["tipo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_creacion" , $datos["fecha_creacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_usr" , $datos["id_usr"], PDO::PARAM_INT);

		if ($stmt->execute()) 
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

	public static function mdleditarParametro($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, fecha_actualizacion = :fecha_actualizacion, id_act = :id_act WHERE id = :id");

		$stmt->bindParam(":nombre" , $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_actualizacion" , $datos["fecha_actualizacion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_act" , $datos["id_act"], PDO::PARAM_INT);//id del usuario que actualizo el parametro
		$stmt->bindParam(":id" , $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) 
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


	public static function mdlBorrarParametro($id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE equiposparametros SET elim = 1 WHERE id = :id");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			# code...
			return "ok";
		}
		else
		{
			return "error";
		}

		$stmt ->close();

		$stmt = null;

	}

	public static function mdlDELETEParametro($id)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM equiposparametros WHERE id = :id");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) 
		{
			# code...
			return "ok";
		}
		else
		{
			return "error";
		}

		$stmt ->close();

		$stmt = null;

	}


	public static function mdlValidarExistencia($tabla, $item1, $valor1, $item2, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :$item1 AND $item2 = :$item2");
		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) 
		{
			return $stmt->fetch();
		}
		else
		{
			return 0;
		}

		$stmt ->close();
		$stmt = null;

	}


	//EQUIPOS

	public static function mdlContarParametros($tabla, $item, $valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item = :$item ");

		$stmt->bindParam(":".$item , $valor , PDO::PARAM_STR);

		if ($stmt->execute()) 
		{
			return $stmt->fetch();
		}
		else
		{
			return 0;
		}

		$stmt -> close();
		$stmt = null;
	}

	public static function mdlMostrarEquipos($tabla, $item, $valor)
	{
		if ($item == "id") 
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt ->bindParam(":".$item, $valor, PDO::PARAM_INT);
			if ($stmt->execute()) 
			{
				return $stmt->fetch();
			}
			else
			{
				return null;
			}
		}//($item == "id") 
		else
		{
			if (!is_null($item)) 
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				if ($stmt->execute()) 
				{
					return $stmt->fetchAll();
				}
				else
				{
					return null;
				}

			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

				if ($stmt->execute()) 
				{
					return $stmt->fetchAll();
				}
				else
				{
					return null;
				}
			}//if (!is_null($item)) 
		}//($item != "id") 

		$stmt->close();
		$stmt = null;

	}//mdlMostrarEquipos($tabla, $item, $valor)

}