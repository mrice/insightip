SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `assets`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `assets` ;

CREATE  TABLE IF NOT EXISTS `assets` (
  `asset_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`asset_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `component_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `component_types` ;

CREATE  TABLE IF NOT EXISTS `component_types` (
  `component_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`component_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `components`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `components` ;

CREATE  TABLE IF NOT EXISTS `components` (
  `component_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `description` TEXT NULL ,
  `asset_id` INT NOT NULL ,
  `component_type_id` INT NOT NULL ,
  PRIMARY KEY (`component_id`) ,
  INDEX `fk_components_assets_idx` (`asset_id` ASC) ,
  INDEX `fk_components_component_types1_idx` (`component_type_id` ASC) ,
  CONSTRAINT `fk_components_assets`
    FOREIGN KEY (`asset_id` )
    REFERENCES `assets` (`asset_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_components_component_types1`
    FOREIGN KEY (`component_type_id` )
    REFERENCES `component_types` (`component_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contribution_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contribution_types` ;

CREATE  TABLE IF NOT EXISTS `contribution_types` (
  `contribution_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`contribution_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `contributions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `contributions` ;

CREATE  TABLE IF NOT EXISTS `contributions` (
  `contribution_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `asset_id` INT NOT NULL ,
  `contribution_type_id` INT NOT NULL ,
  PRIMARY KEY (`contribution_id`) ,
  INDEX `fk_contributions_assets1_idx` (`asset_id` ASC) ,
  INDEX `fk_contributions_contribution_types1_idx` (`contribution_type_id` ASC) ,
  CONSTRAINT `fk_contributions_assets1`
    FOREIGN KEY (`asset_id` )
    REFERENCES `assets` (`asset_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contributions_contribution_types1`
    FOREIGN KEY (`contribution_type_id` )
    REFERENCES `contribution_types` (`contribution_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `constraint_types`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `constraint_types` ;

CREATE  TABLE IF NOT EXISTS `constraint_types` (
  `constraint_type_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  PRIMARY KEY (`constraint_type_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `constraints`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `constraints` ;

CREATE  TABLE IF NOT EXISTS `constraints` (
  `constraint_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `description` TEXT NULL ,
  `constraint_type_id` INT NOT NULL ,
  `components_component_id` INT NOT NULL ,
  `contributions_contribution_id` INT NOT NULL ,
  PRIMARY KEY (`constraint_id`) ,
  INDEX `fk_constraints_constraint_types1_idx` (`constraint_type_id` ASC) ,
  INDEX `fk_constraints_components1_idx` (`components_component_id` ASC) ,
  INDEX `fk_constraints_contributions1_idx` (`contributions_contribution_id` ASC) ,
  CONSTRAINT `fk_constraints_constraint_types1`
    FOREIGN KEY (`constraint_type_id` )
    REFERENCES `constraint_types` (`constraint_type_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_constraints_components1`
    FOREIGN KEY (`components_component_id` )
    REFERENCES `components` (`component_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_constraints_contributions1`
    FOREIGN KEY (`contributions_contribution_id` )
    REFERENCES `contributions` (`contribution_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
