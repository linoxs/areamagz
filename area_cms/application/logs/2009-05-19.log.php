<?php defined('SYSPATH') or die('No direct script access.'); ?>

2009-05-19 11:21:47 +01:00 --- error: Uncaught PHP Error: Missing argument 1 for ORM_Core::factory(), called in D:\area_cms\application\controllers\manage_users.php on line 10 and defined in file D:/kohana_system/libraries/ORM.php on line 77
2009-05-19 11:27:34 +01:00 --- error: Uncaught Kohana_Exception: Query methods cannot be used through ORM in file D:/kohana_system/libraries/ORM.php on line 200
2009-05-19 11:42:39 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Not unique table/alias: 'users' - SELECT `users`.*
FROM `users`, `roles`, `users`
JOIN `roles` ON (`roles`.`id` = `users`.`role`)
ORDER BY `users`.`id` ASC in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 11:43:09 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Not unique table/alias: 'roles' - SELECT `users`.*
FROM `roles`, `users`
JOIN `roles` ON (`roles`.`id` = `users`.`role`)
ORDER BY `users`.`id` ASC in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 11:43:37 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Not unique table/alias: 'roles' - SELECT `users`.*
FROM `roles`, `users`
JOIN `roles` ON (`roles`.`id` = `users`.`role`)
ORDER BY `users`.`id` ASC in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 11:44:55 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'user.role_id' in 'where clause' - SELECT `users`.*
FROM `users`
WHERE `user`.`role_id` = 0
ORDER BY `users`.`id` ASC in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 11:46:07 +01:00 --- error: Uncaught PHP Error: Invalid argument supplied for foreach() in file D:/area_cms/application/views/pages/show_user.php on line 22
2009-05-19 12:19:55 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'role.name' in 'field list' - SELECT `users`.`id`, `users`.`username`, `users`.`display_name`, `users`.`status`, `role`.`name` AS `role`, `CASE WHEN users`.`status=0 THEN "active" ELSE "inactive" END` AS `status`
FROM `users`
JOIN `roles` ON (`roles`.`id` = `users`.`role`) in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 12:20:18 +01:00 --- error: Uncaught Kohana_Database_Exception: There was an SQL error: Unknown column 'CASE WHEN users.status=0 THEN "active" ELSE "inactive" END' in 'field list' - SELECT `users`.`id`, `users`.`username`, `users`.`display_name`, `users`.`status`, `roles`.`name` AS `role`, `CASE WHEN users`.`status=0 THEN "active" ELSE "inactive" END` AS `status`
FROM `users`
JOIN `roles` ON (`roles`.`id` = `users`.`role`) in file D:/kohana_system/libraries/drivers/Database/Mysql.php on line 392
2009-05-19 12:36:06 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/page/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:37:35 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/page/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:40:25 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/page/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:40:42 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:42:21 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:42:35 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_users/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:42:48 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:43:05 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:43:19 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:44:44 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:44:53 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/index, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:45:21 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, manage_user/2, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:49:45 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/info.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:49:45 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/important.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 12:49:45 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, media/css/media/images/icons/jquery_alerts/title.gif, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 13:06:44 +01:00 --- error: Uncaught Kohana_404_Exception: The page you requested, author_profile/4, could not be found. in file D:/kohana_system/core/Kohana.php on line 787
2009-05-19 14:05:02 +01:00 --- error: Missing i18n entry form_error_messages.confirm_pass.required for language en_US
2009-05-19 14:05:02 +01:00 --- error: Missing i18n entry form_error_messages.confirm_pass.default for language en_US
2009-05-19 14:06:40 +01:00 --- error: Missing i18n entry form_error_messages.password.pwd_check for language en_US
