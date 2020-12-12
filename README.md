# Myportfolio
php web site

CREATE DATABASE nyportfolio;
USE myportfolio;
DROP TABLE users;
CREATE TABLE users(
	id       INT          	NOT NULL AUTO_INCREMENT,
	username VARCHAR(50)  	NOT NULL UNIQUE,
	email    VARCHAR(100) 	NOT NULL UNIQUE,
	password VARCHAR(400) 	NOT NULL,
	isadmin  ENUM('Y','N')	NOT NULL DEFAULT('Y'),
	PRIMARY KEY (id)
);
INSERT INTO users (username, email, PASSWORD, isadmin)
VALUE ('FathiMalek', 'abdelmalek.fathi.2001@gmail.com', '2001', 'Y');
