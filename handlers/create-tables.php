<?php
require("../config/db.php");

$sql_query = file_get_contents('../sql/create-tables.sql');

if ($db->multi_query($sql_query)) {
  echo 'success';
} else {
  echo 'Ошибка (' . $db->connect_errno . ') ' . $db->connect_error;
}
