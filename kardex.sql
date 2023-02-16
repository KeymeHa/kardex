-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.31 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para kardex
CREATE DATABASE IF NOT EXISTS `kardex` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kardex`;

-- Volcando estructura para tabla kardex.accion
CREATE TABLE IF NOT EXISTS `accion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.accion: ~10 rows (aproximadamente)
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

-- Volcando estructura para tabla kardex.accion_pqr
CREATE TABLE IF NOT EXISTS `accion_pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_accion` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Acciones de pqr que ya estan en tramite por la entidad';

-- Volcando datos para la tabla kardex.accion_pqr: ~6 rows (aproximadamente)
INSERT INTO `accion_pqr` (`id`, `nombre`, `descripcion`, `fecha_creacion`, `nombre_accion`) VALUES
	(1, 'Traslado Interno', NULL, '2023-01-30 16:05:09', 'Asignado'),
	(2, 'Traslado Por Competencia', NULL, '2023-01-30 16:05:27', 'Trasladó'),
	(3, 'Devuelto para Reasignación', NULL, '2023-01-30 16:05:43', 'Reasignado'),
	(4, 'Respondido por evaluar', NULL, '2023-01-30 16:06:18', 'Respondido por evaluar'),
	(5, 'Respodido y Enviado', NULL, '2023-01-30 16:06:40', 'Respondió y envió'),
	(6, 'Para Enviar', NULL, '2023-01-30 16:06:47', 'Envió'),
	(7, 'Cambiar Tipo PQR', NULL, '2023-02-03 08:58:52', 'Modifico su tipo'),
	(8, 'Marcar Como Resuelto', NULL, '2023-02-14 15:00:30', 'Resuelto');

-- Volcando estructura para tabla kardex.actas
CREATE TABLE IF NOT EXISTS `actas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoInt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tipo` int NOT NULL,
  `id_usr` int NOT NULL,
  `fecha` date NOT NULL,
  `fechaSal` date DEFAULT NULL,
  `fechaEnt` date DEFAULT NULL,
  `autorizado` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `dependencia` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `responsable` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `dependenciaR` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `motivo` int NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `listainsumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.actas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.anexosprov
CREATE TABLE IF NOT EXISTS `anexosprov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_carpeta` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.anexosprov: ~2 rows (aproximadamente)
INSERT INTO `anexosprov` (`id`, `nombre`, `id_carpeta`, `fecha`, `ruta`) VALUES
	(13, 'Comprobante Banco', 1, '2022-07-07 10:15:19', '1/1.pdf'),
	(14, 'Archivo Prueba', 2, '2022-09-08 11:25:27', '2/1.pdf');

-- Volcando estructura para tabla kardex.anios
CREATE TABLE IF NOT EXISTS `anios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anio` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.anios: ~3 rows (aproximadamente)
INSERT INTO `anios` (`id`, `anio`) VALUES
	(1, 2021),
	(2, 2022),
	(3, 2023);

-- Volcando estructura para tabla kardex.areas
CREATE TABLE IF NOT EXISTS `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT 'Sin Información',
  `elim` int NOT NULL DEFAULT '0',
  `cat_asociadas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.areas: ~9 rows (aproximadamente)
INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
	(1, 'Sistemas', 'Encargados del área de Sistemas', 0, ''),
	(2, 'Contratación', 'Personal de Contratación', 0, ''),
	(3, 'Reasentamiento', 'Abogados', 0, ''),
	(4, 'Jurídica', 'Personal de Juridíca', 0, ''),
	(5, 'Mercados', 'Personal de Mercados', 0, ''),
	(6, 'Area Tecnica', 'Ingenieros y Arquitectos', 0, ''),
	(7, 'ADMINISTRATIVO', 'Toda la Parte Administrativa', 0, ''),
	(8, 'SGSST', 'SGSST', 0, NULL),
	(9, 'CONTABILIDAD', 'CONTABILIDAD', 0, NULL),
	(10, 'GERENCIA GENERAL', 'GERENCIA GENERAL', 0, NULL),
	(11, 'Tesorería', 'Tesorería', 0, NULL);

-- Volcando estructura para tabla kardex.articulo
CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.articulo: ~9 rows (aproximadamente)
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

-- Volcando estructura para tabla kardex.asignaciones
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `modulo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignaciones_usuarios` (`id_persona`),
  CONSTRAINT `FK_asignaciones_usuarios` FOREIGN KEY (`id_persona`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.asignaciones: ~2 rows (aproximadamente)
INSERT INTO `asignaciones` (`id`, `id_persona`, `modulo`) VALUES
	(4, 11, 7),
	(5, 1, 3);

-- Volcando estructura para tabla kardex.carpetasprov
CREATE TABLE IF NOT EXISTS `carpetasprov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `carpeta` int NOT NULL,
  `id_prov` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.carpetasprov: ~2 rows (aproximadamente)
INSERT INTO `carpetasprov` (`id`, `nombre`, `carpeta`, `id_prov`, `fecha`) VALUES
	(1, 'Contratos', 1, 1, '2022-07-07 10:14:45'),
	(2, 'Prueba Carpeta', 2, 2, '2022-09-08 11:25:00');

-- Volcando estructura para tabla kardex.categoriaarea
CREATE TABLE IF NOT EXISTS `categoriaarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_categorias` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoriaarea_categorias` (`id_categorias`),
  CONSTRAINT `FK_categoriaarea_categorias` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.categoriaarea: ~6 rows (aproximadamente)
INSERT INTO `categoriaarea` (`id`, `id_areas`, `id_categorias`) VALUES
	(5, '[{"id":"2"},{"id":"7"}]', 1),
	(6, '[{"id":"1"}]', 2),
	(7, '[{"id":"1"}]', 2),
	(8, NULL, 3),
	(9, NULL, 4),
	(10, NULL, 5);

-- Volcando estructura para tabla kardex.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.categorias: ~5 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
	(1, 'Papelería', 'Sin Informacion.', 0),
	(2, 'Sistemas', 'Sin Informacion.', 0),
	(3, 'Aseo', 'Sin Informacion.', 0),
	(4, 'Cocina', 'Elementos para la cocina', 0),
	(5, 'Otros', 'Almacena Insumos que no manejan categoría especifica', 0);

-- Volcando estructura para tabla kardex.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `sid` int NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.clientes: ~0 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `nombre`, `sid`, `correo`, `telefono`, `elim`) VALUES
	(1, 'Susana Amador', 123456789, 'susanaamador@hotmail.com', '2147483647', 0);

-- Volcando estructura para tabla kardex.cortes
CREATE TABLE IF NOT EXISTS `cortes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `corte` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `corte` (`corte`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.cortes: ~35 rows (aproximadamente)
INSERT INTO `cortes` (`id`, `corte`, `fecha`) VALUES
	(1, '2206061753', '2022-06-06 20:54:22'),
	(2, '2206081754', '2022-06-10 19:26:06'),
	(3, '2206091755', '2022-06-09 22:08:56'),
	(4, '2206091756', '2022-06-09 22:11:36'),
	(5, '2206101757', '2022-06-10 13:57:36'),
	(6, '2206101758', '2022-06-10 13:58:39'),
	(7, '2206101759', '2022-06-10 14:22:52'),
	(8, '2206161760', '2022-06-16 21:51:25'),
	(9, '2206221762', '2022-06-22 17:11:00'),
	(10, '2206231763', '2022-06-23 20:59:10'),
	(11, '2206231764', '2022-06-23 22:00:48'),
	(12, '2207141765', '2022-07-14 20:30:23'),
	(13, '2207271765', '2022-07-27 14:44:04'),
	(15, '2207271766', '2022-07-27 14:55:14'),
	(16, '2207271767', '2022-07-27 16:06:26'),
	(17, '2207271768', '2022-07-27 16:12:54'),
	(18, '2207281769', '2022-07-28 21:08:42'),
	(19, '2207281770', '2022-07-28 21:08:57'),
	(20, '2207281771', '2022-07-28 21:13:43'),
	(21, '2208091773', '2022-08-09 21:41:44'),
	(22, '2208101774', '2022-08-10 13:57:55'),
	(23, '2208231776', '2022-08-23 15:53:37'),
	(24, '2301270001', '2023-01-27 13:31:59'),
	(60, '2302090002', '2023-02-09 20:25:40'),
	(61, '2302090003', '2023-02-09 20:30:26'),
	(62, '2302090004', '2023-02-09 20:31:58'),
	(63, '2302090005', '2023-02-09 20:32:18'),
	(64, '2302090006', '2023-02-09 20:32:33'),
	(65, '2302090007', '2023-02-09 20:32:46'),
	(66, '2302090008', '2023-02-09 20:33:18'),
	(67, '2302090009', '2023-02-09 21:23:32'),
	(68, '-010-2023', '2023-02-13 14:47:18'),
	(69, '-011-2023', '2023-02-13 14:48:33'),
	(70, '-012-2023', '2023-02-13 14:52:23'),
	(71, '-013-2023', '2023-02-13 14:55:16'),
	(72, '-014-2023', '2023-02-13 15:02:10'),
	(73, '-015-2023', '2023-02-14 21:03:11'),
	(74, '2302140021', '2023-02-14 21:08:58'),
	(75, '2302160021', '2023-02-16 13:25:31');

-- Volcando estructura para tabla kardex.estado_pqr
CREATE TABLE IF NOT EXISTS `estado_pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `html` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'success',
  `icono` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'fa-circle-thin',
  `descripcion` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla kardex.estado_pqr: ~6 rows (aproximadamente)
INSERT INTO `estado_pqr` (`id`, `nombre`, `elim`, `fecha_creacion`, `html`, `icono`, `descripcion`) VALUES
	(1, 'Resuelta', 0, '2023-01-26 20:52:45', 'success', 'ok-circle', NULL),
	(2, 'Pendiente', 0, '2023-01-26 20:52:57', 'warning', 'exclamation-sign', NULL),
	(3, 'Vencida', 0, '2023-01-26 20:53:15', 'danger', 'remove-circle', NULL),
	(4, 'Extemporanea', 0, '2023-01-26 20:53:28', 'warning', 'remove-circle', NULL),
	(5, 'Por Asignar', 0, '2023-01-26 22:09:44', 'info', 'exclamation-sign', NULL),
	(6, 'Trasladado', 0, '2023-02-07 16:19:46', 'success', 'ok-circle', NULL);

-- Volcando estructura para tabla kardex.exepcion_mensajes
CREATE TABLE IF NOT EXISTS `exepcion_mensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.exepcion_mensajes: ~5 rows (aproximadamente)
INSERT INTO `exepcion_mensajes` (`id`, `valor`) VALUES
	(1, 'Contraseña Equivocada'),
	(2, 'Usuario Errado'),
	(3, 'Usuario Bloqueado por muchos intentos'),
	(4, 'Intento de inicio de sesion estando desactivado'),
	(5, 'Inicio Correcto');

-- Volcando estructura para tabla kardex.exeption_usuarios
CREATE TABLE IF NOT EXISTS `exeption_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_mensaje` int NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor` varchar(2000) DEFAULT NULL,
  `ip_cliente` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_exeption_usuarios_exepcion_mensajes` (`id_mensaje`),
  CONSTRAINT `FK_exeption_usuarios_exepcion_mensajes` FOREIGN KEY (`id_mensaje`) REFERENCES `exepcion_mensajes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='guarda las exepciones y mantiene un registro de los intentos e inicio de sesión';

-- Volcando datos para la tabla kardex.exeption_usuarios: ~118 rows (aproximadamente)
INSERT INTO `exeption_usuarios` (`id`, `id_mensaje`, `fecha`, `valor`, `ip_cliente`) VALUES
	(1, 2, '2022-08-30 15:09:34', '#kb', NULL),
	(2, 5, '2022-08-30 15:14:02', '1', NULL),
	(3, 5, '2022-08-30 15:48:26', '1', NULL),
	(4, 5, '2022-08-30 19:40:11', '1', NULL),
	(5, 5, '2022-08-30 20:50:29', '1', NULL),
	(6, 5, '2022-08-31 19:32:29', '1', NULL),
	(7, 5, '2022-09-01 13:06:05', '1', NULL),
	(8, 5, '2022-09-02 13:20:48', '1', NULL),
	(9, 5, '2022-09-05 13:43:43', '1', NULL),
	(10, 5, '2022-09-08 13:21:20', '1', NULL),
	(11, 5, '2022-09-08 15:58:28', '1', NULL),
	(12, 5, '2022-09-08 19:06:28', '14', NULL),
	(13, 2, '2022-09-08 19:07:07', '#belkysperez', NULL),
	(14, 5, '2022-09-08 19:07:36', '14', NULL),
	(15, 5, '2022-09-19 13:26:33', '1', NULL),
	(16, 5, '2022-09-19 13:58:41', '1', NULL),
	(17, 5, '2022-09-19 14:19:07', '1', NULL),
	(18, 5, '2022-09-19 14:35:58', '1', NULL),
	(19, 5, '2022-09-19 14:37:11', '1', NULL),
	(20, 5, '2022-09-19 14:37:26', '1', NULL),
	(21, 5, '2022-09-19 14:37:53', '1', NULL),
	(22, 2, '2022-09-19 14:41:03', '#carmenr', NULL),
	(23, 5, '2022-09-19 14:41:10', '1', NULL),
	(24, 5, '2022-09-19 14:42:24', '2', NULL),
	(25, 5, '2022-09-19 14:55:14', '1', NULL),
	(26, 5, '2022-09-19 14:55:53', '2', NULL),
	(27, 5, '2022-09-19 15:01:13', '1', NULL),
	(28, 5, '2022-09-19 15:05:39', '1', NULL),
	(29, 5, '2022-09-19 15:05:50', '2', NULL),
	(30, 5, '2022-09-19 20:30:06', '1', NULL),
	(31, 5, '2022-09-20 19:54:04', '1', NULL),
	(32, 5, '2022-09-26 13:09:02', '1', NULL),
	(33, 5, '2022-09-26 21:46:07', '3', NULL),
	(34, 5, '2022-09-26 21:53:22', '1', NULL),
	(35, 5, '2022-09-27 13:24:30', '3', NULL),
	(36, 5, '2022-09-27 13:59:00', '1', NULL),
	(37, 5, '2022-09-27 15:29:52', '3', NULL),
	(38, 5, '2022-09-27 15:34:27', '1', NULL),
	(39, 5, '2022-09-27 15:38:36', '3', NULL),
	(40, 5, '2022-09-27 15:39:36', '1', NULL),
	(41, 5, '2022-09-27 15:48:36', '3', NULL),
	(42, 5, '2022-09-27 17:04:59', '1', NULL),
	(43, 5, '2022-09-27 19:09:45', '3', NULL),
	(44, 5, '2022-09-27 19:18:04', '1', NULL),
	(45, 5, '2022-09-27 20:30:18', '1', NULL),
	(46, 5, '2022-09-27 20:57:19', '1', NULL),
	(47, 2, '2022-09-27 20:57:48', '#kmoreno', NULL),
	(48, 5, '2022-09-27 20:57:56', '3', NULL),
	(49, 5, '2022-09-27 21:56:47', '1', '::1'),
	(50, 5, '2022-09-27 21:57:32', '1', NULL),
	(51, 5, '2022-09-27 21:58:50', '1', '::1'),
	(52, 5, '2022-09-28 13:45:42', '1', '::1'),
	(53, 5, '2022-09-28 13:45:53', '3', '::1'),
	(54, 5, '2022-09-29 13:33:08', '1', '::1'),
	(55, 5, '2022-09-30 15:26:31', '1', '::1'),
	(56, 5, '2022-10-04 22:06:27', '3', '::1'),
	(57, 5, '2022-10-05 12:54:50', '1', '::1'),
	(58, 5, '2022-10-05 12:55:16', '3', '::1'),
	(59, 5, '2022-10-05 19:23:52', '1', '::1'),
	(60, 5, '2022-10-05 19:24:13', '1', '::1'),
	(61, 5, '2022-10-05 19:27:57', '3', '::1'),
	(62, 5, '2022-10-06 14:19:06', '1', '::1'),
	(63, 5, '2022-10-07 16:50:08', '1', '::1'),
	(64, 5, '2022-12-16 16:35:33', '1', '::1'),
	(65, 5, '2022-12-16 19:09:11', '1', '::1'),
	(66, 5, '2022-12-20 13:48:29', '1', '::1'),
	(67, 5, '2022-12-20 20:48:46', '1', '::1'),
	(68, 5, '2023-01-24 21:02:27', '1', '::1'),
	(69, 5, '2023-01-24 21:05:55', '12', '::1'),
	(70, 5, '2023-01-24 22:00:12', '1', '::1'),
	(71, 2, '2023-01-25 13:16:52', '#ycantillo', '::1'),
	(72, 2, '2023-01-25 13:17:00', '#ycantillo', '::1'),
	(73, 5, '2023-01-25 13:17:07', '12', '::1'),
	(74, 5, '2023-01-25 13:21:37', '1', '::1'),
	(75, 5, '2023-01-25 15:34:46', '1', '::1'),
	(76, 5, '2023-01-26 15:56:51', '1', '::1'),
	(77, 5, '2023-01-26 16:47:15', '3', '::1'),
	(78, 5, '2023-01-26 22:40:06', '1', '::1'),
	(79, 5, '2023-01-26 22:46:42', '12', '::1'),
	(80, 5, '2023-01-26 22:49:02', '1', '::1'),
	(81, 5, '2023-01-26 22:53:33', '12', '::1'),
	(82, 5, '2023-01-27 13:24:27', '12', '::1'),
	(83, 5, '2023-01-27 13:26:31', '1', '::1'),
	(84, 5, '2023-01-27 20:39:28', '3', '::1'),
	(85, 2, '2023-01-30 14:01:17', '#kb', '::1'),
	(86, 2, '2023-01-30 14:01:27', '#ycantillo', '::1'),
	(87, 2, '2023-01-30 14:01:40', '#kb', '::1'),
	(88, 5, '2023-01-30 14:02:14', '1', '::1'),
	(89, 2, '2023-01-30 14:02:29', '#ycantillo', '::1'),
	(90, 5, '2023-01-30 14:02:35', '12', '::1'),
	(91, 5, '2023-01-30 23:04:33', '3', '::1'),
	(92, 5, '2023-01-31 15:13:21', '1', '::1'),
	(93, 5, '2023-02-01 14:05:20', '1', '::1'),
	(94, 5, '2023-02-01 14:06:01', '12', '::1'),
	(95, 5, '2023-02-01 15:18:15', '1', '::1'),
	(96, 5, '2023-02-02 13:17:39', '12', '::1'),
	(97, 5, '2023-02-03 14:51:08', '1', '::1'),
	(98, 5, '2023-02-03 20:24:45', '1', '::1'),
	(99, 2, '2023-02-03 20:24:55', '#jcantillo', '::1'),
	(100, 5, '2023-02-03 20:25:03', '12', '::1'),
	(101, 5, '2023-02-03 20:33:44', '12', '::1'),
	(102, 5, '2023-02-03 20:41:49', '12', '::1'),
	(103, 5, '2023-02-09 14:55:29', '1', '::1'),
	(104, 5, '2023-02-09 19:05:53', '1', '::1'),
	(105, 5, '2023-02-09 19:06:17', '12', '::1'),
	(106, 5, '2023-02-09 20:22:00', '1', '::1'),
	(107, 5, '2023-02-09 21:13:25', '1', '::1'),
	(108, 2, '2023-02-09 21:23:50', '#ycantillo', '::1'),
	(109, 2, '2023-02-09 21:23:55', '#ycantillo', '::1'),
	(110, 3, '2023-02-09 21:24:00', '#ycantillo', '::1'),
	(111, 2, '2023-02-09 21:24:06', '#kb', '::1'),
	(112, 5, '2023-02-09 21:24:15', '1', '::1'),
	(113, 2, '2023-02-09 21:24:28', '#ycantillo', '::1'),
	(114, 5, '2023-02-09 21:24:37', '1', '::1'),
	(115, 5, '2023-02-09 21:24:44', '12', '::1'),
	(116, 5, '2023-02-10 17:13:48', '1', '::1'),
	(117, 5, '2023-02-10 17:24:23', '1', '::1'),
	(118, 5, '2023-02-13 14:32:44', '12', '::1'),
	(119, 5, '2023-02-13 14:32:54', '12', '::1'),
	(120, 5, '2023-02-13 14:46:29', '1', '::1'),
	(121, 5, '2023-02-13 15:01:39', '12', '192.168.1.147'),
	(122, 5, '2023-02-13 16:48:26', '12', '192.168.1.206'),
	(123, 2, '2023-02-14 15:10:54', '#ycantillo', '192.168.1.206'),
	(124, 5, '2023-02-14 16:39:15', '1', '::1'),
	(125, 5, '2023-02-14 20:59:57', '1', '::1'),
	(126, 5, '2023-02-14 21:10:42', '12', '::1'),
	(127, 5, '2023-02-15 16:45:15', '1', '::1'),
	(128, 5, '2023-02-15 16:50:38', '11', '::1'),
	(129, 5, '2023-02-16 13:24:17', '1', '::1');

-- Volcando estructura para tabla kardex.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoInt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_proveedor` int NOT NULL,
  `soporte` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_usr` int NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.facturas: ~2 rows (aproximadamente)
INSERT INTO `facturas` (`id`, `codigoInt`, `codigo`, `id_proveedor`, `soporte`, `id_usr`, `insumos`, `fecha`, `inversion`, `iva`, `observacion`) VALUES
	(2, 'FAC-002-2022', 'FACTURA-1', 2, '', 2, '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"1","con":"1","pre":"0","sub":"0"}]', '2022-08-24', 0, 0, ''),
	(3, 'FAC-003-2022', '5GBNJDVF', 2, '', 3, '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","can":"10","con":"20","pre":"1000","sub":"10000"}]', '2022-09-27', 10000, 1900, '');

-- Volcando estructura para tabla kardex.festivos
CREATE TABLE IF NOT EXISTS `festivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.festivos: ~47 rows (aproximadamente)
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
	(20, '2022-12-25'),
	(21, '2023-03-20'),
	(22, '2023-04-02'),
	(23, '2023-04-06'),
	(24, '2023-04-07'),
	(25, '2023-04-09'),
	(26, '2023-05-01'),
	(27, '2023-05-14'),
	(28, '2023-05-22'),
	(29, '2023-06-12'),
	(30, '2023-06-18'),
	(31, '2023-06-19'),
	(32, '2023-07-03'),
	(33, '2023-07-20'),
	(34, '2023-08-07'),
	(35, '2023-08-21'),
	(36, '2023-10-09'),
	(37, '2023-10-10'),
	(38, '2023-10-11'),
	(39, '2023-10-12'),
	(40, '2023-10-13'),
	(41, '2023-10-16'),
	(42, '2023-10-31'),
	(43, '2023-11-06'),
	(44, '2023-11-13'),
	(45, '2023-12-07'),
	(46, '2023-12-08'),
	(47, '2023-12-25');

-- Volcando estructura para tabla kardex.historial
CREATE TABLE IF NOT EXISTS `historial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accion` int NOT NULL COMMENT '1 Crear, 2 Leer, 3 Actualizar, 4 Eliminar',
  `numTabla` int NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas, 11 carpetas, 12 anexos, 13 proyectos, 14 asignaciones, 15 Radicados\r\n',
  `valorAnt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `valorNew` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usr` int NOT NULL,
  `id_otro` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.historial: ~15 rows (aproximadamente)
INSERT INTO `historial` (`id`, `accion`, `numTabla`, `valorAnt`, `valorNew`, `fecha`, `id_usr`, `id_otro`) VALUES
	(7, 3, 15, '[{"ca":"2","val":"3"},{"ca":"4","val":"5"},{"ca":"5","val":"ALCALDÍA : B/QUILLA ROJA"}]', '[{"ca":"2","val":"6"},{"ca":"4","val":"7"},{"ca":"5","val":"54"}]', '2022-08-27 16:06:46', 1, 0),
	(8, 3, 15, '[{"ca":"3","val":"3"},{"ca":"6","val":"PRACTICA LO QUE APRENDES"},{"ca":"7","val":"3"}]', '[{"ca":"3","val":"11"},{"ca":"6","val":"HAZIEL SI ES NECIO"},{"ca":"7","val":"4"}]', '2022-08-27 16:20:22', 1, 0),
	(9, 3, 15, '[{"ca":"1","val":"3"},{"ca":"2","val":"6"},{"ca":"7","val":"4"}],[{"id":"51"}]', '[{"ca":"1","val":"5"},{"ca":"2","val":"4"},{"ca":"7","val":"1"}],[{"id":"51"}]', '2022-08-27 16:30:53', 1, 0),
	(10, 3, 9, 'Listado de insumos. Solicitó Aprobación de Modificación. ', '', '2022-10-05 20:16:48', 1, 21),
	(11, 3, 9, 'Modificada lista de insumos. Aprobó la Modificación. ', '', '2022-10-05 20:25:23', 3, 21),
	(12, 3, 9, 'Aprobó la Modificación. ', '', '2022-10-05 20:25:43', 3, 21),
	(13, 3, 9, 'Aprobó la Modificación. ', '', '2022-10-05 20:32:42', 3, 21),
	(14, 3, 9, 'Aprobó la Modificación. ', '', '2022-10-05 20:33:13', 3, 21),
	(15, 3, 9, 'Aprobó la Modificación. ', '', '2022-10-05 20:38:31', 3, 21),
	(16, 3, 9, 'Solicitó Aprobación de Modificación. ', '', '2022-10-05 20:39:31', 1, 21),
	(17, 3, 9, 'Compras Modifico el Comentario. Aprobó la Modificación. ', '', '2022-10-05 20:40:25', 3, 21),
	(18, 3, 9, 'El Encargado Modifico el Comentario. Solicitó Aprobación de Modificación. ', '', '2022-10-05 20:40:59', 1, 21),
	(19, 3, 15, '],[{"id":"31"}]', '],[{"id":"31"}]', '2022-12-16 16:49:25', 1, 0),
	(20, 3, 15, '],[{"id":"51"}]', '],[{"id":"51"}]', '2022-12-16 16:49:41', 1, 0),
	(21, 3, 15, '],[{"id":"31"}]', '],[{"id":"31"}]', '2022-12-16 16:54:51', 1, 0),
	(22, 3, 15, '[{"ca":"2","val":"4"}],[{"id":"51"}]', '[{"ca":"2","val":"1"}],[{"id":"51"}]', '2023-01-24 22:02:17', 1, 0),
	(23, 3, 15, '[{"ca":"7","val":"7"}],[{"id":"59"}]', '[{"ca":"7","val":"4"}],[{"id":"59"}]', '2023-02-09 20:33:11', 1, 0);

-- Volcando estructura para tabla kardex.impuestos
CREATE TABLE IF NOT EXISTS `impuestos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `valor` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.impuestos: ~0 rows (aproximadamente)
INSERT INTO `impuestos` (`id`, `descripcion`, `valor`) VALUES
	(1, 'IVA', 19);

-- Volcando estructura para tabla kardex.insumos
CREATE TABLE IF NOT EXISTS `insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_categoria` int NOT NULL,
  `codigo` varchar(7) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `imagen` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `stock` int NOT NULL DEFAULT '0',
  `stockIn` int NOT NULL DEFAULT '0',
  `precio_compra` float NOT NULL DEFAULT '0',
  `precio_unidad` float NOT NULL DEFAULT '0',
  `precio_por_mayor` float NOT NULL DEFAULT '0',
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `elim` int NOT NULL DEFAULT '0',
  `estante` char(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `nivel` char(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `seccion` char(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `prioridad` int NOT NULL DEFAULT '2',
  `unidad` int NOT NULL DEFAULT '1',
  `unidadSal` int NOT NULL DEFAULT '1',
  `contenido` int NOT NULL DEFAULT '1',
  `habilitado` int NOT NULL DEFAULT '1',
  `imp` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_insumos_insumosunidad` (`unidadSal`),
  KEY `FK_insumos_insumosunidad_2` (`unidad`),
  CONSTRAINT `FK_insumos_insumosunidad` FOREIGN KEY (`unidadSal`) REFERENCES `insumosunidad` (`id`),
  CONSTRAINT `FK_insumos_insumosunidad_2` FOREIGN KEY (`unidad`) REFERENCES `insumosunidad` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.insumos: ~163 rows (aproximadamente)
INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `stockIn`, `precio_compra`, `precio_unidad`, `precio_por_mayor`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`, `unidad`, `unidadSal`, `contenido`, `habilitado`, `imp`) VALUES
	(1, 3, '1', 'AMBIENTADOR DE BAÑO AIR WICK', 'SIN INFORMACION', NULL, 195, 1, 1000, 0, 0, '2022-08-09 11:23:50', 0, 'g1', '0', 'G6', 3, 1, 1, 20, 0, 0),
	(2, 4, '2', 'AROMATICA SURTIDA EN BOLSA', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, '0', '0', '0', 2, 1, 1, 1, 0, 0),
	(3, 3, '3', 'ATOMIZADOR AMBIENTADOR LAVANDA ', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(4, 4, '4', 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(5, 4, '5', 'AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(6, 1, '6', 'BANDEJA PORTA DOCUMENTOS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(7, 3, '7', 'BLANQUEADOR (LIMPIDO)', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(8, 1, '8', 'BOLIGRAFO  ROJO ', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(9, 1, '9', 'BOLIGRAFO NEGRO', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(10, 3, '10', 'BOLSA BASURA NEGRA X 90*110 ', 'SIN INFORMACION', NULL, 6, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(11, 3, '11', 'BOLSA BASURA VERDE 42*47CMS ', 'SIN INFORMACION', NULL, 7, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(12, 1, '12', 'BORRADOR DE NATA', 'SIN INFORMACION', NULL, 13, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(13, 1, '13', 'BORRADOR DE TABLERO', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(14, 4, '14', 'CAFÉ TOSTADO Y MOLIDO, FUERTE', 'SIN INFORMACION', NULL, 28, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(15, 1, '15', 'CARATULA POLY COVER CARTA ', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(16, 1, '16', 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(17, 1, '17', 'CARTULINA BRISTOL 70*100 BLANCA', 'SIN INFORMACION', NULL, 4, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(18, 2, '18', 'CD-R ', 'SIN INFORMACION', NULL, 128, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(19, 3, '19', 'CERA NATURAL SÓLIDA PARA MADERA AUTOBRILLO', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(20, 1, '20', 'CINTA EMP TRANSP 48X100 REF.301 3M ', 'SIN INFORMACION', NULL, 14, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(21, 1, '21', 'CINTA EMP TRANSP DELGADA 12 MM X40M ', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(22, 2, '22', 'CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
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
	(39, 2, '39', 'DVD +R ', 'SIN INFORMACION', NULL, 104, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
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
	(58, 2, '58', 'HP 711 CYAN', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:50', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
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
	(154, 2, '154', 'FUNDA PARA CD', 'SIN INFORMACION', NULL, 45, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(155, 1, '155', 'FORMAS CONTINUAS 9 1/2 x 5 1/2  2 PARTES', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(156, 1, '156', 'FORMAS CONTINUAS 9 1/2 x 11 2 PARTES', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(157, 2, '157', 'LEXMARK MAGENTA', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(158, 1, '158', 'BANDERITA', 'SIN INFORMACION', NULL, 14, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(159, 3, '159', 'BOLSA BLANCA', 'SIN INFORMACION', NULL, 11, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(160, 3, '160', 'BOLSA CANECA PEQUEÑA', 'SIN INFORMACION', NULL, 3, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(161, 2, '161', 'TINTA EPSON MAGENTA 544', 'SIN INFORMACION', NULL, 0, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(162, 2, '162', 'TINTA EPSON CYAN 544', 'SIN INFORMACION', NULL, 1, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0),
	(163, 1, '163', 'LIBRO CARTA', 'SIN INFORMACION', NULL, 2, 1, 0, 0, 0, '2022-08-09 11:23:51', 0, 'SINF', 'SINF', 'SINF', 2, 1, 1, 1, 1, 0);

-- Volcando estructura para tabla kardex.insumosnombre
CREATE TABLE IF NOT EXISTS `insumosnombre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_insumo` int NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.insumosnombre: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.insumosunidad
CREATE TABLE IF NOT EXISTS `insumosunidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.insumosunidad: ~11 rows (aproximadamente)
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

-- Volcando estructura para tabla kardex.inversiones
CREATE TABLE IF NOT EXISTS `inversiones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_prov` int NOT NULL,
  `invertido` float NOT NULL,
  `anio` int NOT NULL,
  `mes` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.inversiones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.js_data
CREATE TABLE IF NOT EXISTS `js_data` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `title` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `num` int NOT NULL DEFAULT '0' COMMENT 'id para traer datos por ajax',
  `pUno` int NOT NULL DEFAULT '1' COMMENT 'permiso para user root',
  `pDos` int NOT NULL DEFAULT '2' COMMENT 'permiso para user administrador',
  `pTres` int NOT NULL DEFAULT '3' COMMENT 'permiso para user auxiliar',
  `pCuatro` int NOT NULL DEFAULT '4' COMMENT 'permiso para user encargado',
  `pCinco` int NOT NULL DEFAULT '5' COMMENT 'permiso para user vendedor',
  `pSeis` int NOT NULL DEFAULT '0',
  `pSiete` int NOT NULL DEFAULT '0',
  `pOcho` int NOT NULL DEFAULT '0',
  `sw` int NOT NULL DEFAULT '1' COMMENT 'Gatillo para mostrar o no una pagina',
  `ver` int NOT NULL DEFAULT '1' COMMENT 'gatillo para consultar este registro',
  `file` int NOT NULL DEFAULT '1' COMMENT '1: tiene js, 0: no tiene js',
  `habilitado` int NOT NULL DEFAULT '0' COMMENT '0: solo muestra el js cuando esta en la pagina, 1: el js se muestra en todo el sistema',
  `descripcion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.js_data: ~64 rows (aproximadamente)
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
	(28, 'parametros', 'Parametros', 0, 1, 2, 0, 0, 0, 0, 7, 0, 1, 1, 1, 0, NULL),
	(29, 'nuevaOrdendeCompras', 'Nuevar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite generar ordenes de compra basado en los requerimientos del sistema.'),
	(30, 'proveedores', 'Proveedores', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores ingresados en el sistema, tambien permite administrarlos.'),
	(31, 'editarOrden', 'Editar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las ordenes de compras alamacenadas en sistemas.'),
	(32, 'editarActa', 'Editar Acta', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las actas alamancenadas en sistema.'),
	(33, 'verOrden', 'Ver Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Visualiza una orden de compra, discriminando los insumos registrados.'),
	(34, 'inventario', 'Inventario', 0, 1, 2, 3, 0, 5, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos pertenecientes a ella.'),
	(35, 'generaciones', 'Generaciones', 0, 1, 2, 3, 4, 0, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos Factura, Ordenes y cotizaciones.'),
	(36, 'salir', 'LogOut', 0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 0, 0, 0, NULL),
	(37, 'perfil', 'Mi Perfil', 0, 1, 2, 3, 4, 5, 6, 7, 0, 1, 1, 1, 0, 'Pagina del perfil del usuario logeado.'),
	(39, 'hisRequisicion', 'Historial de Requisición', 30, 1, 2, 0, 4, 5, 6, 7, 8, 1, 1, 1, 0, NULL),
	(40, 'verProyecto', 'Proyecto', 28, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(41, 'verRequisicion', 'Ver Requisición', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, NULL),
	(42, 'borrador', 'Borrador', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 0, 1, 0, NULL),
	(43, 'verFactura', 'Ver Factura', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite visualizar una factura seleccionada, discriminando valores e insumos agregados al stock.'),
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
	(63, 'resumenRadicado', 'Radicados', 0, 1, 2, 0, 0, 0, 6, 0, 0, 1, 1, 1, 0, NULL),
	(64, 'asignaciones', 'Asignaciones', 38, 1, 2, 3, 0, 0, 0, 7, 0, 1, 1, 1, 0, 'Muestra los encargados que tienen permitido realizar respuesta a las correspondencias'),
	(65, 'registros', 'Registros y Base de Datos', 39, 1, 2, 3, 4, 5, 6, 7, 0, 1, 1, 1, 0, 'Pagina donde relaciona todas las correspondencias tramitadas y que estan en ello'),
	(66, 'noAutorizado', 'No Autorizado', 0, 1, 2, 3, 4, 5, 6, 7, 8, 1, 1, 0, 0, 'Pagina con la información de No autorización por ingresar a un modulo no permitido'),
	(67, 'equipos', 'Base de Datos PC', 0, 1, 2, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, NULL),
	(68, 'resumenRadicadoD', 'Resumen Radicados', 0, 1, 2, 3, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Resumen de los caricados segun propiedades, areas, pqr'),
	(69, 'replicar', 'Nueva requisición', 0, 1, 2, 3, 4, 5, 6, 0, 0, 1, 1, 1, 0, NULL),
	(70, 'verRegistro', 'Registro', 0, 1, 2, 3, 4, 0, 0, 7, 0, 1, 1, 1, 0, 'Pagina detallada del registro de un Radicado');

-- Volcando estructura para tabla kardex.movimientos
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `entrYsal` int NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `anio` int NOT NULL,
  `mes` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.movimientos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.objeto
CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.objeto: ~29 rows (aproximadamente)
INSERT INTO `objeto` (`id`, `nombre`, `termino`, `elim`) VALUES
	(1, 'CITACIÓN JUDICIAL', 5, 0),
	(2, 'DECRETO EJECUTIVO', 5, 0),
	(3, 'DECRETO JUDICIAL', 5, 0),
	(4, 'RECEPCIÓN DE FACTURA(S)', 7, 0),
	(5, 'RECEPCIÓN INFORME', 5, 0),
	(6, 'RECEPCIÓN OFICIO', 5, 0),
	(7, 'RECEPCIÓN PETICIÓN', 12, 0),
	(8, 'RECEPCIÓN QUEJA', 12, 0),
	(9, 'RECLAMACIÓN ADMINISTRATIVA', 5, 0),
	(10, 'RECURSOS DE REPOSICIÓN', 5, 0),
	(11, 'REMISIÓN DOCUMENTO', 5, 0),
	(12, 'REQUERIMIENTO ENTE CONTROL', 5, 0),
	(13, 'REQUERIMIENTO PAGO', 5, 0),
	(14, 'RESPUESTA SOLICITUD', 5, 0),
	(15, 'SOLICITUD AUTORIZACIÓN', 5, 0),
	(16, 'SOLICITUD CONSTRUCCIÓN', 5, 0),
	(17, 'SOLICITUD CUMPLIMIENTO', 5, 0),
	(18, 'SOLICITUD DOCUMENTO', 5, 0),
	(19, 'SOLICITUD ENTE DE CONTROL', 5, 0),
	(20, 'SOLICITUD ENTE JUDICIAL', 5, 0),
	(21, 'SOLICITUD INFORMACIÓN', 5, 0),
	(22, 'SOLICITUD RECONOCIMIENTO', 5, 0),
	(23, 'SOLICITUD RESPUESTA', 5, 0),
	(24, 'TRASLADO DOCUMENTAL', 5, 0),
	(25, 'TRASLADO PETICIÓN', 5, 0),
	(26, 'TRASLADO QUEJA', 5, 0),
	(27, 'TRASLADO RECLAMO', 5, 0),
	(28, 'CONVOCATORIA A CONCILIACION', 5, 0),
	(29, 'DEVOLUCION CORRESPONDENCIA', 5, 0);

-- Volcando estructura para tabla kardex.ordencompra
CREATE TABLE IF NOT EXISTS `ordencompra` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoInt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_proveedor` int NOT NULL,
  `id_usr` int NOT NULL,
  `id_cotizacion` int NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `fac_asociada` int NOT NULL DEFAULT '0',
  `formaPago` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `responsable` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fechaEntrega` date NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.ordencompra: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.paginicio
CREATE TABLE IF NOT EXISTS `paginicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_perfil` int NOT NULL,
  `contenido` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__perfiles` (`id_perfil`),
  CONSTRAINT `FK__perfiles` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.paginicio: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stMinimo` int NOT NULL DEFAULT '0',
  `stModerado` int NOT NULL DEFAULT '0',
  `stAlto` int NOT NULL DEFAULT '0',
  `codRq` int NOT NULL DEFAULT '0',
  `codFac` int NOT NULL DEFAULT '0',
  `codPed` int NOT NULL DEFAULT '0',
  `codOrdC` int NOT NULL DEFAULT '0',
  `anioActual` int NOT NULL DEFAULT '2021',
  `nameFac` int NOT NULL DEFAULT '0',
  `razonSocial` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nit` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `tel` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `correo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `direccionEnt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `repLegal` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `valorIVA` int NOT NULL,
  `validarIns` int NOT NULL DEFAULT '0',
  `validarCat` int NOT NULL DEFAULT '0',
  `codActa` int NOT NULL DEFAULT '0',
  `li` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `prueba` int DEFAULT '0',
  `extencion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `dia` int NOT NULL,
  `count` int NOT NULL,
  `codVen` int NOT NULL DEFAULT '0',
  `codCorte` int NOT NULL DEFAULT '0',
  `codRad` int NOT NULL DEFAULT '0',
  `nameRad` int NOT NULL DEFAULT '0',
  `festivos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `modomanto` int NOT NULL DEFAULT '0',
  `fechaRegistroPqr` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.parametros: ~0 rows (aproximadamente)
INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`, `codVen`, `codCorte`, `codRad`, `nameRad`, `festivos`, `modomanto`, `fechaRegistroPqr`) VALUES
	(1, 10, 20, 30, 2, 1, 1, 1, 2023, 2, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 1, 0, 1, NULL, NULL, NULL, 0, 0, 0, 18, 19, 21, '[{0:"1/enero/2022"},\r\n{1:"10/enero/2022"},\r\n{2:"21/marzo/2022"},\r\n{3:"10/abril/2022"},\r\n{4:"14/abril/2022"},\r\n{5:"15/abril/2022"},\r\n{6:"17/abril/2022"},\r\n{7:"1/mayo/2022"},\r\n{8:"30/mayo/2022"},\r\n{9:"20/junio/2022"},\r\n{10:"27/junio/2022"},\r\n{11:"4/julio/2022"},\r\n{12:"20/julio/2022"},\r\n{13:"7/agosto/2022"},\r\n{14:"15/agosto/2022"},\r\n{15:"17/octubre/2022"},\r\n{16:"7/noviembre/2022"},\r\n{17:"14/noviembre/2022"},\r\n{18:"8/diciembre/2022"},\r\n{19:"25/diciembre/2022"}]', 0, '2023-02-14 15:57:27');

-- Volcando estructura para tabla kardex.perfiles
CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int NOT NULL,
  `perfil` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.perfiles: ~10 rows (aproximadamente)
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

-- Volcando estructura para tabla kardex.permisos
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `permisos` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__usuarios` (`id_usuario`),
  CONSTRAINT `FK__usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.permisos: ~0 rows (aproximadamente)

-- Volcando estructura para tabla kardex.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL DEFAULT '0',
  `id_area` int NOT NULL,
  `id_perfil` int NOT NULL DEFAULT '3' COMMENT 'Permite visualizar los usuarios segun el modulo: ejemplo 7 es perfil juridica, con esto permitira que el usuario de un area pueda ver juridica',
  `sw` int NOT NULL DEFAULT '0' COMMENT 'Usuario principal del área ',
  PRIMARY KEY (`id`),
  KEY `FK_personas_usuarios` (`id_usuario`),
  KEY `FK_personas_areas` (`id_area`),
  KEY `FK_personas_perfiles` (`id_perfil`),
  CONSTRAINT `FK_personas_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK_personas_perfiles` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`),
  CONSTRAINT `FK_personas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.personas: ~12 rows (aproximadamente)
INSERT INTO `personas` (`id`, `id_usuario`, `id_area`, `id_perfil`, `sw`) VALUES
	(5, 9, 7, 3, 0),
	(6, 1, 1, 7, 1),
	(7, 12, 4, 7, 0),
	(9, 11, 1, 3, 0),
	(10, 18, 2, 7, 0),
	(11, 17, 3, 7, 0),
	(12, 41, 5, 7, 0),
	(13, 15, 6, 7, 0),
	(14, 21, 8, 7, 0),
	(15, 24, 9, 7, 0),
	(16, 13, 10, 7, 0),
	(17, 23, 11, 8, 0);

-- Volcando estructura para tabla kardex.pqr
CREATE TABLE IF NOT EXISTS `pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.pqr: ~8 rows (aproximadamente)
INSERT INTO `pqr` (`id`, `nombre`, `elim`) VALUES
	(1, 'PETICIÓN', 0),
	(2, 'QUEJA', 0),
	(3, 'RECLAMO', 0),
	(4, 'TUTELA', 0),
	(5, 'CTA COBRO', 0),
	(6, 'FACTURA', 0),
	(7, 'CORRESPONDENCIA', 0),
	(8, 'RECURSO', 0);

-- Volcando estructura para tabla kardex.pqr_filtro
CREATE TABLE IF NOT EXISTS `pqr_filtro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pqr` text COLLATE utf8mb4_general_ci,
  `id_per` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pqr_filtro_perfiles` (`id_per`),
  CONSTRAINT `FK_pqr_filtro_perfiles` FOREIGN KEY (`id_per`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla kardex.pqr_filtro: ~3 rows (aproximadamente)
INSERT INTO `pqr_filtro` (`id`, `id_pqr`, `id_per`) VALUES
	(1, '[{"id":"1"},{"id":"2"},{"id":"3"},{"id":"4"}]', 7),
	(2, '[{"id":"6"},{"id":"5"}]', 8),
	(3, '[{"id":"8"},{"id":"7"}]', 6),
	(10, NULL, 3),
	(14, NULL, 4);

-- Volcando estructura para tabla kardex.proveedores
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `razonSocial` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nombreComercial` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `nit` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `digitoNit` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'Sin Información',
  `direccion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'No Registra',
  `telefono` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '0',
  `contacto` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT 'Sin Info',
  `fecha` date NOT NULL,
  `correo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.proveedores: ~0 rows (aproximadamente)
INSERT INTO `proveedores` (`id`, `razonSocial`, `nombreComercial`, `nit`, `digitoNit`, `descripcion`, `direccion`, `telefono`, `contacto`, `fecha`, `correo`) VALUES
	(2, 'SOLUCIONES MAF', 'TAURO', '900236525', '5', '', '', '', '', '0000-00-00', '');

-- Volcando estructura para tabla kardex.proyectoarea
CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_proyecto` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.proyectoarea: ~3 rows (aproximadamente)
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
	(1, '[{"id":"5"},{"id":"1"},{"id":"2"}]', 5),
	(3, '[{"id":"5"},{"id":"3"}]', 6),
	(4, NULL, 7);

-- Volcando estructura para tabla kardex.proyectos
CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.proyectos: ~3 rows (aproximadamente)
INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `elim`) VALUES
	(5, 'Administrativo', '2022-06-23', '2022-06-30', 'parte administrativa', 0),
	(6, 'HOSPITALES', '2022-06-24', '2022-12-31', 'Nuevos Hospitales para el distrito de barranquilla', 0),
	(7, 'Arroyo Hospital', '2022-06-24', '2022-09-20', 'Canalización de arroyos en el hospital barranquilla', 0);

-- Volcando estructura para tabla kardex.radicados
CREATE TABLE IF NOT EXISTS `radicados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_corte` int NOT NULL DEFAULT '0' COMMENT 'numero del corte',
  `fecha` datetime NOT NULL,
  `radicado` varchar(100) NOT NULL DEFAULT '0' COMMENT 'numero del radicado para citar',
  `id_accion` int NOT NULL,
  `id_pqr` int NOT NULL,
  `id_objeto` int NOT NULL,
  `id_usr` int NOT NULL,
  `asunto` varchar(150) NOT NULL DEFAULT '',
  `id_remitente` varchar(150) NOT NULL DEFAULT '',
  `id_area` int NOT NULL,
  `observaciones` text,
  `id_articulo` int NOT NULL,
  `cantidad` int NOT NULL,
  `recibido` varchar(3) NOT NULL DEFAULT '',
  `dias` int NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `sw` int NOT NULL DEFAULT '0' COMMENT 'Muestra un boton imrpimir luego de haberse radicado radicado',
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
  CONSTRAINT `FK_radicados_accion` FOREIGN KEY (`id_accion`) REFERENCES `accion` (`id`),
  CONSTRAINT `FK_radicados_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK_radicados_articulo` FOREIGN KEY (`id_articulo`) REFERENCES `articulo` (`id`),
  CONSTRAINT `FK_radicados_objeto` FOREIGN KEY (`id_objeto`) REFERENCES `objeto` (`id`),
  CONSTRAINT `FK_radicados_pqr` FOREIGN KEY (`id_pqr`) REFERENCES `pqr` (`id`),
  CONSTRAINT `FK_radicados_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.radicados: ~48 rows (aproximadamente)
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
	(31, 23, '2022-08-10 10:34:28', '20220803273', 1, 1, 6, 1, 'PETICION AL PERTENECIENTE', '56', 4, '', 2, 1, 'ESR', 5, '2022-08-18', 0, '', '', ''),
	(32, 23, '2022-08-16 08:24:45', '20220803274', 1, 1, 6, 9, 'NOTIFICACION PREDIO PUERTO', '7', 4, '', 2, 1, 'ESR', 5, '2022-08-23', 0, '', '', 'Calle 1 13 Av Juarez'),
	(33, 23, '2022-08-16 14:04:57', '20220803275', 4, 3, 11, 9, 'AYUDAME SEÑOR A ENTENDER', 'DOÑA JUANA', 5, '', 4, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(34, 23, '2022-08-16 14:05:36', '20220803276', 6, 5, 13, 9, 'OJALA PUDIERA DEVOLVER EL TIEMPO PARA VERTE DE NUEVO', '6', 6, '', 4, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
	(35, 23, '2022-08-16 14:06:08', '20220803277', 8, 2, 9, 9, 'AQUI ESTOY', '56', 3, '', 5, 5, 'ES', 5, '2022-08-23', 0, '', '', ''),
	(36, 23, '2022-08-16 14:07:19', '20220803278', 7, 7, 22, 1, 'SI SI COLOMBIA SI SI CARIBE', '51', 3, '', 7, 1, 'ESR', 5, '2022-08-23', 0, '', '', ''),
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
	(51, 60, '2022-08-24 08:01:46', '20220804118', 5, 1, 11, 1, 'HAZIEL SI ES NECIO', '54', 1, '', 7, 1, 'KBA', 5, '2022-08-31', 0, '', '', ''),
	(52, 60, '2023-01-27 08:26:38', '20230100001', 1, 1, 6, 1, 'DERECHO DE PETICION CIRCUNVALAR FASE VI', '10', 4, '', 2, 1, 'KBA', 5, '2023-02-03', 0, '', '', ''),
	(53, 60, '2023-01-27 08:28:18', '20230100002', 1, 3, 6, 1, 'RECLAMO GENERADO POR UN PERSONAL', '24', 5, '', 1, 1, 'KBA', 5, '2023-02-03', 0, '', '', ''),
	(54, 60, '2023-01-27 08:29:12', '20230100003', 1, 2, 8, 1, 'QUEJA REALIZADA POR LOS INTEGRANTES DE ALGUNA ORGANIZACION', '51', 3, '', 4, 1, 'KBA', 12, '2023-02-14', 0, '', '', ''),
	(55, 60, '2023-02-09 09:55:33', '20230200004', 1, 6, 4, 1, 'FACTURA DE INTERNET', 'CLARO', 11, 'Cobro de internet', 5, 1, 'KBA', 7, '2023-02-20', 0, 'vistas/radicados/2023/02/09/14.pdf', 'CLARO@CLARO.COM', 'VIA 40 # 73 290 PISO 9'),
	(56, 60, '2023-02-09 09:59:06', '20230200005', 1, 1, 7, 1, 'DERECHO DE PETICIÓN  SOBRE AFECTACION DE CALZADA', '2', 6, 'SE RECIBE CD POR PARTE DE LA ENTIDAD', 2, 1, 'KBA', 12, '2023-02-27', 0, 'vistas/radicados/2023/02/09/15.pdf', '', ''),
	(57, 60, '2023-02-09 15:22:03', '20230200006', 1, 2, 8, 1, 'QUEJA POR ALGO', '', 5, '', 2, 1, 'KBA', 12, '2023-02-27', 0, 'vistas/radicados/2023/02/09/20.pdf', '', ''),
	(58, 61, '2023-02-09 15:29:38', '20230200007', 1, 3, 7, 1, 'RECLAMO DE ALGUNA COSA', '', 3, '', 2, 1, 'KBA', 12, '2023-02-27', 0, '', '', ''),
	(59, 66, '2023-02-09 15:30:38', '20230200008', 1, 4, 8, 1, 'TUTELA DE ESO', '', 4, '', 2, 1, 'KBA', 12, '2023-02-27', 0, '', '', ''),
	(60, 67, '2023-02-09 16:23:09', '20230200009', 1, 1, 7, 1, 'PETICION DE PAGO', 'BANCO GNB SUDAMERIS', 4, '', 2, 1, 'KBA', 12, '2023-02-27', 0, '', '', ''),
	(61, 68, '2023-02-13 09:46:37', '20230200010', 1, 1, 7, 1, 'PETICION GENERADA POR SUPUESTO ALGO', '57', 4, '', 2, 1, 'KBA', 12, '2023-03-01', 0, '', '', ''),
	(62, 69, '2023-02-13 09:47:34', '20230200011', 1, 2, 8, 1, 'QUEJA RADICADA', '51', 4, '', 1, 1, 'KBA', 12, '2023-03-01', 0, '', '', ''),
	(63, 70, '2023-02-13 09:51:52', '20230200012', 1, 1, 7, 1, 'PETICION DE PAGO SOLICITADA', '40', 5, '', 1, 1, 'KBA', 12, '2023-03-01', 0, '', '', ''),
	(64, 71, '2023-02-13 09:54:45', '20230200013', 1, 1, 6, 1, 'PETICION DE PAGO', '36', 4, '', 3, 1, 'KBA', 5, '2023-02-20', 0, '', '', ''),
	(65, 72, '2023-02-13 10:01:30', '20230200014', 1, 1, 7, 1, 'PETICION REALIZADA A LA ENTIDAD', '34', 4, '', 2, 1, 'KBA', 12, '2023-03-01', 0, '', '', ''),
	(66, 73, '2023-02-14 16:02:04', '20230200015', 1, 2, 3, 1, 'PETICION GENERADA POR SUPUESTO ALGO RECLARO', '27', 4, '', 2, 1, 'KBA', 5, '2023-02-21', 0, '', '', ''),
	(67, 74, '2023-02-14 16:07:32', '20230200016', 1, 4, 8, 1, 'tutela', '27', 4, '', 1, 1, 'KBA', 12, '2023-03-02', 0, '', '', ''),
	(68, 0, '2023-02-16 08:24:25', '20230200017', 1, 6, 3, 1, 'PRUEBA FACTURA', '27', 6, '', 2, 1, 'KBA', 5, '2023-02-23', 0, '', '', ''),
	(69, 0, '2023-02-16 08:24:49', '20230200018', 2, 2, 6, 1, 'PRUEBA QUEJA', '15', 3, '', 2, 1, 'KBA', 5, '2023-02-23', 0, '', '', '');

-- Volcando estructura para tabla kardex.registropqr
CREATE TABLE IF NOT EXISTS `registropqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_radicado` int NOT NULL,
  `id_area` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_estado` int NOT NULL,
  `id_pqr` int NOT NULL,
  `acciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `observacion_usuario` text COLLATE utf8mb4_general_ci,
  `observacion_encargado` text COLLATE utf8mb4_general_ci,
  `fecha_asignacion` datetime DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  `fecha_vencimiento` datetime NOT NULL,
  `dias_habiles` int NOT NULL,
  `dias_contados` int NOT NULL,
  `soporte` text COLLATE utf8mb4_general_ci,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `fecha` datetime NOT NULL COMMENT 'fecha en el que se radico, se creo esta columna para evitar mas procesamiento',
  PRIMARY KEY (`id`),
  KEY `FK__registro_radicados` (`id_radicado`),
  KEY `FK__registro_areas` (`id_area`),
  KEY `FK__registro_usuarios` (`id_usuario`),
  KEY `FK_registropqr_estado_pqr` (`id_estado`),
  KEY `FK_registropqr_pqr` (`id_pqr`),
  CONSTRAINT `FK__registro_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK__registro_radicados` FOREIGN KEY (`id_radicado`) REFERENCES `radicados` (`id`),
  CONSTRAINT `FK__registro_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_registropqr_estado_pqr` FOREIGN KEY (`id_estado`) REFERENCES `estado_pqr` (`id`),
  CONSTRAINT `FK_registropqr_pqr` FOREIGN KEY (`id_pqr`) REFERENCES `pqr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla kardex.registropqr: ~17 rows (aproximadamente)
INSERT INTO `registropqr` (`id`, `id_radicado`, `id_area`, `id_usuario`, `id_estado`, `id_pqr`, `acciones`, `observacion_usuario`, `observacion_encargado`, `fecha_asignacion`, `fecha_respuesta`, `fecha_vencimiento`, `dias_habiles`, `dias_contados`, `soporte`, `fecha_actualizacion`, `fecha`) VALUES
	(3, 54, 9, 24, 6, 2, '[{"fe":"2023-02-07","hr":"15:56","acc":"2","da":{"id":"15","nom":"Diana Romero Solano","idA":"3"}},{"fe":"2023-02-07","hr":"15:57","acc":"2","da":{"id":"24","nom":"Cesar Ibañez Marquez","idA":"9"}},{"fe":"2023-02-07","hr":"15:58","acc":"2","da":{"0":{"id":"9","rem":"AVP"}}}]', ',{"fe":"2023-02-07","hr":"15:58","id":"12","nom":"Yesid Cantillo Consuegra","obs":""}]', NULL, '2023-02-07 15:58:00', NULL, '2023-02-14 00:00:00', 12, 5, NULL, '2023-01-27 08:29:12', '2023-01-27 08:29:12'),
	(4, 53, 3, 17, 6, 3, '[{"fe":"2023-02-08","hr":"11:42","acc":"2","da":{"id":"1","nom":"Kevin Bolaño Ariza","idA":"1"}},{"fe":"2023-02-08","hr":"12:12","acc":"2","da":{"id":"41","nom":"Kimberly Cervantes","idA":"5"}},{"fe":"2023-02-08","hr":"12:45","acc":"2","da":{"id":"9","nom":"Edna Suarez Restrepo","idA":"7"}},{"fe":"2023-02-08","hr":"12:47","acc":"2","da":{"id":"21","nom":"Ricardo Perez Donado","idA":"8"}},{"fe":"2023-02-09","hr":"09:23","acc":"1","da":{"id":"17","nom":"Isabella Diaz Londoño","idA":"3"}},{"fe":"2023-02-09","hr":"09:24","acc":"2","da":{"0":{"id":"3","rem":"ALCALDÍA : B/QUILLA VERDE"}}}]', '[{"fe":"2023-02-09","hr":"09:24","id":"12","nom":"Yesid Cantillo Consuegra","obs":""}]', NULL, '2023-02-09 09:24:00', NULL, '2023-02-03 00:00:00', 5, 9, NULL, '2023-02-09 00:00:00', '2023-01-27 08:28:18'),
	(5, 52, 3, 21, 6, 1, '[{"fe":"2023-02-07","hr":"15:39","acc":"2","da":{"id":"21","nom":"Ricardo Perez Donado","idA":"3"}},{"fe":"2023-02-07","hr":"15:39","acc":"2","da":{"0":{"id":"1","rem":"A CONSTRUIR"}}}]', ',{"fe":"2023-02-07","hr":"15:39","id":"12","nom":"Yesid Cantillo Consuegra","obs":""}]', NULL, '2023-02-07 15:39:00', NULL, '2023-02-03 00:00:00', 5, 5, NULL, '2023-01-27 08:26:38', '2023-01-27 08:26:38'),
	(6, 51, 1, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-08-31 00:00:00', 5, 5, NULL, '2022-08-24 08:01:46', '2022-08-24 08:01:46'),
	(7, 56, 1, 1, 2, 1, '[{"fe":"2023-02-13","hr":"11:23","acc":"2","da":{"id":"1","nom":"Kevin Bolaño Ariza","idA":"1"}}]', '{"fe":"2023-02-13","hr":"11:23","id":"12","nom":"Yesid Cantillo Consuegra""obs":""}]', NULL, '2023-02-13 11:23:00', NULL, '2023-02-27 00:00:00', 12, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 09:59:06'),
	(8, 55, 11, 23, 5, 6, NULL, NULL, NULL, NULL, NULL, '2023-02-20 00:00:00', 7, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 09:55:33'),
	(9, 57, 5, 41, 5, 2, NULL, NULL, NULL, NULL, NULL, '2023-02-27 00:00:00', 12, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 15:22:03'),
	(10, 58, 3, 17, 5, 3, NULL, NULL, NULL, NULL, NULL, '2023-02-27 00:00:00', 12, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 15:29:38'),
	(11, 59, 4, 12, 5, 4, NULL, NULL, NULL, NULL, NULL, '2023-02-27 00:00:00', 12, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 15:30:38'),
	(12, 60, 9, 24, 2, 1, '[{"fe":"2023-02-14","hr":"15:02","acc":"2","da":{"id":"24","nom":"Cesar Ibañez Marquez","idA":"9"}}]', '{"fe":"2023-02-14","hr":"15:02","id":"12","nom":"Yesid Cantillo Consuegra""obs":""}]', NULL, '2023-02-14 15:02:00', NULL, '2023-02-27 00:00:00', 12, 3, NULL, '2023-02-14 00:00:00', '2023-02-09 16:23:09'),
	(13, 61, 4, 12, 5, 1, NULL, NULL, NULL, NULL, NULL, '2023-03-01 00:00:00', 12, 1, NULL, '2023-02-14 00:00:00', '2023-02-13 09:46:37'),
	(14, 62, 4, 12, 5, 2, NULL, NULL, NULL, NULL, NULL, '2023-03-01 00:00:00', 12, 1, NULL, '2023-02-14 00:00:00', '2023-02-13 09:47:34'),
	(15, 63, 5, 41, 5, 1, NULL, NULL, NULL, NULL, NULL, '2023-03-01 00:00:00', 12, 1, NULL, '2023-02-14 00:00:00', '2023-02-13 09:51:52'),
	(16, 64, 4, 12, 5, 1, NULL, NULL, NULL, NULL, NULL, '2023-02-20 00:00:00', 5, 1, NULL, '2023-02-14 00:00:00', '2023-02-13 09:54:45'),
	(17, 65, 4, 12, 5, 1, NULL, NULL, NULL, NULL, NULL, '2023-03-01 00:00:00', 12, 1, NULL, '2023-02-14 00:00:00', '2023-02-13 10:01:30'),
	(18, 66, 4, 12, 5, 2, NULL, NULL, NULL, NULL, NULL, '2023-02-21 00:00:00', 5, 0, NULL, '2023-02-14 16:02:04', '2023-02-14 16:02:04'),
	(19, 67, 4, 12, 5, 4, NULL, NULL, NULL, NULL, NULL, '2023-03-02 00:00:00', 12, 0, NULL, '2023-02-14 16:07:32', '2023-02-14 16:07:32'),
	(20, 69, 3, 17, 5, 2, NULL, NULL, NULL, NULL, NULL, '2023-02-23 00:00:00', 5, 0, NULL, '2023-02-16 08:24:49', '2023-02-16 08:24:49');

-- Volcando estructura para tabla kardex.remitente
CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla kardex.remitente: ~54 rows (aproximadamente)
INSERT INTO `remitente` (`id`, `nombre`, `telefono`, `correo`, `direccion`) VALUES
	(1, 'A CONSTRUIR', NULL, NULL, NULL),
	(2, 'ALCALDIA DE B/QUILLA :SECRETARÍA DISTRITAL DE HACIENDA ', NULL, NULL, NULL),
	(3, 'ALCALDÍA : B/QUILLA VERDE', NULL, NULL, NULL),
	(4, 'ALCALDÍA DE B/QUILLA : CONTROL URBANO Y ESPACIO PÚBLICO ', NULL, NULL, NULL),
	(5, 'ALCALDÍA DE B/QUILLA : SECRETARÍA DE OBRAS PÚBLICAS', NULL, NULL, NULL),
	(6, 'ALCALDÍA DE B/QUILLA SECRETARÍA GENERAL', NULL, NULL, NULL),
	(7, 'ALCALDIA DE BARRANQUILLA / SECRETARIO DE OBRAS PUBLICAS', NULL, NULL, NULL),
	(8, 'AREA ADMINISTRATIVA ', NULL, NULL, NULL),
	(9, 'AVP', NULL, NULL, NULL),
	(10, 'BANCO GNB SUDAMERIS', NULL, NULL, NULL),
	(11, 'BANCOLOMBIA ', NULL, NULL, NULL),
	(12, 'BLACO & BLANCO LTDA', NULL, NULL, NULL),
	(13, 'CAMARA DE COMERCIO DE COMERCIO', NULL, NULL, NULL),
	(14, 'CONSORCIO A 1 A', NULL, NULL, NULL),
	(15, 'CONSORCIO AVENIDA AL RIO', NULL, NULL, NULL),
	(16, 'CONSORCIO ECO BARRANQUILLA', NULL, NULL, NULL),
	(17, 'CONSORCIO INTERVENTOR PARQUES DEL ATLÁNTICO - CONSORCIO IPDA', NULL, NULL, NULL),
	(18, 'CONSORCIO MALECON LEON CARIDI', NULL, NULL, NULL),
	(19, 'CONSORCIO MEC - AV. MALECOM - UF 1', NULL, NULL, NULL),
	(20, 'CONSORCIO MEC-AV.MALECON - UF 2', NULL, NULL, NULL),
	(21, 'CONSORCO ACI 01', NULL, NULL, NULL),
	(22, 'CONSTRUCTORA FG S.A.', NULL, NULL, NULL),
	(23, 'CORPORACION LONJA DE PROPIEDAD RAIZ', NULL, NULL, NULL),
	(24, 'DICONSULTORIA S.A.', NULL, NULL, NULL),
	(25, 'DIRECCION DE LIQUIDACIONES /ALCALDIA DE BARRANQUILLA', NULL, NULL, NULL),
	(26, 'DISTRITO ESPECIAL E INDUSTRIAL DE BARRANQUILLA', NULL, NULL, NULL),
	(27, 'EL BOLETIN JURIDICO.COM.CO', NULL, NULL, NULL),
	(28, 'GOBERNACIÓN DEL DEL ATLÁNTICO ', NULL, NULL, NULL),
	(29, 'ICE - INGENIEROS CIVILES ESPECIALISTAS', NULL, NULL, NULL),
	(30, 'INEICA LTDA', NULL, NULL, NULL),
	(31, 'INSAR S.A.S', NULL, NULL, NULL),
	(32, 'INTERRAPIDISMO - BANCO AGRARIO', NULL, NULL, NULL),
	(33, 'LEALTAD Y CUMPLIMIENTO SAS', NULL, NULL, NULL),
	(34, 'NOTARIA 9°DE B/QUILLA', NULL, NULL, NULL),
	(35, 'RENTING COLOMBIA', NULL, NULL, NULL),
	(36, 'SAFRI S.A.S', NULL, NULL, NULL),
	(37, 'SECRETARIA DE HACIENDA DISTRITAL', NULL, NULL, NULL),
	(38, 'SERVIENTREGA CENTRO DE SOLUCIONES', NULL, NULL, NULL),
	(39, 'SINTH S.A.S', NULL, NULL, NULL),
	(40, 'TALENTO HUMANO ', NULL, NULL, NULL),
	(41, 'TALENTOS HUMANOS', NULL, NULL, NULL),
	(42, 'UNION TEMOPORAL VIA 40', NULL, NULL, NULL),
	(43, 'UNION TEMPORAL AURORA-SPORAS', NULL, NULL, NULL),
	(44, 'UNION TEMPORAL CARIBE', NULL, NULL, NULL),
	(45, 'UNIÓN TEMPORAL ESPACIOS URBANOS 2020', NULL, NULL, NULL),
	(46, 'UNIÓN TEMPORAL GRAN MALECON', NULL, NULL, NULL),
	(47, 'UNIÓN TEMPORAL GRAN VÍA R90', NULL, NULL, NULL),
	(48, 'UNIÓN TEMPORAL PARQUES VI', NULL, NULL, NULL),
	(49, 'VALORCON S.A.', NULL, NULL, NULL),
	(51, 'Kevin Londoño', NULL, NULL, NULL),
	(52, 'Susana Martinez', NULL, NULL, NULL),
	(54, 'ALCALDÍA : B/QUILLA ROJA', NULL, NULL, NULL),
	(55, 'SECRETARIA DE MOVILIDAD MAGDALENA', NULL, NULL, NULL),
	(56, 'ANGELINA JOLIE', NULL, NULL, NULL),
	(57, 'CLARO', NULL, NULL, NULL);

-- Volcando estructura para tabla kardex.requisiciones
CREATE TABLE IF NOT EXISTS `requisiciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area` int NOT NULL,
  `id_persona` int NOT NULL,
  `id_usr` int NOT NULL,
  `codigoInt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_sol` datetime NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `id_proyecto` int NOT NULL DEFAULT '1',
  `aprobado` int NOT NULL DEFAULT '0',
  `observacionE` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `registro` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `gen` int DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_requisiciones_areas` (`id_area`),
  KEY `FK_requisiciones_usuarios` (`id_usr`),
  KEY `FK_requisiciones_usuarios_2` (`id_persona`),
  KEY `FK_requisiciones_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_requisiciones_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK_requisiciones_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`),
  CONSTRAINT `FK_requisiciones_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.requisiciones: ~21 rows (aproximadamente)
INSERT INTO `requisiciones` (`id`, `id_area`, `id_persona`, `id_usr`, `codigoInt`, `insumos`, `fecha`, `fecha_sol`, `observacion`, `id_proyecto`, `aprobado`, `observacionE`, `registro`, `gen`) VALUES
	(1, 1, 1, 3, 'RQ-001-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"1"},{"id":"6","des":"BANDEJA PORTA DOCUMENTOS","ped":"4","ent":"1"}]', '2022-08-09 00:00:00', '2022-08-09 00:00:00', 'Todo bien todo bacano', 5, 1, NULL, 'BANDEJA PORTA DOCUMENTOS con codigo 6, tiene menor stock al solicitado.:', 1),
	(2, 1, 1, 1, 'RQ-002-2022', '[{"id":"11","des":"BOLSA BASURA VERDE 42*47CMS ","ped":"1","ent":"2"},{"id":"10","des":"BOLSA BASURA NEGRA X 90*110 ","ped":"1","ent":"1"}]', '2022-08-25 17:05:13', '2022-08-10 00:00:00', '', 5, 1, '', '', 1),
	(3, 1, 1, 1, 'RQ-003-2022', '[{"id":"81","des":"MOUSE USB","ped":"1","ent":"1"}]', '2022-08-17 16:25:52', '2022-08-17 15:54:04', '', 5, 1, '', '', 1),
	(4, 1, 1, 1, 'RQ-004-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"0"}]', '2022-08-25 17:05:44', '2022-08-17 16:07:52', '', 5, 2, '', '', 1),
	(5, 1, 11, 3, 'RQ-005-2022', '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"2","ent":"2"}]', '2022-09-30 00:01:00', '2022-08-25 15:38:50', NULL, 5, 1, '', '', 1),
	(6, 1, 1, 3, 'RQ-006-2022', '[{"id":"3","des":"ATOMIZADOR AMBIENTADOR LAVANDA ","ped":"1","ent":"0"}]', '2022-09-16 14:59:00', '2022-08-30 14:40:32', '', 5, 1, '', 'ATOMIZADOR AMBIENTADOR LAVANDA  con Codigo 3, no tiene stock.:', 1),
	(7, 1, 1, 3, 'RQ-007-2022', '[{"id":"8","des":"BOLIGRAFO  ROJO ","ped":"14","ent":"5"},{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"14","ent":"5"},{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"1","ent":"1"},{"id":"2","des":"AROMATICA SURTIDA EN BOLSA","ped":"1","ent":"1"},{"id":"6","des":"BANDEJA PORTA DOCUMENTOS","ped":"1","ent":"1"},{"id":"7","des":"BLANQUEADOR (LIMPIDO)","ped":"1","ent":"1"}]', '2022-09-16 14:48:00', '2022-08-30 14:40:53', '', 5, 1, '', 'ATOMIZADOR AMBIENTADOR LAVANDA  con Codigo 3, no tiene stock.:', 1),
	(8, 1, 1, 3, 'RQ-008-2022', '[{"id":"8","des":"BOLIGRAFO  ROJO ","ped":"14","ent":"5"},{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"14","ent":"5"},{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"1","ent":"1"},{"id":"2","des":"AROMATICA SURTIDA EN BOLSA","ped":"1","ent":"1"},{"id":"6","des":"BANDEJA PORTA DOCUMENTOS","ped":"1","ent":"1"},{"id":"7","des":"BLANQUEADOR (LIMPIDO)","ped":"1","ent":"1"}]', '2022-08-18 10:30:00', '2022-08-16 08:26:00', '', 5, 1, NULL, NULL, 0),
	(9, 1, 1, 3, 'RQ-009-2022', '[{"id":"8","des":"BOLIGRAFO  ROJO ","ped":"1","ent":"1"}]', '2022-09-16 15:28:00', '2022-09-16 15:28:00', '', 5, 1, NULL, NULL, 0),
	(10, 1, 1, 3, 'RQ-010-2022', '[{"id":"2","des":"AROMATICA SURTIDA EN BOLSA","ped":"1","ent":"1"}]', '2022-09-16 16:52:00', '2022-09-16 15:52:00', 'Prueba 1000', 5, 1, NULL, NULL, 0),
	(11, 1, 1, 1, 'RQ-011-2022', '[{"id":"22","des":"CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL","ped":"15"},{"id":"136","des":"TONER NEGRO TK-3132 (4300)","ped":"2"}]', '0000-00-00 00:00:00', '2022-09-26 16:41:04', NULL, 5, 0, '', NULL, 1),
	(12, 1, 1, 3, 'RQ-012-2022', '[{"id":"58","des":"HP 711 CYAN","ped":"5","ent":"4"},{"id":"161","des":"TINTA EPSON MAGENTA 544","ped":"7","ent":"1"}]', '2022-09-26 16:47:00', '2022-09-26 16:44:02', '', 5, 1, '', 'HP 711 CYAN con codigo 58, tiene menor stock al solicitado.:TINTA EPSON MAGENTA 544 con codigo 161, tiene menor stock al solicitado.:', 1),
	(13, 1, 1, 3, 'RQ-013-2022', '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"5","ent":"5"},{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"5","ent":"0"}]', '2022-09-26 16:47:00', '2022-09-26 16:47:00', '', 5, 1, NULL, NULL, 0),
	(14, 1, 1, 3, 'RQ-014-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"1"}]', '2022-09-26 16:48:00', '2022-09-26 16:48:00', '', 5, 1, NULL, NULL, 0),
	(15, 1, 1, 3, 'RQ-015-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"5","ent":"3"}]', '2022-09-26 16:49:00', '2022-09-26 16:49:00', '', 5, 1, NULL, NULL, 0),
	(16, 1, 1, 1, 'RQ-016-2022', '[{"id":"18","des":"CD-R ","ped":"1","ent":0},{"id":"135","des":"TONER NEGRO TK-3122 (4200)","ped":"1","ent":0}]', '0000-00-00 00:00:00', '2022-09-26 16:57:40', NULL, 5, 0, '', NULL, 1),
	(17, 1, 1, 3, 'RQ-017-2022', '[{"id":"22","des":"CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL","ped":"1","ent":"1"},{"id":"39","des":"DVD +R ","ped":"1","ent":"1"}]', '2022-09-27 14:12:00', '2022-09-27 14:09:12', '', 5, 1, '', '', 1),
	(18, 1, 1, 3, 'RQ-018-2022', '[{"id":"22","des":"CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL","ped":"1","ent":"1"},{"id":"39","des":"DVD +R ","ped":"1","ent":"1"}]', '2022-09-27 14:11:00', '2022-09-27 14:09:23', '', 5, 1, '', '', 1),
	(19, 1, 1, 3, 'RQ-019-2022', '[{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"1","ent":"1"}]', '2022-09-27 14:12:00', '2022-09-27 14:12:00', '', 5, 1, NULL, NULL, 0),
	(20, 1, 1, 1, 'RQ-020-2022', '[{"id":"1","des":"AMBIENTADOR DE BAÑO AIR WICK","ped":"5","ent":"5"},{"id":"4","des":"AZUCAR ALTA PUREZA 200 TUBITOS DE 5G","ped":"5","ent":"5"},{"id":"116","des":"TINTA EPSON 664 COLOR AMARILLO","ped":"1","ent":"0"},{"id":"117","des":"TINTA EPSON 664 COLOR CYAN","ped":"2","ent":"0"},{"id":"18","des":"CD-R ","ped":"2","ent":"0"}]', '2022-09-28 08:46:00', '2022-09-28 08:45:29', 'Mensaje de la Encargada', 5, 3, 'Este es el mensaje del encargado', '', 1),
	(21, 1, 1, 1, 'RQ-021-2022', '[{"id":"18","des":"CD-R ","ped":"1","ent":"1"},{"id":"154","des":"FUNDA PARA CD","ped":"5","ent":"5"},{"id":"22","des":"CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL","ped":"1","ent":"1"}]', '2022-10-05 12:07:00', '2022-10-04 17:14:58', 'compras modificacion', 5, 3, 'la verdad no queria esos insumos', '', 1),
	(22, 1, 1, 1, 'RQ-001-2023', '[{"id":"18","des":"CD-R ","ped":"1","ent":0}]', '0000-00-00 00:00:00', '2023-01-31 11:32:31', NULL, 5, 0, '', NULL, 1);

-- Volcando estructura para tabla kardex.tempdatosrq
CREATE TABLE IF NOT EXISTS `tempdatosrq` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `fecha` date DEFAULT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.tempdatosrq: ~0 rows (aproximadamente)
INSERT INTO `tempdatosrq` (`id`, `nombre`, `fecha`, `observacion`) VALUES
	(1, 'KEVIN BOLAÑO', '2021-05-20', NULL);

-- Volcando estructura para tabla kardex.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `perfil` int NOT NULL DEFAULT '4',
  `foto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `correo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `estado` int DEFAULT '1',
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sid_ext` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `elim` int NOT NULL DEFAULT '0',
  `try` int NOT NULL DEFAULT '0',
  `id_area` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_perfiles` (`perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.usuarios: ~54 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `correo`, `estado`, `ultimo_login`, `fecha`, `sid`, `sid_ext`, `elim`, `try`, `id_area`) VALUES
	(1, 'Kevin Bolaño Ariza', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 1, NULL, 'kevin.bolano@edubar.com.co', 1, '2023-02-16 08:24:17', '2021-02-11 10:06:49', 'nf7a88ihjcg46o4g6bcddv5vpk', '339049c70f36fb36acbdbbccf6a738724da5d549', 0, 0, 1),
	(2, 'Carmen Rebolledo', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 3, NULL, 'carmen.rebolledo@edubar.com.co', 1, '2022-09-19 10:05:50', '2021-08-19 11:12:33', 'oho1qf3bfejuhvhrrqbpe0drbt', '8aeac4f855c50abf9960bd423dc16a80cd60e130', 0, 0, 0),
	(3, 'Karelly Moreno Llorente', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 3, NULL, 'karelly.moreno@edubar.com.co', 1, '2023-01-30 18:04:33', '2021-08-19 11:12:39', '4cmimrb08dq4hatpqes8o09dc4', 'db2cbd286ad47de3caef2d9fe1b990b67ae01d5e', 0, 0, 0),
	(9, 'Edna Suarez Restrepo', 'ednasuarez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 6, NULL, 'edna.suarez@edubar.com.co', 1, '2022-08-23 10:37:42', '2022-06-23 21:03:37', 'me1ke295ilip8imleg14g668c3', NULL, 0, 0, 1),
	(10, 'Peter Zahn Colmenares', 'peterz', '$2a$07$asxx54ahjppf45sd87a5audhKBwo8xk9XJMPoAAiZTYGH13ARqu8O', 4, NULL, 'peter.zahn@edubar.com.co', 1, '2022-06-24 08:01:42', '2022-06-23 22:06:28', 'fd94agrc2l1isi90r49kcjo6k6', NULL, 0, 0, 1),
	(11, 'Fernando Barcelo Bercelo', 'fbarcelo', '$2a$07$asxx54ahjppf45sd87a5auFuIwlfJLphOvP9e1fjwMhkIma7jyw0i', 4, NULL, 'fernando.barcelo@edubar.com.co', 1, '2023-02-15 11:50:38', '2022-06-24 13:07:00', 'aiq8aaf2709ocvjdppv8n46c6b', '145ed27e6099de0c9056a63eaa8c722d3727c1a0', 0, 0, 1),
	(12, 'Yesid Cantillo Consuegra', 'ycantillo', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 7, NULL, 'yesid.cantillo@edubar.com.co', 1, '2023-02-14 16:10:42', '2022-07-12 19:14:55', 'bm98cjpgg3hohn56ge2eo86svm', 'bc1792d24df58207a830273338a3fc46d6c3e9b5', 0, 0, 1),
	(13, 'Angelly Criales Anibal', 'angelly.criales@edubar.com.co', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'angelly.criales@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-08-29 15:41:46', NULL, NULL, 0, 0, 1),
	(14, 'Belkys Perez', 'belkysperez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 6, NULL, 'belkys.perez@edubar.com.co', 1, '2022-09-08 14:07:36', '2022-09-08 19:04:17', 'clrbjocccm4e3837ckgvspqfml', NULL, 0, 0, 0),
	(15, 'Diana Romero Solano', 'dianaromero', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'diana.romero@edubar.com.co', 1, '2022-12-06 12:23:57', '2022-08-27 01:02:26', 'ccb27b4de99f81688e46bdbfd09f27d4', '3a2662a934b4072388a24057b723bd311a7c2110', 0, 0, 1),
	(16, 'Ligia Mizuno Bustamante', 'ligiamizuno', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'ligia.mizuno@edubar.com.co', 0, '0000-00-00 00:00:00', '2022-08-27 01:03:08', NULL, NULL, 0, 0, 0),
	(17, 'Isabella Diaz Londoño', 'isabelladiaz', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'isabella.diaz@edubar.com.co', 1, '2023-01-10 10:46:59', '2022-08-27 01:04:03', '7f3d2645ad9eeaee14cea3057a0d0823', '7ebe322ccbc0e8db33c0ade09444210627b2ae88', 0, 0, 1),
	(18, 'Kimberly Lozano Serpa', 'kimberlylozano', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'kimberly.lozano@edubar.com.co', 1, '2022-12-29 18:18:14', '2022-08-27 01:34:37', '762e4f209b42dc725d02eb860c743bbe', '6a3d49905d85e68b414e81d69995ef75252dbaa8', 0, 0, 1),
	(19, 'Angelly Criales Anibal', 'angellycriales', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'angelly.criales@edubar.com.co', 0, '0000-00-00 00:00:00', '2022-08-29 20:43:53', NULL, NULL, 0, 0, 0),
	(20, 'Carmen Herrera Recuero', 'carmenherrera', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'carmen.herrera@edubar.com.co', 0, '0000-00-00 00:00:00', '2022-08-29 20:45:20', NULL, NULL, 0, 0, 0),
	(21, 'Ricardo Perez Donado', 'ricardoperez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'ricardo.perez@edubar.com.co', 0, '0000-00-00 00:00:00', '2022-08-29 20:51:00', NULL, NULL, 0, 0, 1),
	(22, 'María Teresa Ruiz Martinez', 'mariateresaruiz', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'mariateresa.ruiz@edubar.com.co', 1, '2022-12-13 10:52:13', '2022-08-29 21:55:14', 'b7982ac63ee154e140e5d4110e39d0d5', 'ecaa930356136eb2dcf2febd8cb660db51de7391', 0, 0, 0),
	(23, 'Kendy Carolina Gómez Jiménez', 'kendygomez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'kendy.gomez@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-08-29 21:56:38', NULL, NULL, 0, 0, 1),
	(24, 'Cesar Ibañez Marquez', 'cesaribanez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'cibanez@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-08-29 21:59:32', NULL, NULL, 0, 0, 1),
	(25, 'Belkys Perez Lopez', 'belkysperez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 6, NULL, 'belkys.perez@edubar.com.co', 1, '2023-01-24 16:36:24', '2022-08-29 22:00:47', '23b056089515104dc4eaa05e84decec4', '9359b657cdc5c97380ca39bd7d06f3d0e6ac446b', 0, 0, 0),
	(26, 'Jeisson Ponce  Ebrath', 'jeissonponce', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'jeison.ponce@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-08-29 22:04:09', NULL, NULL, 0, 0, 0),
	(27, 'Danna Rada rey', 'dannarada', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'danna.rada@edubar.com.co', 1, '2022-12-27 11:49:24', '2022-08-31 00:24:09', 'c6e770f7b621d3cbc1b1b78f80d76058', 'e52810536cd1242a48a367fa17b08fcb3395e2af', 0, 0, 0),
	(28, 'Pedro Caballero', 'pedrocaballero', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'pedro.caballero@edubar.com.co', 1, '2023-01-17 09:06:03', '2022-08-31 00:27:04', '0b009d871c8d515b40016145d142ae46', 'd6ce7c5394ff4a92837392e85cd95c4d44d3ccf7', 0, 0, 0),
	(29, 'Alvaro Delgado', 'alvarodelgado', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'alvaro.delgado@edubar.com.co', 1, '2022-12-30 09:27:21', '2022-09-01 20:29:07', '75575b5c64da7bcbc270f44de4af5189', 'bd40690df125959e0df5fc4c127dc6583bc53d17', 0, 1, 0),
	(30, 'Yosury Mercado', 'yosurymercado', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'kimberly.lozano@edubar.com.co', 1, '2022-10-19 08:43:29', '2022-09-02 02:42:53', '62d0b5afa10abb5fb3ccaa24cbf3642c', '2f0674bfa49d047ec514c2018d926607eac98357', 0, 0, 0),
	(31, 'Valentina Barrios', 'valentinabarrios', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'valentina.barrios@edubar.com.co', 1, '2022-09-14 10:18:12', '2022-09-05 20:55:28', '6dd2196516a5e3082a1313a570338f14', NULL, 0, 0, 0),
	(32, 'Andrea Escorcia', 'andreaescorcia', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'andrea.escorcia@edubar.com.co', 1, '2023-01-25 14:59:44', '2022-09-05 20:56:07', '4855bd1cb7e5f73b468683bf0869fb1d', 'eba1b41af1e60cfb643772f21720a0b754a4ac3e', 0, 0, 0),
	(33, 'Libi Perez', 'libiPerez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'libi.perez@edubar.com.co', 1, '2023-01-13 09:55:26', '2022-09-06 00:16:32', '170be2074bcb5aa1dfdd1fea1ceec561', '9c4f291d719bc9a117ef613b5f3c3dd571d404d9', 0, 0, 0),
	(34, 'Maria Del Carmen Argumedo', 'mariaargumedo', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'maria.argumendo@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-09-06 01:51:40', NULL, NULL, 0, 0, 0),
	(35, 'Andres Romero', 'andresromero', '$2a$07$asxx54ahjppf45sd87a5aueFh0.UKF2HanDMxIOfJOuFMpEDmKbuO', 4, NULL, 'andres.romero@edubar.com.co', 1, '2023-01-18 09:53:43', '2022-09-06 02:38:37', 'df4e31ee86dba92b167b7436df4723a0', '86ac54d202d39d4c965b69fb3c7081c5af6c65b2', 0, 0, 0),
	(36, 'Juan Camilo Manotas', 'juancmanotas', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'juan.manotas@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-09-06 02:39:28', NULL, NULL, 0, 0, 0),
	(37, 'Eider Rodriguez', 'eiderrodriguez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'eider.rodriguez@edubar.com.co', 1, '2022-09-09 10:21:27', '2022-09-06 02:43:20', 'efe5083a80952d8988716a540312b3b5', NULL, 0, 0, 0),
	(38, 'Kevin Salazar', 'kevinsalazar', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'kevin.salazar@edubar.com.co', 1, '2022-10-18 15:08:38', '2022-09-06 02:45:10', 'e2328de3ed836e483771369169b44ada', '2023a2347844b7d0bd608ccec5b3d3f15c8056d4', 0, 0, 0),
	(39, 'Jassiel Hernandez', 'jassielhernandez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'jassiel.hernandez@edubar.com.co', 1, '2022-12-01 08:46:31', '2022-09-06 02:45:47', '06c207464d9985ab03394f6841b120c8', '50051726a5457d87ab24bdc8c189f092310215fd', 0, 0, 0),
	(40, 'Diego Rada', 'diegorada', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'diego.rada@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-09-06 02:46:15', NULL, NULL, 0, 0, 0),
	(41, 'Kimberly Cervantes', 'kimberlycervantes', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'kimberly.cervantes@edubar.com.co', 1, '2023-01-13 12:27:46', '2022-09-13 20:29:58', '0bf46fbb33b924a7f8e1525a3362cc32', '3a6fcd4741eef9f3ccf40e44692cb72983881a0d', 0, 0, 1),
	(42, 'Nugeth Ucros', 'nugethucros', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'nugeth.ucros@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-09-21 01:49:19', NULL, NULL, 0, 0, 0),
	(43, 'JUAN SAMPER', 'juansamper', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'juan.samper@edubar.com.co', 1, '2022-09-30 09:06:23', '2022-09-29 20:26:15', '3e2240ce33c86c6cd325628c829e0bd0', '5b1513739d3b93e7b0c65992096892ecf38f601d', 0, 0, 0),
	(44, 'Cristian Murillo', 'cristianmurillo', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'cristian.murillo@edubar.com.co', 1, '2022-10-04 09:40:11', '2022-10-04 03:13:30', '888553971cc03b7246cefd4792e8657a', '5b009d0b7a9e18d966a874eebdcddeea846b75ab', 0, 0, 0),
	(45, 'Marla Mendoza', 'marlamendoza', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'marla.mendoza@edubar.com.co', 1, '2022-10-04 09:18:50', '2022-10-04 19:15:09', '9dd69f381aa833a717e2dee15574dd2f', '2f476ce02f9947400c04dfdff620ad7d86d82788', 0, 0, 0),
	(46, 'Angelica Marimon', 'angelicamarimon', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'angelica.marimon@edubar.com.co', 1, '2023-01-20 10:16:18', '2022-10-05 01:28:43', '1c637fad9dfa457adb6d536b08d24248', '0304e0b3c0df697a7ee0f7017e612012d3ff90ef', 0, 0, 0),
	(47, 'Julián Perez', 'julianperez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'julian.perez@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-10-12 19:41:16', NULL, NULL, 0, 0, 0),
	(48, 'Andrea Espitia ', 'andreaespitia', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'andrea.espitia@edubar.com.co', 1, '2023-01-20 09:15:09', '2022-10-12 19:42:08', 'dd7f7dfc58c0ece7a32595a73c2e1603', '6ccb91a588640ccfea416219b6bbf75ee9c19d37', 0, 0, 0),
	(49, 'Carlos Florez', 'carlosflorez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, NULL, 'carlos.florez@edubar.com.co', 1, '2022-10-27 10:37:15', '2022-10-18 20:31:49', '34410479daabf378d8e65f0f56868875', 'bc62056a9e52d34558adc713001fbb4b84997f4e', 0, 0, 0),
	(50, 'Jorge Acero', 'jorgeacero', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'jorge.acero@edubar.com.co', 1, '2023-01-04 11:26:21', '2022-10-18 22:06:17', 'eb667c07960e5c4d4abdca76bd9f9a13', 'e1c5507093f71d4d490f5d706abbbc7e45e46885', 0, 0, 0),
	(51, 'Estefani Corcho', 'estefanicorcho', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'estefani.corcho@edubar.com.co', 1, '2022-10-19 16:20:15', '2022-10-20 01:23:40', 'a11c3e5b028de901340bc07c56f0425d', '7ae35f1a37ce3dd00f36fd3e2f58882e73daaba3', 0, 0, 0),
	(52, ' Eileen Torres', 'eileentorres', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'eileen.torres@edubar.com.co', 1, '2023-01-18 09:21:56', '2022-10-20 19:14:22', 'b256076d10896fb1fe690018959bb121', '25c058dec465eee86c8f407240adde57f4eb317b', 0, 0, 0),
	(53, 'Paola Figueroa', 'paolafigueroa', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'paola.figueroa@edubar.com.co', 1, '2022-12-26 08:59:40', '2022-10-24 20:43:02', 'da0fda92ec14be0887ac295aeedb0977', '0597051696ba91de14afa16e64175aa3331a37de', 0, 0, 0),
	(54, 'Merlin Lozano', 'merlinlozano', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'merlin.lozano@edubar.com.co', 1, '2023-01-10 14:55:24', '2022-10-27 00:27:36', '0732b73fe5b35d3c83a204956047c069', '6bb20d1a9d3a304bf1d3a1411de232c00807dbe8', 0, 0, 0),
	(55, 'Anyelyn Orozco', 'anyelynorozco', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'anyelyn.orozco@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-11-02 22:08:02', NULL, NULL, 0, 0, 0),
	(56, 'Ivan Lopéz', 'ivanlopez', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'ivan.lopez@edubar.com.co', 1, '2022-12-14 08:50:19', '2022-11-09 20:20:22', '0843936075a8abf4c87395b484ee94c6', 'c817f2c2235aca49cf9e3c04eb7a340f767fd2df', 0, 0, 0),
	(57, 'Grace Rojano', 'gracerojano', '$2a$07$asxx54ahjppf45sd87a5au7M7ZfVxcjCcaSQOeGv6L9FmSZrXr/s6', 4, NULL, 'grace.rojano@edubar.com.co', 1, '2022-11-21 10:55:57', '2022-11-21 20:28:02', 'e5dd2c2301986c3b3c2f2a4fb18909a2', '3fbb39a9fd0270837349dcb9c0106705d1edeec1', 0, 0, 0),
	(58, 'Alejandra Barrozo', 'alejandrabarrozo', '$2a$07$asxx54ahjppf45sd87a5auT1UAAEAvMZf.Uz17bs4H08qCrxCpA/S', 4, '', 'alejandra.barrozo@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-11-21 20:30:35', NULL, NULL, 0, 0, 0),
	(59, 'Jaasiel Hernandez', 'jaasielh', '$2a$07$asxx54ahjppf45sd87a5au17Rma8fBHqQFNXNkob6Rm32TKek6HLK', 4, '', 'jaasiel.hernandez@edubar.com.co', 1, '0000-00-00 00:00:00', '2022-11-26 00:29:20', NULL, NULL, 0, 0, 0);

-- Volcando estructura para tabla kardex.valores
CREATE TABLE IF NOT EXISTS `valores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_insumo` int NOT NULL,
  `registro` text,
  `tipo` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Muestra los cambios de valores que lleva un insumo a lo largo del tiempo.';

-- Volcando datos para la tabla kardex.valores: ~2 rows (aproximadamente)
INSERT INTO `valores` (`id`, `id_insumo`, `registro`, `tipo`) VALUES
	(1, 2, NULL, 1),
	(4, 1, '[{"val":"500","fe":"2022-08-07"},{"val":"800","fe":"2022-08-08"},{"val":"1700","fe":"2022-08-09"},{"val":"1000","fe":"2022-08-12"}]', 1);

-- Volcando estructura para tabla kardex.ventas
CREATE TABLE IF NOT EXISTS `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigoInt` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `codigo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_usr` int NOT NULL,
  `id_cli` int NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL,
  `iva` float NOT NULL,
  `observacion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.ventas: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
