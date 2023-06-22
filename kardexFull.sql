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
  `rutaScan` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `parametros` (`id`, `stMinimo`, `stModerado`, `stAlto`, `codRq`, `codFac`, `codPed`, `codOrdC`, `anioActual`, `nameFac`, `razonSocial`, `nit`, `direccion`, `tel`, `correo`, `direccionEnt`, `repLegal`, `valorIVA`, `validarIns`, `validarCat`, `codActa`, `li`, `prueba`, `extencion`, `dia`, `count`, `codVen`, `codCorte`, `codRad`, `nameRad`, `festivos`, `modomanto`, `fechaRegistroPqr`, `rutaScan`) VALUES
  (1, 10, 20, 30, 1, 1, 1, 1, 2023, 1, 'NOMBRE DE LA EMPRESA', 'id de la empresa', 'Dirección fisica de la empresa', 'telefono', 'correo', 'Direccion fisica', 'gerente', 1, 1, 0, 1, NULL, NULL, NULL, 0, 0, 1, 1, 1, 1, '', 0, '2023-04-18 08:53:17', '');


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
  `pNueve` int NOT NULL DEFAULT '0' COMMENT 'permiso para user con perfil gerencia',
  `pDiez` int NOT NULL DEFAULT '0',
  `pOnce` int NOT NULL DEFAULT '0' COMMENT 'permiso para user con perfil gerencia',
  `sw` int NOT NULL DEFAULT '1' COMMENT 'Gatillo para mostrar o no una pagina',
  `ver` int NOT NULL DEFAULT '1' COMMENT 'gatillo para consultar este registro',
  `file` int NOT NULL DEFAULT '1' COMMENT '1: tiene js, 0: no tiene js',
  `habilitado` int NOT NULL DEFAULT '0' COMMENT '0: solo muestra el js cuando esta en la pagina, 1: el js se muestra en todo el sistema',
  `descripcion` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `js_data` (`id`, `page`, `title`, `num`, `pUno`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pSeis`, `pSiete`, `pOcho`, `pNueve`, `pDiez`, `pOnce`, `sw`, `ver`, `file`, `habilitado`, `descripcion`) VALUES
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
  (15, 'inicio', 'Dashboard', 17, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 11, 1, 0, 0, 0, 'Presenta los modulos del sistema.'),
  (16, 'reportesRq', 'Reportes de Requisiciones', 17, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
  (17, 'verArea', 'Ver Área', 18, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra las personas asignadas a esa área y presen'),
  (18, 'proveedor', 'Proveedor', 19, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proveedores, para realizar tramites de o'),
  (19, 'inversionInsumos', 'Inversión en Insumos', 23, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los los valores invertidos en cada insumo'),
  (20, 'cotizaciones', 'Cotizaciones', 25, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
  (21, 'verInsumo', 'Ver Insumo', 26, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Muestra un resumen perteneciente a dicho insumo, l'),
  (22, 'proyectos', 'Proyectos', 27, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los proyectos de la organización, para así c'),
  (23, 'usuarios', 'Usuarios', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 'Lista los usuarios del sistema y permite realizar '),
  (24, 'plantilla', 'Plantilla', 0, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 1, 1, NULL),
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
  (54, 'Creditos', 'Creditos', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 0, 1, 0, 0, 0, NULL),
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
  (65, 'registros', 'Registros y Base de Datos', 39, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 0, 'Pagina donde relaciona todas las correspondencias tramitadas y que estan en ello'),
  (66, 'noAutorizado', 'No Autorizado', 0, 1, 2, 3, 4, 5, 6, 7, 8, 0, 0, 0, 1, 1, 0, 0, 'Pagina con la información de No autorización por ingresar a un modulo no permitido'),
  (67, 'equipos', 'Base de Datos PC', 45, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
  (68, 'resumenRadicadoD', 'Resumen Radicados', 0, 1, 2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 'Resumen de los caricados segun propiedades, areas, pqr'),
  (69, 'replicar', 'Nueva requisición', 0, 1, 2, 3, 4, 5, 6, 0, 0, 0, 0, 0, 1, 1, 1, 0, NULL),
  (70, 'verRegistro', 'Registro', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 0, 'Pagina detallada del registro de un Radicado'),
  (71, 'equiposlicencias', 'Licencias', 43, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, 'Pagina que lista las licencias adquiridas de los programas, como el paquete de ofimatica'),
  (72, 'equiposParametros', 'Parametros', 0, 1, 0, 0, 0, 5, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
  (73, 'actasIngreso', 'Actas de Ingreso', 46, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 1, 0, NULL),
  (74, 'verActaEquipos', 'Ver Acta', 47, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 0, 0, NULL),
  (75, 'verpc', 'Caracteristicas PC', 0, 1, 2, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 1, 0, 0, NULL),
  (76, '404', 'Página no Encontrada', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 1, 1, 1, 0, NULL);


CREATE TABLE IF NOT EXISTS `festivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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


CREATE TABLE IF NOT EXISTS `insumosunidad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unidad` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id` int NOT NULL,
  `perfil` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  (10, 'Sistemas'),
  (11, 'Gerencia');

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci DEFAULT 'Sin Información',
  `elim` int NOT NULL DEFAULT '0',
  `cat_asociadas` text CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

INSERT INTO `areas` (`id`, `nombre`, `descripcion`, `elim`, `cat_asociadas`) VALUES
  (1, 'SISTEMAS', 'Encargados del área de Sistemas', 0, ''),
  (2, 'CONTRATACIÓN', 'Personal de Contratación', 0, ''),
  (3, 'REASENTAMIENTO', 'Abogados', 0, ''),
  (4, 'JURÍDICA', 'Personal de Juridíca', 0, ''),
  (5, 'MERCADOS', 'Personal de Mercados', 0, ''),
  (6, 'ÁREA TÉCNICA', 'SUB GERENCIA DE PROYECTOS', 0, ''),
  (7, 'ADMINISTRATIVO', 'Toda la Parte Administrativa', 0, ''),
  (8, 'Servicio General', 'Aseo y Atención', 0, ''),
  (9, 'PRESUPUESTO', '', 0, ''),
  (10, 'GERENCIA GENERAL', '', 0, ''),
  (11, 'CONTABILIDAD', 'Contadores', 0, ''),
  (12, 'SGSST', 'Sistema de Gestión de la Seguridad y Salud en el t', 0, ''),
  (13, 'Financiera', 'Jefe Administrativo', 0, ''),
  (14, 'Tesorería', '', 0, ''),
  (15, 'Compras', '', 0, ''),
  (16, 'AREA SOCIAL', '', 0, ''),
  (17, 'REGALIAS', '', 0, ''),
  (18, 'ARCHIVO CENTRAL', '', 0, ''),
  (19, 'DESARROLLO TERRITORIAL', '', 0, ''),
  (20, 'ORDENAMIENTO TERRITORIAL', '', 0, ''),
  (21, 'CONTROL INTERNO', 'AUDITOR INTERNO', 0, ''),
  (22, 'CONTROL INTERNO', 'AUDITOR INTERNO', 1, ''),
  (23, 'CALIDAD', 'JEFE DE CALIDAD', 0, '');



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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE IF NOT EXISTS `accion_pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre_accion` varchar(50) DEFAULT NULL,
  `sw` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Dependiendo del perfil asi podrá visualizar una acción',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Acciones de pqr que ya estan en tramite por la entidad';

INSERT INTO `accion_pqr` (`id`, `nombre`, `descripcion`, `fecha_creacion`, `nombre_accion`, `sw`) VALUES
  (1, 'Traslado Interno o Reasginación', NULL, '2023-01-30 16:05:09', 'Asignado', NULL),
  (2, 'Traslado Por Competencia', NULL, '2023-01-30 16:05:27', 'Trasladó', NULL),
  (3, 'Devolver Oficio', NULL, '2023-01-30 16:05:43', 'Devuelto para Reasignación', NULL),
  (4, 'Respondido por evaluar', NULL, '2023-01-30 16:06:18', 'Respondido por evaluar', NULL),
  (5, 'Respodido y Enviado', NULL, '2023-01-30 16:06:40', 'Respondió y envió', NULL),
  (6, 'Para Enviar', NULL, '2023-01-30 16:06:47', 'Envió', NULL),
  (7, 'Cambiar Tipo PQR', NULL, '2023-02-03 08:58:52', 'Modifico su tipo', NULL),
  (8, 'Marcar Como Resuelto', NULL, '2023-02-14 15:00:30', 'Resuelto', NULL),
  (9, 'Recepción de Oficio', NULL, '2023-04-11 08:55:55', 'Recepción de Oficio', NULL);


  CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla edubarco_kardex.estado_pqr: ~6 rows (aproximadamente)
INSERT INTO `estado_pqr` (`id`, `nombre`, `elim`, `fecha_creacion`, `html`, `color`, `icono`, `descripcion`) VALUES
  (1, 'Resuelta', 0, '2023-01-27 01:52:45', 'success', 'green', 'ok-circle', NULL),
  (2, 'Pendiente', 0, '2023-01-27 01:52:57', 'warning', 'yellow', 'exclamation-sign', NULL),
  (3, 'Vencida', 0, '2023-01-27 01:53:15', 'danger', 'red', 'remove-circle', NULL),
  (4, 'Extemporanea', 0, '2023-01-27 01:53:28', 'warning', 'yellow', 'remove-circle', NULL),
  (5, 'Por Asignar', 0, '2023-01-27 03:09:44', 'info', 'blue', 'exclamation-sign', NULL),
  (6, 'Trasladado', 0, '2023-02-07 21:19:46', 'success', 'green', 'ok-circle', NULL);


CREATE TABLE IF NOT EXISTS `objeto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

CREATE TABLE IF NOT EXISTS `pqr` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `termino` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pqr` (`id`, `nombre`, `termino`) VALUES
  (1, 'PETICIÓN', 12),
  (2, 'QUEJA', 12),
  (3, 'RECLAMO', 5),
  (4, 'TUTELA', 0),
  (5, 'CTA COBRO', 7),
  (6, 'FACTURA', 7),
  (7, 'CORRESPONDENCIA', 5),
  (8, 'RECURSO', 5),
  (9, 'PQRS', 12);


CREATE TABLE IF NOT EXISTS `remitente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla edubarco_kardex.proyectos: ~12 rows (aproximadamente)
INSERT INTO `proyectos` (`id`, `nombre`, `fecha_inicio`, `fecha_fin`, `descripcion`, `elim`) VALUES
  (5, 'ADMINISTRATIVO', '2022-06-23', '2022-06-30', 'parte administrativa', 0),
  (6, 'HOSPITALES', '2022-06-24', '2022-12-31', 'LA EJECUCION DE LA INTERVENTORIA INTEGRAL (TECNICA, ADMINISTRATIVA, AMBIENTAL, FINANCIERA Y JURIDCA) DEL CONTRATO DE IBRA PARA EL DISEÑO, CONSTRUCCION, AMPLIACION, DOTACION PARA EL FUNCIONAMIENTO DE LAS INSTITUCIONES HOSPITALARIAS Y PUESTOS DE SALUD EN EL DEPARTAMENTO DEL ATLANTICO', 0),
  (7, 'ARROYO HOSPITAL', '2022-06-24', '2022-09-20', 'Canalización de arroyos en el hospital barranquilla', 0),
  (8, 'BARRIOS A LA OBRA', '2022-08-26', '2022-12-31', 'DURANTE LA Y COORDINACION DE LAS OBRAS NECESARIAS PARA LA EJECUCION DEL PROGRAMA BARRIOS A LA OBRA, DEL DISTRITO DE BARRANQUILLA VIGENCIA 2020-2021', 0),
  (9, 'PARQUES PARA LA GENTE', '2022-08-26', '2022-12-31', 'GERENCIA INTEGRAL PARA LA ESTRUCTURACIÓN Y EJECUCIÓN DEL COMPONENTE DE MANTENIMIENTO, CONSERVACIÓN Y ORNATO GENERAL DE ZONAS VERDES Y DURAS, DE PLAZAS, PARQUES, ESCENARIOS DEPORTIVOS, MALECONES, CENTROS INTEGRALES DE CONVIVENCIA –CIC, ENTRE OTRAS TIPOLOGIAS DE ESPACIO PÚBLICO DEL PROGRAMA DE “PARQUES PARA LA GENTE”', 0),
  (10, 'ADQUISICIÓN PREDIAL Y REASENTAMIENTO', '2022-08-26', '2022-12-31', 'ADQUISICIÓN PREDIAL Y REASENTAMIENTO EN LOS PROYECTOS DEL DISTRITO DE BARRANQUILLA INCLUIDOS EN EL PLAN DE DESARROLLO SOY BARRANQUILLA 2020-2023 – FASE I', 0),
  (11, 'ESCENARIOS DEPORTIVOS', '2022-08-26', '2022-12-30', 'DURANTE LA GERENCIA INTEGRAL PARA LA ESTRUCTURACIÓN Y EJECUCIÓN DEL COMPONENTE DE MANTENIMIENTO, CONSERVACIÓN Y ORNATO GENERAL DE ZONAS VERDES Y DURAS, DE PLAZAS, PARQUES, ESCENARIOS DEPORTIVOS, MALECONES, CENTROS INTEGRALES DE CONVIVENCIA –CIC, ENTRE OTRAS TIPOLOGIAS DE ESPACIO PÚBLICO DEL PROGRAMA DE “PARQUES PARA LA GENTE”', 0),
  (12, 'APOYO A LA GESTION', '2022-08-26', '2022-12-31', 'ADMINISTRATIVO', 0),
  (13, 'MERCADOS PÚBLICOS', '2022-01-01', '2022-12-30', 'ESTRUCTURACIÓN Y EJECUCIÓN DEL PROYECTO PARA LA CONSTRUCCIÓN DE NUEVOS MERCADOS PÚBLICOS EN EL DISTRITO DE BARRANQUILLA', 0),
  (14, 'CIÉNAGA DE MALLORQUÍN', '2022-01-01', '2022-12-31', 'GERENCIA INTEGRAL Y COORDINACIÓN DE LAS INTERVENCIONES NECESARIAS PARA LA EJECUCIÓN DE LOS PROYECTOS ECOPARQUE UF1 DISTRITO FAMILIAR Y TREN-TAJAMAR EN EL MARCO DE LA RECUPERACIÓN INTEGRAL DE LA CIÉNAGA DE MALLORQUÍN EN LA CIUDAD DE BARRANQUILLA', 0),
  (15, 'AGUA POTABLE', '2022-09-05', '2022-12-30', 'Sin información', 0),
  (16, 'GAS NATURAL', '2022-09-05', '2022-12-31', 'INTERVENTORIA, TECNICA, ADMINISTRATIVA Y FINANCIERA, PARA ESTRATOS 1 Y 2 EN LA ZONA URBANA', 0);

CREATE TABLE IF NOT EXISTS `proyectoarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_proyecto` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_proyectoarea_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_proyectoarea_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla edubarco_kardex.proyectoarea: ~14 rows (aproximadamente)
INSERT INTO `proyectoarea` (`id`, `id_areas`, `id_proyecto`) VALUES
  (1, '[{"id":"5"},{"id":"1"},{"id":"8"},{"id":"10"},{"id":"11"},{"id":"12"},{"id":"9"},{"id":"7"},{"id":"4"},{"id":"6"},{"id":"2"},{"id":"13"},{"id":"14"},{"id":"15"},{"id":"16"},{"id":"18"},{"id":"17"},{"id":"3"},{"id":"19"},{"id":"20"},{"id":"21"}]', 5),
  (3, '[{"id":"5"},{"id":"2"},{"id":"3"}]', 6),
  (4, '[{"id":"6"},{"id":"3"}]', 7),
  (5, '[{"id":"6"}]', 8),
  (6, '[{"id":"6"},{"id":"3"}]', 9),
  (7, '[{"id":"6"},{"id":"3"}]', 9),
  (8, '[{"id":"3"},{"id":"16"}]', 10),
  (9, '[{"id":"6"}]', 11),
  (10, '[{"id":"6"}]', 11),
  (11, '[{"id":"1"},{"id":"2"},{"id":"7"},{"id":"5"},{"id":"3"},{"id":"8"},{"id":"23"}]', 12),
  (12, '[{"id":"5"}]', 13),
  (13, '[{"id":"3"},{"id":"16"}]', 14),
  (14, '[{"id":"17"}]', 15),
  (15, '[{"id":"6"}]', 16);

CREATE TABLE IF NOT EXISTS `categoriaarea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_areas` text,
  `id_categorias` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_categoriaarea_categorias` (`id_categorias`),
  CONSTRAINT `FK_categoriaarea_categorias` FOREIGN KEY (`id_categorias`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla edubarco_kardex.categoriaarea: ~10 rows (aproximadamente)
INSERT INTO `categoriaarea` (`id`, `id_areas`, `id_categorias`) VALUES
  (1, '[{"id":"10"},{"id":"9"},{"id":"8"},{"id":"7"},{"id":"6"},{"id":"5"},{"id":"4"},{"id":"3"},{"id":"2"},{"id":"1"},{"id":"18"},{"id":"17"},{"id":"16"},{"id":"14"},{"id":"13"},{"id":"12"},{"id":"11"},{"id":"19"},{"id":"20"},{"id":"21"},{"id":"23"}]', 1),
  (2, '[{"id":"10"},{"id":"9"},{"id":"8"},{"id":"7"},{"id":"6"},{"id":"5"},{"id":"4"},{"id":"3"},{"id":"2"},{"id":"1"},{"id":"18"},{"id":"17"},{"id":"16"},{"id":"14"},{"id":"13"},{"id":"12"},{"id":"11"},{"id":"19"},{"id":"20"},{"id":"21"},{"id":"23"}]', 1),
  (3, '[{"id":"1"},{"id":"5"}]', 2),
  (4, '[{"id":"1"},{"id":"5"}]', 2),
  (5, '[{"id":"8"}]', 3),
  (6, '[{"id":"8"}]', 3),
  (7, '[{"id":"8"}]', 4),
  (8, '[{"id":"8"}]', 4),
  (9, '[{"id":"6"}]', 5),
  (10, '[{"id":"6"}]', 5);


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
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

-- Volcando datos para la tabla edubarco_kardex.insumos: ~134 rows (aproximadamente)
INSERT INTO `insumos` (`id`, `id_categoria`, `codigo`, `descripcion`, `observacion`, `imagen`, `stock`, `stockIn`, `precio_compra`, `precio_unidad`, `precio_por_mayor`, `fecha`, `elim`, `estante`, `nivel`, `seccion`, `prioridad`, `unidad`, `unidadSal`, `contenido`, `habilitado`, `imp`) VALUES
  (1, 3, '1', 'AMBIENTADOR DE BAÑO', '', NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (2, 4, '2', 'AROMATICA SURTIDA EN BOLSA', '', NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (3, 3, '3', 'ATOMIZADOR AMBIENTADOR', '', NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (4, 4, '4', 'AZUCAR ALTA PUREZA 200 TUBITOS DE 5G', '', NULL, 8, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (5, 1, '5', 'BANDEJA PORTA DOCUMENTOS', '', NULL, 40, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (6, 3, '6', 'BLANQUEADOR (LIMPIDO)', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (7, 1, '7', 'BOLIGRAFO  ROJO', '', NULL, 11, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 15, 1, 0),
  (8, 1, '8', 'BOLIGRAFO DE COLORES', '', NULL, 14, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 0, 0),
  (9, 1, '9', 'BOLIGRAFO NEGRO', NULL, NULL, 24, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (10, 3, '10', 'BOLSA BASURA NEGRA X 90*110 CMS', NULL, NULL, 7, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 10, 1, 0),
  (11, 3, '11', 'BOLSA BASURA VERDE 90*110 CMS ', NULL, NULL, 11, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 10, 1, 0),
  (12, 1, '12', 'BOLSA BASURA BLANCA X 90*110 CMS', '', NULL, 10, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 10, 1, 0),
  (13, 1, '13', 'BOLSA BASURA BLANCA 52*55 CMS (CANECA)', '', NULL, 8, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (14, 1, '14', 'BORRADOR DE NATA', NULL, NULL, 19, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (15, 1, '15', 'BORRADOR DE TABLERO', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (16, 4, '16', 'CAFÉ TOSTADO Y MOLIDO, FUERTE', NULL, NULL, 29, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (17, 1, '17', 'CARTULINA BRISTOL 1/8 X 8 SURTIDAS', NULL, NULL, 12, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (18, 1, '18', 'CARTULINA BRISTOL 70*100 BLANCA', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (19, 1, '19', 'CD-R ', NULL, NULL, 99, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (20, 1, '20', 'CINTA EMP TRANSP 48X100 REF.301 3M ', NULL, NULL, 11, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (21, 1, '21', 'CINTA EMP TRANSP DELGADA 12 MM X40M ', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (22, 1, '22', 'CINTA IMPRESORA EPSON LX350', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (23, 1, '23', 'CINTA INVISIBLE 33M:19MM PARA CHEQUES', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (24, 1, '24', 'CLIP MARIPOSA GIGANTE', NULL, NULL, 7, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (25, 1, '25', 'CLIP MARIPOSA X 50 EMP*50 ', NULL, NULL, 9, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 4, 1, 0),
  (26, 1, '26', 'CLIP SENCILLO X 100 EMP*100', NULL, NULL, 7, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (27, 1, '27', 'COLBON (PEGANTE UNIVERSAL) 480GR', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (28, 1, '28', 'CORRECTOR LIQUIDO LAPIZ *7 ML', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (29, 3, '29', 'CREMA LAVALOZA ', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (30, 1, '30', 'CUENTA FACIL', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (31, 5, '31', 'CINTA METRICA 10 MTS', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (32, 5, '32', 'CINTA METRICA 30 MTS', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (33, 5, '33', 'CINTA METRICA 50 MTS', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (34, 3, '34', 'DESINFECTANTE MULTIUSOS ', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (35, 3, '35', 'DETERGENTE EN POLVO ', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (36, 1, '36', 'DVD +R', '', NULL, 88, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (37, 3, '37', 'ESCOBA SUAVE MANGO MADERA', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (38, 3, '38', 'ESPONJA LAVAPLATOS DOBLE USO', NULL, NULL, 7, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (39, 5, '39', 'FLEXOMETRO STANLEY 26/8METROS', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (40, 1, '40', 'FOLIADOR (NUMERADOR CONSECUTIVO)', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (41, 1, '41', 'FORMAS CONTINUAS 9 1/2 *11 3P BLANCA 903 ', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (42, 1, '42', 'GANCHO LEGAJADOR PLASTICO', '', NULL, 60, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 100, 1, 0),
  (43, 1, '43', 'GRAPA COBRIZADA STANDARD *5000 ', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (44, 1, '44', 'GRAPA GALVANIZADA INDUSTRIAL *1000', NULL, NULL, 12, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (45, 1, '45', 'GRAPADORA 340 RANK (SENCILLA)', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (46, 1, '46', 'GRAPADORA INDUSTRIAL HASTA 100 HOJAS', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (47, 3, '47', 'GUANTES DE LATEX DE  EXAMEN ', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (48, 3, '48', 'GUANTES SEMI-INDUSTRIALES T9-9 ½*CALIBRE 25*LATEX NATURAL*COLOR NEGRO', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (49, 1, '49', 'GUIA CLASIFICADORA  CARTULINA REF. 105 AMARILLA ', NULL, NULL, 27, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (50, 1, '50', 'GUIAS CELUGUIA', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (51, 2, '51', 'HP 711 AMARILLO', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (52, 2, '52', 'HP 711 CYAN', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (53, 2, '53', 'HP 711 MAGENTA', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (54, 2, '54', 'HP 711 NEGRO', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (55, 1, '55', 'HUELLERO COLOR NEGRO', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (56, 3, '56', 'JABON LÍQUIDO PARA MANOS, ANTIBACTERIAL, BIODEGRADABLE AROMA MANZANA', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (57, 1, '57', 'LAPIZ NEGRO Nº2 ORIG. 482 ', NULL, NULL, 37, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 50, 1, 0),
  (58, 1, '58', 'LEGAJADOR AZ OFICIO AZUL ', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 12, 1, 0),
  (59, 1, '59', 'LEGAJOS (CARPETAS DE EDUBAR)', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (60, 1, '60', 'LIBRO ACTA 1/2 OFICIO 80H  100 FOLIOS (BITACORA)', NULL, NULL, 6, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 4, 1, 0),
  (61, 1, '61', 'LIBRO ACTA OFICIO 50H  100 FOLIOS (BITACORA)', NULL, NULL, 6, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 4, 1, 0),
  (62, 3, '62', 'LIMPIAVIDRIOS (AMONIACO-DESENGRASANTE SECADO RAPIDO)', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (63, 3, '63', 'LIMPION', NULL, NULL, 23, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (64, 1, '64', 'MARCADOR BORRABLE', NULL, NULL, 20, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (65, 1, '65', 'MARCADOR PERMANENTE NEGRO PUNTA FINA  (SHARPIE)', NULL, NULL, 17, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (66, 1, '66', 'MARCADOR PERMANENTE COLORES SURTIDOS PUNTA FINA  (SHARPIE)', NULL, NULL, 8, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (67, 1, '67', 'MARCADORES PERMANENTES SURTIDOS (ROJO/AZUL/NEGRO)', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (68, 3, '68', 'MASCARILLA DESECHABLE (TAPABOCAS)', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (69, 4, '69', 'MEZCLADORES DESECHABLES PARA CAFÉ', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (70, 2, '70', 'MOUSE USB', '', NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (71, 3, '71', 'PAPEL HIGIENIENICO INSTITUCIONAL ROLLOS, DOBLE HOJA, PRECORTADO, BLANCO', NULL, NULL, 15, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 4, 1, 0),
  (72, 1, '72', 'PAPEL RESMA FOTOCOPIA 75GR CARTA', '', NULL, 20, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (73, 1, '73', 'PAPEL RESMA FOTOCOPIA 75GR OFICIO ', NULL, NULL, 21, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (74, 3, '74', 'PAPELERA (CANECA)', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (75, 1, '75', 'PASTA CATALOGO 0.5R HERRAJE BLANCA', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (76, 1, '76', 'PASTA CATALOGO 1.0R HERRAJE BLANCA', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (77, 1, '77', 'PASTA CATALOGO 1.5R HERRAJE BLANCA', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (78, 1, '78', 'PASTA CATALOGO 2.0R HERRAJE BLANCA', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (79, 1, '79', 'PASTA CATALOGO 2.5R HERRAJE BLANCA', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (80, 1, '80', 'PASTA CATALOGO 3.0D HERRAJE BLANCA', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 3, 1, 0),
  (81, 1, '81', 'PEGANTE  EN BARRA 40GRS ', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (82, 1, '82', 'PERFORADORA 3 HUECOS', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (83, 1, '83', 'PERFORADORA RANK 1050 DOS HUECOS SEMI INDUSTRIAL (40 HOJAS)', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (84, 1, '84', 'PERFORADORA SENCILLA 1038 RANK', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (85, 1, '85', 'PROTECTOR DE TRANSPARENCIA (BOLSILLOS)', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (86, 1, '86', 'RECIBO DE CAJA MENOR X 200 HOJAS', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (87, 3, '87', 'RECOGEDOR DE BASURA', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (88, 1, '88', 'REGLA DE 30 CM', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (89, 1, '89', 'RESALTADORES SURTIDOS ', NULL, NULL, 20, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (90, 2, '90', 'ROLLO PLOTER BOND 75 GR 28 PULGADAS', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (91, 4, '91', 'ROLLO TOALLA COCINA LAVABLE', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (92, 1, '92', 'SACAGRAPA', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (93, 1, '93', 'SACAPUNTA', NULL, NULL, 35, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (94, 4, '94', 'SERVILLETA 27-5*17', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (95, 1, '95', 'SOBRE MANILA CARTA  22*29 ', NULL, NULL, 64, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (96, 1, '96', 'SOBRE MANILA GIGANTE 37*27 ', NULL, NULL, 89, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (97, 1, '97', 'SOBRE MANILA OFICIO 25*35 ', NULL, NULL, 119, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (98, 4, '98', 'TE HELADO', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (99, 2, '99', 'TECLADO KB-110X USB ', NULL, NULL, 6, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (100, 1, '100', 'TIJERA', '', NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (101, 2, '101', 'TINTA EPSON 664 COLOR AMARILLO', NULL, NULL, 6, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (102, 2, '102', 'TINTA EPSON 664 COLOR CYAN', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (103, 2, '103', 'TINTA EPSON 664 COLOR MAGENTA', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (104, 2, '104', 'TINTA EPSON 664 COLOR NEGRO', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (105, 1, '105', 'TINTA PARA SELLO DE CAUCHO', NULL, NULL, 6, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (106, 3, '106', 'TOALLA DE MANOS BLANCA 24X21CM HOJA TRIPLE DOBLADA EN Z', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (107, 3, '107', 'TRAPERO TIPO INDUSTRIAL', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (108, 3, '108', 'VARSOL SIN OLOR ', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (109, 4, '109', 'VASO 11 ONZAS TRANSPARENTE', NULL, NULL, 45, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (110, 4, '110', 'VASO CAFETERO TERMICO ESPUMADO (4 ONZAS)', '', NULL, 33, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (111, 1, '111', 'LAPIZ ROJO', NULL, NULL, 7, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (112, 1, '112', 'NOTAS ADHESIVAS', NULL, NULL, 15, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (113, 1, '113', 'PLANILLERO ACRILICO CON GANCHO', NULL, NULL, 40, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (114, 1, '114', 'BLOCK ANOTACIÓN ', NULL, NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (115, 1, '115', 'CAJA ARCHIVO INACTIVO # 12', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (116, 1, '116', 'CAJA ARCHIVO INACTIVO # 20', NULL, NULL, 1, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (117, 1, '117', 'CALCULADORA CASIO 12 DIGITOS', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (118, 2, '119', 'TONER TK-3160/3162', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:04', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (119, 2, '118', 'TONER TK-1175 (M2040dn)', NULL, NULL, 8, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (120, 2, '119', 'TONER TK-3160/3162', NULL, NULL, 2, 0, 0, 0, 0, '2022-08-24 10:07:51', 1, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (121, 1, '120', 'EXACTO PLÁSTICO GRANDE', '', NULL, 4, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, '0', '0', '0', 2, 2, 2, 4, 1, 0),
  (122, 4, '121', 'SERVILLETA DE LUJO 33*32CM ', NULL, NULL, 0, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (123, 1, '122', 'FUNDA PARA CD', '', NULL, 68, 0, 0, 0, 0, '2022-08-24 10:07:51', 1, '0', '0', '0', 2, 2, 2, 1, 1, 0),
  (124, 1, '123', 'BANDERITAS ADHESIVAS', '', NULL, 15, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, '0', '0', '0', 2, 2, 2, 20, 1, 0),
  (125, 2, '124', 'EPSON 544 NEGRO', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (126, 2, '125', 'EPSON 544 MAGENTA', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (127, 2, '126', 'EPSON 544 CYAN', NULL, NULL, 5, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (128, 2, '127', 'EPSON 544 AMARILLO', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (129, 2, '128', 'HP GT 53 NEGRO', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (130, 2, '129', 'HP GT 52 MAGENTA', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (131, 2, '130', 'HP GT 53 CYAN', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (132, 2, '131', 'HP GT 53 AMARILLO', NULL, NULL, 3, 0, 0, 0, 0, '2022-08-24 10:07:51', 0, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (133, 2, '132', 'TONER NEGRO KYOCERA TK - 1175', NULL, NULL, 15, 0, 0, 0, 0, '2022-08-24 10:07:51', 1, NULL, NULL, NULL, 2, 2, 2, 1, 1, 0),
  (134, 3, '133', 'PASTILLAS PARA TANQUE SANITARIO', '', 'vistas/img/productos/default/anonymous.png', 0, 0, 0, 0, 0, '2022-08-25 11:54:16', 0, '0', '0', '0', 3, 2, 2, 1, 0, 0);


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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_persona` int NOT NULL,
  `modulo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_asignaciones_usuarios` (`id_persona`),
  CONSTRAINT `FK_asignaciones_usuarios` FOREIGN KEY (`id_persona`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `pqr_filtro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pqr` text,
  `id_per` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_pqr_filtro_perfiles` (`id_per`),
  CONSTRAINT `FK_pqr_filtro_perfiles` FOREIGN KEY (`id_per`) REFERENCES `perfiles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `pqr_filtro` (`id`, `id_pqr`, `id_per`) VALUES
  (1, '[{"id":"1"},{"id":"2"},{"id":"3"},{"id":"4"},{"id":"9"}]', 7),
  (2, '[{"id":"6"},{"id":"5"}]', 8),
  (3, '[{"id":"8"},{"id":"7"}]', 6),
  (10, NULL, 3),
  (15, NULL, 2),
  (16, NULL, 2),
  (21, NULL, 11),
  (26, NULL, 1),
  (35, NULL, 4);


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
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

CREATE TABLE IF NOT EXISTS `exepcion_mensajes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='guarda las exepciones y mantiene un registro de los intentos e inicio de sesión';

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `sid` int NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `elim` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


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
  `id_accion` int NOT NULL DEFAULT '9',
  `acciones` text,
  `fecha_asignacion` datetime DEFAULT NULL,
  `fecha_respuesta` datetime DEFAULT NULL,
  `fecha_vencimiento` datetime NOT NULL,
  `dias_habiles` int NOT NULL,
  `dias_contados` int NOT NULL,
  `fecha_actualizacion` datetime DEFAULT NULL,
  `fecha` datetime NOT NULL COMMENT 'fecha en el que se radico, se creo esta columna para evitar mas procesamiento',
  PRIMARY KEY (`id`),
  KEY `FK__registro_radicados` (`id_radicado`),
  KEY `FK__registro_areas` (`id_area`),
  KEY `FK__registro_usuarios` (`id_usuario`),
  KEY `FK_registropqr_estado_pqr` (`id_estado`),
  KEY `FK_registropqr_pqr` (`id_pqr`),
  KEY `FK_registropqr_accion_pqr` (`id_accion`),
  CONSTRAINT `FK__registro_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK__registro_radicados` FOREIGN KEY (`id_radicado`) REFERENCES `radicados` (`id`),
  CONSTRAINT `FK__registro_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_registropqr_accion_pqr` FOREIGN KEY (`id_accion`) REFERENCES `accion_pqr` (`id`),
  CONSTRAINT `FK_registropqr_estado_pqr` FOREIGN KEY (`id_estado`) REFERENCES `estado_pqr` (`id`),
  CONSTRAINT `FK_registropqr_pqr` FOREIGN KEY (`id_pqr`) REFERENCES `pqr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE IF NOT EXISTS `registropqrencargado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_registro` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_tramite` datetime NOT NULL,
  `sw` int NOT NULL DEFAULT '1' COMMENT 'marca un check para las notificaciones',
  `id_estado` int NOT NULL,
  `id_accion` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_registro` (`id_registro`),
  KEY `FK__regIdUsuario` (`id_usuario`),
  KEY `FK_registropqrencargado_estado_pqr` (`id_estado`),
  KEY `FK_registropqrencargado_accion_pqr` (`id_accion`),
  CONSTRAINT `FK__regIdUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK__registropqr` FOREIGN KEY (`id_registro`) REFERENCES `registropqr` (`id`),
  CONSTRAINT `FK_registropqrencargado_accion_pqr` FOREIGN KEY (`id_accion`) REFERENCES `accion_pqr` (`id`),
  CONSTRAINT `FK_registropqrencargado_estado_pqr` FOREIGN KEY (`id_estado`) REFERENCES `estado_pqr` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Esta tabla almacena los registros que fueron asignados a un encargado, de tal forma que los filtre y muestre los que han sido asignados a este.';

CREATE TABLE IF NOT EXISTS `equiposactas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` char(7) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fecha` date DEFAULT NULL,
  `tipo` int DEFAULT '1',
  `cantidad` int DEFAULT '1',
  `observaciones` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `equiposparametros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `tipo` smallint NOT NULL DEFAULT '0',
  `fecha_creacion` date NOT NULL,
  `elim` tinyint(1) NOT NULL DEFAULT '0',
  `id_usr` int NOT NULL,
  `fecha_actualizacion` date DEFAULT NULL,
  `id_act` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_equiposparametros_usuarios` (`id_usr`),
  CONSTRAINT `FK_equiposparametros_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `equiposparametros` (`id`, `nombre`, `tipo`, `fecha_creacion`, `elim`, `id_usr`, `fecha_actualizacion`, `id_act`) VALUES
  (1, 'Portatil', 1, '2023-05-19', 0, 1, '2023-05-19', NULL),
  (2, 'Escritorio', 1, '2023-05-19', 0, 1, NULL, NULL),
  (4, 'EDUBAR', 2, '2023-05-19', 0, 1, NULL, NULL),
  (5, 'ACCESAR', 2, '2023-05-19', 0, 1, NULL, NULL),
  (6, 'AMD', 5, '2023-05-19', 0, 1, NULL, NULL),
  (7, 'INTEL', 5, '2023-05-19', 0, 1, NULL, NULL),
  (8, 'Microsoft Windows', 7, '2023-05-19', 0, 1, NULL, NULL),
  (9, 'IOS', 7, '2023-05-19', 0, 1, NULL, NULL),
  (10, '11', 8, '2023-05-19', 0, 1, NULL, NULL),
  (11, 'Monterey', 8, '2023-05-19', 0, 1, NULL, NULL),
  (12, 'Linux', 7, '2023-05-23', 0, 1, '2023-05-23', 1),
  (13, 'Ubuntu Server', 8, '2023-05-23', 0, 1, NULL, NULL),
  (14, 'MAC', 1, '2023-05-24', 0, 1, NULL, NULL),
  (15, 'HP', 3, '2023-05-24', 0, 1, NULL, NULL),
  (16, 'DELL', 3, '2023-05-24', 0, 1, NULL, NULL),
  (17, 'LENOVO', 3, '2023-05-24', 0, 1, NULL, NULL),
  (18, 'RYZEN 5 5500U', 6, '2023-05-24', 0, 1, NULL, NULL),
  (19, 'Core i7 8Gen', 6, '2023-05-24', 0, 1, NULL, NULL),
  (20, 'EliteBook x360', 4, '2023-05-24', 0, 1, NULL, NULL),
  (22, '245 G8', 4, '2023-06-21', 0, 1, NULL, NULL);

CREATE TABLE IF NOT EXISTS `equipos_licencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `productos` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `instalaciones` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `equipos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `n_serie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serialD` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `nombre` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `id_propietario` int DEFAULT NULL,
  `id_arquitectura` int DEFAULT NULL,
  `marca` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cpu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cpu_modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `cpu_generacion` int DEFAULT '0',
  `cpu_frecuencia` float DEFAULT '0',
  `ram` int DEFAULT '0',
  `ssd` int DEFAULT '0',
  `hdd` int NOT NULL DEFAULT '0',
  `gpu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `gpu_modelo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `gpu_capacidad` int DEFAULT '0',
  `teclado` int DEFAULT '0',
  `mouse` int DEFAULT '0',
  `so` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT 'sistema operativo',
  `so_version` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `observaciones` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `estado` int DEFAULT '0',
  `id_licencia` int NOT NULL DEFAULT '0',
  `historial` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `id_responsable` int NOT NULL,
  `id_usr_generado` int NOT NULL COMMENT 'quien ejecuto la acción',
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  `id_area` int NOT NULL,
  `id_proyecto` int NOT NULL,
  `rol` int NOT NULL DEFAULT '0',
  `id_acta` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_serie` (`n_serie`),
  KEY `FK_equipos_usuarios` (`id_usuario`),
  KEY `FK_equipos_usuarios_2` (`id_responsable`),
  KEY `FK_equipos_usuarios_3` (`id_usr_generado`),
  KEY `FK_equipos_areas` (`id_area`),
  KEY `FK_equipos_proyectos` (`id_proyecto`),
  CONSTRAINT `FK_equipos_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`),
  CONSTRAINT `FK_equipos_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`),
  CONSTRAINT `FK_equipos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_equipos_usuarios_2` FOREIGN KEY (`id_responsable`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `FK_equipos_usuarios_3` FOREIGN KEY (`id_usr_generado`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='atributos de la entidad equipos de computo';