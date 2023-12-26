<?php

require_once "conexion.php";

class ModeloInsumos
{
	static public function mdlMostrarInsumos($tabla, $item, $valor, $sw)
	{
		if($item != null)
		{
			if($item == "id_categoria")
			{

				if ($sw == 0) 
				{
					# code...
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				$stmt -> execute();

				return $stmt -> fetchAll();

				}
				else
				{
					$stmt = Conexion::conectar()->prepare("SELECT descripcion, stock FROM $tabla WHERE $item = :$item AND elim = 0");

					$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
					$stmt -> execute();

					return $stmt -> fetchAll();
				}

			}
			elseif($item == "stock" && $valor == 12)
			{
				$valor = 0;
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor , PDO::PARAM_INT);
				$stmt -> execute();

				return $stmt -> fetchAll();
			}
			elseif($item == "stock" && $valor == 13)
			{
				$valor = 16;
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item BETWEEN 1 AND :$item AND elim = 0");
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
				$stmt -> execute();

				return $stmt -> fetchAll();
			}
			elseif($item == "codigo")
			{
				$stmt = Conexion::conectar()->prepare("SELECT codigo, descripcion FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

				$stmt -> execute();

				return $stmt -> fetch();
			}
			elseif($item == "habilitado")
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetchAll();
			}
			elseif($item == "descripcion")
			{
				$stmt = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);

				$stmt -> execute();

				return $stmt -> fetch();
			}
			else
			{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();

				return $stmt -> fetch();
			}
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}#mdlMostrarInsumos

	static public function mdlCrearSinDefinir($tabla, $valor)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(unidad) VALUES (:unidad)");

		$stmt->bindParam(":unidad", $valor, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;
	}

	static public function mdlmostrarRegistros($tabla, $item, $valor, $tipo)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor AND tipo = $tipo");
		$stmt -> execute();
		return $stmt -> fetch();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlNuevaHistoriaPro($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT IGNORE INTO $tabla(id_insumo, registro, tipo) VALUES (:id_insumo, :registro, :tipo)");

		$stmt->bindParam(":id_insumo", $datos["id_insumo"], PDO::PARAM_STR);
		$stmt->bindParam(":registro", $datos["registro"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);


		if($stmt->execute()){
			return "ok";	
		}else{
			return $stmt->errorCode();
		}
		$stmt->close();
		$stmt = null;
	}

	static public function MdlActualizarH($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET registro = :registro WHERE id_insumo = :id_insumo AND tipo = :tipo");

		$stmt -> bindParam(":registro", $datos["registro"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_insumo", $datos["id_insumo"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlBuscarInsumo($tabla, $item, $valor)
	{


		if ($item == "id") 
		{
			$stmt = Conexion::conectar()->prepare("SELECT $item FROM $tabla WHERE $item = $valor");
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT $item FROM $tabla WHERE $item LIKE '%$valor%'");
		}
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlAgruparInsumos($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT categorias.categoria, COUNT(categorias.categoria) FROM $tabla INNER JOIN categorias ON $tabla.id_categoria = categorias.id GROUP BY(categorias.categoria) ORDER BY COUNT(categorias.categoria)");

		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlVerImagen($tabla, $id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT imagen FROM $tabla WHERE id = :id AND elim = 0");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlVerDescripcion($tabla, $id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT descripcion FROM $tabla WHERE id = :id AND elim = 0");

		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlActualizarPrecio($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio_compra = :precio_compra WHERE id = :id");

		$stmt -> bindParam(":precio_compra", $datos["precio_compra"] , PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMostrarRT($tabla, $item, $valor)
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
	}#mdlMostrarInsumos
	/*=============================================
	REGISTRAR NUEVO INSUMO
	=============================================*/
	static public function mdlIngresarInsumo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, observacion, imagen, precio_compra, estante, nivel, seccion, fecha, prioridad, unidad, unidadSal, contenido, habilitado) VALUES (:id_categoria, :codigo, :descripcion, :observacion, :imagen, :precio_compra, :estante, :nivel, :seccion, :fecha, :prioridad, :unidad, :unidadSal, :contenido, :habilitado)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":estante", $datos["estante"], PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_INT);
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_INT);
		$stmt->bindParam(":unidadSal", $datos["unidadSal"], PDO::PARAM_INT);
		$stmt->bindParam(":contenido", $datos["contenido"], PDO::PARAM_INT);
		$stmt->bindParam(":habilitado", $datos["habilitado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;

	}#mdlIngresarInsumo

	static public function mdlIngresarInsumoIMP($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, observacion, stock, stockIn, precio_compra, precio_unidad, precio_por_mayor, prioridad, estante, nivel, seccion) VALUES (:id_categoria, :codigo, :descripcion, :observacion, :stock, :stockIn, :precio_compra, :precio_unidad, :precio_por_mayor, :prioridad, :estante, :nivel, :seccion)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":stockIn", $datos["stockIn"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_unidad", $datos["precio_unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_por_mayor", $datos["precio_por_mayor"], PDO::PARAM_STR);
		$stmt->bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_INT);
		$stmt->bindParam(":estante", $datos["estante"], PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;

	}#mdlIngresarInsumoIMP

	static public function mdlImportarInsumo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, observacion, stock, stockIn, precio_compra, precio_unidad, precio_por_mayor, estante, nivel, seccion, prioridad, unidad, unidadSal, contenido, habilitado) VALUES (:id_categoria, :codigo, :descripcion, :observacion, :stock, :stockIn, :precio_compra, :precio_unidad, :precio_por_mayor, :estante, :nivel, :seccion, :prioridad, :unidad, :unidadSal, :contenido, :habilitado)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt->bindParam(":stockIn", $datos["stockIn"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_unidad", $datos["precio_unidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_por_mayor", $datos["precio_por_mayor"], PDO::PARAM_STR);
		$stmt->bindParam(":estante", $datos["estante"], PDO::PARAM_STR);
		$stmt->bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		$stmt->bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
		$stmt->bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_INT);
		$stmt->bindParam(":unidad", $datos["unidad"], PDO::PARAM_INT);
		$stmt->bindParam(":unidadSal", $datos["unidadSal"], PDO::PARAM_INT);
		$stmt->bindParam(":contenido", $datos["contenido"], PDO::PARAM_INT);
		$stmt->bindParam(":habilitado", $datos["habilitado"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}#$stmt->execute()

		$stmt->close();
		$stmt = null;

	}#mdlIngresarInsumo

	/*=============================================
	EDITAR INSUMO
	=============================================*/
	static public function mdlEditarInsumo($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, codigo = :codigo, descripcion = :descripcion, observacion = :observacion, estante = :estante, nivel = :nivel, seccion = :seccion, prioridad = :prioridad, precio_compra = :precio_compra, habilitado = :habilitado, stock = :stock WHERE id = :id");
		$stmt -> bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":estante", $datos["estante"], PDO::PARAM_STR);
		$stmt -> bindParam(":nivel", $datos["nivel"], PDO::PARAM_STR);
		$stmt -> bindParam(":seccion", $datos["seccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":prioridad", $datos["prioridad"], PDO::PARAM_STR);
		$stmt -> bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt -> bindParam(":habilitado", $datos["habilitado"], PDO::PARAM_INT);
		$stmt -> bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;
	}#mdlEditarInsumo


	static public function mdlMostrarInsumosDeCategoria($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND elim = 0");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE elim = 0");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	/*BORRAR INSUMO*/

	static public function mdlBorrarInsumo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET elim = :elim WHERE id = :id");

		$elim = 1;
		$stmt -> bindParam(":elim", $elim, PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}#mdlBorrarInsumo

	static public function mdlActualizarStock($tabla, $datos)
	{
		if ( isset($datos["contenido"])) 
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock, precio_compra = :precio_compra, contenido = :contenido WHERE id = :id");

			$stmt -> bindParam(":stock", $datos["stock"] , PDO::PARAM_INT);
			$stmt -> bindParam(":precio_compra", $datos["precio_compra"] , PDO::PARAM_INT);
			$stmt -> bindParam(":contenido", $datos["contenido"] , PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET stock = :stock, precio_compra = :precio_compra WHERE id = :id");

			$stmt -> bindParam(":stock", $datos["stock"] , PDO::PARAM_INT);
			$stmt -> bindParam(":precio_compra", $datos["precio_compra"] , PDO::PARAM_INT);
			$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		}

		
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function ctrActualizarPrecio($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio_compra = :precio_compra WHERE id = :id");

		$stmt -> bindParam(":precio_compra", $datos["precio_compra"] , PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}

	static public function mdlMigrarInsumos($tabla, $valor1, $valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = $valor1 WHERE id_categoria = $valor2 AND elim = 0");	

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;
	}


	static public function mdlVerificarInsAgotados($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE stock = 0 AND $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE stock = 0");
			$stmt -> execute();
			return $stmt -> fetch();
		}

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlVerificarInsEscasos($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE stock BETWEEN 1 AND 16 AND $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE stock BETWEEN 1 AND 16");
			$stmt -> execute();
			return $stmt -> fetch();
		}

		$stmt -> close();
		$stmt = null;
	}

	static public function mdlContarStockTotal($tabla, $item, $valor)
	{
		if($item != null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(stock) FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT SUM(stock) FROM $tabla");
			$stmt -> execute();
			return $stmt -> fetch();
		}


		$stmt -> close();

		$stmt = null;
	}


	static public function mdlVerHistoriaInsumo($tabla, $id, $anio, $mes){

		if($anio != 0)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_insumo = :id_insumo AND anio = :anio AND mes = :mes");
			$stmt -> bindParam(":id_insumo", $id, PDO::PARAM_INT);
			$stmt -> bindParam(":anio", $anio, PDO::PARAM_STR);
			$stmt -> bindParam(":mes", $mes, PDO::PARAM_STR);
			return ( $stmt -> execute() )? $stmt -> fetch() : "error" ;
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_insumo = :id_insumo");
			$stmt -> bindParam(":id_insumo", $id, PDO::PARAM_INT);
			return ( $stmt -> execute() )? $stmt -> fetch() : "error" ;
		}
		$stmt -> close();
		$stmt = null;
	}//mdlVerHistoriaInsumo

	static public function mdlCrearHistorialInsumo($tabla, $data){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_insumo, anio, historia, mes) VALUES (:id_insumo, :anio, :historia, :mes)");
		$stmt -> bindParam(":id_insumo", $data["id_insumo"], PDO::PARAM_INT);
		$stmt -> bindParam(":anio", $data["anio"], PDO::PARAM_STR);
		$stmt -> bindParam(":historia", $data["historia"], PDO::PARAM_STR);
		$stmt -> bindParam(":mes", $data["mes"], PDO::PARAM_STR);
		return ($stmt -> execute())? "ok" : "error" ;
		$stmt -> close();
		$stmt = null;
	}//mdlActualizarHistorialInsumo

	static public function mdlActualizarHistorialInsumo($tabla, $id, $data){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET historia = :historia WHERE id = :id");
		$stmt -> bindParam(":id", $id, PDO::PARAM_INT);
		$stmt -> bindParam(":historia", $data, PDO::PARAM_STR);
		return ($stmt -> execute())? "ok" : "error" ;
		$stmt -> close();
		$stmt = null;
	}//mdlActualizarHistorialInsumo

}#ModeloInsumos