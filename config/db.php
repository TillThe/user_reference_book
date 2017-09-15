<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$db_host = 'localhost';
$db_user = 'root';
$db_password = '12kirill';
$db_name = 'for_projects';

$db = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($db->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
