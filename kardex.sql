-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2021 a las 00:09:19
-- Versión del servidor: 10.4.20-MariaDB
-- Versión de PHP: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kardex`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `id` int(5) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  `id_usr` int(5) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `fechaSal` date DEFAULT NULL,
  `fechaEnt` date DEFAULT NULL,
  `autorizado` text COLLATE utf8_spanish_ci NOT NULL,
  `dependencia` text COLLATE utf8_spanish_ci NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `dependenciaR` text COLLATE utf8_spanish_ci NOT NULL,
  `motivo` int(1) NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `listainsumos` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `actas`
--

INSERT INTO `actas` (`id`, `codigoInt`, `tipo`, `id_usr`, `fecha`, `fechaSal`, `fechaEnt`, `autorizado`, `dependencia`, `responsable`, `dependenciaR`, `motivo`, `observacion`, `listainsumos`) VALUES
(1, 'ACT-001-2021', 1, 1, '2021-09-07', '2021-09-07', '2021-09-10', 'Fernando', 'Sis', 'Kevin', 'Estanco', 3, '', '[{\"sn\":\"xcvfbgtfc\",\"mc\":\"Hp\",\"des\":\"Computador\",\"can\":\"1\",\"obs\":\"N/A\"}]'),
(2, 'ACT-002-2021', 1, 1, '2021-09-10', '2021-09-10', '2021-09-17', 'Kevin', 'Sistemas', 'Karelly', 'Compras', 4, '', '[{\"sn\":\"CVFBGHT\",\"mc\":\"Genius\",\"des\":\"Parlantes\",\"can\":\"2\",\"obs\":\"N/A\"},{\"sn\":\"AXCDV54\",\"mc\":\"Dell\",\"des\":\"Monitor\",\"can\":\"1\",\"obs\":\"N/A\"}]'),
(3, 'ACT-003-2021', 2, 1, '2021-09-10', NULL, '2021-09-12', 'Peter Zahn', 'Sistemas', 'Fernando', 'Estilista', 4, '', '[{\"sn\":\"NMJKULI89\",\"mc\":\"Dell\",\"des\":\"Portatil 2gb Ram\",\"can\":\"2\",\"obs\":\"N/A\"}]'),
(4, 'ACT-004-2021', 3, 1, '2021-09-17', NULL, '2021-09-17', 'Kevin Bolaño', 'Sistemas', 'Juan Samper', 'Área Técnica', 1, '', '[{\"sn\":\"CJDVUFU5\",\"mc\":\"Hp\",\"des\":\"Monitor de 15&quot, Todo En uno\",\"can\":\"1\",\"obs\":\"N/A\"}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexosprov`
--

CREATE TABLE `anexosprov` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `id_carpeta` int(11) NOT NULL,
  `elim` int(11) NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL,
  `ruta` text COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT '\'Sin Información\'',
  `elim` int(11) NOT NULL DEFAULT 0,
  `cat_asociadas` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
(1, 'Sistemas', '&quotEncargados del àrea de Sistemas&quot', 0, ''),
(2, 'Contratación', 'Personal de Contratación', 0, ''),
(3, 'Reasentamiento', 'Abogados unidos', 0, ''),
(4, 'Jurídica', 'Personal de Juridíca', 0, ''),
(5, 'Mercados', 'Personal de Mercados', 0, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carpetasprov`
--

CREATE TABLE `carpetasprov` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `id_prov` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `elim` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `elim` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `soporte` text COLLATE utf8_spanish_ci NOT NULL,
  `id_usr` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `codigoInt`, `codigo`, `id_proveedor`, `soporte`, `id_usr`, `insumos`, `fecha`, `inversion`, `iva`, `observacion`) VALUES
(1, 'FAC-001-2021', 'GFD-231', 2, '', 1, '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"can\":\"15\",\"pre\":\"5501\",\"sub\":\"82515\"},{\"id\":\"3\",\"des\":\"AROMATICA SURTIDA EN BOLSA\",\"can\":\"10\",\"pre\":\"7425\",\"sub\":\"74250\"},{\"id\":\"6\",\"des\":\"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL\",\"can\":\"8\",\"pre\":\"18000\",\"sub\":\"144000\"},{\"id\":\"4\",\"des\":\"ATOMIZADOR AMBIENTADOR LAVANDA \",\"can\":\"40\",\"pre\":\"8596\",\"sub\":\"343840\"},{\"id\":\"8\",\"des\":\"BLANQUEADOR (LIMPIDO)\",\"can\":\"50\",\"pre\":\"8800\",\"sub\":\"440000\"}]', '2021-07-19', 1084600, 206074, ''),
(2, 'FAC-002-2021', 'prueba1', 1, '', 1, '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"can\":\"1\",\"pre\":\"5501\",\"sub\":\"5501\"},{\"id\":\"3\",\"des\":\"AROMATICA SURTIDA EN BOLSA\",\"can\":\"1\",\"pre\":\"7425\",\"sub\":\"7425\"},{\"id\":\"4\",\"des\":\"ATOMIZADOR AMBIENTADOR LAVANDA \",\"can\":\"1\",\"pre\":\"8596\",\"sub\":\"8596\"}]', '2021-08-17', 21522, 4089, ''),
(3, 'FAC-003-2021', '98-FAS', 1, '', 1, '[{\"id\":\"152\",\"des\":\"EXACTO PLÀSTICO GRANDE\",\"can\":\"10\",\"pre\":\"2000\",\"sub\":\"20000\"},{\"id\":\"11\",\"des\":\"BOLSA BASURA NEGRA X 90*110 \",\"can\":\"8\",\"pre\":\"15\",\"sub\":\"120\"},{\"id\":\"9\",\"des\":\"BOLIGRAFO  ROJO \",\"can\":\"18\",\"pre\":\"587\",\"sub\":\"10566\"}]', '2021-08-17', 30686, 5830, ''),
(4, 'FAC-004-2021', 'SAS333', 2, '', 1, '[{\"id\":\"152\",\"des\":\"EXACTO PLÀSTICO GRANDE\",\"can\":\"10\",\"pre\":\"2000\",\"sub\":\"20000\"}]', '2021-08-17', 20000, 3800, ''),
(5, 'FAC-005-2021', 'ccas', 2, '', 1, '[{\"id\":\"10\",\"des\":\"BOLIGRAFO NEGRO\",\"can\":\"100\",\"pre\":\"1500\",\"sub\":\"150000\"}]', '2021-08-17', 150000, 28500, ''),
(6, 'FAC-006-2021', 'ONLY-2012', 1, '', 1, '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"can\":\"1\",\"pre\":\"5501\",\"sub\":\"5501\"},{\"id\":\"3\",\"des\":\"AROMATICA SURTIDA EN BOLSA\",\"can\":\"1\",\"pre\":\"7425\",\"sub\":\"7425\"},{\"id\":\"4\",\"des\":\"ATOMIZADOR AMBIENTADOR LAVANDA \",\"can\":\"1\",\"pre\":\"8596\",\"sub\":\"8596\"}]', '2021-08-21', 21522, 4089, ''),
(7, 'FAC-007-2021', 'GFD-232', 1, '', 1, '[{\"id\":\"15\",\"des\":\"CAFÉ TOSTADO Y MOLIDO, FUERTE\",\"can\":\"15\",\"pre\":\"850\",\"sub\":\"12750\"},{\"id\":\"21\",\"des\":\"CINTA EMP TRANSP 48X100 REF.301 3M \",\"can\":\"20\",\"pre\":\"700\",\"sub\":\"14000\"},{\"id\":\"29\",\"des\":\"COLCAFE COFFE CREAM 100 SOBRES DE 3 GR\",\"can\":\"5\",\"pre\":\"8000\",\"sub\":\"40000\"},{\"id\":\"34\",\"des\":\"DECAMETRO STANPROF 10 MTS\",\"can\":\"5\",\"pre\":\"14000\",\"sub\":\"70000\"},{\"id\":\"31\",\"des\":\"CREMA INSTANTANEA NO LACTEA PARA CAFÉ \",\"can\":\"5\",\"pre\":\"1200\",\"sub\":\"6000\"}]', '2021-08-22', 142750, 27122, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `accion` int(11) NOT NULL COMMENT '1 Crear, 2 Leer, 3 Actualizar, 4 Eliminar',
  `numTabla` int(11) NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas\r\n',
  `valorAnt` text COLLATE utf8_spanish_ci NOT NULL,
  `valorNew` text COLLATE utf8_spanish_ci DEFAULT '',
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `id_usr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `accion`, `numTabla`, `valorAnt`, `valorNew`, `fecha`, `id_usr`) VALUES
(1, 4, 8, 'OC-001-2021 INSERCOP', '', '2021-08-23', 1),
(2, 4, 9, 'RQ-001-2021 Sistemas', '', '2021-08-26', 1),
(3, 4, 9, 'RQ-002-2021 Sistemas', '', '2021-08-30', 1),
(4, 1, 2, '\"ohla', '', '2021-09-16', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impustoagregado`
--

CREATE TABLE `impustoagregado` (
  `id` int(11) NOT NULL,
  `sumatoria` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `impustoagregado`
--

INSERT INTO `impustoagregado` (`id`, `sumatoria`, `anio`, `mes`) VALUES
(1, 192308, 2021, 7),
(2, 138257, 2021, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `precio_compra` float NOT NULL DEFAULT 0,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `elim` int(11) NOT NULL DEFAULT 0,
  `estante` int(11) DEFAULT 0,
  `nivel` int(11) DEFAULT 0,
  `seccion` int(11) DEFAULT 0,
  `prioridad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `precio_compra`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`) VALUES
(2, 1, 1, 'AMBIENTADOR DE BAÑO AIR WICK', '', NULL, 110, 0, '0000-00-00 00:00:00', 0, 5, 4, 0, 2),
(3, 12, 2, 'AROMATICA SURTIDA EN BOLSA', '', NULL, 118, 89999, '0000-00-00 00:00:00', 0, 7, 7, 7, 2),
(4, 1, 3, 'ATOMIZADOR AMBIENTADOR LAVANDA', '', NULL, 139, 500, '0000-00-00 00:00:00', 0, 5, 4, 4, 2),
(5, 12, 4, 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', '', NULL, 72, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(6, 12, 5, 'AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL', NULL, NULL, 184, 18000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(7, 13, 6, 'BANDEJA PORTA DOCUMENTOS', NULL, NULL, 101, 4000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(8, 1, 7, 'BLANQUEADOR (LIMPIDO)', NULL, NULL, 84, 8800, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(9, 10, 8, 'BOLIGRAFO  ROJO ', NULL, NULL, 29, 587, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(10, 10, 9, 'BOLIGRAFO NEGRO', NULL, NULL, 100, 1500, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(11, 1, 10, 'BOLSA BASURA NEGRA X 90*110 ', NULL, NULL, 10, 5, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(12, 1, 11, 'BOLSA BASURA VERDE 42*47CMS ', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(13, 14, 12, 'BORRADOR DE NATA', NULL, NULL, 17, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(14, 10, 13, 'BORRADOR DE TABLERO', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(15, 12, 14, 'CAFÉ TOSTADO Y MOLIDO, FUERTE', NULL, NULL, 15, 850, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(16, 14, 15, 'CARATULA POLY COVER CARTA ', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(17, 14, 16, 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(18, 14, 17, 'CARTULINA BRISTOL 70*100 BLANCA', NULL, NULL, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(19, 14, 18, 'CD-R ', NULL, NULL, 39, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(20, 1, 19, 'CERA NATURAL SÓLIDA PARA MADERA AUTOBRILLO', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(21, 14, 20, 'CINTA EMP TRANSP 48X100 REF.301 3M ', NULL, NULL, 20, 700, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(22, 14, 21, 'CINTA EMP TRANSP DELGADA 12 MM X40M ', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(23, 2, 22, 'CINTA IMPRESORA EPSON LX300/800 8750- ORIGINAL', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(24, 14, 23, 'CINTA INVISIBLE 33M:19MM PARA CHEQUES', '', NULL, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(25, 14, 24, 'CLIP MARIPOSA GIGANTE', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(26, 14, 25, 'CLIP MARIPOSA X 50 EMP*50 ', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(27, 14, 26, 'CLIP SENCILLO X 100 EMP*100', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(28, 14, 27, 'COLBON (PEGANTE UNIVERSAL) 480GR', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(29, 12, 28, 'COLCAFE COFFE CREAM 100 SOBRES DE 3 GR', NULL, NULL, 5, 8000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(30, 10, 29, 'CORRECTOR LIQUIDO LAPIZ *7 ML', NULL, NULL, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(31, 12, 30, 'CREMA INSTANTANEA NO LACTEA PARA CAFÉ ', NULL, NULL, 5, 1200, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(32, 11, 31, 'CREMA LAVALOZA ', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(33, 9, 32, 'CUENTA FACIL', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(34, 5, 33, 'DECAMETRO STANPROF 10 MTS', NULL, NULL, 5, 14000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(35, 5, 34, 'DECAMETRO STANPROF 30 MTS', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(36, 5, 35, 'DECAMETRO STANPROF 50 MTS', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(37, 1, 36, 'DESENGRASANTE', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(38, 1, 37, 'DESINFECTANTE MULTIUSOS ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(39, 1, 38, 'DETERGENTE EN POLVO ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(40, 15, 39, 'DVD +R ', NULL, NULL, 31, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(41, 1, 40, 'ESCOBA SUAVE MANGO MADERA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(42, 11, 41, 'ESPONJA LAVAPLATOS DOBLE USO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(43, 5, 42, 'FLEXOMETRO LUFKIN 26/8METROS', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(44, 9, 43, 'FOLIADOR (NUMERADOR CONSECUTIVO)', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(45, 15, 44, 'FORMAS CONTINUAS 1/2 11 1/2 TROQUELADA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(46, 15, 45, 'FORMAS CONTINUAS 9 1/2 *11 1P BLANCA 901', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(47, 15, 46, 'FORMAS CONTINUAS 9 1/2 *11 3P BLANCA 903 ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(48, 15, 47, 'GANCHO LEGAJADOR PLASTICO ', NULL, NULL, 38, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(49, 14, 48, 'GRAPA COBRIZADA STANDARD *5000 ', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(50, 14, 49, 'GRAPA GALVANIZADA INDUSTRIAL *1000', NULL, NULL, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(51, 13, 50, 'GRAPADORA 340 RANK (SENCILLA)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(52, 13, 51, 'GRAPADORA INDUSTRIAL HASTA 100 HOJAS', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(53, 1, 52, 'GUANTES DE LATEX DE  EXAMEN ', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(54, 1, 53, 'GUANTES SEMI-INDUSTRIALES T9-9 ½*CALIBRE 25*LATEX NATURAL*COLOR NEGRO', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(55, 15, 54, 'GUIA CLASIFICADORA  CARTULINA REF. 105 AMARILLA ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(56, 15, 55, 'GUIAS CELUGUIA', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(57, 2, 56, 'HP 10 NEGRO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(58, 2, 57, 'HP 711 AMARILLO', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(59, 2, 58, 'HP 711 CYAN', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(60, 2, 59, 'HP 711 MAGENTA', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(61, 2, 60, 'HP 711 NEGRO', NULL, NULL, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(62, 2, 61, 'HP 82 AMARILLO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(63, 2, 62, 'HP 82 NEGRO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(64, 9, 63, 'HUELLERO COLOR NEGRO', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(65, 8, 64, 'JABON LÍQUIDO PARA MANOS, ANTIBACTERIAL, BIODEGRADABLE AROMA MANZANA', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(66, 15, 65, 'LAMPARAS FLUORESCENTES SILVANIA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(67, 10, 66, 'LAPIZ NEGRO Nº2 ORIG. 482 ', NULL, NULL, 13, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(68, 14, 67, 'LEGAJADOR AZ OFICIO AZUL ', NULL, NULL, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(69, 14, 68, 'LEGAJOS (CARPETAS DE EDUBAR)', NULL, NULL, 600, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(70, 2, 69, 'LEXMARK AMARILLO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(71, 2, 70, 'LEXMARK CYAN', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(72, 2, 71, 'LEXMARK NEGRO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(73, 14, 72, 'LIBRO ACTA 1/2 OFICIO 80H  100 FOLIOS (BITACORA)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(74, 1, 73, 'LIMPIAVIDRIOS (AMONIACO-DESENGRASANTE SECADO RAPIDO)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(75, 1, 74, 'LIMPION', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(76, 1, 75, 'LIQUIDO ESPECIAL PARA PISOS (BRILLO)', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(77, 10, 76, 'MARCADOR BORRABLE', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(78, 10, 77, 'MARCADOR PERMANENTE NEGRO PUNTA FINA  (SHARPIE)', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(79, 1, 78, 'MARCADORES PERMANENTES SURTIDOS (ROJO/AZUL/NEGRO)', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(80, 15, 79, 'MASCARILLA DESECHABLE (TAPABOCAS)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(81, 12, 80, 'MEZCLADORES DESECHABLES PARA CAFÉ', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(82, 7, 81, 'MOUSE USB', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(83, 8, 82, 'PAPEL HIGIENIENICO INSTITUCIONAL ROLLOS, DOBLE HOJA, PRECORTADO, BLANCO', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(84, 3, 83, 'PAPEL RESMA DOBLE CARTA 11*17 75GRS', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(85, 3, 84, 'PAPEL RESMA FOTOCOPIA 75GR CARTA ', NULL, NULL, 14, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(86, 3, 85, 'PAPEL RESMA FOTOCOPIA 75GR OFICIO ', NULL, NULL, 23, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(87, 13, 86, 'PAPELERA (CANECA)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(88, 15, 87, 'PASTA CATALOGO 0.5R HERRAJE BLANCA', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(89, 15, 88, 'PASTA CATALOGO 1.0R HERRAJE BLANCA', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(90, 15, 89, 'PASTA CATALOGO 1.5R HERRAJE BLANCA', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(91, 15, 90, 'PASTA CATALOGO 2.0R HERRAJE BLANCA', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(92, 15, 91, 'PASTA CATALOGO 2.5R HERRAJE BLANCA', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(93, 15, 92, 'PASTA CATALOGO 3.0D HERRAJE BLANCA', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(94, 14, 93, 'PEGANTE  EN BARRA 40GRS ', NULL, NULL, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(95, 13, 94, 'PERFORADORA 3 HUECOS', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(96, 13, 95, 'PERFORADORA RANK 1050 DOS HUECOS SEMI INDUSTRIAL (40 HOJAS)', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(97, 13, 96, 'PERFORADORA SENCILLA 1038 RANK', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(98, 12, 97, 'PLATO DESECHABLE MEDIANO *20 ESPUMADO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(99, 15, 98, 'PROTECTOR DE TRANSPARENCIA (BOLSILLOS)', NULL, NULL, 13, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(100, 14, 99, 'RECIBO DE CAJA MENOR X 200 HOJAS', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(101, 1, 100, 'RECOGEDOR DE BASURA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(102, 13, 101, 'REGLA DE 30 CM', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(103, 10, 102, 'RESALTADORES SURTIDOS ', NULL, NULL, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(104, 3, 103, 'ROLLO PLOTER BOND 75 GR 28 PULGADAS', NULL, NULL, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(105, 12, 104, 'ROLLO TOALLA COCINA LAVABLE', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(106, 14, 105, 'SACAGRAPA', NULL, NULL, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(107, 14, 106, 'SACAPUNTA', NULL, NULL, 16, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(108, 9, 107, 'SELLO NUMERADOR FOLIADOR AUTOMATICO CONSECUTIVO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(109, 12, 108, 'SERVILLETA 27-5*17', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(110, 14, 109, 'SOBRE MANILA CARTA  22*29 ', NULL, NULL, 190, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(111, 14, 110, 'SOBRE MANILA GIGANTE 37*27 ', NULL, NULL, 80, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(112, 14, 111, 'SOBRE MANILA OFICIO 25*35 ', NULL, NULL, 100, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(113, 12, 112, 'SOBRES NESCAFE TRADICION ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(114, 12, 113, 'TE HELADO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(115, 7, 114, 'TECLADO KB-110X USB ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(116, 14, 115, 'TIJERA', NULL, NULL, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(117, 2, 116, 'TINTA EPSON 664 COLOR AMARILLO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(118, 2, 117, 'TINTA EPSON 664 COLOR CYAN', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(119, 2, 118, 'TINTA EPSON 664 COLOR MAGENTA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(120, 2, 119, 'TINTA EPSON 664 COLOR NEGRO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(121, 9, 120, 'TINTA PARA SELLO DE CAUCHO', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(122, 14, 121, 'TIRA NEGRA (CAPACIDAD DE 300 HOJAS)', NULL, NULL, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(123, 14, 122, 'TIRA NEGRA 11MM*42 AROS (CAPACIDAD DE 70 HOJAS)', NULL, NULL, 79, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(124, 14, 123, 'TIRA NEGRA 12 MM (CAPACIDAD DE 80 HOJAS)', NULL, NULL, 109, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(125, 14, 124, 'TIRA NEGRA 15 MM (CAPACIDAD DE 120 HOJAS)', NULL, NULL, 31, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(126, 14, 125, 'TIRA NEGRA 18 MM (CAPACIDAD DE 140 HOJAS)', NULL, NULL, 34, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(127, 14, 126, 'TIRA NEGRA 22 MM (CAPACIDAD DE 170 HOJAS)', NULL, NULL, 11, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(128, 14, 127, 'TIRA NEGRA 25 MM (CAPACIDAD DE 200 HOJAS)', NULL, NULL, 36, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(129, 14, 128, 'TIRA NEGRA 9MM  (CAPACIDAD DE 50 HOJAS)', NULL, NULL, 208, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(130, 2, 129, 'TK 512 AMARILLO', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(131, 2, 130, 'TK 512 MAGENTA', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(132, 2, 131, 'TK512 CYAN', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(133, 8, 132, 'TOALLA DE MANOS BLANCA 24X21CM HOJA TRIPLE DOBLADA EN Z', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(134, 2, 133, 'TONER NEGRO TK-1147 (2035)', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(135, 2, 134, 'TONER NEGRO TK-137 (2810)', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(136, 2, 135, 'TONER NEGRO TK-3122 (4200)', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(137, 2, 136, 'TONER NEGRO TK-3132 (4300)', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(138, 2, 137, 'TONER NEGRO TK-342 (2020)', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(139, 1, 138, 'TRAPERO TIPO INDUSTRIAL', NULL, NULL, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(140, 1, 139, 'VARSOL SIN OLOR ', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(141, 12, 140, 'VASO 11 ONZAS TRANSPARENTE', NULL, NULL, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(142, 12, 141, 'VASO CAFETERO TERMICO ESPUMADO (4 ONZAS)', NULL, NULL, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(143, 10, 142, 'LAPIZ ROJO', NULL, NULL, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(144, 13, 143, 'NOTAS ADHESIVAS', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(145, 15, 144, 'PLANILLERO ACRILICO CON GANCHO', NULL, NULL, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(146, 14, 145, 'BLOCK ANOTACIÒN ', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(147, 14, 146, 'CAJA ARCHIVO INACTIVO # 20', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(148, 6, 147, 'CALCULADORA CASIO 12 DIGITOS', NULL, NULL, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(149, 2, 148, 'TONER TK-1175 (M2040dn)', NULL, NULL, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(150, 2, 149, 'TONER TK-3160/3162', NULL, NULL, 0, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(151, 14, 150, 'CHINCHE TRITON NIQUELADO', NULL, NULL, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(152, 14, 151, 'EXACTO PLÀSTICO GRANDE', NULL, NULL, 20, 2000, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(153, 2, 152, 'TONER NEGRO HP 85A(P1102W)', NULL, NULL, 5, 10, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(154, 12, 153, 'SERVILLETA DE LUJO 33*32CM ', NULL, NULL, 68, 28, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(155, 15, 154, 'FUNDA PARA CD', NULL, NULL, 73, 20, '0000-00-00 00:00:00', 0, 0, 0, 0, 2),
(156, 2, 155, '&quotohla&quot', '', 'vistas/img/productos/default/anonymous.png', 0, 0, '2021-09-16 12:22:04', 0, 2, 1, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inversiones`
--

CREATE TABLE `inversiones` (
  `id` int(11) NOT NULL,
  `id_prov` int(11) NOT NULL,
  `invertido` float NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inversiones`
--

INSERT INTO `inversiones` (`id`, `id_prov`, `invertido`, `anio`, `mes`) VALUES
(1, 0, 456290, 2021, 7),
(2, 2, 648001, 2021, 7),
(3, 1, 271384, 2021, 8),
(4, 0, 456290, 2021, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `js_files`
--

CREATE TABLE `js_files` (
  `id` int(3) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `habilitado` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'all'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `js_files`
--

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
(26, 'proveedor', 'proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `entrYsal` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `anio` int(11) NOT NULL,
  `mes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `entrYsal`, `insumos`, `anio`, `mes`) VALUES
(1, 1, '[{\"id\":\"149\", \"can\":\"2\"},{\"id\":\"117\", \"can\":\"1\"},{\"id\":\"118\", \"can\":\"1\"},{\"id\":\"120\", \"can\":\"1\"}]', 2021, 7),
(2, 0, '[{\"id\":\"2\", \"can\":\"\"},{\"id\":\"3\", \"can\":\"\"},{\"id\":\"4\", \"can\":\"\"},{\"id\":\"5\", \"can\":\"\"},{\"id\":\"6\", \"can\":\"\"},{\"id\":\"7\", \"can\":\"\"},{\"id\":\"8\", \"can\":\"\"}]', 2021, 7),
(3, 0, '[{\"id\":\"15\", \"can\":\"15\"},{\"id\":\"21\", \"can\":\"20\"},{\"id\":\"29\", \"can\":\"5\"},{\"id\":\"34\", \"can\":\"5\"},{\"id\":\"31\", \"can\":\"5\"}]', 2021, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordencompra`
--

CREATE TABLE `ordencompra` (
  `id` int(11) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `id_cotizacion` int(11) NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `inversion` float NOT NULL,
  `iva` float NOT NULL,
  `fac_asociada` int(11) NOT NULL DEFAULT 0,
  `formaPago` text COLLATE utf8_spanish_ci NOT NULL,
  `responsable` text COLLATE utf8_spanish_ci NOT NULL,
  `fechaEntrega` date NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ordencompra`
--

INSERT INTO `ordencompra` (`id`, `codigoInt`, `id_proveedor`, `id_usr`, `id_cotizacion`, `insumos`, `fecha`, `inversion`, `iva`, `fac_asociada`, `formaPago`, `responsable`, `fechaEntrega`, `observacion`) VALUES
(2, '2', 1, 1, 0, '[{\"id\":\"6\",\"des\":\"AZUCAR BLANCA*REFINADA*GRANULADA*100% NATURAL\",\"can\":\"8\",\"pre\":\"18000\",\"sub\":\"144000\"},{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"can\":\"1\",\"pre\":\"5000\",\"sub\":\"5000\"},{\"id\":\"3\",\"des\":\"AROMATICA SURTIDA EN BOLSA\",\"can\":\"1\",\"pre\":\"7425\",\"sub\":\"7425\"}]', '2021-08-18', 156425, 29721, 0, 'Chan con chan', 'Kevin', '0000-00-00', ''),
(3, '1', 2, 1, 0, '[{\"id\":\"9\",\"des\":\"BOLIGRAFO  ROJO \",\"can\":\"20\",\"pre\":\"587\",\"sub\":\"11740\"}]', '2021-08-18', 11740, 2231, 0, 'para la quincena', 'Kevin', '0000-00-00', 'None');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
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
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`) VALUES
(1, 10, 15, 30, 6, 8, 1, 2, 2021, 1, 'Empresa de Desarrollo Urbano de Barranquilla y la Región Caribe S.A - EDUBAR S.A', '800.091.140-4', 'Centro de Negocios Mix Via 40 # 73 Piso 9', '3605148 - 3602561', 'atencionalciudadano@edubar.com.co', 'Centro de Negocios Mix Via 40 # 73 Piso 9', 'Angelly Criales', 19, 1, 0, 5, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `id_area` int(11) NOT NULL,
  `elim` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `id_area`, `elim`) VALUES
(1, 'Kevin Bolaño', 1, 0),
(2, 'Kimberly Lozano', 2, 0),
(3, 'Isabella Diaz', 3, 0),
(4, 'Fernando Barcelo', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `razonSocial` text COLLATE utf8_spanish_ci NOT NULL,
  `nombreComercial` text COLLATE utf8_spanish_ci NOT NULL,
  `nit` text COLLATE utf8_spanish_ci NOT NULL,
  `digitoNit` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin Información',
  `direccion` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'No Registra',
  `telefono` text COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `contacto` text COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Sin Info',
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `correo` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `razonSocial`, `nombreComercial`, `nit`, `digitoNit`, `descripcion`, `direccion`, `telefono`, `contacto`, `fecha`, `correo`) VALUES
(1, 'INSERCOP DISTRILAN SAS', 'INSERCOP', '802012326', '7', 'Toner e impresoras', 'No Registra', '3016115118', 'Sin Info', '2021-06-25', ''),
(2, 'SOLUCIONES MAF S.A.S', 'TAURO', '802008192', '1', 'PAPELERIA', 'CL 30 # 1 -295', '3758600', 'KATHERINE SERGE', '2021-07-13', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisiciones`
--

CREATE TABLE `requisiciones` (
  `id` int(11) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_usr` int(11) NOT NULL,
  `codigoInt` text COLLATE utf8_spanish_ci NOT NULL,
  `insumos` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `fecha_sol` date NOT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `requisiciones`
--

INSERT INTO `requisiciones` (`id`, `id_area`, `id_persona`, `id_usr`, `codigoInt`, `insumos`, `fecha`, `fecha_sol`, `observacion`) VALUES
(3, 1, 1, 1, 'RQ-003-2021', '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"ped\":\"1\",\"ent\":\"5\"}]', '2021-09-22', '2021-09-23', ''),
(4, 2, 2, 1, 'RQ-004-2021', '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"ped\":\"1\",\"ent\":\"5\"},{\"id\":\"4\",\"des\":\"ATOMIZADOR AMBIENTADOR LAVANDA\",\"ped\":\"1\",\"ent\":\"1\"}]', '2021-09-20', '2021-08-10', ''),
(5, 2, 2, 1, 'RQ-005-2021', '[{\"id\":\"2\",\"des\":\"AMBIENTADOR DE BAÑO AIR WICK\",\"ped\":\"1\",\"ent\":\"1\"}]', '2021-08-20', '2021-08-17', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempdatosrq`
--

CREATE TABLE `tempdatosrq` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `observacion` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tempdatosrq`
--

INSERT INTO `tempdatosrq` (`id`, `nombre`, `fecha`, `observacion`) VALUES
(1, 'KEVIN BOLAÑO', '2021-05-20', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `perfil` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `foto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` text COLLATE utf8_spanish_ci DEFAULT '1',
  `ultimo_login` datetime DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `sid` text COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `elim` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`, `sid`, `elim`) VALUES
(1, 'Kevin Bolaño', 'kb', '$2a$07$asxx54ahjppf45sd87a5autHv3Ukefrj18Q.sA446i51Rv.qpK78q', 'root', NULL, '1', '2021-09-28 18:12:19', '2021-02-11 15:06:49', 'nadea6uif3rt4tvfrjr6139qqp', 0),
(2, 'Carmen Rebolledo A', 'carmenr', '$2a$07$asxx54ahjppf45sd87a5auRajNP0zeqOkB9Qda.dSiTb2/n.wAC/2', 'Administrador', NULL, '1', '2021-08-18 14:18:38', '2021-08-19 16:12:33', '', 0),
(3, 'Karelly Moreno', 'kmoreno', '$2a$07$asxx54ahjppf45sd87a5aub5AdYGnDrNPXtjZGt9K5ZSA6JZ42Pci', 'Auxiliar', NULL, '1', '2021-06-10 09:47:31', '2021-08-19 16:12:39', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anexosprov`
--
ALTER TABLE `anexosprov`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carpetasprov`
--
ALTER TABLE `carpetasprov`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `impustoagregado`
--
ALTER TABLE `impustoagregado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inversiones`
--
ALTER TABLE `inversiones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `js_files`
--
ALTER TABLE `js_files`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ordencompra`
--
ALTER TABLE `ordencompra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `requisiciones`
--
ALTER TABLE `requisiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tempdatosrq`
--
ALTER TABLE `tempdatosrq`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `anexosprov`
--
ALTER TABLE `anexosprov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carpetasprov`
--
ALTER TABLE `carpetasprov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `impustoagregado`
--
ALTER TABLE `impustoagregado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT de la tabla `inversiones`
--
ALTER TABLE `inversiones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `js_files`
--
ALTER TABLE `js_files`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ordencompra`
--
ALTER TABLE `ordencompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `requisiciones`
--
ALTER TABLE `requisiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tempdatosrq`
--
ALTER TABLE `tempdatosrq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;