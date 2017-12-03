-- MySQL Workbench Synchronization
-- Generated: 2017-12-03 16:33
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: rrd

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `bhakta_nyilvantartas`.`departments` 
ADD COLUMN `center_id` SMALLINT(5) UNSIGNED NOT NULL AFTER `id`,
ADD INDEX `fk_departments_centers1_idx` (`center_id` ASC);

CREATE TABLE IF NOT EXISTS `bhakta_nyilvantartas`.`centers` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `bhakta_nyilvantartas`.`centers_users` (
  `id` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `center_id` SMALLINT(5) UNSIGNED NOT NULL,
  `user_id` CHAR(36) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_has_centers_centers1_idx` (`center_id` ASC),
  INDEX `fk_users_has_centers_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_users_has_centers_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `bhakta_nyilvantartas`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_centers_centers1`
    FOREIGN KEY (`center_id`)
    REFERENCES `bhakta_nyilvantartas`.`centers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE `bhakta_nyilvantartas`.`departments` 
ADD CONSTRAINT `fk_departments_centers1`
  FOREIGN KEY (`center_id`)
  REFERENCES `bhakta_nyilvantartas`.`centers` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO centers SET name = 'Krisna-völgy';
INSERT INTO centers SET name = 'Budapest';
UPDATE `departments` SET center_id = 1
INSERT INTO `departments` (`id`, `center_id`, `name`, `aktiv`) VALUES (NULL, '2', 'BP - 1', '1');
INSERT INTO `departments` (`id`, `center_id`, `name`, `aktiv`) VALUES (NULL, '2', 'BP - 2', '1');
