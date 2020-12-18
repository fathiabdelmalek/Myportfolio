DROP DATABASE if EXISTS myportfolio;
CREATE DATABASE myportfolio;
USE myportfolio;
CREATE TABLE users(
	`id`       		INT          	NOT NULL AUTO_INCREMENT,
	`username` 		VARCHAR(50)  	NOT NULL UNIQUE,
	`email`    		VARCHAR(100) 	NOT NULL UNIQUE,
	`password` 		VARCHAR(400) 	NOT NULL,
	`fullname` 		VARCHAR(50),
    `date_joined` 	DATE			NOT NULL DEFAULT(now()),
	`isadmin`  		ENUM('Y','N')	NOT NULL DEFAULT('N'),
	CONSTRAINT `id` PRIMARY KEY (`id`)
);
INSERT INTO users (`username`, `email`, `password`, `isadmin`)
VALUE ('FathiMalek', 'abdelmalek.fathi.2001@gmail.com', SHA1('123'), 'Y');
INSERT INTO users (`username`, `email`, `password`)
VALUE ('Youma', 'youma@gmail.com', SHA1('123'));
INSERT INTO users (`username`, `email`, `password`)
VALUE ('Chihab', 'chihab@gmail.com', SHA1('123'));
CREATE TABLE categories(
	`id` 			TINYINT 	 	NOT NULL AUTO_INCREMENT,
	`title` 		VARCHAR(50)  	NOT NULL UNIQUE,
	`description` 	VARCHAR(400),
	`ordering`		INT,
	`hidden`  		BOOLEAN			NOT NULL DEFAULT(1),
	`comments`		BOOLEAN			NOT NULL DEFAULT(1),
	`ads`			BOOLEAN			NOT NULL DEFAULT(1),
	CONSTRAINT `id` PRIMARY KEY (`id`)
);
CREATE TABLE `projects`(
	`id` 			INT 		NOT NULL AUTO_INCREMENT,
	`name` 			VARCHAR(50) NOT NULL,
	`description` 	TEXT 		NOT NULL,
	`add_date` 		DATETIME 	NOT NULL DEFAULT(now()),
	`image` 		VARCHAR(20),
    `rating`		TINYINT			NOT NULL DEFAULT(0),
    `private`		BOOLEAN		NOT NULL DEFAULT(0),
	`userID` 		INT,
	`categoryID`	TINYINT,
	CONSTRAINT `id` PRIMARY KEY (`id`),
	CONSTRAINT `user_id` FOREIGN KEY (`userID`) 		REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT `category_id` FOREIGN KEY (`categoryID`) 	REFERENCES `categories`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
);
