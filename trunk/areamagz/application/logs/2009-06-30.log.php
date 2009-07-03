<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-06-30 11:07:23 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, welcome, could not be found. in file D:/kohana_system/core/Kohana.php on line 841
2009-06-30 11:08:17 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, welcome, could not be found. in file D:/kohana_system/core/Kohana.php on line 841
2009-06-30 11:12:27 +01:00 --- error: Uncaught Kohana_Exception: The requested view, pages/header, could not be found in file D:/kohana_system/core/Kohana.php on line 1162
2009-06-30 11:13:37 +01:00 --- error: Uncaught PHP Error: include(include/showcase.php) [<a href='function.include'>function.include</a>]: failed to open stream: No such file or directory in file D:/areamagz/trunk/application/views/pages/home_page.php on line 284
2009-06-30 14:32:09 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'category_id ' in 'where clause' - SELECT `id`, `created_at`, `title`, `excerpt`, `category_id`, `thumb_image`, `url`
FROM (`entries`)
WHERE `status` = 1
AND `category_id ` NOT IN (10,11)
ORDER BY `created_at` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
2009-06-30 14:33:11 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'category_id ' in 'where clause' - SELECT `id`, `created_at`, `title`, `excerpt`, `category_id`, `thumb_image`, `url`
FROM (`entries`)
WHERE `status` = 1
AND `category_id ` NOT IN (10,11)
ORDER BY `created_at` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
2009-06-30 14:33:53 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'entries.category_id ' in 'where clause' - SELECT `id`, `created_at`, `title`, `excerpt`, `category_id`, `thumb_image`, `url`
FROM (`entries`)
WHERE `status` = 1
AND `entries`.`category_id ` NOT IN (10,11)
ORDER BY `created_at` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
2009-06-30 14:38:46 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'NULL)
WHERE `status` = 1
AND `category_id` NOT IN (10,11)
ORDER BY `created_at` ' at line 3 - SELECT `entries`.`id`, `entries`.`created_at`, `entries`.`title`, `entries`.`excerpt`, `entries`.`category_id`, `entries`.`thumb_image`, `entries`.`url`, `categories`.`label`
FROM (`entries`)
JOIN `categories` ON (entries.category_id=categories.id NULL)
WHERE `status` = 1
AND `category_id` NOT IN (10,11)
ORDER BY `created_at` DESC
LIMIT 0, 5 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
2009-06-30 14:40:44 +01:00 --- error: Uncaught PHP Error: preg_match() expects parameter 2 to be string, array given in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 135
2009-06-30 14:41:34 +01:00 --- error: Uncaught PHP Error: preg_match() expects parameter 2 to be string, array given in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 135
2009-06-30 14:41:42 +01:00 --- error: Uncaught PHP Error: preg_match() expects parameter 2 to be string, array given in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 135
2009-06-30 14:44:20 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'entriesc.reated_at' in 'field list' - SELECT
                    entries.id,
                    entriesc.reated_at,
                    entries.title,
                    entriesc.excerpt,
                    entriesc.category_id,
                    entriesc.thumb_image,
                    entriesc.url,
                    categories.label
              FROM  entries
              INNER JOIN categories
              ON entries.category_id = categories.id
              WHERE status=1
              ORDER BY created_at DESC
              LIMIT 0,5
             in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
2009-06-30 14:44:34 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'entries.reated_at' in 'field list' - SELECT
                    entries.id,
                    entries.reated_at,
                    entries.title,
                    entries.excerpt,
                    entries.category_id,
                    entries.thumb_image,
                    entries.url,
                    categories.label
              FROM  entries
              INNER JOIN categories
              ON entries.category_id = categories.id
              WHERE status=1
              ORDER BY created_at DESC
              LIMIT 0,5
             in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 371
