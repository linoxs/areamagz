<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-05-28 11:45:47 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/important.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 11:45:47 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/title.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:10:45 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/data/entry_image/1243508763november08-turkey-nocal-1600x1200.jpg, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:11:01 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/data/entry_image/1243508763november08-turkey-nocal-1600x1200.jpg, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:12:23 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file?height=500&width=400&random=1243509142072, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:12:23 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:12:25 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross_bw.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:26:51 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/title.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:26:52 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/info.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:26:52 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/important.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 12:38:03 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_entry/edit/12, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 14:47:09 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown table 'comments' in field list - SELECT `comments`.`id`, `comments`.`time`, `comments`.`name`, `comments`.`comment`, `comments`.`entry_id`, `entries`.`id`, `entries`.`title`
ORDER BY `comments`.`time` DESC
LIMIT 5, 0 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-28 14:47:55 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown table 'comments' in field list - SELECT `comments`.`id`, `comments`.`time`, `comments`.`name`, `comments`.`comment`, `comments`.`entry_id`, `entries`.`id`, `entries`.`title`
ORDER BY `comments`.`time` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-28 15:36:53 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'entries.id' in 'field list' - SELECT `entries`.`id`, `entries`.`created_at`, `entries`.`title`, `entries`.`body_text`, `entries`.`category_id`, `entries`.`author_id`, `categories`.`label`, `users`.`name`
FROM `comments`
JOIN `categories` ON (`categories`.`id` = `entries`.`category_id`)
JOIN `users` ON (`users`.`id` = `entries`.`author_id`)
ORDER BY `entries`.`id` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-28 15:37:11 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'users.name' in 'field list' - SELECT `entries`.`id`, `entries`.`created_at`, `entries`.`title`, `entries`.`body_text`, `entries`.`category_id`, `entries`.`author_id`, `categories`.`label`, `users`.`name`
FROM `entries`
JOIN `categories` ON (`categories`.`id` = `entries`.`category_id`)
JOIN `users` ON (`users`.`id` = `entries`.`author_id`)
ORDER BY `entries`.`id` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-28 16:15:50 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/info.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 16:15:50 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/important.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 16:15:50 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/title.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-28 18:29:36 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
