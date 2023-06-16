ALTER TABLE `registropqrencargado`
	ADD COLUMN `id_estado` INT(1) NOT NULL AFTER `sw`,
	ADD CONSTRAINT `FK_registropqrencargado_estado_pqr` FOREIGN KEY (`id_estado`) REFERENCES `estado_pqr` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE `accion_pqr`
	ADD COLUMN `id_perfil` INT(2) NULL DEFAULT '7' COMMENT 'Las acciones se mostraran segun el perfil' AFTER `nombre_accion`,
	ADD CONSTRAINT `FK_accion_pqr_perfiles` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE `accion_pqr`
	CHANGE COLUMN `sw` `sw` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Dependiendo del perfil asi podrá visualizar una acción' AFTER `nombre_accion`;



ALTER TABLE `registropqr`
	ADD COLUMN `id_accion` INT(10) NOT NULL DEFAULT '9' AFTER `id_pqr`,
	ADD CONSTRAINT `FK_registropqr_accion_pqr` FOREIGN KEY (`id_accion`) REFERENCES `accion_pqr` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;


ALTER TABLE `registropqrencargado`
	ADD COLUMN `fecha_tramite` DATETIME NOT NULL AFTER `fecha`;

ALTER TABLE `registropqrencargado`
	ADD UNIQUE INDEX `id_registro` (`id_registro`);


ALTER TABLE `registropqrencargado`
	ADD COLUMN `id_accion` INT NOT NULL DEFAULT '1' AFTER `id_estado`,
	ADD CONSTRAINT `FK_registropqrencargado_accion_pqr` FOREIGN KEY (`id_accion`) REFERENCES `accion_pqr` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;



CREATE TABLE `equipos` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`serial` VARCHAR(50) NULL DEFAULT NULL,
	`serialD` VARCHAR(50) NULL DEFAULT NULL,
	`id_propietario` INT(11) NULL,
	`id_arquitectura` INT(11) NULL,
	`marca` VARCHAR(50) NULL DEFAULT NULL,
	`modelo` VARCHAR(50) NULL DEFAULT NULL,
	`cpu` VARCHAR(50) NULL DEFAULT NULL,
	`cpu_modelo` VARCHAR(50) NULL DEFAULT NULL,
	`cpu_generacion` INT(2) NULL,
	`cpu_frecuencia` FLOAT(3) NULL DEFAULT NULL,
	`ram` INT(3) NULL DEFAULT NULL,
	`ssd` INT(5) NULL DEFAULT NULL,
	`hdd` INT(5) NULL,
	`gpu` VARCHAR(50) NULL DEFAULT NULL,
	`gpu_modelo` VARCHAR(50) NULL DEFAULT NULL,
	`gpu_capacidad` INT(4) NULL,
	`teclado` INT(1) NULL DEFAULT '0',
	`mouse` INT(1) NULL DEFAULT '0',
	`so` VARCHAR(50) NULL DEFAULT NULL COMMENT 'sistema operativo',
	`so_version` VARCHAR(50) NULL DEFAULT NULL,
	`observaciones` VARCHAR(500) NULL DEFAULT NULL,
	`estado` INT(1) NULL,
	`id_licencia` INT(3) NULL DEFAULT '0',
	`historial` VARCHAR(500) NULL DEFAULT NULL,
	`id_usuario` INT(11) NOT NULL,
	`id_responsable` INT(11) NOT NULL,
	`id_usr_generado` INT(11) NOT NULL COMMENT 'quien ejecuto la acción',
	`fecha_ingreso` DATE NULL,
	`fecha_devolucion` DATE NULL,
	`id_area` INT NOT NULL,
	PRIMARY KEY (`id`)
)
COMMENT='atributos de la entidad equipos de computo'
COLLATE='utf8mb4_unicode_ci'
;


CREATE TABLE `equipos_licencias` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`usuario` VARCHAR(50) NULL DEFAULT NULL,
	`password` VARCHAR(50) NULL DEFAULT NULL,
	`productos` VARCHAR(50) NULL DEFAULT NULL,
	`fecha_creacion` DATE NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
;


CREATE TABLE `equipos_arquitectura` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
;

CREATE TABLE `equipos_propietario` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(50) NULL DEFAULT NULL,
	`contacto` VARCHAR(50) NULL DEFAULT NULL,
	`contacto_num` VARCHAR(50) NULL DEFAULT NULL,
	`contacto_email` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
;


ALTER TABLE `equipos`
	ADD COLUMN `id_proyecto` INT(10) NOT NULL AFTER `id_area`,
	ADD CONSTRAINT `FK_equipos_equipos_propietario` FOREIGN KEY (`id_propietario`) REFERENCES `equipos_propietario` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_equipos_arquitectura` FOREIGN KEY (`id_arquitectura`) REFERENCES `equipos_arquitectura` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_usuarios_2` FOREIGN KEY (`id_responsable`) REFERENCES `usuarios` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_usuarios_3` FOREIGN KEY (`id_usr_generado`) REFERENCES `usuarios` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_areas` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION,
	ADD CONSTRAINT `FK_equipos_proyectos` FOREIGN KEY (`id_proyecto`) REFERENCES `proyectos` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;


INSERT INTO `edubarco_kardex`.`js_data` (`page`, `title`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pOnce`, `descripcion`) VALUES ('equiposlicencias', 'Licencias', '0', '0', '0', '10', '0', 'Pagina que lista las licencias adquiridas de los programas, como el paquete de ofimatica');
INSERT INTO `edubarco_kardex`.`js_data` (`page`, `title`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pOnce`) VALUES ('equiposParametros', 'Parametros', '0', '0', '0', '10', '0');


CREATE TABLE `equiposParametros` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(100) NOT NULL DEFAULT '0',
	`tipo` SMALLINT(2) NOT NULL DEFAULT 0,
	`fecha_creacion` DATE NOT NULL,
	`elim` TINYINT(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`)
)
COMMENT='Almacenara los paramtros de equipos, como propietarios, cpu'
COLLATE='utf8mb4_unicode_ci'
;


ALTER TABLE `equiposparametros`
	ADD COLUMN `id_usr` INT(11) NOT NULL AFTER `elim`,
	ADD CONSTRAINT `FK_equiposparametros_usuarios` FOREIGN KEY (`id_usr`) REFERENCES `usuarios` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE `equiposparametros`
	ADD COLUMN `fecha_actualizacion` DATE NOT NULL AFTER `id_usr`;

ALTER TABLE `equiposparametros`
	ADD COLUMN `id_act` INT(11) NULL AFTER `fecha_actualizacion`;

ALTER TABLE `equipos`
	ADD COLUMN `rol` INT(1) NOT NULL DEFAULT '0' AFTER `id_proyecto`;

UPDATE `edubarco_kardex`.`js_data` SET `num`='45' WHERE  `id`=67;

ALTER TABLE `equipos`
	CHANGE COLUMN `estado` `estado` INT(1) NULL DEFAULT NULL AFTER `observaciones`,
	CHANGE COLUMN `id_licencia` `id_licencia` INT(10) NOT NULL DEFAULT '1' AFTER `estado`;

ALTER TABLE `equipos`
	ADD COLUMN `nombre` CHAR(50) NULL DEFAULT NULL AFTER `serialD`;

INSERT INTO `edubarco_kardex`.`js_data` (`page`, `title`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pDiez`) VALUES ('actasIngreso', 'Actas de Ingreso', '0', '0', '0', '0', '10');

CREATE TABLE `equiposActas` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`fecha` DATE NULL,
	`tipo` INT(1) NULL DEFAULT '1',
	`cantidad` INT(2) NULL DEFAULT '1',
	`Observaciones` VARCHAR(500) NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
;

UPDATE `edubarco_kardex`.`js_data` SET `num`='46' WHERE  `id`=73;

ALTER TABLE `equiposactas`
	ADD COLUMN `file` VARCHAR(100) NULL DEFAULT NULL AFTER `Observaciones`;


INSERT INTO `edubarco_kardex`.`js_data` (`page`, `title`, `pDos`, `pTres`, `pCuatro`, `pCinco`, `pDiez`, `file`) VALUES ('verActaEquipos', 'Ver Acta', '0', '0', '0', '0', '10', '0');


UPDATE `edubarco_kardex`.`js_data` SET `num`='47' WHERE  `id`=74;


ALTER TABLE `equipos`
	ADD COLUMN `id_acta` INT NULL AFTER `rol`;

ALTER TABLE `equiposactas`
	ADD COLUMN `codigo` CHAR(7) NOT NULL DEFAULT '0' AFTER `id`;

UPDATE `edubarco_kardex`.`js_data` SET `file`='1' WHERE  `id`=67;

ALTER TABLE `equipos_licencias`
	ADD COLUMN `instalaciones` TINYINT(2) NOT NULL DEFAULT '1' AFTER `fecha_creacion`;
