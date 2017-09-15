<?php
require("../config/db.php");
require("../service/functions.php");

// echo json_encode($_POST);
$user_id = insert_record('user', $_POST, array('city', 'city-new'));
if ($user_id == 0) die('fail');

if (is_array($_POST['city'])) {
  foreach ($_POST['city'] as $value) {
    insert_record('users_city', array('user_id' => $user_id, 'city_id' => $value), 'city');
  }
}
insert_record('users_city', array('user_id' => $user_id, 'city_id' => $_POST['city']), 'city');

$data = get_user_data();
echo json_encode(array('data' => $data, 'list' => form_user_list($data)));
