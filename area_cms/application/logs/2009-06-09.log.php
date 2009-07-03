<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-06-09 07:26:22 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'category' in 'where clause' - SELECT `entries`.*
FROM `entries`
WHERE  `category` LIKE '%flash%'
ORDER BY `entries`.`id` ASC
LIMIT 0, 1 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-06-09 07:26:50 +01:00 --- error: Uncaught Kohana_Exception: The category property does not exist in the Entry_Model class. in file D:/kohana_system/libraries/ORM.php on line 363
2009-06-09 07:27:18 +01:00 --- error: Uncaught Kohana_Exception: The category property does not exist in the Entry_Model class. in file D:/kohana_system/libraries/ORM.php on line 363
2009-06-09 07:27:19 +01:00 --- error: Uncaught Kohana_Exception: The category property does not exist in the Entry_Model class. in file D:/kohana_system/libraries/ORM.php on line 363
2009-06-09 07:27:26 +01:00 --- error: Uncaught Kohana_Exception: The category property does not exist in the Entry_Model class. in file D:/kohana_system/libraries/ORM.php on line 363
2009-06-09 07:31:29 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'category' in 'where clause' - SELECT `entries`.*
FROM `entries`
WHERE  `category` LIKE '%flash%'
ORDER BY `entries`.`id` ASC
LIMIT 0, 1 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-06-09 07:33:53 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'categories.label' in 'where clause' - SELECT `entries`.*
FROM `entries`
WHERE  `categories`.`label` LIKE '%flash%'
ORDER BY `entries`.`id` ASC
LIMIT 0, 1 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
