<?php
function insert_record($table, $data, $except_arr) {
  global $db;
  // начало формирования строки запроса
  $keys = "INSERT INTO {$table} (";
  $values = "VALUES (";
  $i = 1;

  if (gettype($except_arr) != 'array') $except_arr = array($except_arr);

  foreach ($data as $key => $value) {
    if (in_array($key, $except_arr)) continue;
    $keys .= ($i == 1) ? $key : ", {$key}";
    $values .= ($i == 1) ? "'{$value}'" : ", '{$value}'";
    $i++;
  }
  $keys .= ") ";
  $values .= ") ";
  $sql = $keys . $values;
  // конец формирования строки запроса

  $db->query($sql);
  return (!$db->connect_error) ? $db->insert_id : 0;
}

function get_data($table) {
  global $db;
  $data = array();

  if ($result = $db->query("SELECT * FROM {$table}")) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->close();
  }

  return $data;
}

function form_options($data) {
  $str = "";

  foreach ($data as $key => $value) {
    $str .= "<option value='{$value['id']}'>{$value['name']}</option>";
  }

  return $str;
}

function form_li($data) {
  $str = "";

  foreach ($data as $key => $value) {
    $str .= "
    <li class='filter-list-item' value='{$value['id']}'>{$value['name']}</li>";
  }

  return $str;
}

function get_user_data() {
  global $db;
  $user_data = array();

  $sql = $db->query("SELECT u.id, u.name, e.name, c.name FROM user u, education e, city c, users_city uc WHERE u.education_id = e.id AND c.id = uc.city_id AND u.id = uc.user_id");

  $data = $sql->fetch_all();
  foreach ($data as $key => $value) {
    if (!key_exists($value[0], $user_data)) {
      $user_data[$value[0]] = $value;
      $user_data[$value[0]][] = $value[3];
    } else {
      $user_data[$value[0]][3] .= ", " . $value[3];
      $user_data[$value[0]][] = $value[3];
    }
  }

  return $user_data;
}
function form_user_list($data) {
  $str = "";

  foreach ($data as $value) {
    $str .= "
    <tr>
      <td>{$value[1]}</td>
      <td>{$value[2]}</td>
      <td>{$value[3]}</td>
    </tr>";
  }

  return $str;
}
