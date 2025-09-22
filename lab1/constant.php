<?php
/*
ЗАДАНИЕ 1
- Создайте константу и присвойте ей значение.
*/
define('SITE_NAME', 'Мой сайт');
define('MAX_USERS', 100);
define('VERSION', '1.0.0');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Константы</title>
</head>
<body>
	<h1>Константы</h1>
	<?php
	/*
	ЗАДАНИЕ 2
	- Проверьте, существует ли константа, которую Вы хотите использовать.
	- Выведите значение созданной константы.
	ЗАДАНИЕ 3
	- Используя предопределённые в ядре константы выведите текущую версию PHP.
	- Используя магические константы выведите директорию скрипта.
	*/
	
	// ЗАДАНИЕ 2
	if (defined('SITE_NAME')) {
		echo "<p>Название сайта: " . SITE_NAME . "</p>";
	}
	
	if (defined('MAX_USERS')) {
		echo "<p>Максимальное количество пользователей: " . MAX_USERS . "</p>";
	}
	
	if (defined('VERSION')) {
		echo "<p>Версия приложения: " . VERSION . "</p>";
	}
	
	// ЗАДАНИЕ 3
	echo "<p>Текущая версия PHP: " . PHP_VERSION . "</p>";
	echo "<p>Директория скрипта: " . __DIR__ . "</p>";
	
	// Дополнительные примеры магических констант
	echo "<p>Полный путь к файлу: " . __FILE__ . "</p>";
	echo "<p>Текущая строка кода: " . __LINE__ . "</p>";
	?>
</body>
</html>
