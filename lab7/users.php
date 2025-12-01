<?php
declare(strict_types=1);

/**
 * Автозагрузчик классов
 */
spl_autoload_register(function ($className) {
    // Преобразуем пространство имен в путь к файлу
    $filePath = str_replace('MyProject\\Classes\\', 'MyProject/Classes/', $className) . '.php';
    
    if (file_exists($filePath)) {
        require_once $filePath;
        return true;
    }
    return false;
});

use MyProject\Classes\User;
use MyProject\Classes\SuperUser;

echo "<h1>Демонстрация работы с классами</h1>";

// Создаем обычных пользователей
echo "<h2>Обычные пользователи:</h2>";
$user1 = new User("Максим Максимов", "maximov", "password123");
$user2 = new User("Петр Петров", "petrov", "qwerty456");
$user3 = new User("Мария Сидорова", "sidorova", "secret789");

// Выводим информацию о пользователях
$user1->showInfo();
$user2->showInfo();
$user3->showInfo();

// Создаем суперпользователя
echo "<h2>Суперпользователь:</h2>";
$superUser = new SuperUser("Администратор", "admin", "admin123", "Супер-администратор");

// Выводим информацию о суперпользователе
$superUser->showInfo();

echo "<p>Скрипт завершен. Объекты будут уничтожены автоматически.</p>";
?>