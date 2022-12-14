-- MySQL Script generated by MySQL Workbench
-- Tue Nov 15 23:17:59 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbapp
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbapp
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbapp` DEFAULT CHARACTER SET utf8 ;
USE `dbapp` ;

-- -----------------------------------------------------
-- Table `dbapp`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbapp`.`comments` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` VARCHAR(90) NOT NULL,
  `comment` TEXT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbapp`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbapp`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(32) NOT NULL,
  `password` VARCHAR(256) NOT NULL,
  `firstname` VARCHAR(45) NOT NULL,
  `lastname` VARCHAR(45) NOT NULL,
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbapp`.`results`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbapp`.`results` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `data` TEXT NOT NULL,
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbapp`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbapp`.`log` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `dbapp`.`comments`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbapp`;
INSERT INTO `dbapp`.`comments` (`id`, `tstamp`, `name`, `comment`) VALUES (1, '2022-11-16 05:01:31', 'Grouse', 'Cross Site Scripting (XSS) is a sophisticated but common exploit.');
INSERT INTO `dbapp`.`comments` (`id`, `tstamp`, `name`, `comment`) VALUES (2, '2022-11-16 05:02:36', 'Tuck', 'It really is a <b>fascinating</b> topic. Everyone should give it a try.');
INSERT INTO `dbapp`.`comments` (`id`, `tstamp`, `name`, `comment`) VALUES (3, '2022-11-16 05:03:23', 'Max', '+1, as long as you\'ve got the right <span style=\"color:tomato;\">permissions</span> to try it out!');
INSERT INTO `dbapp`.`comments` (`id`, `tstamp`, `name`, `comment`) VALUES (4, '2022-11-16 05:04:39', 'Grouse', 'Thanks for stopping by. Leave a comment to let us know you were here!');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbapp`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbapp`;
INSERT INTO `dbapp`.`users` (`id`, `username`, `password`, `firstname`, `lastname`, `tstamp`) VALUES (1, 'admin', '$2y$10$awi9NTwz5JWf0SVsDL7uE.tWpOyA9OyhSJUsS4TxXIQdrBYfWKy/u', 'Demo', 'Administrator', '2022-11-13 16:03:58');

COMMIT;


-- -----------------------------------------------------
-- Data for table `dbapp`.`log`
-- -----------------------------------------------------
START TRANSACTION;
USE `dbapp`;
INSERT INTO `dbapp`.`log` (`id`, `tstamp`, `activity`) VALUES (1, '2022-11-16 05:14:29', 'Complete database prep.');

COMMIT;
