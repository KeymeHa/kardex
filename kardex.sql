-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.22-MariaDB - mariadb.org binary distribution
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.actas: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `actas` DISABLE KEYS */;
INSERT INTO `actas` (`id`, `codigoInt`, `tipo`, `id_usr`, `fecha`, `fechaSal`, `fechaEnt`, `autorizado`, `dependencia`, `responsable`, `dependenciaR`, `motivo`, `observacion`, `listainsumos`) VALUES
	(1, 'ACT-001-2021', 1, 1, '2021-09-07', '2021-09-07', '2021-09-10', 'Fernando', 'Sis', 'Kevin', 'Estanco', 3, '', '[{"sn":"xcvfbgtfc","mc":"Hp","des":"Computador","can":"1","obs":"N/A"}]'),
	(2, 'ACT-002-2021', 1, 1, '2021-09-10', '2021-09-10', '2021-09-17', 'Kevin', 'Sistemas', 'Karelly', 'Compras', 4, '', '[{"sn":"CVFBGHT","mc":"Genius","des":"Parlantes","can":"2","obs":"N/A"},{"sn":"AXCDV54","mc":"Dell","des":"Monitor","can":"1","obs":"N/A"}]'),
	(3, 'ACT-003-2021', 2, 1, '2021-09-10', NULL, '2021-09-12', 'Peter Zahn', 'Sistemas', 'Fernando', 'Estilista', 4, '', '[{"sn":"NMJKULI89","mc":"Dell","des":"Portatil 2gb Ram","can":"2","obs":"N/A"}]'),
	(4, 'ACT-004-2021', 3, 1, '2021-09-17', NULL, '2021-09-17', 'Kevin Bolaño', 'Sistemas', 'Juan Samper', 'Área Técnica', 1, '', '[{"sn":"CJDVUFU5","mc":"Hp","des":"Monitor de 15&quot, Todo En uno","can":"1","obs":"N/A"}]'),
	(5, 'ACT-001-2022', 2, 1, '2022-02-15', NULL, '2022-02-07', 'Kevin', 'Sistemas', 'Milanesa', 'Macarato', 1, '', '[{"sn":"ffrfg","mc":"DELL ","des":"ULTIMA GEMN","can":"1","obs":"N/A"}]');
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

-- Volcando datos para la tabla kardex.anios: ~2 rows (aproximadamente)
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.areas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
	(1, 'Sistemas', '&quotEncargados del àrea de Sistemas&quot', 0, ''),
	(2, 'Contratación', 'Personal de Contratación', 0, ''),
	(3, 'Reasentamiento', 'Abogados unidos', 0, ''),
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.carpetasprov: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `carpetasprov` DISABLE KEYS */;
INSERT INTO `carpetasprov` (`id`, `nombre`, `carpeta`, `id_prov`, `fecha`) VALUES
	(1, 'Certificados', 1, 1, '2021-10-06 08:24:55');
/*!40000 ALTER TABLE `carpetasprov` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.categorias: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
	(1, 'Productos Liquidos Limpieza', 'Son los productos o químicos para desengrasar, limpiar brillar pisos y otras áreas', 0),
	(2, 'Insumos para Impresoras', 'Tintas, toner, almohadillas, rodillos alimentadores.', 0),
	(3, 'Resmas de Papel', 'Carta, oficio, doble Carta', 0),
	(4, 'Elementos para la limpieza', 'Escobas, traperos, bayetas, plumilla.', 1),
	(5, 'Herramientas de Medición', 'Metros, cintras métricas.', 0),
	(6, 'Electronicos', 'Calculadoras', 0),
	(7, 'Dispositivos para Computadores', 'teclados, mouse, pad mouse, cables VGA, Memorias USB', 0),
	(8, 'Baños', 'Toallas, papel higiénico, jabones', 0),
	(9, 'Radicación', 'Foliadores, sellos', 0),
	(10, 'Artículos de Escritura', 'Lápices, plumeros, marcadores', 0),
	(11, 'Cocina', 'Vasos, Mezcladores, Servilletas', 0),
	(12, 'Consumibles Cocina', 'Cafe, agua, te', 0),
	(13, 'Oficina', 'Portalápices, bandejas', 0),
	(14, 'Papelería General', 'Sin Informacion.', 0),
	(15, 'Otros', 'Sin Informacion.', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.facturas: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` (`id`, `codigoInt`, `codigo`, `id_proveedor`, `soporte`, `id_usr`, `insumos`, `fecha`, `inversion`, `iva`, `observacion`) VALUES
	(1, 'FAC-001-2021', 'GFD-231', 2, '', 1, '[{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"15","con":"6","pre":"5501","sub":"82515"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","can":"10","con":"6","pre":"7425","sub":"74250"},{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","can":"8","con":"6","pre":"18000","sub":"144000"},{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA ","can":"40","con":"6","pre":"8596","sub":"343840"},{"id":"8","des":"BLANQUEADOR (LIMPIDO)","can":"50","pre":"8800","sub":"440000"}]', '2021-07-19', 1084600, 206074, ''),
	(2, 'FAC-002-2021', 'prueba1', 1, '', 1, '[{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"1","con":"6","pre":"5501","sub":"5501"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","can":"1","con":"6","pre":"7425","sub":"7425"},{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA ","can":"1","con":"6","pre":"8596","sub":"8596"}]', '2021-08-17', 21522, 4089, ''),
	(3, 'FAC-003-2021', '98-FAS', 1, '', 1, '[{"id":"152","des":"EXACTO PLÀSTICO GRANDE","can":"10","con":"6","pre":"2000","sub":"20000"},{"id":"11","des":"BOLSA BASURA NEGRA X 90*110 ","can":"8","con":"6","pre":"15","sub":"120"},{"id":"9","des":"BOLIGRAFO  ROJO ","can":"18","con":"6","pre":"587","sub":"10566"}]', '2021-08-17', 30686, 5830, ''),
	(4, 'FAC-004-2021', 'SAS333', 2, '', 1, '[{"id":"152","des":"EXACTO PLÀSTICO GRANDE","can":"10","con":"6","pre":"2000","sub":"20000"}]', '2021-08-17', 20000, 3800, ''),
	(5, 'FAC-005-2021', 'ccas', 2, '', 1, '[{"id":"10","des":"BOLIGRAFO NEGRO","can":"100","con":"6","pre":"1500","sub":"150000"}]', '2021-08-17', 150000, 28500, ''),
	(6, 'FAC-006-2021', 'ONLY-2012', 1, '', 1, '[{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"1","con":"6","pre":"5501","sub":"5501"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","can":"1","con":"6","pre":"7425","sub":"7425"},{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA ","can":"1","con":"6","pre":"8596","sub":"8596"}]', '2021-08-21', 21522, 4089, ''),
	(7, 'FAC-007-2021', 'GFD-232', 1, '', 1, '[{"id":"15","des":"CAFÉ TOSTADO Y MOLIDO, FUERTE","can":"15","con":"6","pre":"850","sub":"12750"},{"id":"21","des":"CINTA EMP TRANSP 48X100 REF.301 3M ","can":"20","con":"6","pre":"700","sub":"14000"},{"id":"29","des":"COLCAFE COFFE CREAM 100 SOBRES DE 3 GR","can":"5","con":"6","pre":"8000","sub":"40000"},{"id":"34","des":"DECAMETRO STANPROF 10 MTS","can":"5","con":"6","pre":"14000","sub":"70000"},{"id":"31","des":"CREMA INSTANTANEA NO LACTEA PARA CAFÉ ","can":"5","con":"6","pre":"1200","sub":"6000"}]', '2021-08-22', 142750, 27122, ''),
	(8, 'FAC-008-2021', 'frv-98', 2, '', 1, '[{"id":"51","des":"GRAPADORA 340 RANK (SENCILLA)","can":"50","con":"6","pre":"500","sub":"25000"},{"id":"50","des":"GRAPA GALVANIZADA INDUSTRIAL *1000","can":"25","con":"6","pre":"700","sub":"17500"},{"id":"49","des":"GRAPA COBRIZADA STANDARD *5000 ","can":"49","con":"6","pre":"1000","sub":"49000"}]', '2021-12-15', 91500, 17385, ''),
	(9, 'NF-001-2022', 'CAR-213-2022', 1, '', 1, '[{"id":"11","des":"BOLSA BASURA NEGRA X 90*110 ","can":"15","con":"6","pre":"12234","sub":"183510"},{"id":"17","des":"CARTULINA BRISTOL 1/8 X 8 SURTIDAS","can":"1","con":"6","pre":"2456","sub":"2456"}]', '2022-12-19', 185966, 35333, '');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.historial: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` (`id`, `accion`, `numTabla`, `valorAnt`, `valorNew`, `fecha`, `id_usr`) VALUES
	(1, 4, 8, 'OC-001-2021 INSERCOP', '', '2021-08-23', 1),
	(2, 4, 9, 'RQ-001-2021 Sistemas', '', '2021-08-26', 1),
	(3, 4, 9, 'RQ-002-2021 Sistemas', '', '2021-08-30', 1),
	(4, 1, 2, '"ohla', '', '2021-09-16', 1),
	(26, 4, 12, 'ret', '', '2021-10-06', 1),
	(27, 4, 12, 'cas', '', '2021-10-06', 1),
	(28, 1, 2, 'Celular', '', '0000-00-00', 1);
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.impustoagregado
CREATE TABLE IF NOT EXISTS `impustoagregado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sumatoria` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.impustoagregado: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `impustoagregado` DISABLE KEYS */;
INSERT INTO `impustoagregado` (`id`, `sumatoria`, `anio`, `mes`) VALUES
	(1, 192308, 2021, 7),
	(2, 138257, 2021, 8),
	(3, 17385, 2021, 12),
	(4, 35333, 2022, 1);
/*!40000 ALTER TABLE `impustoagregado` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumos
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `stockIn` int(11) NOT NULL DEFAULT 0,
  `precio_compra` float NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `elim` int(11) NOT NULL DEFAULT 0,
  `estante` int(11) DEFAULT 0,
  `nivel` int(11) DEFAULT 0,
  `seccion` int(11) DEFAULT 0,
  `prioridad` int(11) NOT NULL,
  `unidad` int(2) NOT NULL DEFAULT 1,
  `unidadSal` int(2) NOT NULL DEFAULT 1,
  `contenido` int(2) NOT NULL DEFAULT 1,
  `habilitado` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.insumos: ~155 rows (aproximadamente)
/*!40000 ALTER TABLE `insumos` DISABLE KEYS */;
INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `stockIn`, `precio_compra`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`, `unidad`, `unidadSal`, `contenido`, `habilitado`) VALUES
	(2, 1, 1, 'AMBIENTADOR DE BAÑO AIR WICK', '', 'vistas/img/productos/default/anonymous.png', 115, 0, 0, '0000-00-00 00:00:00', 1, 5, 4, 0, 2, 1, 1, 1, 0),
	(3, 12, 2, 'AROMATICA SURTIDA EN BOLSA', '', 'vistas/img/productos/default/anonymous.png', 96, 0, 89999, '0000-00-00 00:00:00', 0, 7, 7, 7, 2, 1, 1, 1, 0),
	(4, 1, 3, 'ATOMIZADOR AMBIENTADOR LAVANDA', '', 'vistas/img/productos/default/anonymous.png', 93, 0, 500, '0000-00-00 00:00:00', 0, 5, 4, 4, 2, 1, 1, 1, 1),
	(5, 12, 4, 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', '', 'vistas/img/productos/default/anonymous.png', 30, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(6, 12, 5, 'AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL', NULL, 'vistas/img/productos/default/anonymous.png', 137, 0, 18000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(7, 13, 6, 'BANDEJA PORTA DOCUMENTOS', NULL, 'vistas/img/productos/default/anonymous.png', 64, 0, 4000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(8, 1, 7, 'BLANQUEADOR (LIMPIDO)', NULL, 'vistas/img/productos/default/anonymous.png', 84, 0, 8800, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(9, 10, 8, 'BOLIGRAFO  ROJO ', NULL, 'vistas/img/productos/default/anonymous.png', 18, 0, 587, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(10, 10, 9, 'BOLIGRAFO NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 95, 0, 1500, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(11, 1, 10, 'BOLSA BASURA NEGRA X 90*110 ', NULL, 'vistas/img/productos/default/anonymous.png', 15, 0, 12234, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(12, 1, 11, 'BOLSA BASURA VERDE 42*47CMS ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(13, 14, 12, 'BORRADOR DE NATA', NULL, 'vistas/img/productos/default/anonymous.png', 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(14, 10, 13, 'BORRADOR DE TABLERO', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(15, 12, 14, 'CAFÉ TOSTADO Y MOLIDO, FUERTE', NULL, 'vistas/img/productos/default/anonymous.png', 15, 0, 850, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(16, 14, 15, 'CARATULA POLY COVER CARTA ', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(17, 14, 16, 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 2456, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(18, 14, 17, 'CARTULINA BRISTOL 70*100 BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 7, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(19, 14, 18, 'CD-R ', NULL, 'vistas/img/productos/default/anonymous.png', 39, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(20, 1, 19, 'CERA NATURAL SÓLIDA PARA MADERA AUTOBRILLO', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(21, 14, 20, 'CINTA EMP TRANSP 48X100 REF.301 3M ', NULL, 'vistas/img/productos/default/anonymous.png', 20, 0, 700, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(22, 14, 21, 'CINTA EMP TRANSP DELGADA 12 MM X40M ', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(23, 2, 22, 'CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(24, 14, 23, 'CINTA INVISIBLE 33M:19MM PARA CHEQUES', '', 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(25, 14, 24, 'CLIP MARIPOSA GIGANTE', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(26, 14, 25, 'CLIP MARIPOSA X 50 EMP*50 ', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(27, 14, 26, 'CLIP SENCILLO X 100 EMP*100', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(28, 14, 27, 'COLBON (PEGANTE UNIVERSAL) 480GR', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(29, 12, 28, 'COLCAFE COFFE CREAM 100 SOBRES DE 3 GR', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 8000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(30, 10, 29, 'CORRECTOR LIQUIDO LAPIZ *7 ML', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(31, 12, 30, 'CREMA INSTANTANEA NO LACTEA PARA CAFÉ ', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 1200, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(32, 11, 31, 'CREMA LAVALOZA ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(33, 9, 32, 'CUENTA FACIL', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(34, 5, 33, 'DECAMETRO STANPROF 10 MTS', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 14000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(35, 5, 34, 'DECAMETRO STANPROF 30 MTS', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(36, 5, 35, 'DECAMETRO STANPROF 50 MTS', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(37, 1, 36, 'DESENGRASANTE', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(38, 1, 37, 'DESINFECTANTE MULTIUSOS ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(39, 1, 38, 'DETERGENTE EN POLVO ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(40, 15, 39, 'DVD +R ', NULL, 'vistas/img/productos/default/anonymous.png', 31, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(41, 1, 40, 'ESCOBA SUAVE MANGO MADERA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 4500, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(42, 11, 41, 'ESPONJA LAVAPLATOS DOBLE USO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(43, 5, 42, 'FLEXOMETRO LUFKIN 26/8METROS', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(44, 9, 43, 'FOLIADOR (NUMERADOR CONSECUTIVO)', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(45, 15, 44, 'FORMAS CONTINUAS 1/2 11 1/2 TROQUELADA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(46, 15, 45, 'FORMAS CONTINUAS 9 1/2 *11 1P BLANCA 901', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(47, 15, 46, 'FORMAS CONTINUAS 9 1/2 *11 3P BLANCA 903 ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(48, 15, 47, 'GANCHO LEGAJADOR PLASTICO ', NULL, 'vistas/img/productos/default/anonymous.png', 38, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(49, 14, 48, 'GRAPA COBRIZADA STANDARD *5000 ', NULL, 'vistas/img/productos/default/anonymous.png', 55, 0, 1000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(50, 14, 49, 'GRAPA GALVANIZADA INDUSTRIAL *1000', NULL, 'vistas/img/productos/default/anonymous.png', 35, 0, 700, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(51, 13, 50, 'GRAPADORA 340 RANK (SENCILLA)', NULL, 'vistas/img/productos/default/anonymous.png', 50, 0, 500, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(52, 13, 51, 'GRAPADORA INDUSTRIAL HASTA 100 HOJAS', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(53, 1, 52, 'GUANTES DE LATEX DE  EXAMEN ', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(54, 1, 53, 'GUANTES SEMI-INDUSTRIALES T9-9 ½*CALIBRE 25*LATEX NATURAL*COLOR NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(55, 15, 54, 'GUIA CLASIFICADORA  CARTULINA REF. 105 AMARILLA ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(56, 15, 55, 'GUIAS CELUGUIA', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(57, 2, 56, 'HP 10 NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(58, 2, 57, 'HP 711 AMARILLO', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(59, 2, 58, 'HP 711 CYAN', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(60, 2, 59, 'HP 711 MAGENTA', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(61, 2, 60, 'HP 711 NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 3, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(62, 2, 61, 'HP 82 AMARILLO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(63, 2, 62, 'HP 82 NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(64, 9, 63, 'HUELLERO COLOR NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(65, 8, 64, 'JABON LÍQUIDO PARA MANOS, ANTIBACTERIAL, BIODEGRADABLE AROMA MANZANA', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(66, 15, 65, 'LAMPARAS FLUORESCENTES SILVANIA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(67, 10, 66, 'LAPIZ NEGRO Nº2 ORIG. 482 ', NULL, 'vistas/img/productos/default/anonymous.png', 13, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(68, 14, 67, 'LEGAJADOR AZ OFICIO AZUL ', NULL, 'vistas/img/productos/default/anonymous.png', 3, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(69, 14, 68, 'LEGAJOS (CARPETAS DE EDUBAR)', NULL, 'vistas/img/productos/default/anonymous.png', 600, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(70, 2, 69, 'LEXMARK AMARILLO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(71, 2, 70, 'LEXMARK CYAN', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(72, 2, 71, 'LEXMARK NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(73, 14, 72, 'LIBRO ACTA 1/2 OFICIO 80H  100 FOLIOS (BITACORA)', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(74, 1, 73, 'LIMPIAVIDRIOS (AMONIACO-DESENGRASANTE SECADO RAPIDO)', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(75, 1, 74, 'LIMPION', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(76, 1, 75, 'LIQUIDO ESPECIAL PARA PISOS (BRILLO)', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(77, 10, 76, 'MARCADOR BORRABLE', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(78, 10, 77, 'MARCADOR PERMANENTE NEGRO PUNTA FINA  (SHARPIE)', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(79, 1, 78, 'MARCADORES PERMANENTES SURTIDOS (ROJO/AZUL/NEGRO)', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(80, 15, 79, 'MASCARILLA DESECHABLE (TAPABOCAS)', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(81, 12, 80, 'MEZCLADORES DESECHABLES PARA CAFÉ', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(82, 7, 81, 'MOUSE USB', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(83, 8, 82, 'PAPEL HIGIENIENICO INSTITUCIONAL ROLLOS, DOBLE HOJA, PRECORTADO, BLANCO', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(84, 3, 83, 'PAPEL RESMA DOBLE CARTA 11*17 75GRS', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(85, 3, 84, 'PAPEL RESMA FOTOCOPIA 75GR CARTA ', NULL, 'vistas/img/productos/default/anonymous.png', 14, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(86, 3, 85, 'PAPEL RESMA FOTOCOPIA 75GR OFICIO ', NULL, 'vistas/img/productos/default/anonymous.png', 23, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(87, 13, 86, 'PAPELERA (CANECA)', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(88, 15, 87, 'PASTA CATALOGO 0.5R HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(89, 15, 88, 'PASTA CATALOGO 1.0R HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(90, 15, 89, 'PASTA CATALOGO 1.5R HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(91, 15, 90, 'PASTA CATALOGO 2.0R HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(92, 15, 91, 'PASTA CATALOGO 2.5R HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(93, 15, 92, 'PASTA CATALOGO 3.0D HERRAJE BLANCA', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(94, 14, 93, 'PEGANTE  EN BARRA 40GRS ', NULL, 'vistas/img/productos/default/anonymous.png', 9, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(95, 13, 94, 'PERFORADORA 3 HUECOS', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(96, 13, 95, 'PERFORADORA RANK 1050 DOS HUECOS SEMI INDUSTRIAL (40 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(97, 13, 96, 'PERFORADORA SENCILLA 1038 RANK', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(98, 12, 97, 'PLATO DESECHABLE MEDIANO *20 ESPUMADO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(99, 15, 98, 'PROTECTOR DE TRANSPARENCIA (BOLSILLOS)', NULL, 'vistas/img/productos/default/anonymous.png', 13, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(100, 14, 99, 'RECIBO DE CAJA MENOR X 200 HOJAS', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(101, 1, 100, 'RECOGEDOR DE BASURA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(102, 13, 101, 'REGLA DE 30 CM', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(103, 10, 102, 'RESALTADORES SURTIDOS ', NULL, 'vistas/img/productos/default/anonymous.png', 7, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(104, 3, 103, 'ROLLO PLOTER BOND 75 GR 28 PULGADAS', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(105, 12, 104, 'ROLLO TOALLA COCINA LAVABLE', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(106, 14, 105, 'SACAGRAPA', NULL, 'vistas/img/productos/default/anonymous.png', 7, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(107, 14, 106, 'SACAPUNTA', NULL, 'vistas/img/productos/default/anonymous.png', 16, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(108, 9, 107, 'SELLO NUMERADOR FOLIADOR AUTOMATICO CONSECUTIVO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(109, 12, 108, 'SERVILLETA 27-5*17', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(110, 14, 109, 'SOBRE MANILA CARTA  22*29 ', NULL, 'vistas/img/productos/default/anonymous.png', 190, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(111, 14, 110, 'SOBRE MANILA GIGANTE 37*27 ', NULL, 'vistas/img/productos/default/anonymous.png', 80, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(112, 14, 111, 'SOBRE MANILA OFICIO 25*35 ', NULL, 'vistas/img/productos/default/anonymous.png', 100, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(113, 12, 112, 'SOBRES NESCAFE TRADICION ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(114, 12, 113, 'TE HELADO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(115, 7, 114, 'TECLADO KB-110X USB ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(116, 14, 115, 'TIJERA', NULL, 'vistas/img/productos/default/anonymous.png', 3, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(117, 2, 116, 'TINTA EPSON 664 COLOR AMARILLO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(118, 2, 117, 'TINTA EPSON 664 COLOR CYAN', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(119, 2, 118, 'TINTA EPSON 664 COLOR MAGENTA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(120, 2, 119, 'TINTA EPSON 664 COLOR NEGRO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(121, 9, 120, 'TINTA PARA SELLO DE CAUCHO', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(122, 14, 121, 'TIRA NEGRA (CAPACIDAD DE 300 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(123, 14, 122, 'TIRA NEGRA 11MM*42 AROS (CAPACIDAD DE 70 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 79, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(124, 14, 123, 'TIRA NEGRA 12 MM (CAPACIDAD DE 80 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 109, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(125, 14, 124, 'TIRA NEGRA 15 MM (CAPACIDAD DE 120 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 31, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(126, 14, 125, 'TIRA NEGRA 18 MM (CAPACIDAD DE 140 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 34, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(127, 14, 126, 'TIRA NEGRA 22 MM (CAPACIDAD DE 170 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 11, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(128, 14, 127, 'TIRA NEGRA 25 MM (CAPACIDAD DE 200 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 36, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(129, 14, 128, 'TIRA NEGRA 9MM  (CAPACIDAD DE 50 HOJAS)', NULL, 'vistas/img/productos/default/anonymous.png', 208, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(130, 2, 129, 'TK 512 AMARILLO', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(131, 2, 130, 'TK 512 MAGENTA', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(132, 2, 131, 'TK512 CYAN', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(133, 8, 132, 'TOALLA DE MANOS BLANCA 24X21CM HOJA TRIPLE DOBLADA EN Z', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(134, 2, 133, 'TONER NEGRO TK-1147 (2035)', NULL, 'vistas/img/productos/default/anonymous.png', 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(135, 2, 134, 'TONER NEGRO TK-137 (2810)', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(136, 2, 135, 'TONER NEGRO TK-3122 (4200)', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(137, 2, 136, 'TONER NEGRO TK-3132 (4300)', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(138, 2, 137, 'TONER NEGRO TK-342 (2020)', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(139, 1, 138, 'TRAPERO TIPO INDUSTRIAL', NULL, 'vistas/img/productos/default/anonymous.png', 2, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(140, 1, 139, 'VARSOL SIN OLOR ', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(141, 12, 140, 'VASO 11 ONZAS TRANSPARENTE', NULL, 'vistas/img/productos/default/anonymous.png', 10, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(142, 12, 141, 'VASO CAFETERO TERMICO ESPUMADO (4 ONZAS)', NULL, 'vistas/img/productos/default/anonymous.png', 3, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(143, 10, 142, 'LAPIZ ROJO', NULL, 'vistas/img/productos/default/anonymous.png', 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(144, 13, 143, 'NOTAS ADHESIVAS', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(145, 15, 144, 'PLANILLERO ACRILICO CON GANCHO', NULL, 'vistas/img/productos/default/anonymous.png', 1, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(146, 14, 145, 'BLOCK ANOTACIÒN ', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(147, 14, 146, 'CAJA ARCHIVO INACTIVO # 20', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(148, 6, 147, 'CALCULADORA CASIO 12 DIGITOS', NULL, 'vistas/img/productos/default/anonymous.png', 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(149, 2, 148, 'TONER TK-1175 (M2040dn)', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(150, 2, 149, 'TONER TK-3160/3162', NULL, 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(151, 14, 150, 'CHINCHE TRITON NIQUELADO', NULL, 'vistas/img/productos/default/anonymous.png', 3, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(152, 14, 151, 'EXACTO PLÀSTICO GRANDE', NULL, 'vistas/img/productos/default/anonymous.png', 20, 0, 2000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(153, 2, 152, 'TONER NEGRO HP 85A(P1102W)', NULL, 'vistas/img/productos/default/anonymous.png', 5, 0, 10, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(154, 12, 153, 'SERVILLETA DE LUJO 33*32CM ', NULL, 'vistas/img/productos/default/anonymous.png', 68, 0, 28, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(155, 15, 154, 'FUNDA PARA CD', NULL, 'vistas/img/productos/default/anonymous.png', 73, 0, 20, '0000-00-00 00:00:00', 0, 0, 0, 0, 2, 1, 1, 1, 1),
	(156, 2, 155, '&quotohla&quot', '', 'vistas/img/productos/default/anonymous.png', 0, 0, 0, '2021-09-16 12:22:04', 0, 2, 1, 1, 3, 1, 1, 1, 1),
	(157, 13, 1, 'Celular', '', 'vistas/img/productos/default/anonymous.png', 0, 0, 455000, '2022-02-21 11:29:17', 0, 2, 1, 5, 3, 1, 1, 1, 1);
/*!40000 ALTER TABLE `insumos` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.insumosunidad
CREATE TABLE IF NOT EXISTS `insumosunidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.insumosunidad: ~9 rows (aproximadamente)
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
	(10, 'Caja');
/*!40000 ALTER TABLE `insumosunidad` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.inversiones
CREATE TABLE IF NOT EXISTS `inversiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prov` int(11) NOT NULL,
  `invertido` float NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.inversiones: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `inversiones` DISABLE KEYS */;
INSERT INTO `inversiones` (`id`, `id_prov`, `invertido`, `anio`, `mes`) VALUES
	(1, 0, 456290, 2021, 7),
	(2, 2, 648001, 2021, 7),
	(3, 1, 271384, 2021, 8),
	(4, 0, 456290, 2021, 8),
	(5, 2, 91500, 2021, 12),
	(6, 1, 185966, 2022, 1);
/*!40000 ALTER TABLE `inversiones` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.js_data
CREATE TABLE IF NOT EXISTS `js_data` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `page` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `num` int(2) NOT NULL DEFAULT 0,
  `pUno` int(1) NOT NULL DEFAULT 1,
  `pDos` int(1) NOT NULL DEFAULT 2,
  `pTres` int(1) NOT NULL DEFAULT 3,
  `pCuatro` int(1) NOT NULL DEFAULT 4,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.js_data: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `js_data` DISABLE KEYS */;
INSERT INTO `js_data` (`id`, `page`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`) VALUES
	(1, 'categorias', 1, 1, 2, 3, 0),
	(2, 'verCategoria', 2, 1, 2, 3, 0),
	(3, 'insumos', 3, 1, 2, 3, 0),
	(4, 'ordendecompras', 4, 1, 2, 3, 0),
	(5, 'facturas', 5, 1, 2, 3, 0),
	(6, 'requisiciones', 8, 1, 2, 3, 0),
	(7, 'nuevaFactura', 10, 1, 2, 3, 0),
	(8, 'editarFactura', 10, 1, 2, 3, 0),
	(9, 'requisicion', 11, 1, 2, 3, 0),
	(10, 'requisicionImportada', 11, 1, 2, 3, 0),
	(11, 'editarRq', 11, 1, 2, 3, 0),
	(12, 'actas', 14, 1, 2, 3, 0),
	(13, 'areas', 15, 1, 2, 3, 0),
	(14, 'personas', 16, 1, 2, 3, 0),
	(15, 'inicio', 17, 1, 2, 3, 4),
	(16, 'reportesRq', 17, 1, 2, 3, 0),
	(17, 'verArea', 18, 1, 2, 3, 0),
	(18, 'proveedor', 19, 1, 2, 3, 0),
	(19, 'inversionInsumos', 23, 1, 2, 3, 0),
	(20, 'cotizaciones', 25, 1, 2, 3, 0),
	(21, 'verInsumo', 26, 1, 2, 3, 0),
	(22, 'proyectos', 27, 1, 2, 3, 0),
	(23, 'usuarios', 0, 1, 2, 0, 0),
	(24, 'plantilla', 0, 1, 2, 3, 0),
	(25, 'nuevaActa', 0, 1, 2, 3, 0),
	(26, 'proveedores', 0, 1, 2, 3, 0),
	(27, 'nuevaActa', 0, 1, 2, 3, 0),
	(28, 'parametros', 0, 1, 2, 3, 0),
	(29, 'nuevaOrdendeCompras', 0, 1, 2, 3, 0),
	(30, 'proveedores', 0, 1, 2, 3, 0),
	(31, 'editarOrden', 0, 1, 2, 3, 0),
	(32, 'editarActa', 0, 1, 2, 3, 0),
	(33, 'verOrden', 0, 1, 2, 3, 0),
	(34, 'inventario', 0, 1, 2, 3, 0),
	(35, 'generaciones', 0, 1, 2, 3, 4),
	(36, 'salir', 0, 1, 2, 3, 4),
	(37, 'perfil', 0, 1, 2, 3, 4),
	(38, 'genRequisicion', 29, 0, 0, 0, 4),
	(39, 'hisRequisicion', 0, 0, 0, 0, 4),
	(40, 'verProyecto', 28, 1, 2, 3, 0),
	(41, 'verRequisicion', 0, 1, 2, 3, 0),
	(42, 'borrador', 0, 1, 2, 3, 0),
	(43, 'verFactura', 0, 1, 2, 3, 0),
	(44, 'verRequisicionS', 11, 1, 2, 3, 0);
/*!40000 ALTER TABLE `js_data` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.js_files
CREATE TABLE IF NOT EXISTS `js_files` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` varchar(30) COLLATE utf8_spanish_ci NOT NULL DEFAULT '''all''',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.js_files: ~28 rows (aproximadamente)
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
	(34, 'hisRequicion', 'hisRequicion'),
	(35, 'verProyecto', 'verProyecto'),
	(36, 'verRequisicionS', 'verRequisicionS');
/*!40000 ALTER TABLE `js_files` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrYsal` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.movimientos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` (`id`, `entrYsal`, `insumos`, `anio`, `mes`) VALUES
	(1, 1, '[{"id":"149", "can":"2"},{"id":"117", "can":"1"},{"id":"118", "can":"1"},{"id":"120", "can":"1"}]', 2021, 7),
	(2, 0, '[{"id":"2", "can":""},{"id":"3", "can":""},{"id":"4", "can":""},{"id":"5", "can":""},{"id":"6", "can":""},{"id":"7", "can":""},{"id":"8", "can":""}]', 2021, 7),
	(3, 0, '[{"id":"15", "can":"15"},{"id":"21", "can":"20"},{"id":"29", "can":"5"},{"id":"34", "can":"5"},{"id":"31", "can":"5"}]', 2021, 8);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.ordencompra: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `ordencompra` DISABLE KEYS */;
INSERT INTO `ordencompra` (`id`, `codigoInt`, `id_proveedor`, `id_usr`, `id_cotizacion`, `insumos`, `fecha`, `inversion`, `iva`, `fac_asociada`, `formaPago`, `responsable`, `fechaEntrega`, `observacion`) VALUES
	(2, '2', 1, 1, 0, '[{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","can":"8","pre":"18000","sub":"144000"},{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"1","pre":"5000","sub":"5000"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","can":"1","pre":"7425","sub":"7425"}]', '2021-08-18', 156425, 29721, 9, 'Chan con chan', 'Kevin', '0000-00-00', ''),
	(3, '1', 2, 1, 0, '[{"id":"9","des":"BOLIGRAFO  ROJO ","can":"20","pre":"587","sub":"11740"}]', '2021-08-18', 11740, 2231, 8, 'para la quincena', 'Kevin', '0000-00-00', 'None'),
	(4, '1', 1, 1, 0, '[{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","can":"6","pre":"89999","sub":"539994"},{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","can":"5","pre":"18000","sub":"90000"},{"id":"8","des":"BLANQUEADOR (LIMPIDO)","can":"2","pre":"8800","sub":"17600"}]', '2021-08-18', 647594, 123043, 0, 'De Contado', 'Carmen Rebolledo', '0000-00-00', ''),
	(5, '3', 2, 1, 0, '[{"id":"9","des":"BOLIGRAFO  ROJO ","can":"1","pre":"587","sub":"587"}]', '2022-01-31', 587, 112, 0, 'De Contado', 'Kevin Bolaño', '0000-00-00', ''),
	(6, '2', 2, 1, 0, '[{"id":"41","des":"ESCOBA SUAVE MANGO MADERA","can":"1","pre":"4500","sub":"4500"}]', '2022-01-31', 4500, 855, 0, 'a Credito', 'Fernando', '0000-00-00', '');
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
	(1, 10, 15, 30, 9, 2, 1, 1, 2022, 1, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 1, 0, 2, NULL, NULL, NULL, 0, 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.personas: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`id`, `id_usuario`, `id_area`) VALUES
	(1, 2, 1),
	(2, 1, 1),
	(3, 4, 3),
	(4, 3, 1),
	(5, 5, 2),
	(9, 6, 6);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.proveedores: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` (`id`, `razonSocial`, `nombreComercial`, `nit`, `digitoNit`, `descripcion`, `direccion`, `telefono`, `contacto`, `fecha`, `correo`) VALUES
	(1, 'INSERCOP DISTRILAN SAS', 'INSERCOP', '802012326', '7', 'Toner e impresoras', 'No Registra', '3453', 'Sin Info', '2021-06-25', 'Correo@delaempresa.es'),
	(2, 'SOLUCIONES MAF S.A.S', 'TAURO', '802008192', '1', 'PAPELERIA', 'CL 30 # 1 -295', '3758600', 'KATHERINE SERGE', '2021-07-13', '');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.proyectoarea
CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_areas` text DEFAULT NULL,
  `id_proyecto` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla kardex.proyectoarea: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectoarea` DISABLE KEYS */;
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
	(6, '[{"id":"6"},{"id":"4"},{"id":"1"},{"id":"2"},{"id":"3"},{"id":"5"}]', 1),
	(7, NULL, 2),
	(8, '[{"id":"6"},{"id":"2"},{"id":"1"}]', 3),
	(9, NULL, 4);
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

-- Volcando datos para la tabla kardex.proyectos: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `proyectos` DISABLE KEYS */;
INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `elim`) VALUES
	(1, 'Administrativo', '2022-02-18', '2025-02-18', 'Todo lo relacionado a la parte administrativa de la empresa', 0),
	(2, 'Hospitales', '2022-02-21', '2022-03-10', 'Diseño y construcción de hospitales en el Distrito de Barranquilla', 0),
	(3, 'La Loma', '2022-02-22', '2022-03-11', 'Interventoría en la loma', 0),
	(4, 'Parques para la gente', '2022-02-22', '2022-02-24', 'Diseño y construcción de parques en barranquilla', 0);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.requisiciones: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `requisiciones` DISABLE KEYS */;
INSERT INTO `requisiciones` (`id`, `id_area`, `id_persona`, `id_usr`, `codigoInt`, `insumos`, `fecha`, `fecha_sol`, `observacion`, `id_proyecto`, `aprobado`, `observacionE`, `registro`, `gen`) VALUES
	(3, 1, 1, 1, 'RQ-003-2021', '[{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"1","ent":"5"}]', '2021-09-22', '2021-09-23', '', 1, 1, NULL, NULL, 0),
	(4, 2, 2, 1, 'RQ-004-2021', '[{"id":"2","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"1","ent":"1"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","ped":"1","ent":"10"}]', '2021-09-20', '2021-08-10', '', 1, 1, NULL, NULL, 0),
	(5, 2, 2, 1, 'RQ-005-2021', '[{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA","ped":"1","ent":"1"}]', '2021-08-20', '2021-08-17', '', 1, 1, NULL, NULL, 0),
	(6, 1, 1, 1, 'RQ-001-2022', '[{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","ped":"1","ent":"1"},{"id":"7","des":"BANDEJA PORTA DOCUMENTOS","ped":"10","ent":"10"}]', '2022-01-10', '2022-02-14', '', 1, 1, NULL, NULL, 0),
	(7, 1, 1, 1, 'RQ-002-2022', '[{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","ped":"1","ent":"1"}]', '2022-02-15', '2022-02-15', '', 1, 1, NULL, NULL, 0),
	(8, 1, 2, 1, 'RQ-003-2022', '[{"id":"9","des":"BOLIGRAFO  ROJO ","ped":"1","ent":"1"},{"id":"3","des":"AROMATICA SURTIDA EN BOLSA","ped":"10","ent":"10"},{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA","ped":"12","ent":"5"}]', '2022-02-15', '2022-02-15', '', 1, 1, NULL, NULL, 0),
	(9, 2, 5, 1, 'RQ-004-2022', '[{"id":"12","des":"BOLSA BASURA VERDE 42*47CMS ","ped":"1","ent":"1"},{"id":"7","des":"BANDEJA PORTA DOCUMENTOS","ped":"1","ent":"9"}]', '2022-02-28', '2022-02-25', '', 1, 1, NULL, NULL, 0),
	(10, 1, 3, 4, 'RQ-005-2022', '[{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","ped":"15","ent":0},{"id":"8","des":"BLANQUEADOR (LIMPIDO)","ped":"10","ent":0},{"id":"10","des":"BOLIGRAFO NEGRO","ped":"15","ent":0},{"id":"11","des":"BOLSA BASURA NEGRA X 90*110 ","ped":"50","ent":0}]', '2022-02-28', '2022-02-28', '', 1, 1, NULL, NULL, 0),
	(11, 3, 4, 1, 'RQ-006-2022', '[{"id":"4","des":"ATOMIZADOR AMBIENTADOR LAVANDA","ped":"10","ent":"10"},{"id":"5","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"15","ent":"12"},{"id":"6","des":"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL","ped":"19","ent":"15"},{"id":"7","des":"BANDEJA PORTA DOCUMENTOS","ped":"6","ent":"6"}]', '2022-02-28', '2022-02-28', '', 1, 1, 'Esto es para la impresión de la loma', '', 1),
	(12, 3, 4, 1, 'RQ-007-2022', '[{"id":"11","des":"BOLSA BASURA NEGRA X 90*110 ","ped":"10","ent":"10"},{"id":"10","des":"BOLIGRAFO NEGRO","ped":"100","ent":"5"},{"id":"9","des":"BOLIGRAFO  ROJO ","ped":"250","ent":"10"}]', '2022-02-28', '2022-02-28', 'Hay insumos sin Stock', 1, 1, 'Esto es para mi area', '', 1),
	(13, 2, 5, 1, 'RQ-008-2022', '[{"id":"24","des":"CINTA INVISIBLE 33M:19MM PARA CHEQUES","ped":"10","ent":"7"},{"id":"25","des":"CLIP MARIPOSA GIGANTE","ped":"5","ent":"2"},{"id":"26","des":"CLIP MARIPOSA X 50 EMP*50 ","ped":"1","ent":"1"},{"id":"27","des":"CLIP SENCILLO X 100 EMP*100","ped":"16","ent":"2"},{"id":"30","des":"CORRECTOR LIQUIDO LAPIZ *7 ML","ped":"7","ent":"7"},{"id":"33","des":"CUENTA FACIL","ped":"12","ent":"1"},{"id":"32","des":"CREMA LAVALOZA ","ped":"4","ent":"2"}]', '2022-02-28', '2022-02-28', 'Hay insumos que no tienen stock', 3, 1, 'Para las cuentas de cobro', 'CREMA LAVALOZA con codigo 31, tiene menor stock al solicitado.:', 1);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla kardex.usuarios: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `sid`, `elim`, `try`, `id_area`) VALUES
	(1, 'Kevin Bolaño', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 1, '', 1, '2022-02-28 13:29:47', '2021-02-11 10:06:49', 'mitr0m71v4fl32623rtkgp70sa', 0, 0, 1),
	(2, 'Carmen Rebolledo A', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 2, '', 1, '2021-08-18 14:18:38', '2021-08-19 11:12:33', '', 0, 0, 1),
	(3, 'Karelly Moreno', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5aub5AdYGnDrNPXtjZGt9K5ZSA6JZ42Pci', 3, '', 1, '2021-06-10 09:47:31', '2021-08-19 11:12:39', '', 0, 0, 1),
	(4, 'Fernando Barcelo', 'fbarcelo', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 4, '', 1, '2022-02-28 12:04:24', '2022-02-18 16:29:41', 'mitr0m71v4fl32623rtkgp70sa', 0, 0, 1),
	(5, 'Selena Reyes', 'sreyes', '$2a$07$asxx54ahjppf45sd87a5auH1xJI2usVPVhPuFmUALPrJB4alQ5yXi', 4, NULL, 1, '2022-02-28 13:28:51', '2022-02-21 11:44:30', 'mitr0m71v4fl32623rtkgp70sa', 0, 0, 1),
	(6, 'Andrea Espitia', 'aespitia', '2a52HUr6WfShk', 4, NULL, 1, '0000-00-00 00:00:00', '2022-02-21 16:43:57', NULL, 0, 0, 1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para tabla kardex.valores
CREATE TABLE IF NOT EXISTS `valores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_insumo` int(11) NOT NULL,
  `registro` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__insumos` (`id_insumo`),
  CONSTRAINT `FK__insumos` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Muestra los cambios de valores que lleva un insumo a lo largo del tiempo.';

-- Volcando datos para la tabla kardex.valores: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `valores` DISABLE KEYS */;
/*!40000 ALTER TABLE `valores` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
