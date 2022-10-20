DROP DATABASE if EXISTS `myportfolio`;
CREATE DATABASE `myportfolio`;
USE `myportfolio`;
CREATE TABLE `users`(
	`id`       		INT          	NOT NULL AUTO_INCREMENT,
	`username` 		VARCHAR(50)  	NOT NULL UNIQUE,
	`email`    		VARCHAR(100) 	NOT NULL UNIQUE,
	`password` 		VARCHAR(400) 	NOT NULL,
	`full_name`     VARCHAR(50),
    `join_date` 	DATE			NOT NULL DEFAULT(now()),
	`is_admin`  	BOOLEAN			NOT NULL DEFAULT(0),
	CONSTRAINT `user_id` PRIMARY KEY (`id`)
);
INSERT INTO users (`username`, `email`, `password`, `is_admin`)
VALUES 	('Fathi Admin', 'fathi@gmail.com', sha1('123'), 1),
		('Choukry Admin', 'choukry@gmail.com', sha1('123'), 1);
INSERT INTO users (`username`, `email`, `password`)
VALUES	('Fathi', 'abdelmalek.fathi.2001@gmail.com', sha1('Fathi_CJPP@2001')),
		('Youma', 'youma@gmail.com', sha1('123')),
		('Chihab', 'chihab@gmail.com', sha1('123'));

CREATE TABLE `categories`(
	`id` 			TINYINT 	 	NOT NULL AUTO_INCREMENT,
	`title` 		VARCHAR(50)  	NOT NULL UNIQUE,
	`description` 	VARCHAR(400)	NOT NULL DEFAULT("There is no description for this category"),
	`visibility`  	BOOLEAN			NOT NULL DEFAULT(1),
	`comments`		BOOLEAN			NOT NULL DEFAULT(1),
	`ads`			BOOLEAN			NOT NULL DEFAULT(1),
	CONSTRAINT `category_id` PRIMARY KEY (`id`)
);
INSERT INTO `categories` (`title`, `description`)
VALUES 	('Web Dev', 'web development with any language (php, java, c#, python, js...)');
INSERT INTO `categories` (`title`)
VALUES 	('Desktop Apps Dev'),
		('Game Dev'),
        ('Design');

CREATE TABLE `projects`(
	`id` 			INT 		NOT NULL AUTO_INCREMENT,
	`name` 			VARCHAR(50) NOT NULL,
	`description` 	TEXT 		NOT NULL,
	`media` 		VARCHAR(20),
	`add_date` 		DATE 		NOT NULL DEFAULT(now()),
    `rating`		TINYINT		NOT NULL DEFAULT(0),
    `visibility`	BOOLEAN		NOT NULL DEFAULT(0),
	`category_id`	TINYINT,
	`user_id` 		INT,
	CONSTRAINT `project_id` 			PRIMARY KEY (`id`),
    CONSTRAINT `project_category_id` 	FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `project_user_id` 		FOREIGN KEY (`user_id`) 	REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
);
INSERT INTO `projects` (`name`, `description`, `category_id`, `user_id`)
VALUES 	('Flying Rocket', 'a game was created with unity game engine', 3, 3),
		('Myportfolio', 'a web site created with basic knowledg in php', 1, 1),
		('Gallery Managment', 'a desktop application to manage your gallery', 2, 3);

CREATE OR REPLACE VIEW `projects_view` AS 
SELECT `projects`.*, `categories`.`title` AS `category_title`, `users`.`username` FROM `projects`
INNER JOIN `categories` ON `categories`.`id` = `projects`.`category_id`
INNER JOIN `users` ON `users`.`id` = `projects`.`user_id`;

CREATE TABLE `comments`(
	`id` 			INT 			NOT NULL AUTO_INCREMENT,
    `comment` 		VARCHAR(500) 	NOT NULL,
    `add_date` 		DATE 			NOT NULL DEFAULT(now()),
    `project_id` 	INT 			NOT NULL,
    `user_id` 		INT 			NOT NULL,
    CONSTRAINT `comment_id` 		PRIMARY KEY (`id`),
    CONSTRAINT `comment_project_id` FOREIGN KEY (`project_id`) 	REFERENCES `projects`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT `comment_user_id` 	FOREIGN KEY (`user_id`) 	REFERENCES `users`(`id`)
    ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE OR REPLACE VIEW `comments_view` AS
SELECT `comments`.*, `projects`.`name` AS `projectname`, `users`.`username` FROM `comments`
INNER JOIN `projects` ON `projects`.`id` = `comments`.`project_id`
INNER JOIN `users` ON `users`.`id` = `comments`.`user_id`;
