<?php
require("config/db.php");
require("service/functions.php");

$city_data = get_data('city');
$education_data = get_data('education');
$user_data = get_user_data();

echo "
<script>
  let user_data = ". json_encode($user_data) .",
    createTablesFlag = false;

  if (!'1' in user_data) {
    createTablesFlag = confirm('Таблицы в БД пусты, отсутствуют или у них неверная структура/названия. Пересоздать их?');
  }
</script>";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>RNS</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="page-title">Справочник пользователей</h1>
    <form class="add-user-form" action="handlers/add-user.php" method="post" name='user'>
      <div class="input-block"><label>ФИО<input class="input" type="text" name="name"></label></div>
      <div class="input-block">
        <label>Образование
          <select class="input" name="education_id">
            <?php echo form_options($education_data); ?>
          </select>
        </label>
      </div>
      <div class="input-block">
        <div class="city-new" id="city-new">
          <span class="close">+</span>
          <span class="save">✓</span>
          <input class="input" type="text" placeholder="Введите город" name="city-new">
        </div>
        <label>Города
          <select class="input" name="city[]"  multiple="multiple" size="4">
            <option value="0" onclick="document.getElementById('city-new').classList.toggle('active');">Ввести самому</option>
            <optgroup id="cities">
              <?php echo form_options($city_data); ?>
            </optgroup>
          </select>
        </label>
      </div>
      <input type="submit" value="Добавить пользователя" class="btn btn-add">
    </form>
    <div class="filters">
      <div class="filter">
        <h2 class="filter-title">Образование</h2>
        <ul class="filter-list" id="edu-box">
          <?php echo form_li($education_data); ?>
        </ul>
      </div>
      <div class="filter">
        <h2 class="filter-title">Города</h2>
        <ul class="filter-list" id="city-box">
          <?php echo form_li($city_data); ?>
        </ul>
      </div>
    </div>
    <table class="user-list">
      <thead>
        <tr>
          <th>ФИО</th>
          <th>Образование</th>
          <th>Города</th>
        </tr>
      </thead>
      <tbody id="user_list">
        <?php echo form_user_list($user_data); ?>
      </tbody>
    </table>
  </div>
</body>
</html>
