-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.24-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para kardex
CREATE DATABASE IF NOT EXISTS `kardex` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `kardex`;

-- Volcando estructura para tabla kardex.actas
CREATE TABLE IF NOT EXISTS `actas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_usr` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `fechaSal` date DEFAULT NULL,
  `fechaEnt` date DEFAULT NULL,
  `autorizado` text COLLATE utf8_spanish_ci NOT NULL,
  `dependencia` text COLLATE utf8_spanish_ci NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `dependenciaR` text COLLATE utf8_spanish_ci NOT NULL,
  `motivo` int(1) NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `listainsumos` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.actas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `actas` DISABLE KEYS */;
/*!40000 ALTER TABLE `actas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.anexosprov
CREATE TABLE IF NOT EXISTS `anexosprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `id_carpeta` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.anexosprov: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexosprov` DISABLE KEYS */;
/*!40000 ALTER TABLE `anexosprov` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.anios
CREATE TABLE IF NOT EXISTS `anios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `anio` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.anios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `anios` DISABLE KEYS */;
INSERT INTO `anios` (`id`, `anio`) VALUES
	(1, 0),
	(2, 2021),
	(3, 2022);
/*!40000 ALTER TABLE `anios` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci DEFAULT 'Sin Información',
  `elim` int(11) NOT NULL DEFAULT 0,
  `cat_asociadas` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.areas: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
	(1, 'Sistemas', 'Encargados del área de Sistemas', 0, ''),
	(2, 'Contratación', 'Personal de Contratación', 0, ''),
	(3, 'Reasentamiento', '', 0, ''),
	(4, 'Jurídica', 'Personal de Juridíca', 0, ''),
	(5, 'Mercados', 'Personal de Mercados', 0, ''),
	(6, 'Area Tecnica', '', 0, '');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.carpetasprov
CREATE TABLE IF NOT EXISTS `carpetasprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `carpeta` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.carpetasprov: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `carpetasprov` DISABLE KEYS */;
/*!40000 ALTER TABLE `carpetasprov` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.categorias: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
	(1, 'Papelería', 'Sin Informacion.', 0),
	(2, 'Sistemas', 'Sin Informacion.', 0),
	(3, 'Aseo', 'Sin Informacion.', 0),
	(4, 'otros', 'Almacena Insumos que no manejan categoría especifica', 0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `soporte` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usr` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.facturas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` int(11) NOT NULL COMMENT '1 Crear, 2 Leer, 3 Actualizar, 4 Eliminar',
  `numTabla` int(11) NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas, 11 carpetas, 12 anexos, 13 proyectos\r\n',
  `valorAnt` text COLLATE utf8_spanish_ci NOT NULL,
  `valorNew` text COLLATE utf8_spanish_ci DEFAULT '',
  `fecha` date NOT NULL,
  `id_usr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.historial: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id`, `accion`, `numTabla`, `valorAnt`, `valorNew`, `fecha`, `id_usr`) VALUES
	(1, 1, 2, 'AROMATICA SURTIDA EN BOLSA', '', '2022-05-05', 1);
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.impuestos
CREATE TABLE IF NOT EXISTS `impuestos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `valor` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.impuestos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `impuestos` DISABLE KEYS */;
INSERT INTO `impuestos` (`id`, `descripcion`, `valor`) VALUES
	(1, 'IVA', 19);
/*!40000 ALTER TABLE `impuestos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumos
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` varchar(7) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `stockIn` int(11) NOT NULL DEFAULT 0,
  `precio_compra` float NOT NULL DEFAULT 0,
  `precio_unidad` float NOT NULL DEFAULT 0,
  `precio_por_mayor` float NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `elim` int(11) NOT NULL DEFAULT 0,
  `estante` char(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` char(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `seccion` char(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `prioridad` int(11) NOT NULL,
  `unidad` int(2) NOT NULL DEFAULT 1,
  `unidadSal` int(2) NOT NULL DEFAULT 1,
  `contenido` int(2) NOT NULL DEFAULT 1,
  `habilitado` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FK_insumos_insumosunidad` (`unidadSal`),
  KEY `FK_insumos_insumosunidad_2` (`unidad`),
  CONSTRAINT `FK_insumos_insumosunidad` FOREIGN KEY (`unidadSal`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_insumos_insumosunidad_2` FOREIGN KEY (`unidad`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.insumos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumosnombre
CREATE TABLE IF NOT EXISTS `insumosnombre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__insumosnombre` (`id_insumo`),
  CONSTRAINT `FK__insumosnombre` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.insumosnombre: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `insumosnombre` DISABLE KEYS */;
/*!40000 ALTER TABLE `insumosnombre` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumosunidad
CREATE TABLE IF NOT EXISTS `insumosunidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.insumosunidad: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `insumosunidad` DISABLE KEYS */;
INSERT INTO `insumosunidad` (`id`, `unidad`) VALUES
	(1, 'Bolsa'),
	(2, 'Unidad'),
	(3, 'Resma'),
	(4, 'Paquete'),
	(5, 'Galón'),
	(6, 'Litro'),
	(7, 'Rollo'),
	(8, 'Envase'),
	(9, 'Porción'),
	(10, 'Caja'),
	(11, 'Sin Definir');
/*!40000 ALTER TABLE `insumosunidad` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.inversiones
CREATE TABLE IF NOT EXISTS `inversiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prov` int(11) NOT NULL,
  `invertido` float NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.inversiones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `inversiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `inversiones` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.js_data
CREATE TABLE IF NOT EXISTS `js_data` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `page` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `title` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `num` int(2) NOT NULL DEFAULT 0,
  `pUno` int(1) NOT NULL DEFAULT 1,
  `pDos` int(1) NOT NULL DEFAULT 2,
  `pTres` int(1) NOT NULL DEFAULT 3,
  `pCuatro` int(1) NOT NULL DEFAULT 4,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.js_data: ~51 rows (aproximadamente)
/*!40000 ALTER TABLE `js_data` DISABLE KEYS */;
INSERT INTO `js_data` (`id`, `page`, `title`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`) VALUES
	(1, 'categorias', 'Categorias', 1, 1, 2, 3, 0),
	(2, 'verCategoria', 'Ver Categoria', 2, 1, 2, 3, 0),
	(3, 'insumos', 'Insumos', 3, 1, 2, 3, 0),
	(4, 'ordendecompras', 'Orden de Compras', 4, 1, 2, 3, 0),
	(5, 'facturas', 'Facturas', 5, 1, 2, 3, 0),
	(6, 'requisiciones', 'Requisiciones', 8, 1, 2, 3, 0),
	(7, 'nuevaFactura', 'Nueva Factura', 10, 1, 2, 3, 0),
	(8, 'editarFactura', 'Editar Factura', 10, 1, 2, 3, 0),
	(9, 'requisicion', 'Requisción', 11, 1, 2, 3, 0),
	(10, 'requisicionImportada', 'Importar Requisición', 11, 1, 2, 3, 0),
	(11, 'editarRq', 'Editar Requisición', 11, 1, 2, 3, 0),
	(12, 'actas', 'Actas', 14, 1, 2, 3, 0),
	(13, 'areas', 'Areas', 15, 1, 2, 3, 0),
	(14, 'personas', 'Personas', 16, 1, 2, 3, 0),
	(15, 'inicio', 'Dashboard', 17, 1, 2, 3, 4),
	(16, 'reportesRq', 'Reportes de Requisiciones', 17, 1, 2, 3, 0),
	(17, 'verArea', 'Ver Área', 18, 1, 2, 3, 0),
	(18, 'proveedor', 'Proveedor', 19, 1, 2, 3, 0),
	(19, 'inversionInsumos', 'Inversión en Insumos', 23, 1, 2, 3, 0),
	(20, 'cotizaciones', 'Cotizaciones', 25, 1, 2, 3, 0),
	(21, 'verInsumo', 'Ver Insumo', 26, 1, 2, 3, 0),
	(22, 'proyectos', 'Proyectos', 27, 1, 2, 3, 0),
	(23, 'usuarios', 'Usuarios', 0, 1, 2, 0, 0),
	(24, 'plantilla', 'Plantilla', 0, 1, 2, 3, 0),
	(25, 'nuevaActa', 'Nueva Acta', 0, 1, 2, 3, 0),
	(28, 'parametros', 'Parametros', 0, 1, 2, 0, 0),
	(29, 'nuevaOrdendeCompras', 'Nuevar Orden', 0, 1, 2, 3, 0),
	(30, 'proveedores', 'Proveedores', 0, 1, 2, 3, 0),
	(31, 'editarOrden', 'Editar Orden', 0, 1, 2, 3, 0),
	(32, 'editarActa', 'Editar Acta', 0, 1, 2, 3, 0),
	(33, 'verOrden', 'Ver Orden', 0, 1, 2, 3, 0),
	(34, 'inventario', 'Inventario', 0, 1, 2, 3, 0),
	(35, 'generaciones', 'Generaciones', 0, 1, 2, 3, 4),
	(36, 'salir', 'LogOut', 0, 1, 2, 3, 4),
	(37, 'perfil', 'Mi Perfil', 0, 1, 2, 3, 4),
	(38, 'genRequisicion', 'Generar Requisición', 29, 0, 0, 0, 4),
	(39, 'hisRequisicion', 'Historial de Requisición', 30, 0, 0, 0, 4),
	(40, 'verProyecto', 'Proyecto', 28, 1, 2, 3, 0),
	(41, 'verRequisicion', 'Ver Requisición', 0, 1, 2, 3, 0),
	(42, 'borrador', 'Borrador', 0, 1, 2, 3, 0),
	(43, 'verFactura', 'Ver Factura', 0, 1, 2, 3, 0),
	(44, 'verRequisicionS', 'ver Requisición', 11, 1, 2, 3, 0),
	(45, 'miRequisicion', 'Requisición', 0, 0, 0, 0, 4),
	(47, 'historialUsuarios', 'Historial de Usuarios', 0, 1, 2, 3, 0),
	(48, 'historialInsumos', 'Historial Insumos', 0, 1, 2, 3, 0),
	(49, 'historialCategorias', 'Historial Categorias', 0, 1, 2, 3, 0),
	(50, 'historialAreas', 'Historial Areas', 0, 1, 2, 3, 0),
	(51, 'historialPersonas', 'Historial Personas', 0, 1, 2, 3, 0),
	(52, 'historialOrdenes', 'Historial Ordenes', 0, 1, 2, 3, 0),
	(53, 'historialRq', 'Historial Requisiciones', 0, 1, 2, 3, 0),
	(54, 'Creditos', 'Creditos', 0, 1, 2, 3, 4);
/*!40000 ALTER TABLE `js_data` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.js_files
CREATE TABLE IF NOT EXISTS `js_files` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '''all''',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.js_files: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `js_files` DISABLE KEYS */;
INSERT INTO `js_files` (`id`, `nombre`, `habilitado`) VALUES
	(1, 'plantilla', 'all'),
	(2, 'actas', 'actas'),
	(3, 'nuevaActa', 'nuevaActa'),
	(4, 'usuarios', 'usuarios'),
	(5, 'categorias', 'categorias'),
	(6, 'insumos', 'insumos'),
	(7, 'areas', 'areas'),
	(8, 'nuevaFactura', 'nuevaFactura'),
	(9, 'facturas', 'facturas'),
	(10, 'proveedores', 'proveedores'),
	(11, 'anexos', 'none'),
	(12, 'requisiciones', 'requisiciones'),
	(13, 'parametros', 'all'),
	(14, 'nuevaOrdendeCompras', 'nuevaOrdendeCompras'),
	(15, 'ordendecompras', 'ordendecompras'),
	(16, 'reportes', 'reportes'),
	(17, 'verCategoria', 'verCategoria'),
	(18, 'editarFactura', 'editarFactura'),
	(19, 'editarOrden', 'editarOrden'),
	(20, 'requisicion', 'requisicion'),
	(21, 'editarRq', 'editarRq'),
	(22, 'editarActa', 'editarActa'),
	(23, 'personas', 'personas'),
	(24, 'reportesRq', 'reportesRq'),
	(25, 'verOrden', 'verOrden'),
	(26, 'proveedor', 'proveedor'),
	(28, 'verArea', 'verArea'),
	(29, 'inversionInsumos', 'inversionInsumos'),
	(30, 'cotizaciones', 'cotizaciones'),
	(31, 'verInsumo', 'verInsumo'),
	(32, 'proyectos', 'proyectos'),
	(33, 'genRequisicion', 'genRequisicion'),
	(34, 'hisRequisicion', 'hisRequisicion'),
	(35, 'verProyecto', 'verProyecto'),
	(36, 'verRequisicionS', 'verRequisicionS'),
	(37, 'verFactura', 'verFactura');
/*!40000 ALTER TABLE `js_files` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrYsal` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.movimientos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.ordencompra
CREATE TABLE IF NOT EXISTS `ordencompra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_cotizacion` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `fac_asociada` int(11) NOT NULL DEFAULT 0,
  `formaPago` text COLLATE utf8_spanish_ci NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrega` date NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.ordencompra: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ordencompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordencompra` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stMinimo` int(11) NOT NULL DEFAULT 0,
  `stModerado` int(11) NOT NULL DEFAULT 0,
  `stAlto` int(11) NOT NULL DEFAULT 0,
  `codRq` int(11) NOT NULL DEFAULT 0,
  `codFac` int(11) NOT NULL DEFAULT 0,
  `codPed` int(11) NOT NULL DEFAULT 0,
  `codOrdC` int(11) NOT NULL DEFAULT 0,
  `anioActual` int(4) NOT NULL DEFAULT 2021,
  `nameFac` int(11) NOT NULL DEFAULT 0,
  `razonSocial` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `tel` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `direccionEnt` text COLLATE utf8_spanish_ci NOT NULL,
  `repLegal` text COLLATE utf8_spanish_ci NOT NULL,
  `valorIVA` int(11) NOT NULL,
  `validarIns` int(11) NOT NULL DEFAULT 0,
  `validarCat` int(11) NOT NULL DEFAULT 0,
  `codActa` int(11) NOT NULL DEFAULT 0,
  `li` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `prueba` int(11) DEFAULT 0,
  `extencion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `dia` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.parametros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`) VALUES
	(1, 10, 15, 30, 1, 1, 1, 1, 2022, 1, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 0, 0, 1, NULL, NULL, NULL, 0, 0);
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(1) NOT NULL,
  `perfil` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.perfiles: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`id`, `perfil`) VALUES
	(1, 'root'),
	(2, 'Administrador'),
	(3, 'Auxiliar'),
	(4, 'Encargado');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(3) NOT NULL DEFAULT 0,
  `id_area` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_personas_usuarios` (`id_usuario`),
  KEY `FK_personas_areas` (`id_area`),
  CONSTRAINT `FK_personas_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_personas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.personas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razonSocial` text COLLATE utf8_spanish_ci NOT NULL,
  `nombreComercial` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `digitoNit` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin Información',
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'No Registra',
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `contacto` varchar(50) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin Info',
  `fecha` date NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.proveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`id`, `razonSocial`, `nombreComercial`, `nit`, `digitoNit`, `descripcion`, `direccion`, `telefono`, `contacto`, `fecha`, `correo`) VALUES
	(1, 'PARMENCO', 'PARMEZANOS PIZZA HOT', '900236525', '5', 'VENTA DE ESPAGUETTI', 'CLL 12 B 55 PISO 1000', '302356985', 'FERNANDITO BARCELITO', '0000-00-00', 'NINGUN@HOLA.COM');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.proyectoarea
CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_areas` text DEFAULT NULL,
  `id_proyecto` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectoarea: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectoarea` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectoarea` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.proyectos
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text NOT NULL,
  `elim` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.requisiciones
CREATE TABLE IF NOT EXISTS `requisiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(3) NOT NULL,
  `id_persona` int(3) NOT NULL,
  `id_usr` int(3) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `fecha_sol` date NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_proyecto` int(3) NOT NULL DEFAULT 1,
  `aprobado` int(1) NOT NULL DEFAULT 0,
  `observacionE` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `registro` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `gen` int(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_requisiciones_areas` (`id_area`),
  KEY `FK_requisiciones_usuarios` (`id_usr`),
  KEY `FK_requisiciones_usuarios_2` (`id_persona`),
  KEY `FK_requisiciones_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_requisiciones_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_requisiciones_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_requisiciones_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.requisiciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `requisiciones` DISABLE KEYS */;
/*!40000 ALTER TABLE `requisiciones` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.tempdatosrq
CREATE TABLE IF NOT EXISTS `tempdatosrq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.tempdatosrq: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tempdatosrq` DISABLE KEYS */;
INSERT INTO `tempdatosrq` (`id`, `nombre`, `fecha`, `observacion`) VALUES
	(1, 'KEVIN BOLAÑO', '2021-05-20', NULL);
/*!40000 ALTER TABLE `tempdatosrq` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` int(1) NOT NULL DEFAULT 4,
  `foto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(11) DEFAULT 1,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `sid` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  `try` int(1) NOT NULL DEFAULT 0,
  `id_area` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_perfiles` (`perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.usuarios: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `sid`, `elim`, `try`, `id_area`) VALUES
	(1, 'Kevin Bolaño', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 1, NULL, 1, '2022-05-18 07:51:16', '2021-02-11 05:06:49', 'n02nmj2bvtsk34hcal1q45mm5k', 0, 0, 0),
	(2, 'Carmen Rebolledo A', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 2, '', 1, '2021-08-18 14:18:38', '2021-08-19 06:12:33', '', 0, 0, 0),
	(3, 'Karelly Moreno', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5aub5AdYGnDrNPXtjZGt9K5ZSA6JZ42Pci', 3, '', 1, '2021-06-10 09:47:31', '2021-08-19 06:12:39', '', 0, 0, 0);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.valores
CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `registro` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__insumos` (`id_insumo`),
  CONSTRAINT `FK__insumos` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Muestra los cambios de valores que lleva un insumo a lo largo del tiempo.';

-- Volcando datos para la tabla kardex.valores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `valores` DISABLE KEYS */;
/*!40000 ALTER TABLE `valores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
