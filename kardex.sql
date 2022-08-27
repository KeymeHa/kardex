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

-- Volcando estructura para tabla kardex.accion
CREATE TABLE IF NOT EXISTS `accion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.accion: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `accion` DISABLE KEYS */;
INSERT INTO `accion` (`id`, `nombre`) VALUES
	(1, 'RADICADO'),
	(2, 'ASIGNADO'),
	(3, 'REASIGNADO'),
	(4, 'INFORMADO'),
	(5, 'DEVOLUCIÓN'),
	(6, 'EN PROCESO'),
	(7, 'TRASLADO'),
	(8, 'TERMINADO'),
	(9, 'TERMINADO EXTEMPORANEO'),
	(10, 'ANULADO');
/*!40000 ALTER TABLE `accion` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.anexosprov: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `anexosprov` DISABLE KEYS */;
INSERT INTO `anexosprov` (`id`, `nombre`, `id_carpeta`, `fecha`, `ruta`) VALUES
	(13, 'Comprobante Banco', 1, '2022-07-07 10:15:19', '1/1.pdf');
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
	(1, 2022),
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.areas: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
	(1, 'Sistemas', 'Encargados del área de Sistemas', 0, ''),
	(2, 'Contratación', 'Personal de Contratación', 0, ''),
	(3, 'Reasentamiento', 'Abogados', 0, ''),
	(4, 'Jurídica', 'Personal de Juridíca', 0, ''),
	(5, 'Mercados', 'Personal de Mercados', 0, ''),
	(6, 'Area Tecnica', 'Ingenieros y Arquitectos', 0, ''),
	(7, 'ADMINISTRATIVO', 'Toda la Parte Administrativa', 0, '');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.articulo
CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.articulo: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `articulo` DISABLE KEYS */;
INSERT INTO `articulo` (`id`, `nombre`) VALUES
	(1, 'Sobre'),
	(2, 'Documento'),
	(3, 'Caja'),
	(4, 'Sobre+Doc'),
	(5, 'Sobre+Caja'),
	(6, 'Doc+Caja'),
	(7, 'Sobre+Doc+Caja'),
	(8, 'Otro'),
	(9, 'Correo Electrónico');
/*!40000 ALTER TABLE `articulo` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.asignaciones
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignaciones_usuarios` (`id_persona`),
  CONSTRAINT `FK_asignaciones_usuarios` FOREIGN KEY (`id_persona`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.asignaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `asignaciones` DISABLE KEYS */;
INSERT INTO `asignaciones` (`id`, `id_persona`, `modulo`) VALUES
	(4, 11, 7),
	(5, 1, 3);
/*!40000 ALTER TABLE `asignaciones` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.carpetasprov
CREATE TABLE IF NOT EXISTS `carpetasprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `carpeta` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.carpetasprov: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `carpetasprov` DISABLE KEYS */;
INSERT INTO `carpetasprov` (`id`, `nombre`, `carpeta`, `id_prov`, `fecha`) VALUES
	(1, 'Contratos', 1, 1, '2022-07-07 10:14:45');
/*!40000 ALTER TABLE `carpetasprov` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.categorias: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
	(1, 'Papelería', 'Sin Informacion.', 0),
	(2, 'Sistemas', 'Sin Informacion.', 0),
	(3, 'Aseo', 'Sin Informacion.', 0),
	(4, 'Cocina', 'Elementos para la cocina', 0),
	(5, 'Otros', 'Almacena Insumos que no manejan categoría especifica', 0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `sid` int(11) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `elim` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.clientes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nombre`, `sid`, `correo`, `telefono`, `elim`) VALUES
	(1, 'Susana Amador', 123456789, 'susanaamador@hotmail.com', '2147483647', 0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.cortes
CREATE TABLE IF NOT EXISTS `cortes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corte` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `corte` (`corte`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.cortes: ~19 rows (aproximadamente)
/*!40000 ALTER TABLE `cortes` DISABLE KEYS */;
INSERT INTO `cortes` (`id`, `corte`, `fecha`) VALUES
	(1, '2206061753', '2022-06-06 15:54:22'),
	(2, '2206081754', '2022-06-10 14:26:06'),
	(3, '2206091755', '2022-06-09 17:08:56'),
	(4, '2206091756', '2022-06-09 17:11:36'),
	(5, '2206101757', '2022-06-10 08:57:36'),
	(6, '2206101758', '2022-06-10 08:58:39'),
	(7, '2206101759', '2022-06-10 09:22:52'),
	(8, '2206161760', '2022-06-16 16:51:25'),
	(9, '2206221762', '2022-06-22 12:11:00'),
	(10, '2206231763', '2022-06-23 15:59:10'),
	(11, '2206231764', '2022-06-23 17:00:48'),
	(12, '2207141765', '2022-07-14 15:30:23'),
	(13, '2207271765', '2022-07-27 09:44:04'),
	(15, '2207271766', '2022-07-27 09:55:14'),
	(16, '2207271767', '2022-07-27 11:06:26'),
	(17, '2207271768', '2022-07-27 11:12:54'),
	(18, '2207281769', '2022-07-28 16:08:42'),
	(19, '2207281770', '2022-07-28 16:08:57'),
	(20, '2207281771', '2022-07-28 16:13:43'),
	(21, '2208091773', '2022-08-09 16:41:44'),
	(22, '2208101774', '2022-08-10 08:57:55'),
	(23, '2208231776', '2022-08-23 10:53:37');
/*!40000 ALTER TABLE `cortes` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.facturas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` (`id`, `codigoInt`, `codigo`, `id_proveedor`, `soporte`, `id_usr`, `insumos`, `fecha`, `inversion`, `iva`, `observacion`) VALUES
	(2, 'FAC-002-2022', 'FACTURA-1', 2, '', 1, '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"1","con":"1","pre":"0","sub":"0"},{"id":"2","des":"AROMATICA SURTIDA EN BOLSA","can":"1","con":"1","pre":"0","sub":"0"},{"id":"3","des":"ATOMIZADOR AMBIENTADOR LAVANDA ","can":"1","con":"1","pre":"0","sub":"0"}]', '2022-08-26', 0, 0, '');
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.festivos
CREATE TABLE IF NOT EXISTS `festivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.festivos: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `festivos` DISABLE KEYS */;
INSERT INTO `festivos` (`id`, `fecha`) VALUES
	(1, '2022-01-01'),
	(2, '2022-01-10'),
	(3, '2022-03-21'),
	(4, '2022-04-10'),
	(5, '2022-04-14'),
	(6, '2022-04-15'),
	(7, '2022-04-17'),
	(8, '2022-05-01'),
	(9, '2022-05-30'),
	(10, '2022-06-20'),
	(11, '2022-06-27'),
	(12, '2022-07-04'),
	(13, '2022-07-20'),
	(14, '2022-08-07'),
	(15, '2022-08-15'),
	(16, '2022-10-17'),
	(17, '2022-11-07'),
	(18, '2022-11-14'),
	(19, '2022-12-08'),
	(20, '2022-12-25');
/*!40000 ALTER TABLE `festivos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accion` int(11) NOT NULL COMMENT '1 Crear, 2 Leer, 3 Actualizar, 4 Eliminar',
  `numTabla` int(11) NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas, 11 carpetas, 12 anexos, 13 proyectos, 14 asignaciones, 15 Radicados\r\n',
  `valorAnt` text COLLATE utf8_spanish_ci NOT NULL,
  `valorNew` text COLLATE utf8_spanish_ci DEFAULT '',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.historial: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
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
  `prioridad` int(1) NOT NULL DEFAULT 2,
  `unidad` int(2) NOT NULL DEFAULT 1,
  `unidadSal` int(2) NOT NULL DEFAULT 1,
  `contenido` int(2) NOT NULL DEFAULT 1,
  `habilitado` int(1) NOT NULL DEFAULT 1,
  `imp` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_insumos_insumosunidad` (`unidadSal`),
  KEY `FK_insumos_insumosunidad_2` (`unidad`),
  CONSTRAINT `FK_insumos_insumosunidad` FOREIGN KEY (`unidadSal`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_insumos_insumosunidad_2` FOREIGN KEY (`unidad`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.insumos: ~163 rows (aproximadamente)
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `stockIn`, `precio_compra`, `precio_unidad`, `precio_por_mayor`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`, `unidad`, `unidadSal`, `contenido`, `habilitado`, `imp`) VALUES
	(1, 3, '1', 'AMBIENTADOR DE BAÑO AIR WICK', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'g1', '0', 'G6', 3, 1, 1, 1, 0, 0),
	(2, 4, '2', 'AROMATICA SURTIDA EN BOLSA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, '0', '0', '0', 2, 1, 1, 1, 0, 0),
	(3, 3, '3', 'ATOMIZADOR AMBIENTADOR LAVANDA ', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(4, 4, '4', 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', 'SIN INFORMACION', NULL, 18, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(5, 4, '5', 'AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(6, 1, '6', 'BANDEJA PORTA DOCUMENTOS', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(7, 3, '7', 'BLANQUEADOR (LIMPIDO)', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(8, 1, '8', 'BOLIGRAFO  ROJO ', 'SIN INFORMACION', NULL, 10, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(9, 1, '9', 'BOLIGRAFO NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(10, 3, '10', 'BOLSA BASURA NEGRA X 90*110 ', 'SIN INFORMACION', NULL, 6, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(11, 3, '11', 'BOLSA BASURA VERDE 42*47CMS ', 'SIN INFORMACION', NULL, 7, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(12, 1, '12', 'BORRADOR DE NATA', 'SIN INFORMACION', NULL, 13, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(13, 1, '13', 'BORRADOR DE TABLERO', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(14, 4, '14', 'CAFÉ TOSTADO Y MOLIDO, FUERTE', 'SIN INFORMACION', NULL, 28, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(15, 1, '15', 'CARATULA POLY COVER CARTA ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(16, 1, '16', 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(17, 1, '17', 'CARTULINA BRISTOL 70*100 BLANCA', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(18, 2, '18', 'CD-R ', 'SIN INFORMACION', NULL, 129, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(19, 3, '19', 'CERA NATURAL SÓLIDA PARA MADERA AUTOBRILLO', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(20, 1, '20', 'CINTA EMP TRANSP 48X100 REF.301 3M ', 'SIN INFORMACION', NULL, 14, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(21, 1, '21', 'CINTA EMP TRANSP DELGADA 12 MM X40M ', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(22, 2, '22', 'CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(23, 1, '23', 'CINTA INVISIBLE 33M:19MM PARA CHEQUES', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(24, 1, '24', 'CLIP MARIPOSA GIGANTE', 'SIN INFORMACION', NULL, 8, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(25, 1, '25', 'CLIP MARIPOSA X 50 EMP*50 ', 'SIN INFORMACION', NULL, 6, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(26, 1, '26', 'CLIP SENCILLO X 100 EMP*100', 'SIN INFORMACION', NULL, 9, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(27, 1, '27', 'COLBON (PEGANTE UNIVERSAL) 480GR', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(28, 4, '28', 'COLCAFE COFFE CREAM 100 SOBRES DE 3 GR', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(29, 1, '29', 'CORRECTOR LIQUIDO LAPIZ *7 ML', 'SIN INFORMACION', NULL, 8, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(30, 4, '30', 'CREMA INSTANTANEA NO LACTEA PARA CAFÉ ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(31, 3, '31', 'CREMA LAVALOZA ', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(32, 1, '32', 'CUENTA FACIL', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(33, 5, '33', 'DECAMETRO STANPROF 10 MTS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(34, 5, '34', 'DECAMETRO STANPROF 30 MTS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(35, 5, '35', 'DECAMETRO STANPROF 50 MTS', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(36, 3, '36', 'DESENGRASANTE', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(37, 3, '37', 'DESINFECTANTE MULTIUSOS ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(38, 3, '38', 'DETERGENTE EN POLVO ', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(39, 2, '39', 'DVD +R ', 'SIN INFORMACION', NULL, 106, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(40, 3, '40', 'ESCOBA SUAVE MANGO MADERA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(41, 3, '41', 'ESPONJA LAVAPLATOS DOBLE USO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(42, 5, '42', 'FLEXOMETRO LUFKIN 26/8METROS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(43, 1, '43', 'FOLIADOR (NUMERADOR CONSECUTIVO)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(44, 1, '44', 'FORMAS CONTINUAS 1/2 11 1/2 TROQUELADA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(45, 1, '45', 'FORMAS CONTINUAS 9 1/2 *11 1P BLANCA 901', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(46, 1, '46', 'FORMAS CONTINUAS 9 1/2 *11 3P BLANCA 903 ', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(47, 1, '47', 'GANCHO LEGAJADOR PLASTICO ', 'SIN INFORMACION', NULL, 11, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(48, 1, '48', 'GRAPA COBRIZADA STANDARD *5000 ', 'SIN INFORMACION', NULL, 5, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(49, 1, '49', 'GRAPA GALVANIZADA INDUSTRIAL *1000', 'SIN INFORMACION', NULL, 10, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(50, 1, '50', 'GRAPADORA 340 RANK (SENCILLA)', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(51, 1, '51', 'GRAPADORA INDUSTRIAL HASTA 100 HOJAS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(52, 3, '52', 'GUANTES DE LATEX DE  EXAMEN ', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(53, 3, '53', 'GUANTES SEMI-INDUSTRIALES T9-9 ½*CALIBRE 25*LATEX NATURAL*COLOR NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(54, 1, '54', 'GUIA CLASIFICADORA  CARTULINA REF. 105 AMARILLA ', 'SIN INFORMACION', NULL, 17, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(55, 1, '55', 'GUIAS CELUGUIA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(56, 2, '56', 'HP 10 NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(57, 2, '57', 'HP 711 AMARILLO', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(58, 2, '58', 'HP 711 CYAN', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(59, 2, '59', 'HP 711 MAGENTA', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(60, 2, '60', 'HP 711 NEGRO', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(61, 2, '61', 'HP 82 AMARILLO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(62, 2, '62', 'HP 82 NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(63, 1, '63', 'HUELLERO COLOR NEGRO', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(64, 3, '64', 'JABON LÍQUIDO PARA MANOS, ANTIBACTERIAL, BIODEGRADABLE AROMA MANZANA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(65, 4, '65', 'LAMPARAS FLUORESCENTES SILVANIA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(66, 1, '66', 'LAPIZ NEGRO Nº2 ORIG. 482 ', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(67, 1, '67', 'LEGAJADOR AZ OFICIO AZUL ', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(68, 1, '68', 'LEGAJOS (CARPETAS DE EDUBAR)', 'SIN INFORMACION', NULL, 500, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(69, 3, '69', 'LEXMARK AMARILLO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(70, 3, '70', 'LEXMARK CYAN', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(71, 3, '71', 'LEXMARK NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(72, 1, '72', 'LIBRO ACTA 1/2 OFICIO 80H  100 FOLIOS (BITACORA)', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(73, 3, '73', 'LIMPIAVIDRIOS (AMONIACO-DESENGRASANTE SECADO RAPIDO)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(74, 3, '74', 'LIMPION', 'SIN INFORMACION', NULL, 22, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(75, 3, '75', 'LIQUIDO ESPECIAL PARA PISOS (BRILLO)', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(76, 1, '76', 'MARCADOR BORRABLE', 'SIN INFORMACION', NULL, 15, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(77, 1, '77', 'MARCADOR PERMANENTE NEGRO PUNTA FINA  (SHARPIE)', 'SIN INFORMACION', NULL, 21, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(78, 1, '78', 'MARCADORES PERMANENTES SURTIDOS (ROJO/AZUL/NEGRO)', 'SIN INFORMACION', NULL, 6, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(79, 3, '79', 'MASCARILLA DESECHABLE (TAPABOCAS)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(80, 4, '80', 'MEZCLADORES DESECHABLES PARA CAFÉ', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(81, 2, '81', 'MOUSE USB', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(82, 3, '82', 'PAPEL HIGIENIENICO INSTITUCIONAL ROLLOS, DOBLE HOJA, PRECORTADO, BLANCO', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(83, 1, '83', 'PAPEL RESMA DOBLE CARTA 11*17 75GRS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(84, 1, '84', 'PAPEL RESMA FOTOCOPIA 75GR CARTA ', 'SIN INFORMACION', NULL, 10, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(85, 1, '85', 'PAPEL RESMA FOTOCOPIA 75GR OFICIO ', 'SIN INFORMACION', NULL, 20, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(86, 3, '86', 'PAPELERA (CANECA)', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(87, 1, '87', 'PASTA CATALOGO 0.5R HERRAJE BLANCA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(88, 1, '88', 'PASTA CATALOGO 1.0R HERRAJE BLANCA', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(89, 1, '89', 'PASTA CATALOGO 1.5R HERRAJE BLANCA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(90, 1, '90', 'PASTA CATALOGO 2.0R HERRAJE BLANCA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(91, 1, '91', 'PASTA CATALOGO 2.5R HERRAJE BLANCA', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(92, 1, '92', 'PASTA CATALOGO 3.0D HERRAJE BLANCA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(93, 1, '93', 'PEGANTE  EN BARRA 40GRS ', 'SIN INFORMACION', NULL, 7, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(94, 1, '94', 'PERFORADORA 3 HUECOS', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(95, 1, '95', 'PERFORADORA RANK 1050 DOS HUECOS SEMI INDUSTRIAL (40 HOJAS)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(96, 1, '96', 'PERFORADORA SENCILLA 1038 RANK', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(97, 4, '97', 'PLATO DESECHABLE MEDIANO *20 ESPUMADO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(98, 1, '98', 'PROTECTOR DE TRANSPARENCIA (BOLSILLOS)', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(99, 1, '99', 'RECIBO DE CAJA MENOR X 200 HOJAS', 'SIN INFORMACION', NULL, 9, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(100, 3, '100', 'RECOGEDOR DE BASURA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(101, 4, '101', 'REGLA DE 30 CM', 'SIN INFORMACION', NULL, 5, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(102, 1, '102', 'RESALTADORES SURTIDOS ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(103, 1, '103', 'ROLLO PLOTER BOND 75 GR 28 PULGADAS', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(104, 4, '104', 'ROLLO TOALLA COCINA LAVABLE', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(105, 1, '105', 'SACAGRAPA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(106, 1, '106', 'SACAPUNTA', 'SIN INFORMACION', NULL, 13, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(107, 1, '107', 'SELLO NUMERADOR FOLIADOR AUTOMATICO CONSECUTIVO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(108, 4, '108', 'SERVILLETA 27-5*17', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(109, 1, '109', 'SOBRE MANILA CARTA  22*29 ', 'SIN INFORMACION', NULL, 120, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(110, 1, '110', 'SOBRE MANILA GIGANTE 37*27 ', 'SIN INFORMACION', NULL, 80, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(111, 1, '111', 'SOBRE MANILA OFICIO 25*35 ', 'SIN INFORMACION', NULL, 151, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(112, 4, '112', 'SOBRES NESCAFE TRADICION ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(113, 4, '113', 'TE HELADO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(114, 2, '114', 'TECLADO KB-110X USB ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(115, 1, '115', 'TIJERA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(116, 2, '116', 'TINTA EPSON 664 COLOR AMARILLO', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(117, 2, '117', 'TINTA EPSON 664 COLOR CYAN', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(118, 2, '118', 'TINTA EPSON 664 COLOR MAGENTA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(119, 2, '119', 'TINTA EPSON 664 COLOR NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(120, 2, '120', 'TINTA PARA SELLO DE CAUCHO', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(121, 1, '121', 'TIRA NEGRA (CAPACIDAD DE 300 HOJAS)', 'SIN INFORMACION', NULL, 5, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(122, 1, '122', 'TIRA NEGRA 11MM*42 AROS (CAPACIDAD DE 70 HOJAS)', 'SIN INFORMACION', NULL, 79, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(123, 1, '123', 'TIRA NEGRA 12 MM (CAPACIDAD DE 80 HOJAS)', 'SIN INFORMACION', NULL, 109, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(124, 1, '124', 'TIRA NEGRA 15 MM (CAPACIDAD DE 120 HOJAS)', 'SIN INFORMACION', NULL, 31, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(125, 1, '125', 'TIRA NEGRA 18 MM (CAPACIDAD DE 140 HOJAS)', 'SIN INFORMACION', NULL, 34, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(126, 1, '126', 'TIRA NEGRA 22 MM (CAPACIDAD DE 170 HOJAS)', 'SIN INFORMACION', NULL, 11, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(127, 1, '127', 'TIRA NEGRA 25 MM (CAPACIDAD DE 200 HOJAS)', 'SIN INFORMACION', NULL, 36, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(128, 1, '128', 'TIRA NEGRA 9MM  (CAPACIDAD DE 50 HOJAS)', 'SIN INFORMACION', NULL, 208, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(129, 2, '129', 'TK 512 AMARILLO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(130, 2, '130', 'TK 512 MAGENTA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(131, 2, '131', 'TK512 CYAN', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(132, 3, '132', 'TOALLA DE MANOS BLANCA 24X21CM HOJA TRIPLE DOBLADA EN Z', 'SIN INFORMACION', NULL, 23, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(133, 2, '133', 'TONER NEGRO TK-1147 (2035)', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(134, 2, '134', 'TONER NEGRO TK-137 (2810)', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(135, 2, '135', 'TONER NEGRO TK-3122 (4200)', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(136, 2, '136', 'TONER NEGRO TK-3132 (4300)', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(137, 2, '137', 'TONER NEGRO TK-342 (2020)', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(138, 3, '138', 'TRAPERO TIPO INDUSTRIAL', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(139, 3, '139', 'VARSOL SIN OLOR ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(140, 4, '140', 'VASO 11 ONZAS TRANSPARENTE', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(141, 4, '141', 'VASO CAFETERO TERMICO ESPUMADO (4 ONZAS)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(142, 1, '142', 'LAPIZ ROJO', 'SIN INFORMACION', NULL, 10, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(143, 1, '143', 'NOTAS ADHESIVAS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(144, 1, '144', 'PLANILLERO ACRILICO CON GANCHO', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(145, 1, '145', 'BLOCK ANOTACIÒN ', 'SIN INFORMACION', NULL, 7, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(146, 1, '146', 'CAJA ARCHIVO INACTIVO # 20', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(147, 1, '147', 'CALCULADORA CASIO 12 DIGITOS', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(148, 2, '148', 'TONER TK-1175 (M2040dn)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(149, 2, '149', 'TONER TK-3160/3162', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(150, 1, '150', 'CHINCHE TRITON NIQUELADO', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(151, 1, '151', 'EXACTO PLÀSTICO GRANDE', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(152, 2, '152', 'TONER NEGRO HP 85A(P1102W)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(153, 4, '153', 'SERVILLETA DE LUJO 33*32CM ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(154, 2, '154', 'FUNDA PARA CD', 'SIN INFORMACION', NULL, 50, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(155, 1, '155', 'FORMAS CONTINUAS 9 1/2 x 5 1/2  2 PARTES', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(156, 1, '156', 'FORMAS CONTINUAS 9 1/2 x 11 2 PARTES', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(157, 2, '157', 'LEXMARK MAGENTA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(158, 1, '158', 'BANDERITA', 'SIN INFORMACION', NULL, 14, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(159, 3, '159', 'BOLSA BLANCA', 'SIN INFORMACION', NULL, 11, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(160, 3, '160', 'BOLSA CANECA PEQUEÑA', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(161, 2, '161', 'TINTA EPSON MAGENTA 544', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(162, 2, '162', 'TINTA EPSON CYAN 544', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(163, 1, '163', 'LIBRO CARTA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0);
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumosnombre
CREATE TABLE IF NOT EXISTS `insumosnombre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  PRIMARY KEY (`id`)
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
  `num` int(2) NOT NULL DEFAULT 0 COMMENT 'id para traer datos por ajax',
  `pUno` int(1) NOT NULL DEFAULT 1 COMMENT 'permiso para user root',
  `pDos` int(1) NOT NULL DEFAULT 2 COMMENT 'permiso para user administrador',
  `pTres` int(1) NOT NULL DEFAULT 3 COMMENT 'permiso para user auxiliar',
  `pCuatro` int(1) NOT NULL DEFAULT 4 COMMENT 'permiso para user encargado',
  `pCinco` int(1) NOT NULL DEFAULT 5 COMMENT 'permiso para user vendedor',
  `pSeis` int(1) NOT NULL DEFAULT 0,
  `pSiete` int(1) NOT NULL DEFAULT 0,
  `pOcho` int(1) NOT NULL DEFAULT 0,
  `sw` int(1) NOT NULL DEFAULT 1 COMMENT 'Gatillo para mostrar o no una pagina',
  `ver` int(1) NOT NULL DEFAULT 1 COMMENT 'gatillo para consultar este registro',
  `file` int(1) NOT NULL DEFAULT 1 COMMENT '1: tiene js, 0: no tiene js',
  `habilitado` int(1) NOT NULL DEFAULT 0 COMMENT '0: solo muestra el js cuando esta en la pagina, 1: el js se muestra en todo el sistema',
  `descripcion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.js_data: ~58 rows (aproximadamente)
/*!40000 ALTER TABLE `js_data` DISABLE KEYS */;
INSERT INTO `js_data` (`id`, `page`, `title`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pSeis`, `pSiete`, `pOcho`, `sw`, `ver`, `file`, `habilitado`, `descripcion`) VALUES
	(1, 'categorias', 'Categorias', 1, 1, 2, 3, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Muestra las categorias de las que seran asociados '),
	(2, 'verCategoria', 'Ver Categoria', 2, 1, 2, 3, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Permite Ver los insumos pertenecientes a una categ'),
	(3, 'insumos', 'Insumos', 3, 1, 2, 3, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Mustras todos los insumos ingresados en el sistema'),
	(4, 'ordendecompras', 'Orden de Compras', 4, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las ordenes de compra, contiene graficas.'),
	(5, 'facturas', 'Facturas', 5, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las facturas ingresadas en el sistema.'),
	(6, 'requisiciones', 'Requisiciones', 8, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las requisiciones aprobadas, pendientes, l'),
	(7, 'nuevaFactura', 'Nueva Factura', 10, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite crear nueva factura, lista los insumos en '),
	(8, 'editarFactura', 'Editar Factura', 10, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar una factura realizada en sistema.'),
	(9, 'requisicion', 'Requisción', 11, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Realiza la requisición de insumos para una área po'),
	(10, 'requisicionImportada', 'Importar Requisición', 11, 1, 2, 3, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'Puede importar una requisicón por medio de una pla'),
	(11, 'editarRq', 'Editar Requisición', 11, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar requisiciones almacenadas en sistem'),
	(12, 'actas', 'Actas', 14, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las actas de salida y entrada.'),
	(13, 'areas', 'Areas', 15, 1, 2, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las areas pertenecientes a la organización'),
	(14, 'personas', 'Personas', 16, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las personas encargadas para cada area, pa'),
	(15, 'inicio', 'Dashboard', 17, 1, 2, 3, 4, 5, 6, 7, 0, 1, 0, 0, 0, 'Presenta los modulos del sistema.'),
	(16, 'reportesRq', 'Reportes de Requisiciones', 17, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(17, 'verArea', 'Ver Área', 18, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las personas asignadas a esa área y presen'),
	(18, 'proveedor', 'Proveedor', 19, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores, para realizar tramites de o'),
	(19, 'inversionInsumos', 'Inversión en Insumos', 23, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los los valores invertidos en cada insumo'),
	(20, 'cotizaciones', 'Cotizaciones', 25, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(21, 'verInsumo', 'Ver Insumo', 26, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra un resumen perteneciente a dicho insumo, l'),
	(22, 'proyectos', 'Proyectos', 27, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proyectos de la organización, para así c'),
	(23, 'usuarios', 'Usuarios', 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los usuarios del sistema y permite realizar '),
	(24, 'plantilla', 'Plantilla', 0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 1, 1, 1, NULL),
	(25, 'nuevaActa', 'Nueva Acta', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite crear una nueva acta de entrada, salida o prestamo.'),
	(28, 'parametros', 'Parametros', 0, 1, 2, 0, 0, 0, 0, 7, 0, 1, 1, 1, 1, NULL),
	(29, 'nuevaOrdendeCompras', 'Nuevar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite generar ordenes de compra basado en los requerimientos del sistema.'),
	(30, 'proveedores', 'Proveedores', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores ingresados en el sistema, tambien permite administrarlos.'),
	(31, 'editarOrden', 'Editar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las ordenes de compras alamacenadas en sistemas.'),
	(32, 'editarActa', 'Editar Acta', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las actas alamancenadas en sistema.'),
	(33, 'verOrden', 'Ver Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Visualiza una orden de compra, discriminando los insumos registrados.'),
	(34, 'inventario', 'Inventario', 0, 1, 2, 3, 0, 5, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos pertenecientes a ella.'),
	(35, 'generaciones', 'Generaciones', 0, 1, 2, 3, 4, 0, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos Factura, Ordenes y cotizaciones.'),
	(36, 'salir', 'LogOut', 0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 0, 0, 0, NULL),
	(37, 'perfil', 'Mi Perfil', 0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 1, 1, 0, 'Pagina del perfil del usuario logeado.'),
	(38, 'genRequisicion', 'Generar Requisición', 29, 1, 2, 0, 4, 5, 6, 7, 8, 1, 1, 1, 0, NULL),
	(39, 'hisRequisicion', 'Historial de Requisición', 30, 1, 2, 0, 4, 5, 6, 7, 8, 1, 1, 1, 0, NULL),
	(40, 'verProyecto', 'Proyecto', 28, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(41, 'verRequisicion', 'Ver Requisición', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(42, 'borrador', 'Borrador', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 0, 1, 0, NULL),
	(43, 'verFactura', 'Ver Factura', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite visualizar una factura seleccionada, discriminando valores e insumos agregados al stock.'),
	(44, 'verRequisicionS', 'ver Requisición', 11, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(45, 'miRequisicion', 'Requisición', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, NULL),
	(47, 'historialUsuarios', 'Historial de Usuarios', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de usuarios'),
	(48, 'historialInsumos', 'Historial Insumos', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de insumos'),
	(49, 'historialCategorias', 'Historial Categorias', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de categorias'),
	(50, 'historialAreas', 'Historial Areas', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de áreas'),
	(51, 'historialPersonas', 'Historial Personas', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de personas'),
	(52, 'historialOrdenes', 'Historial Ordenes', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de Ordenes de compra'),
	(53, 'historialRq', 'Historial Requisiciones', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de Requisiciones'),
	(54, 'Creditos', 'Creditos', 0, 1, 2, 3, 4, 5, 0, 0, 0, 1, 0, 0, 0, NULL),
	(55, 'ventas', 'Ventas', 31, 1, 2, 0, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Lista las ventas generadas.'),
	(56, 'clientes', 'Clientes', 32, 1, 2, 0, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Lista los clientes ingresados en el sistema, con esto pueden generarse nuevas ventas.'),
	(57, 'nuevaVenta', 'Nueva Venta', 33, 1, 2, 0, 0, 5, 0, 0, 0, 1, 1, 1, 0, 'Permite generar una nueva venta a un cliente.'),
	(58, 'cortes', 'Lista de Cortes', 36, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 1, 0, 'Lista los Cortes generados'),
	(59, 'radicado', 'Radicados', 35, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 1, 0, 'Presenta los radicados almacenados en sistema'),
	(60, 'verCorte', 'Visualizar Corte', 35, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 1, 0, NULL),
	(61, 'verRadicado', 'Radicado', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 1, 0, NULL),
	(62, 'correspondencia', 'Correspondencia', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, NULL),
	(63, 'resumenRadicado', 'Radicados', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 0, 0, NULL),
	(64, 'asignaciones', 'Asignaciones', 38, 1, 2, 3, 0, 0, 0, 7, 0, 1, 1, 1, 0, 'Muestra los encargados que tienen permitido realizar respuesta a las correspondencias'),
	(65, 'registros', 'Registros y Base de Datos', 39, 1, 2, 3, 4, 5, 6, 7, 0, 1, 1, 1, 0, 'Pagina donde relaciona todas las correspondencias tramitadas y que estan en ello'),
	(66, 'noAutorizado', 'No Autorizado', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, 'Pagina con la información de No autorización por ingresar a un modulo no permitido'),
	(67, 'equipos', 'Base de Datos PC', 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, NULL);
/*!40000 ALTER TABLE `js_data` ENABLE KEYS */;

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

-- Volcando estructura para tabla kardex.objeto
CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.objeto: ~29 rows (aproximadamente)
/*!40000 ALTER TABLE `objeto` DISABLE KEYS */;
INSERT INTO `objeto` (`id`, `nombre`, `termino`) VALUES
	(1, 'CITACIÓN JUDICIAL', 5),
	(2, 'DECRETO EJECUTIVO', 5),
	(3, 'DECRETO JUDICIAL', 5),
	(4, 'RECEPCIÓN DE FACTURA(S)', 7),
	(5, 'RECEPCIÓN INFORME', 5),
	(6, 'RECEPCIÓN OFICIO', 5),
	(7, 'RECEPCIÓN PETICIÓN', 12),
	(8, 'RECEPCIÓN QUEJA', 12),
	(9, 'RECLAMACIÓN ADMINISTRATIVA', 5),
	(10, 'RECURSOS DE REPOSICIÓN', 5),
	(11, 'REMISIÓN DOCUMENTO', 5),
	(12, 'REQUERIMIENTO ENTE CONTROL', 5),
	(13, 'REQUERIMIENTO PAGO', 5),
	(14, 'RESPUESTA SOLICITUD', 5),
	(15, 'SOLICITUD AUTORIZACIÓN', 5),
	(16, 'SOLICITUD CONSTRUCCIÓN', 5),
	(17, 'SOLICITUD CUMPLIMIENTO', 5),
	(18, 'SOLICITUD DOCUMENTO', 5),
	(19, 'SOLICITUD ENTE DE CONTROL', 5),
	(20, 'SOLICITUD ENTE JUDICIAL', 5),
	(21, 'SOLICITUD INFORMACIÓN', 5),
	(22, 'SOLICITUD RECONOCIMIENTO', 5),
	(23, 'SOLICITUD RESPUESTA', 5),
	(24, 'TRASLADO DOCUMENTAL', 5),
	(25, 'TRASLADO PETICIÓN', 5),
	(26, 'TRASLADO QUEJA', 5),
	(27, 'TRASLADO RECLAMO', 5),
	(28, 'CONVOCATORIA A CONCILIACION', 5),
	(29, 'DEVOLUCION CORRESPONDENCIA', 5);
/*!40000 ALTER TABLE `objeto` ENABLE KEYS */;

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

-- Volcando estructura para tabla kardex.paginicio
CREATE TABLE IF NOT EXISTS `paginicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(11) NOT NULL,
  `contenido` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__perfiles` (`id_perfil`),
  CONSTRAINT `FK__perfiles` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.paginicio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `paginicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `paginicio` ENABLE KEYS */;

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
  `codVen` int(11) NOT NULL DEFAULT 0,
  `codCorte` int(11) NOT NULL DEFAULT 0,
  `codRad` int(11) NOT NULL DEFAULT 0,
  `nameRad` int(11) NOT NULL DEFAULT 0,
  `festivos` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.parametros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `parametros` DISABLE KEYS */;
INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`, `codVen`, `codCorte`, `codRad`, `nameRad`, `festivos`) VALUES
	(1, 10, 20, 30, 6, 3, 1, 1, 2022, 2, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 1, 0, 1, NULL, NULL, NULL, 0, 0, 0, 1, 4119, 717, '[{0:"1/enero/2022"},\r\n{1:"10/enero/2022"},\r\n{2:"21/marzo/2022"},\r\n{3:"10/abril/2022"},\r\n{4:"14/abril/2022"},\r\n{5:"15/abril/2022"},\r\n{6:"17/abril/2022"},\r\n{7:"1/mayo/2022"},\r\n{8:"30/mayo/2022"},\r\n{9:"20/junio/2022"},\r\n{10:"27/junio/2022"},\r\n{11:"4/julio/2022"},\r\n{12:"20/julio/2022"},\r\n{13:"7/agosto/2022"},\r\n{14:"15/agosto/2022"},\r\n{15:"17/octubre/2022"},\r\n{16:"7/noviembre/2022"},\r\n{17:"14/noviembre/2022"},\r\n{18:"8/diciembre/2022"},\r\n{19:"25/diciembre/2022"}]');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(1) NOT NULL,
  `perfil` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.perfiles: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`id`, `perfil`) VALUES
	(1, 'root'),
	(2, 'Administrador'),
	(3, 'Compras'),
	(4, 'Encargado'),
	(5, 'Vendedor'),
	(6, 'Recepción'),
	(7, 'Jurídica'),
	(8, 'Tesorería'),
	(9, 'Auditor'),
	(10, 'Sistemas');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `permisos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__usuarios` (`id_usuario`),
  CONSTRAINT `FK__usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.permisos: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `permisos` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisos` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.personas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`, `id_usuario`, `id_area`) VALUES
	(5, 9, 7),
	(6, 1, 1),
	(7, 12, 4);
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.pqr
CREATE TABLE IF NOT EXISTS `pqr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.pqr: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `pqr` DISABLE KEYS */;
INSERT INTO `pqr` (`id`, `nombre`) VALUES
	(1, 'PETICIÓN'),
	(2, 'QUEJA'),
	(3, 'RECLAMO'),
	(4, 'TUTELA'),
	(5, 'CTA COBRO'),
	(6, 'FACTURA'),
	(7, 'CORRESPONDENCIA'),
	(8, 'RECURSO');
/*!40000 ALTER TABLE `pqr` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.proveedores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`id`, `razonSocial`, `nombreComercial`, `nit`, `digitoNit`, `descripcion`, `direccion`, `telefono`, `contacto`, `fecha`, `correo`) VALUES
	(2, 'SOLUCIONES MAF', 'TAURO', '900236525', '5', '', '', '', '', '0000-00-00', '');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.proyectoarea
CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_areas` text DEFAULT NULL,
  `id_proyecto` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectoarea: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectoarea` DISABLE KEYS */;
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
	(1, '[{"id":"5"},{"id":"1"}]', 5),
	(3, '[{"id":"5"},{"id":"2"},{"id":"3"}]', 6),
	(4, NULL, 7);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `elim`) VALUES
	(5, 'Administrativo', '2022-06-23', '2022-06-30', 'parte administrativa', 0),
	(6, 'HOSPITALES', '2022-06-24', '2022-12-31', 'Nuevos Hospitales para el distrito de barranquilla', 0),
	(7, 'Arroyo Hospital', '2022-06-24', '2022-09-20', 'Canalización de arroyos en el hospital barranquilla', 0);
/*!40000 ALTER TABLE `proyectos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.radicados
CREATE TABLE IF NOT EXISTS `radicados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_corte` int(11) NOT NULL DEFAULT 0 COMMENT 'numero del corte',
  `fecha` datetime NOT NULL,
  `radicado` varchar(100) NOT NULL DEFAULT '0' COMMENT 'numero del radicado para citar',
  `id_accion` int(11) NOT NULL,
  `id_pqr` int(11) NOT NULL,
  `id_objeto` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `asunto` varchar(150) NOT NULL DEFAULT '',
  `id_remitente` varchar(150) NOT NULL DEFAULT '',
  `id_area` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `id_articulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `recibido` varchar(3) NOT NULL DEFAULT '',
  `dias` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `sw` int(1) NOT NULL DEFAULT 0 COMMENT 'Muestra un boton imrpimir luego de haberse radicado radicado',
  `soporte` varchar(250) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `radicado` (`radicado`),
  KEY `FK_radicados_usuarios` (`id_usr`),
  KEY `FK_radicados_accion` (`id_accion`),
  KEY `FK_radicados_pqr` (`id_pqr`),
  KEY `FK_radicados_objeto` (`id_objeto`),
  KEY `FK_radicados_articulo` (`id_articulo`),
  KEY `FK_radicados_areas` (`id_area`),
  CONSTRAINT `FK_radicados_accion` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_radicados_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_radicados_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_radicados_objeto` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_radicados_pqr` FOREIGN KEY (`id_pqr`) REFERENCES `pqr` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_radicados_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.radicados: ~44 rows (aproximadamente)
/*!40000 ALTER TABLE `radicados` DISABLE KEYS */;
INSERT INTO `radicados` (`id`, `id_corte`, `fecha`, `radicado`, `id_accion`, `id_pqr`, `id_objeto`, `id_usr`, `asunto`, `id_remitente`, `id_area`, `observaciones`, `id_articulo`, `cantidad`, `recibido`, `dias`, `fecha_vencimiento`, `sw`, `soporte`, `correo`, `direccion`) VALUES
	(1, 1, '2022-06-06 11:48:47', '2147483647', 1, 7, 6, 1, 'AMPARADO', 'SUSANA', 4, '0', 2, 1, '0', 5, '2022-06-14', 0, '', NULL, NULL),
	(2, 1, '2022-06-06 14:26:59', '2022060603247', 2, 6, 15, 1, 'PELEA POR LA LEA', 'KEVIN BOLAÑO', 4, '', 2, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(5, 1, '2022-06-06 14:44:12', '2022060603248', 2, 2, 1, 1, 'LIQUIDACION PERSONAL', 'JOHANA DE LA ROSA', 3, '', 2, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(6, 1, '2022-06-06 14:46:55', '2022060603249', 1, 7, 6, 1, 'INFORME DE GESTION', 'FERNANDO BARCELO', 4, '', 2, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(7, 1, '2022-06-06 14:48:39', '2022060603250', 6, 3, 26, 1, 'FACTURA MUNDO AVENTURA', 'ITJAK', 1, '', 2, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(8, 1, '2022-06-06 14:56:20', '2022060603251', 10, 8, 29, 1, 'que sera', 'BELKYS', 6, '', 8, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(9, 2, '2022-06-06 16:40:07', '2022060603252', 1, 1, 1, 1, 'PETICION DE MATRIMONIO', 'KEILA JIMENEZ', 4, '', 1, 1, 'KBA', 5, '2022-06-14', 0, '', NULL, NULL),
	(10, 3, '2022-06-08 09:33:00', '2022060803253', 9, 7, 28, 1, 'PUBLICACION DE SITIO', 'KENYA ALJHEICK', 5, '', 7, 1, 'KBA', 5, '2022-06-16', 0, '', NULL, NULL),
	(11, 3, '2022-06-08 15:54:51', '2022060803254', 1, 7, 6, 1, 'DEMANDA PARA EL PUEBLO', 'FERNANDO BARCELO', 4, '', 2, 1, 'KBA', 5, '2022-06-16', 0, '', NULL, NULL),
	(12, 3, '2022-06-09 12:05:49', '2022060903255', 1, 8, 28, 1, 'BACTERIA TERAPIA', 'JOJO', 3, '', 7, 1, 'KBA', 5, '2022-06-17', 0, '', NULL, NULL),
	(13, 7, '2022-06-10 08:59:36', '2022061003256', 1, 6, 27, 1, 'FACTURA CLARO', 'COMCEL', 2, '', 1, 1, 'KBA', 5, '2022-06-18', 0, '', NULL, NULL),
	(14, 8, '2022-06-10 15:45:03', '2022061003257', 4, 2, 3, 1, 'QUEJA SOBRE LA AUSENCIA DE DIVERSIDAD', 'WALIER', 3, '', 1, 1, 'KBA', 5, '2022-06-18', 0, '', NULL, NULL),
	(15, 8, '2022-06-14 14:20:59', '20220603258', 2, 1, 6, 1, 'demanda por no contratar rapido a belkys', 'kevin bolaño', 2, '', 1, 1, 'KBA', 5, '2022-06-22', 0, '', NULL, NULL),
	(16, 8, '2022-06-16 16:46:30', '20220603259', 1, 7, 6, 1, 'ya no demandaremos por no contratar a', 'kevin bolaño', 1, '', 2, 1, 'KBA', 5, '2022-06-24', 0, '', NULL, NULL),
	(17, 9, '2022-06-22 08:44:32', '20220603260', 3, 1, 4, 1, 'PATRIARCADO OPRESOR', 'Susana Martinez', 2, '', 1, 1, 'KBA', 7, '2022-07-02', 0, '', NULL, NULL),
	(18, 9, '2022-06-22 09:35:26', '20220603261', 1, 7, 6, 1, 'POLVO EN LAS MESAS', 'Kevin Londoño', 1, '', 2, 4, 'KBA', 5, '2022-06-30', 0, '', NULL, NULL),
	(19, 9, '2022-06-22 09:37:27', '20220603262', 8, 1, 6, 1, 'LAS QUE TIRAN MOUSE', 'KEVIN SALAZAR', 4, '', 2, 6, 'KBA', 5, '2022-06-30', 0, 'vistas/radicados/2022/06/22/1762.pdf', NULL, NULL),
	(20, 9, '2022-06-22 11:59:14', '20220603263', 5, 6, 2, 1, 'seguridad salud', 'AURA LOPEZ', 5, '', 2, 1, 'KBA', 5, '2022-06-30', 0, '', NULL, NULL),
	(21, 9, '2022-06-22 11:59:44', '20220603264', 6, 4, 15, 1, 'añoñi', '5', 6, '', 4, 1, 'KBA', 5, '2022-06-30', 0, '', NULL, NULL),
	(23, 9, '2022-06-22 12:08:31', '20220603265', 7, 1, 7, 1, 'CASI CASI', '9', 5, 'TODO BIEN', 6, 1, 'KBA', 12, '2022-07-09', 0, '', NULL, NULL),
	(24, 10, '2022-06-23 07:54:28', '20220603266', 3, 1, 7, 1, 'PRESTAMO DE TIJERAS PARA EL MATRIMONIO', '8', 4, '', 3, 1, 'KBA', 12, '2022-07-12', 0, '', NULL, NULL),
	(25, 11, '2022-06-23 16:57:46', '20220603267', 4, 4, 8, 9, 'ALGUNA COSA', '37', 2, '', 4, 1, 'ES', 12, '2022-07-13', 0, '', NULL, NULL),
	(26, 17, '2022-06-25 20:07:40', '20220603268', 1, 3, 5, 1, 'PICADA PARA LA BOGDI', '6', 3, '', 4, 1, 'KBA', 5, '2022-07-05', 0, '', 'prueba@hotmail.com', 'Calle 10'),
	(27, 17, '2022-07-13 16:20:48', '20220703269', 1, 7, 6, 9, 'PRUEBA DE CORREO', '26', 1, '', 2, 1, 'ESC', 5, '2022-07-21', 0, '', '', ''),
	(28, 20, '2022-07-28 16:04:50', '20220703270', 1, 1, 6, 9, 'LA DECEPCION LA TRAICION HERMANO', '8', 4, '', 2, 1, 'ES', 5, '2022-08-04', 0, '', '', ''),
	(29, 20, '2022-07-28 16:05:53', '20220703271', 1, 3, 8, 9, 'NO ME DIGAS NADA NO QUIERO ESCUCHARTE', '24', 4, '', 4, 1, 'ESR', 12, '2022-08-16', 0, '', '', ''),
	(30, 22, '2022-08-09 16:39:01', '20220803272', 1, 3, 3, 9, 'FACTURA', '6', 4, '', 2, 1, 'ESR', 5, '2022-08-17', 0, 'vistas/radicados/2022/08/09/1773.pdf', '', ''),
	(31, 23, '2022-08-10 10:34:28', '20220803273', 1, 1, 6, 9, 'PETICION AL PERTENECIENTE', '56', 4, '', 2, 1, 'ESR', 5, '2022-08-18', 0, '', 'prueba@hotmail.com', 'Calle 1 13 Av Benito'),
	(32, 23, '2022-08-16 08:24:45', '20220803274', 1, 1, 6, 9, 'NOTIFICACION PREDIO PUERTO', '7', 4, '', 2, 1, 'ESR', 5, '2022-08-23', 0, '', '', 'Calle 1 13 Av Juarez'),
	(33, 23, '2022-08-16 14:04:57', '20220803275', 4, 3, 11, 9, 'AYUDAME SEÑOR A ENTENDER', 'DOÑA JUANA', 5, '', 4, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(34, 23, '2022-08-16 14:05:36', '20220803276', 6, 5, 13, 9, 'OJALA PUDIERA DEVOLVER EL TIEMPO PARA VERTE DE NUEVO', '6', 6, '', 4, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(35, 23, '2022-08-16 14:06:08', '20220803277', 8, 2, 9, 9, 'AQUI ESTOY', '56', 3, '', 5, 5, 'ES', 5, '2022-08-23', 0, '', '', ''),
	(36, 23, '2022-08-16 14:07:19', '20220803278', 7, 7, 22, 9, 'SI SI COLOMBIA SI SI CARIBE', '51', 3, '', 7, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(37, 23, '2022-08-16 14:08:17', '20220803279', 7, 4, 14, 9, 'HUAWEI MATE S 2016', '40', 3, '', 4, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(38, 23, '2022-08-16 14:11:40', '20220803280', 4, 8, 19, 9, 'EL EXTINTOR ESTA VENCIDO', '24', 6, '', 1, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(39, 23, '2022-08-16 14:12:22', '20220803281', 5, 2, 16, 9, 'DAME DE BEBER DE TU MANANTIAL', '46', 4, '', 3, 7, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(40, 23, '2022-08-16 14:13:12', '20220803282', 3, 7, 15, 9, 'PASE UNOS AÑOS BUSCANDO EL AGUA DE LA VIDA, ESA QUE FLUYE Y QUE DA &quotPAZ&quot', '34', 2, '', 4, 6, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(41, 23, '2022-08-16 14:16:47', '20220803283', 8, 5, 9, 9, 'PAGENME MIS PRESTACIONES, NO SEAN VIVOS', '39', 3, '', 6, 2, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(42, 23, '2022-08-23 10:44:53', '20220803284', 2, 5, 3, 1, 'PRUEBA 2000', '5', 4, '', 7, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(43, 23, '2022-08-23 10:45:46', '20220803285', 1, 3, 8, 1, 'PROMOCION DE INSUMOS', '15', 5, '', 6, 5, 'KBA', 12, '2022-09-08', 0, '', '', ''),
	(44, 23, '2022-08-23 10:46:20', '20220803286', 6, 6, 5, 1, 'VENTA DE PAQUETES AEREOS', '12', 5, '', 6, 5, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(45, 23, '2022-08-23 10:47:18', '20220803287', 6, 4, 8, 1, 'PRACTICAS EMPRESARIALES', '25', 5, '', 5, 1, 'KBA', 12, '2022-09-08', 0, '', '', ''),
	(46, 23, '2022-08-23 10:48:04', '20220803288', 5, 6, 2, 1, 'CONTRATOS PARA GENERAR', '34', 3, '', 1, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(47, 23, '2022-08-23 10:49:23', '20220803289', 9, 4, 18, 1, 'COMPRAVENTA DE LOTES', '41', 4, '', 3, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(48, 23, '2022-08-23 10:50:00', '20220803290', 8, 6, 3, 1, 'LLORARAS Y LLORARAS SIN NADIE QUE TE CONSUELE, Y ASI TE DARAS CUENTA QUE ESO NOSE QUE DICE', '51', 6, '', 7, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(49, 23, '2022-08-23 10:50:47', '20220803291', 5, 5, 11, 1, 'FACTURA DE VEHICULOS', '15', 1, '', 6, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(50, 23, '2022-08-23 10:51:33', '20220803292', 6, 6, 6, 1, 'JARABE PARA LA GRIPA EL CONID PARA VER QUE PASA 3292', '33', 5, '', 4, 1, 'KBA', 5, '2022-08-30', 0, '', '', ''),
	(51, 0, '2022-08-24 08:01:46', '20220804118', 3, 4, 7, 1, 'PRACTICAS EMPRESARIALES', '54', 3, '', 6, 1, 'KBA', 12, '2022-09-09', 0, '', '', '');
/*!40000 ALTER TABLE `radicados` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.registropqr
CREATE TABLE IF NOT EXISTS `registropqr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vigencia` int(1) NOT NULL DEFAULT 1 COMMENT '1: activo, 0: vencido, 2: Gestionado',
  `dias` int(3) NOT NULL COMMENT 'calcula dias que tardo en generar una accion',
  `id_corte` int(11) NOT NULL,
  `id_radicado` int(11) NOT NULL,
  `id_area_o` int(11) NOT NULL,
  `id_area_d` int(11) NOT NULL,
  `id_usuario_o` int(11) NOT NULL,
  `id_usuario_d` int(11) NOT NULL,
  `id_accion` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `observacion` varchar(3500) DEFAULT NULL,
  `soporte` varchar(3500) DEFAULT NULL,
  `sw` int(1) NOT NULL DEFAULT 1,
  `modulo` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_registropqr_cortes` (`id_corte`),
  KEY `FK_registropqr_radicados` (`id_radicado`),
  KEY `FK_registropqr_areas` (`id_area_o`),
  KEY `FK_registropqr_areas_2` (`id_area_d`),
  KEY `FK_registropqr_usuarios` (`id_usuario_o`),
  KEY `FK_registropqr_accion` (`id_accion`),
  CONSTRAINT `FK_registropqr_accion` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registropqr_areas` FOREIGN KEY (`id_area_o`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registropqr_areas_2` FOREIGN KEY (`id_area_d`) REFERENCES `areas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registropqr_cortes` FOREIGN KEY (`id_corte`) REFERENCES `cortes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registropqr_radicados` FOREIGN KEY (`id_radicado`) REFERENCES `radicados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_registropqr_usuarios` FOREIGN KEY (`id_usuario_o`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.registropqr: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `registropqr` DISABLE KEYS */;
INSERT INTO `registropqr` (`id`, `vigencia`, `dias`, `id_corte`, `id_radicado`, `id_area_o`, `id_area_d`, `id_usuario_o`, `id_usuario_d`, `id_accion`, `fecha`, `observacion`, `soporte`, `sw`, `modulo`) VALUES
	(1, 1, 0, 18, 29, 7, 4, 9, 0, 2, '2022-07-28 16:05:53', '', '', 1, 7),
	(2, 1, 0, 20, 28, 7, 4, 9, 0, 2, '2022-07-28 16:04:50', '', '', 1, 7);
/*!40000 ALTER TABLE `registropqr` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.remitente
CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.remitente: ~49 rows (aproximadamente)
/*!40000 ALTER TABLE `remitente` DISABLE KEYS */;
INSERT INTO `remitente` (`id`, `nombre`) VALUES
	(1, 'A CONSTRUIR'),
	(54, 'ALCALDÍA : B/QUILLA ROJA'),
	(3, 'ALCALDÍA : B/QUILLA VERDE'),
	(4, 'ALCALDÍA DE B/QUILLA : CONTROL URBANO Y ESPACIO PÚBLICO '),
	(5, 'ALCALDÍA DE B/QUILLA : SECRETARÍA DE OBRAS PÚBLICAS'),
	(2, 'ALCALDIA DE B/QUILLA :SECRETARÍA DISTRITAL DE HACIENDA '),
	(6, 'ALCALDÍA DE B/QUILLA SECRETARÍA GENERAL'),
	(7, 'ALCALDIA DE BARRANQUILLA / SECRETARIO DE OBRAS PUBLICAS'),
	(56, 'ANGELINA JOLIE'),
	(8, 'AREA ADMINISTRATIVA '),
	(9, 'AVP'),
	(10, 'BANCO GNB SUDAMERIS'),
	(11, 'BANCOLOMBIA '),
	(12, 'BLACO & BLANCO LTDA'),
	(13, 'CAMARA DE COMERCIO DE COMERCIO'),
	(14, 'CONSORCIO A 1 A'),
	(15, 'CONSORCIO AVENIDA AL RIO'),
	(16, 'CONSORCIO ECO BARRANQUILLA'),
	(17, 'CONSORCIO INTERVENTOR PARQUES DEL ATLÁNTICO - CONSORCIO IPDA'),
	(18, 'CONSORCIO MALECON LEON CARIDI'),
	(19, 'CONSORCIO MEC - AV. MALECOM - UF 1'),
	(20, 'CONSORCIO MEC-AV.MALECON - UF 2'),
	(21, 'CONSORCO ACI 01'),
	(22, 'CONSTRUCTORA FG S.A.'),
	(23, 'CORPORACION LONJA DE PROPIEDAD RAIZ'),
	(24, 'DICONSULTORIA S.A.'),
	(25, 'DIRECCION DE LIQUIDACIONES /ALCALDIA DE BARRANQUILLA'),
	(26, 'DISTRITO ESPECIAL E INDUSTRIAL DE BARRANQUILLA'),
	(27, 'EL BOLETIN JURIDICO.COM.CO'),
	(28, 'GOBERNACIÓN DEL DEL ATLÁNTICO '),
	(29, 'ICE - INGENIEROS CIVILES ESPECIALISTAS'),
	(30, 'INEICA LTDA'),
	(31, 'INSAR S.A.S'),
	(32, 'INTERRAPIDISMO - BANCO AGRARIO'),
	(51, 'Kevin Londoño'),
	(33, 'LEALTAD Y CUMPLIMIENTO SAS'),
	(34, 'NOTARIA 9°DE B/QUILLA'),
	(35, 'RENTING COLOMBIA'),
	(36, 'SAFRI S.A.S'),
	(37, 'SECRETARIA DE HACIENDA DISTRITAL'),
	(55, 'SECRETARIA DE MOVILIDAD MAGDALENA'),
	(38, 'SERVIENTREGA CENTRO DE SOLUCIONES'),
	(39, 'SINTH S.A.S'),
	(52, 'Susana Martinez'),
	(40, 'TALENTO HUMANO '),
	(41, 'TALENTOS HUMANOS'),
	(42, 'UNION TEMOPORAL VIA 40'),
	(43, 'UNION TEMPORAL AURORA-SPORAS'),
	(44, 'UNION TEMPORAL CARIBE'),
	(45, 'UNIÓN TEMPORAL ESPACIOS URBANOS 2020'),
	(46, 'UNIÓN TEMPORAL GRAN MALECON'),
	(47, 'UNIÓN TEMPORAL GRAN VÍA R90'),
	(48, 'UNIÓN TEMPORAL PARQUES VI'),
	(49, 'VALORCON S.A.');
/*!40000 ALTER TABLE `remitente` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.requisiciones
CREATE TABLE IF NOT EXISTS `requisiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_area` int(3) NOT NULL,
  `id_persona` int(3) NOT NULL,
  `id_usr` int(3) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_sol` datetime NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.requisiciones: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `requisiciones` DISABLE KEYS */;
INSERT INTO `requisiciones` (`id`, `id_area`, `id_persona`, `id_usr`, `codigoInt`, `insumos`, `fecha`, `fecha_sol`, `observacion`, `id_proyecto`, `aprobado`, `observacionE`, `registro`, `gen`) VALUES
	(1, 1, 1, 3, 'RQ-001-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"1"},{"id":"6","des":"BANDEJA PORTA DOCUMENTOS","ped":"4","ent":"1"}]', '2022-08-09 00:00:00', '2022-08-09 00:00:00', 'Todo bien todo bacano', 5, 1, NULL, 'BANDEJA PORTA DOCUMENTOS con codigo 6, tiene menor stock al solicitado.:', 1),
	(2, 1, 1, 1, 'RQ-002-2022', '[{"id":"11","des":"BOLSA BASURA VERDE 42*47CMS ","ped":"1","ent":"2"},{"id":"10","des":"BOLSA BASURA NEGRA X 90*110 ","ped":"1","ent":"1"}]', '2022-08-25 17:05:13', '2022-08-10 00:00:00', '', 5, 1, '', '', 1),
	(3, 1, 1, 1, 'RQ-003-2022', '[{"id":"81","des":"MOUSE USB","ped":"1","ent":"1"}]', '2022-08-17 16:25:52', '2022-08-17 15:54:04', '', 5, 1, '', '', 1),
	(4, 1, 1, 1, 'RQ-004-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"0"}]', '2022-08-25 17:05:44', '2022-08-17 16:07:52', '', 5, 2, '', '', 1),
	(5, 1, 11, 1, 'RQ-005-2022', '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"2","ent":"2"}]', '0000-00-00 00:00:00', '2022-08-25 15:38:50', NULL, 5, 0, '', NULL, 1);
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
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `estado` int(11) DEFAULT 1,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `sid` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sid_ext` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  `try` int(1) NOT NULL DEFAULT 0,
  `id_area` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_perfiles` (`perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.usuarios: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `correo`, `estado`, `ultimo_login`, `fecha`, `sid`, `sid_ext`, `elim`, `try`, `id_area`) VALUES
	(1, 'Kevin Bolaño Ariza', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 1, NULL, 'kevin.bolano@edubar.com.co', 1, '2022-08-27 09:56:58', '2021-02-11 05:06:49', '4a7q8g8n56aidbi6q7omgkias4', NULL, 0, 0, 1),
	(2, 'Carmen Rebolledo', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, '', 1, '2022-06-23 15:35:33', '2021-08-19 06:12:33', '97pabqieof66locspl0m949r0k', NULL, 0, 0, 0),
	(3, 'Karelly Moreno Llorente', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 3, NULL, 'karelly.moreno@edubar.com.co', 1, '2022-08-18 08:35:53', '2021-08-19 06:12:39', '4a7q8g8n56aidbi6q7omgkias4', NULL, 0, 0, 0),
	(9, 'Edna Suarez Restrepo', 'ednasuarez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 6, NULL, 'edna.suarez@edubar.com.co', 1, '2022-08-23 10:37:42', '2022-06-23 16:03:37', 'me1ke295ilip8imleg14g668c3', NULL, 0, 0, 1),
	(10, 'Peter Zahn Colmenares', 'peterz', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, 'peter.zahn@edubar.com.co', 1, '2022-06-24 08:01:42', '2022-06-23 17:06:28', 'fd94agrc2l1isi90r49kcjo6k6', NULL, 0, 0, 1),
	(11, 'Fernando Barcelo Bercelo', 'fbarcelo', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, 'fernando.barcelo@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-06-24 08:07:00', NULL, NULL, 0, 0, 0),
	(12, 'Yesid Cantillo Consuegra', 'ycantillo', '$2a$07$asxx54ahjppf45sd87a5auUBKAq2MpBHzSIfBZOK52ERDFh3zAhQe', 7, NULL, 'yesid.cantillo@edubar.com.co', 1, '2022-08-03 09:27:01', '2022-07-12 14:14:55', 'crgsub941msod5pvhgjpmi8qum', NULL, 0, 0, 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.valores
CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `registro` text DEFAULT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='Muestra los cambios de valores que lleva un insumo a lo largo del tiempo.';

-- Volcando datos para la tabla kardex.valores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `valores` DISABLE KEYS */;
INSERT INTO `valores` (`id`, `id_insumo`, `registro`, `tipo`) VALUES
	(1, 2, NULL, 1),
	(4, 1, '[{"val":"500","fe":"2022-08-07"},{"val":"800","fe":"2022-08-08"},{"val":"1700","fe":"2022-08-09"},{"val":"1000","fe":"2022-08-12"}]', 1);
/*!40000 ALTER TABLE `valores` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigoInt` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_cli` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL,
  `iva` float NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.ventas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
