<?php
require_once 'inc/lib.inc.php';

// Устанавливаем значения по умолчанию
$default_cols = 6;
$default_rows = 8;
$default_color = '#90ee90';

// Получаем параметры из формы или используем значения по умолчанию
$cols = isset($_GET['cols']) ? (int)$_GET['cols'] : $default_cols;
$rows = isset($_GET['rows']) ? (int)$_GET['rows'] : $default_rows;
$color = isset($_GET['color']) ? $_GET['color'] : $default_color;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Таблица умножения</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <img src="logo.png" width="130" height="80" alt="Наш логотип" class="logo">
    <span class="slogan">приходите к нам учиться</span>
  </header>
  <section>
    <h1>Таблица умножения</h1>
    <form action=''>
      <label>Количество колонок: </label>
      <br>
      <input name='cols' type='text' value='<?= isset($_GET['cols']) ? htmlspecialchars($_GET['cols']) : $default_cols ?>'>
      <br>
      <label>Количество строк: </label>
      <br>
      <input name='rows' type='text' value='<?= isset($_GET['rows']) ? htmlspecialchars($_GET['rows']) : $default_rows ?>'>
      <br>
      <label>Цвет: </label>
      <br>
      <input name='color' type='color' value='<?= isset($_GET['color']) ? htmlspecialchars($_GET['color']) : $default_color ?>'>
      <br>
      <small>Или выберите из списка: </small>
      <select onchange="document.querySelector('input[name=color]').value = this.value">
        <option value="#90ee90">Светло-зеленый</option>
        <option value="#ff0000">Красный</option>
        <option value="#00ff00">Зеленый</option>
        <option value="#0000ff">Синий</option>
        <option value="#ffff00">Желтый</option>
        <option value="#ff00ff">Пурпурный</option>
        <option value="#00ffff">Бирюзовый</option>
      </select>
      <br>
      <br>
      <input type='submit' value='Создать'>
    </form>
    <br>
    <!-- Таблица -->
    <?php 
    // Вызываем функцию getTable() с параметрами из формы или значениями по умолчанию
    getTable($rows, $cols, $color);
    ?>
    <!-- Таблица -->
  </section>
  <nav>
    <h2>Навигация по сайту</h2>
    <ul>
      <li><a href='index.php'>Домой</a></li>
      <li><a href='about.php'>О нас</a></li>
      <li><a href='contact.php'>Контакты</a></li>
      <li><a href='table.php'>Таблица умножения</a></li>
      <li><a href='calc.php'>Калькулятор</a></li>
    </ul>
  </nav>
  <footer>
    &copy; Супер Мега Веб-мастер, 2000 &ndash; <?= date('Y') ?>
  </footer>
</body>
</html>
