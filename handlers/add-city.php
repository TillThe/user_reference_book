<?php
require("../config/db.php");
require("../service/functions.php");

$city_id = insert_record('city', $_POST, array());
if ($city_id == 0) die('fail');

$data = get_last_record('city');
echo json_encode(array('li' => form_li($data), 'options' => form_options($data)));
