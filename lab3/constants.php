<?php
declare(strict_types=1);

/**
 * Скрипт для отображения всех определённых констант в PHP
 * 
 * Этот скрипт получает все определённые константы, группирует их по категориям
 * и выводит в удобном для просмотра формате с подсветкой типов данных.
 * 
 * @package ConstantsViewer
 * @version 1.0
 */

/**
 * Получает все определённые константы, сгруппированные по категориям
 * 
 * @var array $constants Ассоциативный массив констант, сгруппированных по категориям
 */
$constants = get_defined_constants(true);

// Начало вывода HTML-документа
echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>PHP Constants</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .constant { margin: 5px 0; padding: 5px; border-bottom: 1px solid #eee; }
        .name { font-weight: bold; color: #0066cc; }
        .value { color: #009900; }
        .category { background: #f0f0f0; padding: 10px; margin: 10px 0; border-radius: 5px; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Определённые константы в PHP</h1>";

/**
 * Перебирает все категории констант и выводит их содержимое
 * 
 * Для каждой категории создаётся отдельный блок с заголовком,
 * содержащим название категории и количество констант в ней.
 */
foreach ($constants as $category => $category_constants) {
    /**
     * Название текущей категории констант
     * 
     * @var string $category Название категории (core, user, date и т.д.)
     */
    
    /**
     * Массив констант текущей категории
     * 
     * @var array $category_constants Ассоциативный массив констант категории
     */
    echo "<div class='category'>";
    echo "<h2>Категория: " . htmlspecialchars($category) . " (" . count($category_constants) . " констант)</h2>";
    
    /**
     * Сортирует константы категории по имени в алфавитном порядке
     */
    ksort($category_constants);
    
    /**
     * Перебирает все константы текущей категории и выводит их значения
     * 
     * Для каждой константы определяется тип значения и форматируется
     * соответствующим образом для улучшения читаемости.
     */
    foreach ($category_constants as $name => $value) {
        /**
         * Имя текущей константы
         * 
         * @var string $name Имя константы
         */
        
        /**
         * Значение текущей константы
         * 
         * @var mixed $value Значение константы любого типа
         */
        echo "<div class='constant'>";
        echo "<span class='name'>" . htmlspecialchars($name) . "</span> = ";
        echo "<span class='value'>";
        
        /**
         * Форматирует вывод значения константы в зависимости от её типа
         * 
         * Обрабатывает различные типы данных:
         * - boolean: выводит как true/false
         * - null: выводит как null
         * - array: показывает размер массива
         * - object: показывает класс объекта
         * - string: выводит в кавычках с экранированием
         * - другие типы: преобразует в строку
         */
        if (is_bool($value)) {
            // Вывод булевых значений в читаемом формате
            echo $value ? 'true' : 'false';
        } elseif (is_null($value)) {
            // Вывод null-значений
            echo 'null';
        } elseif (is_array($value)) {
            // Вывод информации о массивах (размер)
            echo 'Array(' . count($value) . ')';
        } elseif (is_object($value)) {
            // Вывод информации об объектах (класс)
            echo 'Object(' . get_class($value) . ')';
        } elseif (is_string($value)) {
            // Вывод строковых значений в кавычках с экранированием
            echo "'" . htmlspecialchars($value) . "'";
        } else {
            // Вывод остальных типов данных (числа и т.д.)
            echo htmlspecialchars((string)$value);
        }
        
        echo "</span>";
        echo "</div>";
    }
    echo "</div>";
}

// Завершение HTML-документа
echo "</body>
</html>";
?>
