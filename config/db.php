<?php
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

$db_host = 'localhost';
$db_user = 'TillThe';
$db_password = '123456';
$db_name = 'for_projects';

/*
Таблицы сформируются самостоятельно при запуске приложения.
Достаточно просто ввести данные для доступа к БД.
*/

$db = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($db->connect_error) {
    die('Ошибка подключения (' . $db->connect_errno . ') '
            . $db->connect_error);
}
