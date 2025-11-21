<?php
declare(strict_types=1);

// Данные для функции getMenu()
$menu = [
    ['href' => 'index.php', 'link' => 'Домой'],
    ['href' => 'about.php', 'link' => 'О нас'],
    ['href' => 'contact.php', 'link' => 'Контакты'],
    ['href' => 'table.php', 'link' => 'Таблица умножения'],
    ['href' => 'calc.php', 'link' => 'Калькулятор']
];

// Параметры по умолчанию для функции getTable()
$cols = $_GET['cols'] ?? 5;
$rows = $_GET['rows'] ?? 7;
$color = $_GET['color'] ??  'lightgreen';
?>
