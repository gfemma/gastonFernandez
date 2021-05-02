/* Tabla de paises */
CREATE TABLE IF NOT EXISTS `facultad`.`geo_paises`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `nombre` VARCHAR(128) NOT NULL COMMENT 'Nombre del país',
    `sys_fecha_alta` DATETIME NULL COMMENT 'Fecha de alta del registro',
    `sys_fecha_modif` DATETIME NULL COMMENT 'Fecha de la ultima modificación',
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

/* Tabla de localidades */
CREATE TABLE IF NOT EXISTS `facultad`.`geo_localidades`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `pais_id` INT NOT NULL COMMENT 'ID del país al que pertenece la localidad',
    `nombre` VARCHAR(128) NOT NULL COMMENT 'Nombre de la ciudad',
    `sys_fecha_alta` DATETIME NULL COMMENT 'Fecha de alta del registro',
    `sys_fecha_modif` DATETIME NULL COMMENT 'Fecha de la ultima modificación',
    PRIMARY KEY(`id`),
    INDEX(`pais_id`)
) ENGINE = InnoDB;

/* Tabla de ciudades */
CREATE TABLE IF NOT EXISTS `facultad`.`geo_ciudades`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `localidad_id` INT NOT NULL COMMENT 'ID de la localidad a la que pertenece',
    `Nombre` VARCHAR(256) NOT NULL,
    `sys_fecha_alta` DATETIME NULL COMMENT 'Fecha de alta del registro',
    `sys_fecha_modif` DATETIME NULL COMMENT 'Fecha de la ultima modificación',
    PRIMARY KEY(`id`),
    INDEX(`localidad_id`)
) ENGINE = InnoDB;

/* Inserción de datos */
-- Paises
INSERT INTO `geo_paises` (`id`, `nombre`, `sys_fecha_alta`, `sys_fecha_modif`) VALUES (1, 'Argentina', '2021-05-01 18:08:39', '2021-05-01 18:08:39');
-- Localidades
INSERT INTO `geo_localidades` (`id`, `pais_id`, `nombre`, `sys_fecha_alta`, `sys_fecha_modif`) 
VALUES 
(1, '1', 'Buenos Aires', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(2, '1', 'Capital Federal', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(3, '1', 'Catamarca', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(4, '1', 'Chaco', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(5, '1', 'Chubut', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(6, '1', 'Córdoba', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(7, '1', 'Corrientes', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(8, '1', 'Entre Ríos', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(9, '1', 'Formosa', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(10, '1', 'Jujuy', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(11, '1', 'La Pampa', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(12, '1', 'La Rioja', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(13, '1', 'Mendoza', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(14, '1', 'Misiones', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(15, '1', 'Neuquén', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(16, '1', 'Río Negro', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(17, '1', 'Salta', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(18, '1', 'San Juan', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(19, '1', 'San Luis', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(20, '1', 'Santa Cruz', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(21, '1', 'Santa Fe', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(22, '1', 'Santiago del Estero', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(23, '1', 'Tierra del Fuego', '2021-05-01 18:08:39', '2021-05-01 18:08:39'),
(24, '1', 'Tucumán', '2021-05-01 18:08:39', '2021-05-01 18:08:39');

-- Ciudades queda en un dump aparte