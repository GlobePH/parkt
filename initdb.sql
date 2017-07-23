DROP DATABASE IF EXISTS barrierdb;

CREATE DATABASE IF NOT EXISTS barrierdb;
CREATE USER IF NOT EXISTS 'barrieradmin'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON barrierdb.* TO 'barrieradmin'@'localhost';

USE hrdodb;

CREATE TABLE `barrierdb`.`barrier_data` (
	`id` SERIAL NOT NULL ,
	`barrier_id` VARCHAR(256) NOT NULL ,
	`barrier_longitude` VARCHAR(256) NOT NULL ,
	`barrier_latitude` VARCHAR(256) NOT NULL ,
	`barrier_status` BOOLEAN NOT NULL ,
	PRIMARY KEY (`barrier_id`))
ENGINE = InnoDB;
