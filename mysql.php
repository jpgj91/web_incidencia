-- MySQL Script generated by MySQL Workbench
-- Thu May  4 21:51:15 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema incidencias
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema incidencias
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `incidencias` DEFAULT CHARACTER SET utf8 ;
USE `incidencias` ;

-- -----------------------------------------------------
-- Table `incidencias`.`rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `email` VARCHAR(60) NOT NULL,
  `rol_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_usuario_rol_idx` (`rol_id` ASC),
  CONSTRAINT `fk_usuario_rol`
    FOREIGN KEY (`rol_id`)
    REFERENCES `incidencias`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`prioridad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`prioridad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`estado` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`incidencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`incidencia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(2000) NOT NULL,
  `asunto` VARCHAR(100) NOT NULL,
  `prioridad_id` INT NOT NULL,
  `estado_id` INT NOT NULL,
  `asignado_usuario_id` INT  NULL,
  `reportador_usuario_id` INT NOT NULL,
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `fk_incidencia_prioridad1_idx` (`prioridad_id` ASC),
  INDEX `fk_incidencia_estado1_idx` (`estado_id` ASC),
  INDEX `fk_incidencia_usuario1_idx` (`asignado_usuario_id` ASC),
  INDEX `fk_incidencia_usuario2_idx` (`reportador_usuario_id` ASC),
  CONSTRAINT `fk_incidencia_prioridad1`
    FOREIGN KEY (`prioridad_id`)
    REFERENCES `incidencias`.`prioridad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incidencia_estado1`
    FOREIGN KEY (`estado_id`)
    REFERENCES `incidencias`.`estado` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incidencia_usuario1`
    FOREIGN KEY (`asignado_usuario_id`)
    REFERENCES `incidencias`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_incidencia_usuario2`
    FOREIGN KEY (`reportador_usuario_id`)
    REFERENCES `incidencias`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`visibilidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`visibilidad` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`comentario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`comentario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `texto` VARCHAR(2000) NOT NULL,
  `visibilidad_id` INT NOT NULL,
  `incidencia_id` INT NOT NULL,
  `usuario_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comentario_visibilidad1_idx` (`visibilidad_id` ASC),
  INDEX `fk_comentario_incidencia1_idx` (`incidencia_id` ASC),
  INDEX `fk_comentario_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_comentario_visibilidad1`
    FOREIGN KEY (`visibilidad_id`)
    REFERENCES `incidencias`.`visibilidad` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_incidencia1`
    FOREIGN KEY (`incidencia_id`)
    REFERENCES `incidencias`.`incidencia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comentario_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `incidencias`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`permiso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`rol_has_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`rol_has_permiso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol_id` INT NOT NULL,
  `permiso_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rol_has_permiso_permiso1_idx` (`permiso_id` ASC),
  INDEX `fk_rol_has_permiso_rol1_idx` (`rol_id` ASC),
  CONSTRAINT `fk_rol_has_permiso_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `incidencias`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rol_has_permiso_permiso1`
    FOREIGN KEY (`permiso_id`)
    REFERENCES `incidencias`.`permiso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `incidencias`.`usuario_has_permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `incidencias`.`usuario_has_permiso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `permiso_id` INT NOT NULL,
  INDEX `fk_usuario_has_permiso_permiso1_idx` (`permiso_id` ASC),
  INDEX `fk_usuario_has_permiso_usuario1_idx` (`usuario_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_has_permiso_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `incidencias`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_permiso_permiso1`
    FOREIGN KEY (`permiso_id`)
    REFERENCES `incidencias`.`permiso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
-- -----------------------------------------------------
-- Table `rol`
-- -----------------------------------------------------
INSERT INTO `rol`(`name`) VALUES ("Cliente");
INSERT INTO `rol`(`name`) VALUES ("Jefe Proyecto");
INSERT INTO `rol`(`name`) VALUES ("Programador");
-- -----------------------------------------------------
-- Table `estado`
-- -----------------------------------------------------
INSERT INTO `estado`(`name`) VALUES ('en epera');
INSERT INTO `estado`(`name`) VALUES ('en proceso');
INSERT INTO `estado`(`name`) VALUES ('cerrado');
-- -----------------------------------------------------
-- Table `prioridad`
-- -----------------------------------------------------
INSERT INTO `prioridad`(`name`) VALUES ('Alta');
INSERT INTO `prioridad`(`name`) VALUES ('media');
INSERT INTO `prioridad`(`name`) VALUES ('baja');
-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('jose','e10adc3949ba59abbe56e057f20f883e','jose@gmail.com','1');
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('juan','e10adc3949ba59abbe56e057f20f883e','juan@gmail.com','1');
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('rafael','e10adc3949ba59abbe56e057f20f883e','rafael@gmail.com','1');
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('pedro','e10adc3949ba59abbe56e057f20f883e','pedro@gmail.com','2');
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('antonio','e10adc3949ba59abbe56e057f20f883e','antonio@gmail.com','3');
INSERT INTO `usuario`(`name`, `password`, `email`, `rol_id`) VALUES ('pedro','e10adc3949ba59abbe56e057f20f883e','pedro@gmail.com','3');