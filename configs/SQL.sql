CREATE TABLE `msolarwanda_dbhuye`.`related_pages` ( 
	`page_id` INT(10) NOT NULL AUTO_INCREMENT , 
	`page_ref` INT(10) NOT NULL , 
	`content_title_en` VARCHAR(200) NOT NULL , 
	`content_title_rw` VARCHAR(200) NOT NULL , 
	`content_text_en` LONGTEXT NOT NULL , 
	`content_text_rw` LONGTEXT NOT NULL , 
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`page_id`)) ENGINE = InnoDB;

CREATE TABLE `msolarwanda_dbhuye`.`views_pages` ( 
	`view_id` INT(10) NOT NULL AUTO_INCREMENT , 
	`page_id` INT(10) NOT NULL , 
	`viewer_ip` VARCHAR(100) NOT NULL , 
	`viewer_loc` VARCHAR(255) NOT NULL , 
	`date_viewed` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
	PRIMARY KEY (`view_id`)) ENGINE = InnoDB;