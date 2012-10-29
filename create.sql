SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `elodie` DEFAULT CHARACTER SET latin1 ;
USE `elodie` ;

-- -----------------------------------------------------
-- Table `elodie`.`objs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `elodie`.`objs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `obj_type` VARCHAR(45) NULL DEFAULT NULL ,
  `title` TEXT NULL DEFAULT NULL ,
  `published` DATE NULL DEFAULT NULL ,
  `text_author` VARCHAR(126) NULL DEFAULT NULL ,
  `text_content` TEXT NULL DEFAULT NULL ,
  `image_file` VARCHAR(256) NULL DEFAULT NULL ,
  `image_width` INT(11) NULL DEFAULT NULL ,
  `image_height` INT(11) NULL DEFAULT NULL ,
  `image_description` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 74
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `elodie`.`tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `elodie`.`tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `tag_name` VARCHAR(256) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 26
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `elodie`.`objs_tags`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `elodie`.`objs_tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `obj_id` INT(11) NULL DEFAULT NULL ,
  `tag_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `obj_id` (`obj_id` ASC) ,
  INDEX `tag_id` (`tag_id` ASC) ,
  CONSTRAINT `obj_id`
    FOREIGN KEY (`obj_id` )
    REFERENCES `elodie`.`objs` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tag_id`
    FOREIGN KEY (`tag_id` )
    REFERENCES `elodie`.`tags` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 57
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `elodie`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `elodie`.`users` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(50) NULL DEFAULT NULL ,
  `password` VARCHAR(50) NULL DEFAULT NULL ,
  `role` VARCHAR(20) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
