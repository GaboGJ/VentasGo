/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 13.5 		*/
/*  Created On : 02-oct.-2024 10:42:18 				*/
/*  DBMS       : MySql 						*/
/* ---------------------------------------------------- */

SET FOREIGN_KEY_CHECKS=0 
;

/* Drop Tables */

DROP TABLE IF EXISTS `tb_almacen` CASCADE
;

DROP TABLE IF EXISTS `tb_carrito` CASCADE
;

DROP TABLE IF EXISTS `tb_categorias` CASCADE
;

DROP TABLE IF EXISTS `tb_clientes` CASCADE
;

DROP TABLE IF EXISTS `tb_compras` CASCADE
;

DROP TABLE IF EXISTS `tb_modulos` CASCADE
;

DROP TABLE IF EXISTS `tb_operaciones` CASCADE
;

DROP TABLE IF EXISTS `tb_permisos` CASCADE
;

DROP TABLE IF EXISTS `tb_proveedores` CASCADE
;

DROP TABLE IF EXISTS `tb_roles` CASCADE
;

DROP TABLE IF EXISTS `tb_usuarios` CASCADE
;

DROP TABLE IF EXISTS `tb_ventas` CASCADE
;

/* Create Tables */

CREATE TABLE `tb_almacen`
(
	`id_producto` INT NOT NULL AUTO_INCREMENT,
	`codigo` VARCHAR(50) NULL,
	`nombre` VARCHAR(50) NULL,
	`descripcion` TEXT NULL,
	`stock` INT NULL,
	`stock_minimo` INT NULL,
	`stock_maximo` INT NULL,
	`precio_compra` VARCHAR(50) NULL,
	`precio_venta` VARCHAR(50) NULL,
	`fecha_ingreso` DATE NULL,
	`imagen` TEXT NULL,
	`id_usuario` INT NULL,
	`id_categoria` INT NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_producto` BIT(1) NULL,
	CONSTRAINT `PK_tb_almacen` PRIMARY KEY (`id_producto` ASC)
)

;

CREATE TABLE `tb_carrito`
(
	`id_carrito` INT NOT NULL AUTO_INCREMENT,
	`nro_venta` INT NULL,
	`id_producto` INT NULL,
	`cantidad` INT NULL,
	`fyh_creacion` DATETIME(4) NULL,
	`fyh_actualizacion` DATETIME(4) NULL,
	`fyh_eliminacio` DATETIME NULL,
	`estado_carrito` BIT(1) NULL,
	CONSTRAINT `PK_tb_carrito` PRIMARY KEY (`id_carrito` ASC)
)

;

CREATE TABLE `tb_categorias`
(
	`id_categoria` INT NOT NULL AUTO_INCREMENT,
	`nombre_categoria` VARCHAR(50) NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_categoria` BIT(1) NULL,
	CONSTRAINT `PK_tb_categorias` PRIMARY KEY (`id_categoria` ASC)
)

;

CREATE TABLE `tb_clientes`
(
	`id_cliente` INT NOT NULL AUTO_INCREMENT,
	`nombre_cliente` VARCHAR(50) NULL,
	`nit_ci_cliente` VARCHAR(50) NULL,
	`celular_cliente` VARCHAR(10) NULL,
	`email_cliente` VARCHAR(50) NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME(4) NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_cliente` BIT(1) NULL,
	CONSTRAINT `PK_tb_clientes` PRIMARY KEY (`id_cliente` ASC)
)

;

CREATE TABLE `tb_compras`
(
	`id_compra` INT NOT NULL AUTO_INCREMENT,
	`id_producto` INT NULL,
	`nro_compra` INT NULL,
	`fecha_compra` DATE NULL,
	`id_proveedor` INT NULL,
	`comprobante` VARCHAR(50) NULL,
	`id_usuario` INT NULL,
	`precio_compra` VARCHAR(50) NULL,
	`cantidad` INT NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_compra` BIT(1) NULL,
	CONSTRAINT `PK_tb_compras` PRIMARY KEY (`id_compra` ASC)
)

;

CREATE TABLE `tb_modulos`
(
	`id_modulo` INT NOT NULL AUTO_INCREMENT,
	`nombre_modulo` VARCHAR(50) NULL,
	`descripcion_modulo` VARCHAR(50) NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_modulo` BIT(1) NULL,
	CONSTRAINT `PK_tb_modulos` PRIMARY KEY (`id_modulo` ASC)
)

;

CREATE TABLE `tb_operaciones`
(
	`id_operacion` INT NOT NULL AUTO_INCREMENT,
	`nombre_operacion` VARCHAR(50) NULL,
	`id_modulo` INT NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_operacion` BIT(1) NULL,
	CONSTRAINT `PK_tb_operaciones` PRIMARY KEY (`id_operacion` ASC)
)

;

CREATE TABLE `tb_permisos`
(
	`id_permiso` INT NOT NULL AUTO_INCREMENT,
	`id_rol` INT NULL,
	`id_operacion` INT NULL,
	CONSTRAINT `PK_tb_permisos` PRIMARY KEY (`id_permiso` ASC)
)

;

CREATE TABLE `tb_proveedores`
(
	`id_proveedor` INT NOT NULL AUTO_INCREMENT,
	`nombre_proveedor` VARCHAR(50) NULL,
	`celular` VARCHAR(50) NULL,
	`empresa` VARCHAR(50) NULL,
	`email` VARCHAR(50) NULL,
	`direccion` VARCHAR(4) NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME(4) NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_proveedor` BIT(1) NULL,
	CONSTRAINT `PK_tb_proveedores` PRIMARY KEY (`id_proveedor` ASC)
)

;

CREATE TABLE `tb_roles`
(
	`id_rol` INT NOT NULL AUTO_INCREMENT,
	`rol` VARCHAR(50) NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_rol` BIT(1) NULL,
	CONSTRAINT `PK_tb_roles` PRIMARY KEY (`id_rol` ASC)
)

;

CREATE TABLE `tb_usuarios`
(
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`nombres` VARCHAR(50) NULL,
	`email` VARCHAR(50) NULL,
	`password_user` TEXT NULL,
	`token` VARCHAR(50) NULL,
	`id_rol` INT NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_usuario` BIT(1) NULL,
	CONSTRAINT `PK_tb_usuarios` PRIMARY KEY (`id_usuario` ASC)
)

;

CREATE TABLE `tb_ventas`
(
	`id_venta` INT NOT NULL AUTO_INCREMENT,
	`nro_venta` INT NOT NULL,
	`id_cliente` INT NULL,
	`total_pagado` INT NULL,
	`fyh_creacion` DATETIME NULL,
	`fyh_actualizacion` DATETIME NULL,
	`fyh_eliminacion` DATETIME NULL,
	`estado_venta` BIT(1) NULL,
	`id_carrito` INT NULL,
	CONSTRAINT `PK_tb_ventas` PRIMARY KEY (`id_venta` ASC)
)

;

/* Create Primary Keys, Indexes, Uniques, Checks */

ALTER TABLE `tb_almacen` 
 ADD INDEX `IXFK_tb_almacen_tb_categorias` (`id_categoria` ASC)
;

ALTER TABLE `tb_almacen` 
 ADD INDEX `IXFK_tb_almacen_tb_usuarios` (`id_usuario` ASC)
;

ALTER TABLE `tb_carrito` 
 ADD INDEX `IXFK_tb_carrito_tb_almacen` (`id_producto` ASC)
;

ALTER TABLE `tb_compras` 
 ADD INDEX `IXFK_tb_compras_tb_almacen` (`id_producto` ASC)
;

ALTER TABLE `tb_compras` 
 ADD INDEX `IXFK_tb_compras_tb_proveedores` (`id_proveedor` ASC)
;

ALTER TABLE `tb_compras` 
 ADD INDEX `IXFK_tb_compras_tb_usuarios` (`id_usuario` ASC)
;

ALTER TABLE `tb_operaciones` 
 ADD INDEX `IXFK_tb_operaciones_tb_modulos` (`id_modulo` ASC)
;

ALTER TABLE `tb_permisos` 
 ADD INDEX `IXFK_tb_permisos_tb_operaciones` (`id_operacion` ASC)
;

ALTER TABLE `tb_permisos` 
 ADD INDEX `IXFK_tb_permisos_tb_roles` (`id_rol` ASC)
;

ALTER TABLE `tb_usuarios` 
 ADD INDEX `IXFK_tb_usuarios_tb_roles` (`id_rol` ASC)
;

ALTER TABLE `tb_ventas` 
 ADD INDEX `IXFK_tb_ventas_tb_clientes` (`id_cliente` ASC)
;

/* Create Foreign Key Constraints */

ALTER TABLE `tb_almacen` 
 ADD CONSTRAINT `FK_tb_almacen_tb_categorias`
	FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_almacen` 
 ADD CONSTRAINT `FK_tb_almacen_tb_usuarios`
	FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_carrito` 
 ADD CONSTRAINT `FK_tb_carrito_tb_almacen`
	FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_compras` 
 ADD CONSTRAINT `FK_tb_compras_tb_almacen`
	FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_compras` 
 ADD CONSTRAINT `FK_tb_compras_tb_proveedores`
	FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_compras` 
 ADD CONSTRAINT `FK_tb_compras_tb_usuarios`
	FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_operaciones` 
 ADD CONSTRAINT `FK_tb_operaciones_tb_modulos`
	FOREIGN KEY (`id_modulo`) REFERENCES `tb_modulos` (`id_modulo`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_permisos` 
 ADD CONSTRAINT `FK_tb_permisos_tb_operaciones`
	FOREIGN KEY (`id_operacion`) REFERENCES `tb_operaciones` (`id_operacion`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_permisos` 
 ADD CONSTRAINT `FK_tb_permisos_tb_roles`
	FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_usuarios` 
 ADD CONSTRAINT `FK_tb_usuarios_tb_roles`
	FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON DELETE Restrict ON UPDATE Restrict
;

ALTER TABLE `tb_ventas` 
 ADD CONSTRAINT `FK_tb_ventas_tb_clientes`
	FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`) ON DELETE Restrict ON UPDATE Restrict
;

SET FOREIGN_KEY_CHECKS=1 
;
