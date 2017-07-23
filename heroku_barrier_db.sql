DROP DATABASE barrierdb;

CREATE DATABASE barrierdb;
CREATE USER barrieradmin WITH PASSWORD password;
GRANT ALL PRIVILEGES ON hrdodb TO barrieradmin;

\c barrierdb;

CREATE TABLE barrier_data (
	id SERIAL NOT NULL ,
	barrier_id VARCHAR(256) NOT NULL ,
	barrier_password VARCHAR(256) NOT NULL ,
	barrier_salt VARCHAR(256) ,
	barrier_longitude VARCHAR(256) NOT NULL ,
	barrier_latitude VARCHAR(256) NOT NULL ,
	barrier_status INT NOT NULL ,
	PRIMARY KEY (barrier_id));
ENGINE = InnoDB;
