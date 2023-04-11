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
