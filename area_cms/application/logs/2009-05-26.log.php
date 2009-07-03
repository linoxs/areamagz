<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-05-26 11:43:01 +01:00 --- error: Uncaught PHP Error: Missing argument 1 for ORM_Core::factory(), called in D:\area_cms\application\controllers\manage_entries.php on line 76 and defined in file D:/kohana_system/libraries/ORM.php on line 77
2009-05-26 12:01:14 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file&amp;random=1243335673933, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:01:14 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:01:20 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross_bw.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:15:21 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file&amp;random=1243336520227, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:32:38 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file&amp;random=1243337557138, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:33:38 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, home/file&amp;random=1243337618807, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:33:38 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:33:41 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/images/ico_cross_bw.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 12:43:34 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_assets, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-26 16:24:02 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Table 'areamagz.access_control' doesn't exist - SELECT `access_control`.`module_id`, `modules`.`name`, `modules`.`controller`
FROM `access_control`
JOIN `modules` ON (`access_control`.`module_id` = `modules`.`id`)
WHERE `access_control`.`role_id` = 0 in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
