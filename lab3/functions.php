<?php
declare(strict_types=1);

/**
 * Основной скрипт для отображения загруженных расширений PHP и их функций
 * 
 * Этот скрипт получает все загруженные расширения PHP и отображает их функции
 * в структурированном HTML-формате с базовым стилем оформления.
 * 
 * @package FunctionsList
 * @version 1.0
 */

/**
 * Получает все загруженные расширения PHP
 * 
 * @var array $loaded_extensions Массив с именами всех загруженных расширений
 */
$loaded_extensions = get_loaded_extensions();

// Начало вывода HTML-документа
echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>PHP Functions by Module</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        .module { margin: 15px 0; padding: 10px; border: 1px solid #ccc; }
        .module-name { font-weight: bold; color: #0066cc; margin-bottom: 5px; }
        .function { font-family: 'Courier New', monospace; margin: 2px 5px; display: inline-block; }
        .stats { background: #f5f5f5; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Функции загруженных модулей PHP</h1>";

/**
 * Сортирует массив расширений в алфавитном порядке
 */
sort($loaded_extensions);

/**
 * Счетчик общего количества функций во всех расширениях
 * 
 * @var int $total_functions Общее количество функций
 */
$total_functions = 0;

/**
 * Перебирает все загруженные расширения и выводит их функции
 * 
 * Для каждого расширения получает список функций и выводит их в виде
 * форматированного HTML-блока с подсчетом количества функций.
 */
foreach ($loaded_extensions as $extension) {
    /**
     * Получает список функций для текущего расширения
     * 
     * @var array|false $functions Массив функций расширения или false в случае ошибки
     */
    $functions = get_extension_funcs($extension);
    
    /**
     * Проверяет, удалось ли получить функции расширения
     * Если нет, инициализирует пустой массив
     */
    if ($functions === false) {
        $functions = array();
    }
    
    /**
     * Подсчитывает количество функций в текущем расширении
     * 
     * @var int $function_count Количество функций в расширении
     */
    $function_count = count($functions);
    
    /**
     * Увеличивает общий счетчик функций
     */
    $total_functions += $function_count;
    
    // Выводит блок с информацией о расширении
    echo "<div class='module'>";
    echo "<div class='module-name'>" . htmlspecialchars($extension) . " (" . $function_count . " функций)</div>";
    
    /**
     * Проверяет, есть ли функции в расширении
     * Если функции есть - выводит их списком, иначе сообщение об отсутствии
     */
    if ($function_count > 0) {
        /**
         * Сортирует функции в алфавитном порядке для удобства просмотра
         */
        sort($functions);
        
        /**
         * Выводит все функции текущего расширения
         * Каждая функция отображается в отдельном span-элементе
         */
        foreach ($functions as $function) {
            echo "<span class='function'>" . htmlspecialchars($function) . "()</span> ";
        }
    } else {
        // Сообщение об отсутствии функций в расширении
        echo "<em>Нет доступных функций</em>";
    }
    
    echo "</div>";
}

/**
 * Выводит блок со статистикой по всем расширениям и функциям
 */
echo "<div class='stats'>";
echo "<strong>Статистика:</strong><br>";
echo "Модулей: " . count($loaded_extensions) . "<br>";
echo "Функций: " . $total_functions;
echo "</div>";

// Завершение HTML-документа
echo "</body>
</html>";
?>
