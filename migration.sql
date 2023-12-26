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
  `rutaScan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`, `codVen`, `codCorte`, `codRad`, `nameRad`, `festivos`, `modomanto`, `fechaRegistroPqr`, `rutaScan`) VALUES
  (1, 10, 20, 30, 1, 1, 1, 1, 2023, 1, 'NOMBRE DE LA EMPRESA', 'id de la empresa', 'Dirección fisica de la empresa', 'telefono', 'correo', 'Direccion fisica', 'gerente', 1, 1, 0, 1, NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, '', 0, '2023-04-18 08:53:17', '');

CREATE TABLE IF NOT EXISTS `anios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `anio` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.anios: ~4 rows (aproximadamente)
INSERT IGNORE INTO `anios` (`id`, `anio`) VALUES
	(1, 2022),
	(2, 2021),
	(3, 2022),
	(4, 2023);


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
  `pNueve` int NOT NULL DEFAULT '0',
  `pDiez` int NOT NULL DEFAULT '0',
  `pOnce` int DEFAULT '0',
  `sw` int NOT NULL DEFAULT '1' COMMENT 'Gatillo para mostrar o no una pagina',
  `ver` int NOT NULL DEFAULT '1' COMMENT 'gatillo para consultar este registro',
  `file` int NOT NULL DEFAULT '1' COMMENT '1: tiene js, 0: no tiene js',
  `habilitado` int NOT NULL DEFAULT '0' COMMENT '0: solo muestra el js cuando esta en la pagina, 1: el js se muestra en todo el sistema',
  `descripcion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.js_data: ~75 rows (aproximadamente)
INSERT IGNORE INTO `js_data` (`id`, `page`, `title`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pSeis`, `pSiete`, `pOcho`, `pNueve`, `pDiez`, `pOnce`, `sw`, `ver`, `file`, `habilitado`, `descripcion`) VALUES
INSERT IGNORE INTO `js_data` (`id`, `page`, `title`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pSeis`, `pSiete`, `pOcho`, `pNueve`, `pDiez`, `pOnce`, `sw`, `ver`, `file`, `habilitado`, `descripcion`) VALUES
	(1, 'categorias', 'Categorias', 1, 1, 2, 3, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las categorias de las que seran asociados '),
	(2, 'verCategoria', 'Ver Categoria', 2, 1, 2, 3, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite Ver los insumos pertenecientes a una categ'),
	(3, 'insumos', 'Insumos', 3, 1, 2, 3, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Mustras todos los insumos ingresados en el sistema'),
	(4, 'ordendecompras', 'Orden de Compras', 4, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las ordenes de compra, contiene graficas.'),
	(5, 'facturas', 'Facturas', 5, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las facturas ingresadas en el sistema.'),
	(6, 'requisiciones', 'Requisiciones', 8, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las requisiciones aprobadas, pendientes, l'),
	(7, 'nuevaFactura', 'Nueva Factura', 10, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite crear nueva factura, lista los insumos en '),
	(8, 'editarFactura', 'Editar Factura', 10, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar una factura realizada en sistema.'),
	(9, 'requisicion', 'Requisción', 11, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 0, 'Realiza la requisición de insumos para una área po'),
	(10, 'requisicionImportada', 'Importar Requisición', 11, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'Puede importar una requisicón por medio de una pla'),
	(11, 'editarRq', 'Editar Requisición', 11, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 0, 'Permite editar requisiciones almacenadas en sistem'),
	(12, 'actas', 'Actas', 14, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las actas de salida y entrada.'),
	(13, 'areas', 'Areas', 15, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las areas pertenecientes a la organización'),
	(14, 'personas', 'Personas', 16, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las personas encargadas para cada area, pa'),
	(15, 'inicio', 'Dashboard', 17, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 0, 0, 0, 'Presenta los modulos del sistema.'),
	(16, 'reportesRq', 'Reportes de Requisiciones', 17, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(17, 'verArea', 'Ver Área', 18, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las personas asignadas a esa área y presen'),
	(18, 'proveedor', 'Proveedor', 19, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores, para realizar tramites de o'),
	(19, 'inversionInsumos', 'Inversión en Insumos', 23, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los los valores invertidos en cada insumo'),
	(20, 'cotizaciones', 'Cotizaciones', 25, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(21, 'verInsumo', 'Ver Insumo', 26, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra un resumen perteneciente a dicho insumo, l'),
	(22, 'proyectos', 'Proyectos', 27, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proyectos de la organización, para así c'),
	(23, 'usuarios', 'Usuarios', 50, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los usuarios del sistema y permite realizar '),
	(24, 'plantilla', 'Plantilla', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 1, NULL),
	(25, 'nuevaActa', 'Nueva Acta', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite crear una nueva acta de entrada, salida o prestamo.'),
	(28, 'parametros', 'Parametros', 0, 1, 2, 0, 0, 0, 0, 7, 0, 0, 0, 0, 1, 1, 1, 1, NULL),
	(29, 'nuevaOrdendeCompras', 'Nuevar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite generar ordenes de compra basado en los requerimientos del sistema.'),
	(30, 'proveedores', 'Proveedores', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores ingresados en el sistema, tambien permite administrarlos.'),
	(31, 'editarOrden', 'Editar Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las ordenes de compras alamacenadas en sistemas.'),
	(32, 'editarActa', 'Editar Acta', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite editar las actas alamancenadas en sistema.'),
	(33, 'verOrden', 'Ver Orden', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Visualiza una orden de compra, discriminando los insumos registrados.'),
	(34, 'inventario', 'Inventario', 0, 1, 2, 3, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos pertenecientes a ella.'),
	(35, 'generaciones', 'Generaciones', 0, 1, 2, 3, 4, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Pagina donde visualiza los modulos Factura, Ordenes y cotizaciones.'),
	(36, 'salir', 'LogOut', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 0, 0, 0, NULL),
	(37, 'perfil', 'Mi Perfil', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 0, 'Pagina del perfil del usuario logeado.'),
	(38, 'genRequisicion', 'Generar Requisición', 29, 1, 2, 0, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 0, NULL),
	(39, 'hisRequisicion', 'Historial de Requisición', 30, 1, 2, 0, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 0, NULL),
	(40, 'verProyecto', 'Proyecto', 28, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(41, 'verRequisicion', 'Ver Requisición', 0, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 0, NULL),
	(42, 'borrador', 'Borrador', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, NULL),
	(43, 'verFactura', 'Ver Factura', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite visualizar una factura seleccionada, discriminando valores e insumos agregados al stock.'),
	(44, 'verRequisicionS', 'ver Requisición', 11, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(45, 'miRequisicion', 'Requisición', 0, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 0, 0, NULL),
	(47, 'historialUsuarios', 'Historial de Usuarios', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de usuarios'),
	(48, 'historialInsumos', 'Historial Insumos', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de insumos'),
	(49, 'historialCategorias', 'Historial Categorias', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de categorias'),
	(50, 'historialAreas', 'Historial Areas', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de áreas'),
	(51, 'historialPersonas', 'Historial Personas', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de personas'),
	(52, 'historialOrdenes', 'Historial Ordenes', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de Ordenes de compra'),
	(53, 'historialRq', 'Historial Requisiciones', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Lista las acciones realizadas del modulo de Requisiciones'),
	(54, 'Creditos', 'Creditos', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 0, 0, 0, NULL),
	(55, 'ventas', 'Ventas', 31, 1, 2, 0, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista las ventas generadas.'),
	(56, 'clientes', 'Clientes', 32, 1, 2, 0, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los clientes ingresados en el sistema, con esto pueden generarse nuevas ventas.'),
	(57, 'nuevaVenta', 'Nueva Venta', 33, 1, 2, 0, 0, 5, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Permite generar una nueva venta a un cliente.'),
	(58, 'cortes', 'Lista de Cortes', 36, 1, 2, 0, 0, 0, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los Cortes generados'),
	(59, 'radicado', 'Radicados', 35, 1, 2, 0, 0, 0, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Presenta los radicados almacenados en sistema'),
	(60, 'verCorte', 'Visualizar Corte', 35, 1, 2, 0, 0, 0, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(61, 'verRadicado', 'Radicado', 0, 1, 2, 0, 0, 0, 6, 0, 0, 0, 0, 0, 1, 1, 0, 0, NULL),
	(62, 'correspondencia', 'Correspondencia', 0, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 0, 0, NULL),
	(63, 'resumenRadicado', 'Radicados', 0, 1, 2, 0, 0, 0, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(64, 'asignaciones', 'Asignaciones', 38, 1, 2, 3, 0, 0, 0, 7, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra los encargados que tienen permitido realizar respuesta a las correspondencias'),
	(65, 'registros', 'Registros y Base de Datos', 39, 1, 2, 3, 4, 5, 6, 7, 0, 0, 0, 11, 1, 1, 1, 0, 'Pagina donde relaciona todas las correspondencias tramitadas y que estan en ello'),
	(66, 'noAutorizado', 'No Autorizado', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 0, 0, 'Pagina con la información de No autorización por ingresar a un modulo no permitido'),
	(67, 'equipos', 'Base de Datos PC', 45, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(68, 'resumenRadicadoD', 'Resumen Radicados', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Resumen de los caricados segun propiedades, areas, pqr'),
	(69, 'replicar', 'Nueva requisición', 0, 1, 2, 3, 4, 5, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
	(70, 'verRegistro', 'Registro', 0, 1, 2, 3, 4, 0, 0, 7, 0, 0, 0, 11, 1, 1, 1, 0, 'Pagina detallada del registro de un Radicado'),
	(71, 'equiposlicencias', 'Licencias', 43, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, 'Pagina que lista las licencias adquiridas de los programas, como el paquete de ofimatica'),
	(72, 'equiposParametros', 'Parametros', 0, 1, 0, 0, 0, 5, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
	(73, 'actasIngreso', 'Actas de Ingreso', 46, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
	(74, 'verActaEquipos', 'Ver Acta', 47, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
	(75, 'verpc', 'Caracteristicas PC', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
	(76, '404', 'Página no Encontrada', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 0, NULL),
	(77, 'equiposDevolucion', 'Devolución de Equipo', 48, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
	(78, 'VerLicencia', 'Licencia', 49, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL);

CREATE TABLE IF NOT EXISTS `insumosunidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.insumosunidad: ~12 rows (aproximadamente)
INSERT IGNORE INTO `insumosunidad` (`id`, `unidad`) VALUES
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
	(11, 'Sin Definir'),
	(12, 'Botella');


CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int NOT NULL,
  `perfil` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.perfiles: ~11 rows (aproximadamente)
INSERT IGNORE INTO `perfiles` (`id`, `perfil`) VALUES
	(1, 'root'),
	(2, 'Administrador'),
	(3, 'Compras'),
	(4, 'Encargado'),
	(5, 'Vendedor'),
	(6, 'Recepción'),
	(7, 'Jurídica'),
	(8, 'Tesorería'),
	(9, 'Auditor'),
	(10, 'Sistemas'),
	(11, 'Gerencia');

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT 'Sin Información',
  `elim` int NOT NULL DEFAULT '0',
  `cat_asociadas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
  (1, 'SISTEMAS', 'Encargados del área de Sistemas', 0, '');



CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `perfil` int NOT NULL DEFAULT '4',
  `foto` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `correo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  `estado` int DEFAULT '1',
  `ultimo_login` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sid` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `sid_ext` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  `elim` int NOT NULL DEFAULT '0',
  `try` int NOT NULL DEFAULT '0',
  `id_area` int NOT NULL DEFAULT '0',
  `dni` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_usuarios_perfiles` (`perfil`),
  CONSTRAINT `FK_usuarios_perfiles` FOREIGN KEY (`perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `correo`, `estado`, `ultimo_login`, `fecha`, `sid`, `sid_ext`, `elim`, `try`, `id_area`) VALUES
  (1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5aub7LdtrTXnn.ZQdALsthndsluPeTbv.a', 1, NULL, 'mail@mail.com', 1, '2023-06-21 17:08:57', '2021-02-11 10:06:49', 'ih6rajrn088vcanmkvehc1ko8o', '2f256b90494106c57e3ac14f7e8cacf6260fa219', 0, 0, 1);

CREATE TABLE IF NOT EXISTS `personas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL DEFAULT '0',
  `id_area` int NOT NULL,
  `id_perfil` int NOT NULL DEFAULT '7',
  `sw` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_personas_usuarios` (`id_usuario`),
  KEY `FK_personas_areas` (`id_area`),
  KEY `id_perfil` (`id_perfil`),
  CONSTRAINT `FK_personas_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK_personas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;



CREATE TABLE IF NOT EXISTS `accion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.accion: ~10 rows (aproximadamente)
INSERT IGNORE INTO `accion` (`id`, `nombre`) VALUES
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

CREATE TABLE IF NOT EXISTS `accion_pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_accion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci COMMENT='Acciones de pqr que ya estan en tramite por la entidad';

-- Volcando datos para la tabla kardex.accion_pqr: ~8 rows (aproximadamente)
INSERT IGNORE INTO `accion_pqr` (`id`, `nombre`, `descripcion`, `fecha_creacion`, `nombre_accion`) VALUES
	(1, 'Traslado Interno', NULL, '2023-01-30 16:05:09', 'Asignado'),
	(2, 'Traslado Por Competencia', NULL, '2023-01-30 16:05:27', 'Trasladó'),
	(3, 'Devuelto para Reasignación', NULL, '2023-01-30 16:05:43', 'Reasignado'),
	(4, 'Respondido por evaluar', NULL, '2023-01-30 16:06:18', 'Respondido por evaluar'),
	(5, 'Respodido y Enviado', NULL, '2023-01-30 16:06:40', 'Respondió y envió'),
	(6, 'Para Enviar', NULL, '2023-01-30 16:06:47', 'Envió'),
	(7, 'Cambiar Tipo PQR', NULL, '2023-02-03 08:58:52', 'Modifico su tipo'),
	(8, 'Marcar Como Resuelto', NULL, '2023-02-14 15:00:30', 'Resuelto');


CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.articulo: ~9 rows (aproximadamente)
INSERT IGNORE INTO `articulo` (`id`, `nombre`) VALUES
	(1, 'Sobre'),
	(2, 'Documento'),
	(3, 'Caja'),
	(4, 'Sobre+Doc'),
	(5, 'Sobre+Caja'),
	(6, 'Doc+Caja'),
	(7, 'Sobre+Doc+Caja'),
	(8, 'Otro'),
	(9, 'Correo Electrónico');


CREATE TABLE IF NOT EXISTS `estado_pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  `fecha_creacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `html` varchar(50) NOT NULL DEFAULT 'success',
  `color` varchar(50) NOT NULL DEFAULT 'green',
  `icono` varchar(50) NOT NULL DEFAULT 'fa-circle-thin',
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.estado_pqr: ~6 rows (aproximadamente)
INSERT IGNORE INTO `estado_pqr` (`id`, `nombre`, `elim`, `fecha_creacion`, `html`, `color`, `icono`, `descripcion`) VALUES
	(1, 'Resuelta', 0, '2023-01-27 01:52:45', 'success', 'green', 'ok-circle', NULL),
	(2, 'Pendiente', 0, '2023-01-27 01:52:57', 'warning', 'green', 'exclamation-sign', NULL),
	(3, 'Vencida', 0, '2023-01-27 01:53:15', 'danger', 'green', 'remove-circle', NULL),
	(4, 'Extemporanea', 0, '2023-01-27 01:53:28', 'warning', 'green', 'remove-circle', NULL),
	(5, 'Por Asignar', 0, '2023-01-27 03:09:44', 'info', 'green', 'exclamation-sign', NULL),
	(6, 'Trasladado', 0, '2023-02-07 21:19:46', 'success', 'green', 'ok-circle', NULL);



CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.objeto: ~29 rows (aproximadamente)
INSERT IGNORE INTO `objeto` (`id`, `nombre`, `termino`) VALUES
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

CREATE TABLE IF NOT EXISTS `pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla kardex.pqr: ~8 rows (aproximadamente)
INSERT IGNORE INTO `pqr` (`id`, `nombre`, `termino`) VALUES
	(1, 'PETICIÓN', 15),
	(2, 'QUEJA', 15),
	(3, 'RECLAMO', 5),
	(4, 'TUTELA', 5),
	(5, 'CTA COBRO', 5),
	(6, 'FACTURA', 5),
	(7, 'CORRESPONDENCIA', 5),
	(8, 'RECURSO', 5);


CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


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
  `fecha` date DEFAULT NULL,
  `correo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `carpetasprov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `carpeta` int NOT NULL,
  `id_prov` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `anexosprov` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_carpeta` int NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.categorias: ~5 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `categoria`, `descripcion`, `elim`) VALUES
  (1, 'Papelería', 'Sin Informacion.', 0),
  (2, 'Sistemas', 'Sin Informacion.', 0),
  (3, 'Aseo', 'Sin Informacion.', 0),
  (4, 'Cocina', 'Elementos para la cocina', 0),
  (5, 'Otros', 'Almacena Insumos que no manejan categoría especifica', 0);


CREATE TABLE IF NOT EXISTS `proyectos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descripcion` text NOT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.proyectos: ~12 rows (aproximadamente)
INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `elim`) VALUES
  (1, 'ADMINISTRATIVO', '2022-06-23', '2022-06-30', 'parte administrativa', 0);

CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_proyecto` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.proyectoarea: ~14 rows (aproximadamente)
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
  (1, '[{"id":"1"}]', 1);

CREATE TABLE IF NOT EXISTS `categoriaarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_categorias` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoriaarea_categorias` (`id_categorias`),
  CONSTRAINT `FK_categoriaarea_categorias` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.categoriaarea: ~10 rows (aproximadamente)
INSERT INTO `categoriaarea` (`id`, `id_areas`, `id_categorias`) VALUES
 (1, '[{"id":"1"}]', 1);


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
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


CREATE TABLE IF NOT EXISTS `historial_insumos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_insumo` int NOT NULL DEFAULT (0),
  `anio` year NOT NULL,
  `mes` char(2) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `historia` text COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__insumos` (`id_insumo`),
  CONSTRAINT `FK__insumos` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.insumos: ~134 rows (aproximadamente)

CREATE TABLE IF NOT EXISTS `requisiciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_area` int NOT NULL,
  `id_persona` int NOT NULL,
  `id_usr` int NOT NULL,
  `codigoInt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `insumos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `fecha_sol` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

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

CREATE TABLE IF NOT EXISTS `cortes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `corte` varchar(50) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `corte` (`corte`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `radicados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_corte` int NOT NULL DEFAULT '0' COMMENT 'numero del corte',
  `fecha` datetime NOT NULL,
  `radicado` varchar(100) NOT NULL DEFAULT '0' COMMENT 'numero del radicado para citar',
  `id_accion` int NOT NULL,
  `id_pqr` int NOT NULL,
  `id_objeto` int NOT NULL,
  `id_usr` int NOT NULL,
  `asunto` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `id_remitente` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `modulo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignaciones_usuarios` (`id_persona`),
  CONSTRAINT `FK_asignaciones_usuarios` FOREIGN KEY (`id_persona`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `pqr_filtro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pqr` text,
  `id_per` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pqr_filtro_perfiles` (`id_per`),
  CONSTRAINT `FK_pqr_filtro_perfiles` FOREIGN KEY (`id_per`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


CREATE TABLE IF NOT EXISTS `historial` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accion` int NOT NULL COMMENT '1 Crear, 2 Leer, 3 Actualizar, 4 Eliminar',
  `numTabla` int NOT NULL COMMENT '1 categoría, 2 insumos, 3 proveedor, 4 facturas, 5 usuarios, 6 areas, 7 personas, 8 ordenes, 9 rq, 10 actas, 11 carpetas, 12 anexos, 13 proyectos, 14 asignaciones\r\n',
  `valorAnt` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `valorNew` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usr` int NOT NULL,
  `id_otro` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `exepcion_mensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.exepcion_mensajes: ~5 rows (aproximadamente)
INSERT INTO `exepcion_mensajes` (`id`, `valor`) VALUES
  (1, 'Contraseña Equivocada'),
  (2, 'Usuario Errado'),
  (3, 'Usuario Bloqueado por muchos intentos'),
  (4, 'Intento de inicio de sesion estando desactivado'),
  (5, 'Inicio Correcto');

-- Volcando estructura para tabla edubarco_kardex.exeption_usuarios
CREATE TABLE IF NOT EXISTS `exeption_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_mensaje` int NOT NULL DEFAULT '0',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor` varchar(2000) DEFAULT NULL,
  `ip_cliente` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_exeption_usuarios_exepcion_mensajes` (`id_mensaje`),
  CONSTRAINT `FK_exeption_usuarios_exepcion_mensajes` FOREIGN KEY (`id_mensaje`) REFERENCES `exepcion_mensajes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci COMMENT='guarda las exepciones y mantiene un registro de los intentos e inicio de sesión';

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `sid` int NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `registropqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_radicado` int NOT NULL,
  `id_area` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_estado` int NOT NULL,
  `id_pqr` int NOT NULL,
  `acciones` text,
  `observacion_usuario` text,
  `observacion_encargado` text,
  `fecha_asignacion` datetime DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  `fecha_vencimiento` datetime NOT NULL,
  `dias_habiles` int NOT NULL,
  `dias_contados` int NOT NULL,
  `soporte` text,
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `registropqrencargado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_registro` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `sw` int NOT NULL DEFAULT '1' COMMENT 'marca un check para las notificaciones',
  PRIMARY KEY (`id`),
  KEY `FK__registropqr` (`id_registro`),
  KEY `FK__regIdUsuario` (`id_usuario`),
  CONSTRAINT `FK__regIdUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK__registropqr` FOREIGN KEY (`id_registro`) REFERENCES `registropqr` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='Esta tabla almacena los registros que fueron asignados a un encargado, de tal forma que los filtre y muestre los que han sido asignados a este.';

CREATE TABLE IF NOT EXISTS `equiposactas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `tipo` int DEFAULT '1',
  `cantidad` int DEFAULT '1',
  `observaciones` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `file` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_equipos` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `ver` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


CREATE TABLE IF NOT EXISTS `equiposparametros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '0',
  `tipo` smallint NOT NULL DEFAULT '0',
  `fecha_creacion` date NOT NULL,
  `elim` tinyint(1) NOT NULL DEFAULT '0',
  `id_usr` int NOT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_act` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_equiposparametros_usuarios` (`id_usr`),
  CONSTRAINT `FK_equiposparametros_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Volcando datos para la tabla kardex.equiposparametros: ~61 rows (aproximadamente)
INSERT IGNORE INTO `equiposparametros` (`id`, `nombre`, `tipo`, `fecha_creacion`, `elim`, `id_usr`, `fecha_actualizacion`, `id_act`) VALUES
	(1, 'Portatil', 1, '2023-09-04', 0, 1, NULL, NULL),
	(2, 'Escritorio', 1, '2023-09-06', 0, 11, NULL, NULL),
	(3, 'Mac', 1, '2023-09-06', 0, 11, NULL, NULL),
	(4, 'Edubar', 2, '2023-09-06', 0, 11, NULL, NULL),
	(5, 'Accesar', 2, '2023-09-06', 0, 11, NULL, NULL),
	(6, 'Hp', 3, '2023-09-06', 0, 11, NULL, NULL),
	(7, 'Lenovo', 3, '2023-09-06', 0, 11, NULL, NULL),
	(8, 'Dell', 3, '2023-09-06', 0, 11, NULL, NULL),
	(9, 'Apple', 3, '2023-09-06', 0, 11, NULL, NULL),
	(10, 'Intel', 5, '2023-09-06', 0, 11, NULL, NULL),
	(11, 'Amd', 5, '2023-09-06', 0, 11, NULL, NULL),
	(12, 'Core i5 - 1035G1', 6, '2023-09-06', 0, 11, '2023-09-06', 11),
	(13, 'Ryzen 5500U', 6, '2023-09-06', 0, 11, NULL, NULL),
	(14, 'Windows', 7, '2023-09-06', 0, 11, NULL, NULL),
	(15, 'OS X', 7, '2023-09-06', 0, 11, NULL, NULL),
	(16, '8', 8, '2023-09-06', 0, 11, NULL, NULL),
	(17, '10', 8, '2023-09-06', 0, 11, NULL, NULL),
	(18, '11', 8, '2023-09-06', 0, 11, NULL, NULL),
	(19, 'Core i7 - 10510U', 6, '2023-09-06', 0, 11, NULL, NULL),
	(20, 'ProBook 440 G7', 4, '2023-09-06', 0, 11, NULL, NULL),
	(21, 'ProBook 440 G7111', 4, '2023-09-06', 0, 11, NULL, NULL),
	(22, '240 G7', 4, '2023-09-08', 0, 11, NULL, NULL),
	(23, 'Servidor', 1, '2023-09-11', 0, 1, NULL, NULL),
	(24, 'Asus', 3, '2023-09-11', 0, 1, NULL, NULL),
	(25, 'Generico', 3, '2023-09-11', 0, 1, NULL, NULL),
	(26, 'Power Group', 3, '2023-09-11', 0, 1, NULL, NULL),
	(27, 'Core i3 - 10110U', 6, '2023-09-11', 0, 1, NULL, NULL),
	(29, 'Ryzen 7 Pro 4750U', 6, '2023-09-11', 0, 1, NULL, NULL),
	(30, 'Core i5 - 1135G7', 6, '2023-09-11', 0, 1, NULL, NULL),
	(31, 'Core i5 - 8250U', 6, '2023-09-11', 0, 1, NULL, NULL),
	(32, 'Pentium E2160', 6, '2023-09-11', 0, 1, '2023-09-11', 1),
	(33, 'Core i7 - 8665U', 6, '2023-09-11', 0, 1, NULL, NULL),
	(34, 'Dual Core E5800', 6, '2023-09-11', 0, 1, '2023-09-11', 1),
	(35, 'Core i3 - 3220', 6, '2023-09-11', 0, 1, NULL, NULL),
	(36, 'Server R2 2012', 8, '2023-09-11', 0, 1, NULL, NULL),
	(37, 'Core i5 - 3330S', 6, '2023-09-11', 0, 1, NULL, NULL),
	(38, '7', 8, '2023-09-11', 0, 1, NULL, NULL),
	(39, 'IMAC 21.5', 4, '2023-09-11', 0, 1, NULL, NULL),
	(40, '240 G8', 4, '2023-09-12', 0, 1, '2023-09-13', 11),
	(41, '240 G7', 4, '2023-09-12', 0, 1, '2023-09-13', 11),
	(42, '245 G8', 4, '2023-09-12', 0, 1, '2023-09-13', 11),
	(43, 'V14', 4, '2023-09-12', 0, 1, NULL, NULL),
	(44, 'THINKPAD L14', 4, '2023-09-12', 0, 1, NULL, NULL),
	(45, '245 G7', 4, '2023-09-12', 0, 1, '2023-09-13', 11),
	(46, 'ELITE BOOK X360', 4, '2023-09-12', 0, 1, NULL, NULL),
	(47, 'vivoBook x513e', 4, '2023-09-12', 0, 1, NULL, NULL),
	(48, 'VOSTRO 3400', 4, '2023-09-12', 0, 1, NULL, NULL),
	(49, 'ZENBOOK', 4, '2023-09-12', 0, 1, NULL, NULL),
	(50, 'LATITUDE 3410', 4, '2023-09-12', 0, 1, NULL, NULL),
	(51, 'INSPIRON 15 5000 GAMING', 4, '2023-09-12', 0, 1, NULL, NULL),
	(52, '15-DW1051LA', 4, '2023-09-12', 0, 1, NULL, NULL),
	(53, 'TP E490', 4, '2023-09-12', 0, 1, NULL, NULL),
	(54, 'Ryzen 5 - 3500U', 6, '2023-09-21', 0, 11, NULL, NULL),
	(55, 'Core i5 - 10500', 6, '2023-09-21', 0, 11, NULL, NULL),
	(56, 'Ryzen 7 PRO 2700', 6, '2023-09-21', 0, 11, NULL, NULL),
	(57, 'EliteDesk 705 G4', 4, '2023-09-21', 0, 11, NULL, NULL),
	(58, 'Core i5 - 4440', 6, '2023-09-21', 0, 11, NULL, NULL),
	(59, 'i5 - 7300HQ', 6, '2023-10-05', 0, 11, NULL, NULL),
	(60, 'NECSOFT', 2, '2023-10-10', 0, 1, NULL, NULL),
	(61, 'ThinkPad E14 Gen4', 4, '2023-10-10', 0, 1, NULL, NULL),
	(62, 'Ryzen 7 5825U', 6, '2023-10-10', 0, 1, NULL, NULL);

CREATE TABLE IF NOT EXISTS `equipos_licencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `productos` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `instalaciones` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `n_serie` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `serialD` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `nombre` char(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `id_propietario` int DEFAULT NULL,
  `id_arquitectura` int DEFAULT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `modelo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `cpu` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `cpu_modelo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `cpu_generacion` char(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `cpu_frecuencia` float DEFAULT NULL,
  `ram` int DEFAULT '0',
  `ssd` int DEFAULT NULL,
  `hdd` int DEFAULT NULL,
  `gpu` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gpu_modelo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `gpu_capacidad` int DEFAULT NULL,
  `teclado` int DEFAULT '0',
  `mouse` int DEFAULT '0',
  `so` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0' COMMENT 'sistema operativo',
  `so_version` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `observaciones` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT '0',
  `estado` int NOT NULL DEFAULT '1',
  `id_licencia` int DEFAULT NULL,
  `historial` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `id_usuario` int DEFAULT NULL,
  `id_responsable` int DEFAULT NULL,
  `id_usr_generado` int NOT NULL COMMENT 'quien ejecuto la acción',
  `fecha_devolucion` date DEFAULT NULL,
  `id_area` int DEFAULT NULL,
  `id_proyecto` int NOT NULL,
  `rol` tinyint(1) NOT NULL DEFAULT '0',
  `id_acta` int DEFAULT '0',
  `fotos` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_serie` (`n_serie`),
  KEY `FK_equipos_usuarios_3` (`id_usr_generado`),
  KEY `FK_equipos_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_equipos_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`),
  CONSTRAINT `FK_equipos_usuarios_3` FOREIGN KEY (`id_usr_generado`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci COMMENT='atributos de la entidad equipos de computo';
