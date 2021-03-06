-- MySQL Script generated by MySQL Workbench
-- Tue Jan  8 14:32:40 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `yii2` DEFAULT CHARACTER SET utf8 ;
USE `yii2` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`users` (
  `id` INT NOT NULL,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`meals`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`meals` (
  `id` INT NOT NULL,
  `start_date` DATETIME NULL,
  `end_date` DATETIME NULL,
  `status` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`orders` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `meal_id` INT NOT NULL,
  PRIMARY KEY (`id`, `user_id`, `meal_id`),
  INDEX `user_id_idx` (`user_id` ASC),
  INDEX `meal_id_idx` (`meal_id` ASC),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `yii2`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `meal_id`
    FOREIGN KEY (`meal_id`)
    REFERENCES `yii2`.`meals` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`addition_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`addition_types` (
  `id` INT NOT NULL,
  `description` VARCHAR(45) NULL,
  `multiselector` TINYINT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`additions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`additions` (
  `id` INT NOT NULL,
  `description` VARCHAR(45) NULL,
  `addition_type_id` INT NOT NULL,
  PRIMARY KEY (`id`, `addition_type_id`),
  INDEX `addition_type_id_idx` (`addition_type_id` ASC),
  CONSTRAINT `addition_type_id`
    FOREIGN KEY (`addition_type_id`)
    REFERENCES `yii2`.`addition_types` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`orders_has_additions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `yii2`.`orders_has_additions` (
  `orders_id` INT NOT NULL,
  `additions_id` INT NOT NULL,
  PRIMARY KEY (`orders_id`, `additions_id`),
  INDEX `fk_orders_has_additions_additions1_idx` (`additions_id` ASC),
  INDEX `fk_orders_has_additions_orders1_idx` (`orders_id` ASC),
  CONSTRAINT `fk_orders_has_additions_orders1`
    FOREIGN KEY (`orders_id`)
    REFERENCES `yii2`.`orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_has_additions_additions1`
    FOREIGN KEY (`additions_id`)
    REFERENCES `yii2`.`additions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
