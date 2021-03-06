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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.asignaciones: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `asignaciones` DISABLE KEYS */;
INSERT INTO `asignaciones` (`id`, `id_persona`, `modulo`) VALUES
	(4, 11, 7);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.categorias: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
	(1, 'Papelería', 'Sin Informacion.', 0),
	(2, 'Sistemas', 'Sin Informacion.', 0),
	(3, 'Aseo', 'Sin Informacion.', 0),
	(4, 'otros', 'Almacena Insumos que no manejan categoría especifica', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.cortes: ~16 rows (aproximadamente)
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
	(20, '2207281771', '2022-07-28 16:13:43');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.facturas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
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
  `numTabla` int(11) NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas, 11 carpetas, 12 anexos, 13 proyectos, 14 asignaciones\r\n',
  `valorAnt` text COLLATE utf8_spanish_ci NOT NULL,
  `valorNew` text COLLATE utf8_spanish_ci DEFAULT '',
  `fecha` date NOT NULL,
  `id_usr` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.historial: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id`, `accion`, `numTabla`, `valorAnt`, `valorNew`, `fecha`, `id_usr`) VALUES
	(1, 1, 2, 'AROMATICA SURTIDA EN BOLSA', '', '2022-05-05', 1),
	(2, 1, 2, 'TK-1175', '', '0000-00-00', 1),
	(3, 1, 14, '0', '7', '0000-00-00', 11),
	(4, 4, 14, '0', '7', '0000-00-00', 11);
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
  `imp` int(3) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_insumos_insumosunidad` (`unidadSal`),
  KEY `FK_insumos_insumosunidad_2` (`unidad`),
  CONSTRAINT `FK_insumos_insumosunidad` FOREIGN KEY (`unidadSal`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_insumos_insumosunidad_2` FOREIGN KEY (`unidad`) REFERENCES `insumosunidad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.insumos: ~120 rows (aproximadamente)
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `stockIn`, `precio_compra`, `precio_unidad`, `precio_por_mayor`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`, `unidad`, `unidadSal`, `contenido`, `habilitado`, `imp`) VALUES
	(1, 3, 'A1', 'AROMATICA SURTIDA EN BOLSA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(2, 3, 'A2', 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(3, 1, 'P1', 'BANDEJA PORTA DOCUMENTOS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(4, 1, 'P2', 'BANDERITAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(5, 3, 'A3', 'BLANQUEADOR (LIMPIDO)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(6, 1, 'P3', 'BLOCK ANOTACIÒN ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(7, 1, 'P4', 'BOLIGRAFO DE COLORES SURTIDOS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(8, 1, 'P5', 'BOLIGRAFO NEGRO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(9, 1, 'P6', 'BOLIGRAFO ROJO ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(10, 3, 'A4', 'BOLSA BASURA NEGRA X 90*110 t  ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(11, 3, 'A5', 'BOLSA BASURA VERDE 42*47CMS ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(12, 3, 'A6', 'BOLSA DE BASURA BLANCA  90 * 60', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(13, 3, 'A7', 'BOLSA DE BASURA BLANCA 40 * 50 (CANECA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(14, 1, 'P7', 'BORRADOR DE NATA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(15, 1, 'P8', 'BORRADOR DE TABLERO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(16, 3, 'A8', 'CAFÉ TOSTADO Y MOLIDO, FUERTE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(17, 1, 'P9', 'CAJA ARCHIVO INACTIVO # 12', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(18, 1, 'P10', 'CAJA ARCHIVO INACTIVO # 20', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(19, 1, 'P11', 'CALCULADORA CASIO 12 DIGITOS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(20, 1, 'P12', 'CARATULA POLY COVER CARTA ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(21, 1, 'P13', 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(22, 1, 'P14', 'CARTULINA BRISTOL 70*100 BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(23, 1, ' P15', 'CARTULINA LEGAJADORA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(24, 1, 'P16', 'CD-R ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(25, 2, 'S1', 'CINTA EMP TRANSP 48X100 REF.301 3M ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(26, 1, 'P17', 'CINTA EMP TRANSP DELGADA 12 MM X40M ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(27, 1, 'P18', 'CINTA INVISIBLE 33M:19MM PARA CHEQUES', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(28, 1, 'P19', 'CLIP MARIPOSA GIGANTE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(29, 1, 'P20', 'CLIP MARIPOSA X 50 EMP*50 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(30, 1, 'P21', 'CLIP SENCILLO X 100 EMP*100', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(31, 1, 'P22', 'COLBON (PEGANTE UNIVERSAL) 480GR', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(32, 1, 'P23', 'CORRECTOR LIQUIDO LAPIZ *7 ML', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(33, 3, 'A9', 'CREMA LAVALOZA ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(34, 1, 'P24', 'CUENTA FACIL', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(35, 1, 'P25', 'DECAMETRO 10, 30 Y 50 MTS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(36, 3, 'A10', 'DESINFECTANTE MULTIUSOS ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(37, 3, 'A11', 'DETERGENTE EN POLVO ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(38, 1, 'P26', 'DVD +R ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(39, 3, 'A12', 'ESCOBA SUAVE MANGO MADERA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(40, 3, 'A13', 'ESPONJA LAVAPLATOS DOBLE USO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(41, 1, 'P26', 'EXACTO PLÀSTICO GRANDE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(42, 1, 'P27', 'FLEXOMETRO LUFKIN 26/8METROS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(43, 1, 'P28', 'FOLIADOR (NUMERADOR CONSECUTIVO)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(44, 1, 'P29', 'FORMAS CONTINUAS 9 1/2 *11 3P BLANCA 903 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(45, 1, 'P30', 'FUNDA PARA CD', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(46, 1, 'P31', 'GANCHO LEGAJADOR PLASTICO ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(47, 1, 'P32', 'GRAPA COBRIZADA STANDARD *5000 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(48, 1, 'P33', 'GRAPA GALVANIZADA INDUSTRIAL *1000', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(49, 1, 'P34', 'GRAPADORA 340 RANK (SENCILLA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(50, 1, 'P35', 'GRAPADORA INDUSTRIAL HASTA 100 HOJAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(51, 1, 'P36', 'GUANTES DE LATEX DE EXAMEN ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(52, 1, 'P37', 'GUIA CLASIFICADORA CARTULINA REF. 105 AMARILLA ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(53, 1, 'P38', 'GUIAS CELUGUIA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(54, 2, 'S2', 'HP 711 AMARILLO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(55, 2, 'S3', 'HP 711 CYAN', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(56, 2, 'S4', 'HP 711 MAGENTA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(57, 2, 'S5', 'HP 711 NEGRO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(58, 1, 'P39', 'HUELLERO COLOR NEGRO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(59, 3, 'A14', 'JABON LÍQUIDO PARA MANOS, ANTIBACTERIAL, BIODEGRADABLE AROMA MANZANA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(60, 1, 'P40', 'LAPIZ NEGRO Nº2 ORIG. 482 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(61, 1, 'P41', 'LAPIZ ROJO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(62, 1, 'P42', 'LEGAJADOR AZ OFICIO AZUL ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(63, 1, 'P43', 'LEGAJOS (CARPETAS DE EDUBAR)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(64, 1, ' P44', 'LIBRO ACTA 1/2 CARTA 80H  100 FOLIOS (BITACORA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(65, 1, 'P45', 'LIBRO ACTA 1/2 OFICIO 80H  100 FOLIOS (BITACORA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(66, 1, ' P46', 'LIBRO DE ACTA 1/2 CARTA 80H - 100 FOLIOS (BITACORA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(67, 3, 'A15', 'LIMPIAVIDRIOS (AMONIACO-DESENGRASANTE SECADO RAPIDO)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(68, 3, 'A16', 'LIMPION', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(69, 1, 'P47', 'MARCADOR BORRABLE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(70, 1, 'P48', 'MARCADOR PERMANENTE NEGRO PUNTA FINA  (SHARPIE)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(71, 1, 'P49', 'MARCADORES PERMANENTES SURTIDOS (ROJO/AZUL/NEGRO)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(72, 1, 'P50', 'MASCARILLA DESECHABLE (TAPABOCAS)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(73, 3, 'A17', 'MEZCLADORES DESECHABLES PARA CAFÉ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(74, 2, 'S6', 'MOUSE USB', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(75, 1, 'P51', 'NOTAS ADHESIVAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(76, 3, 'A18', 'PAPEL HIGIENIENICO INSTITUCIONAL ROLLOS, DOBLE HOJA, PRECORTADO, BLANCO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(77, 1, 'P52', 'PAPEL RESMA FOTOCOPIA 75GR CARTA ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(78, 1, 'P53', 'PAPEL RESMA FOTOCOPIA 75GR OFICIO ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(79, 1, 'P54', 'PAPELERA (CANECA)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(80, 1, 'P55', 'PASTA CATALOGO 0.5R HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(81, 1, 'P56', 'PASTA CATALOGO 1.0R HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(82, 1, 'P57', 'PASTA CATALOGO 1.5R HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(83, 1, 'P58', 'PASTA CATALOGO 2.0R HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(84, 1, 'P59', 'PASTA CATALOGO 2.5R HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(85, 1, 'P60', 'PASTA CATALOGO 3.0D HERRAJE BLANCA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(86, 1, 'P61', 'PEGANTE EN BARRA 40GRS ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(87, 1, 'P62', 'PERFORADORA 3 HUECOS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(88, 1, 'P63', 'PERFORADORA RANK 1050 DOS HUECOS SEMI INDUSTRIAL (40 HOJAS)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(89, 1, 'P64', 'PERFORADORA SENCILLA 1038 RANK', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(90, 1, 'P65', 'PLANILLERO ACRILICO CON GANCHO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(91, 1, 'P66 ', 'PORTAMINAS 0.7', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(92, 1, 'P67', 'PROTECTOR DE TRANSPARENCIA (BOLSILLOS)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(93, 1, 'P68', 'RECIBO DE CAJA MENOR X 200 HOJAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(94, 3, 'A19', 'RECOGEDOR DE BASURA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(95, 1, 'P69', 'REGLA DE 30 CM', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(96, 1, 'P70', 'REPUESTO DE MINA 0.7', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(97, 1, 'P71', 'RESALTADORES SURTIDOS ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(98, 1, 'P72', 'ROLLO PLOTER BOND 75 GR 28 PULGADAS', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(99, 3, 'A20', 'ROLLO TOALLA COCINA LAVABLE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(100, 1, 'P73', 'SACAGRAPA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(101, 1, 'P74', 'SACAPUNTA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(102, 1, 'P75', 'SELLO NUMERADOR FOLIADOR AUTOMATICO CONSECUTIVO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(103, 3, 'A21', 'SERVILLETA 27-5*17', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(104, 1, 'P76', 'SOBRE MANILA CARTA  22*29 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(105, 1, 'P77', 'SOBRE MANILA GIGANTE 37*27 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(106, 1, 'P78', 'SOBRE MANILA OFICIO 25*35 ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(107, 2, 'S7', 'TECLADO KB-110X USB ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(108, 1, 'P79', 'TIJERA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(109, 2, 'S8', 'TINTA EPSON 664 COLOR AMARILLO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(110, 2, 'S9', 'TINTA EPSON 664 COLOR CYAN', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(111, 2, 'S10', 'TINTA EPSON 664 COLOR MAGENTA', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(112, 2, 'S11', 'TINTA EPSON 664 COLOR NEGRO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(113, 2, 'S12', 'TINTA PARA SELLO DE CAUCHO', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(114, 3, 'A22', 'TOALLA DE MANOS BLANCA 24X21CM HOJA TRIPLE DOBLADA EN Z', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:05', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(115, 2, 'S13', 'TONER TK-1175 (M2040dn)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(116, 2, 'S14', 'TONER TK-3160/3162', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(117, 3, 'A23', 'TRAPERO TIPO INDUSTRIAL', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(118, 3, 'A24', 'VARSOL SIN OLOR ', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(119, 3, 'A25', 'VASO 11 ONZAS TRANSPARENTE', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0),
	(120, 3, 'A26', 'VASO CAFETERO TERMICO ESPUMADO (4 ONZAS)', 'NO APLICA', NULL, 1, 1, 0, 0, 0, '2022-06-07 15:13:06', 0, '0', '0', '0', 2, 1, 1, 1, 1, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
	(28, 'parametros', 'Parametros', 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, NULL),
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
	(45, 'miRequisicion', 'Requisición', 0, 0, 0, 0, 4, 0, 0, 0, 0, 1, 1, 0, 0, NULL),
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
	(61, 'verRadicado', 'Radicado', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 0, 0, NULL),
	(62, 'correspondencia', 'Correspondencia', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 0, 0, NULL),
	(63, 'resumenRadicado', 'Radicados', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 0, 0, NULL),
	(64, 'asignaciones', 'Asignaciones', 38, 1, 2, 3, 0, 0, 0, 7, 0, 1, 1, 1, 0, 'Muestra los encargados que tienen permitido realizar respuesta a las correspondencias'),
	(65, 'registros', 'Registros y Base de Datos', 39, 1, 2, 3, 4, 7, 6, 7, 0, 1, 1, 1, 0, 'Pagina donde relaciona todas las correspondencias tramitadas y que estan en ello'),
	(66, 'noAutorizado', 'No Autorizado', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, 'Pagina con la información de No autorización por ingresar a un modulo no permitido');
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
	(1, 10, 20, 30, 1, 1, 1, 1, 2022, 1, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 1, 0, 1, NULL, NULL, NULL, 0, 0, 0, 1, 3272, 1772, '[{0:"1/enero/2022"},\r\n{1:"10/enero/2022"},\r\n{2:"21/marzo/2022"},\r\n{3:"10/abril/2022"},\r\n{4:"14/abril/2022"},\r\n{5:"15/abril/2022"},\r\n{6:"17/abril/2022"},\r\n{7:"1/mayo/2022"},\r\n{8:"30/mayo/2022"},\r\n{9:"20/junio/2022"},\r\n{10:"27/junio/2022"},\r\n{11:"4/julio/2022"},\r\n{12:"20/julio/2022"},\r\n{13:"7/agosto/2022"},\r\n{14:"15/agosto/2022"},\r\n{15:"17/octubre/2022"},\r\n{16:"7/noviembre/2022"},\r\n{17:"14/noviembre/2022"},\r\n{18:"8/diciembre/2022"},\r\n{19:"25/diciembre/2022"}]');
/*!40000 ALTER TABLE `parametros` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int(1) NOT NULL,
  `perfil` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.perfiles: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` (`id`, `perfil`) VALUES
	(1, 'root'),
	(2, 'Administrador'),
	(3, 'Compras'),
	(4, 'Encargado'),
	(5, 'Vendedor'),
	(6, 'Recepción'),
	(7, 'Jurídica'),
	(8, 'Tesorería');
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
	(4, 11, 1),
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectoarea: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectoarea` DISABLE KEYS */;
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
	(1, '[{"id":"5"}]', 5),
	(2, '[{"id":"5"}]', 5),
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.radicados: ~21 rows (aproximadamente)
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
	(29, 20, '2022-07-28 16:05:53', '20220703271', 1, 3, 8, 9, 'NO ME DIGAS NADA NO QUIERO ESCUCHARTE', '24', 4, '', 4, 1, 'ESR', 12, '2022-08-16', 0, '', '', '');
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
  `observacion` varchar(1000) DEFAULT NULL,
  `soporte` varchar(250) DEFAULT NULL,
  `sw` int(1) NOT NULL DEFAULT 1,
  `indicativo` int(1) NOT NULL DEFAULT 1 COMMENT 'almacena un numero que incrementa en cada registro, por cada nueva modificacion realizada a un radicado',
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.registropqr: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `registropqr` DISABLE KEYS */;
INSERT INTO `registropqr` (`id`, `vigencia`, `dias`, `id_corte`, `id_radicado`, `id_area_o`, `id_area_d`, `id_usuario_o`, `id_usuario_d`, `id_accion`, `fecha`, `observacion`, `soporte`, `sw`, `indicativo`, `modulo`) VALUES
	(1, 1, 0, 18, 29, 7, 4, 9, 0, 2, '2022-07-28 16:05:53', '', '', 1, 1, 7),
	(2, 1, 0, 19, 29, 7, 4, 9, 0, 2, '2022-07-28 16:05:53', '', '', 1, 1, 7),
	(3, 1, 0, 20, 29, 7, 4, 9, 0, 2, '2022-07-28 16:05:53', '', '', 1, 1, 7),
	(4, 1, 0, 20, 28, 7, 4, 9, 0, 2, '2022-07-28 16:04:50', '', '', 1, 1, 7);
/*!40000 ALTER TABLE `registropqr` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.remitente
CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

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
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.usuarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `correo`, `estado`, `ultimo_login`, `fecha`, `sid`, `elim`, `try`, `id_area`) VALUES
	(1, 'Kevin Bolaño Ariza', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 1, NULL, 'kevin.bolano@edubar.com.co', 1, '2022-07-28 16:02:47', '2021-02-11 05:06:49', 'c3nmo0mb46sussecrpfc4ni8vu', 0, 0, 1),
	(2, 'Carmen Rebolledo', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, '', 1, '2022-06-23 15:35:33', '2021-08-19 06:12:33', '97pabqieof66locspl0m949r0k', 0, 0, 0),
	(3, 'Karelly Moreno', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5aub5AdYGnDrNPXtjZGt9K5ZSA6JZ42Pci', 3, NULL, '', 1, '2022-06-07 14:45:25', '2021-08-19 06:12:39', 'k8hnc4v664jqe1fplprlo4as7g', 0, 0, 0),
	(9, 'Edna Suarez R', 'ednasuarez', '$2a$07$asxx54ahjppf45sd87a5auUBKAq2MpBHzSIfBZOK52ERDFh3zAhQe', 6, NULL, 'edna.suarez@edubar.com.co', 1, '2022-07-28 16:04:45', '2022-06-23 16:03:37', 'c3nmo0mb46sussecrpfc4ni8vu', 0, 0, 1),
	(10, 'Peter Zahn C', 'peterz', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, '', 1, '2022-06-24 08:01:42', '2022-06-23 17:06:28', 'fd94agrc2l1isi90r49kcjo6k6', 0, 0, 1),
	(11, 'Fernando Barcelo Bercelo', 'fbarcelo', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, 'fernando.barcelo@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-06-24 08:07:00', NULL, 0, 0, 1),
	(12, 'Yesid Cantillo Consuegra', 'ycantillo', '$2a$07$asxx54ahjppf45sd87a5auUBKAq2MpBHzSIfBZOK52ERDFh3zAhQe', 7, NULL, 'yesid.cantillo@edubar.com.co', 1, '2022-07-28 09:12:04', '2022-07-12 14:14:55', 'c3nmo0mb46sussecrpfc4ni8vu', 0, 0, 1);
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
