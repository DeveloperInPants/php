<?php
declare(strict_types=1);

/*
ЗАДАНИЕ 1
- Присвойте переменной $now значение метки времени актуальной даты(сегодня)
- Присвойте переменной $birthday значение метки времени Вашего дня рождения
- Создайте переменную $hour
- С помощью функции getdate() присвойте переменной $hour текущий час
*/

/**
 * Инициализирует переменные с датами и временем
 * 
 * @return array Массив с временными данными
 */
function initializeDateTimeVariables(): array
{
    $now = time();
    
    $currentYear = (int)date('Y');
    $birthday = mktime(0, 0, 0, 3, 12, $currentYear);
    
    if ($birthday < $now) {
        $birthday = mktime(0, 0, 0, 3, 12, date('Y') + 1);
    }
    
    $currentDate = getdate();
    $hour = $currentDate['hours'];
    
    return [
        'now' => $now,
        'birthday' => $birthday,
        'hour' => $hour
    ];
}

/**
 * Определяет приветствие в зависимости от времени суток
 * 
 * @param int $hour Текущий час (0-23)
 * @return string Приветственное сообщение
 */
function getWelcomeMessage(int $hour): string
{
    if ($hour >= 6 && $hour < 12) {
        return 'Доброе утро';
    } elseif ($hour >= 12 && $hour < 18) {
        return 'Добрый день';
    } elseif ($hour >= 18 && $hour < 23) {
        return 'Добрый вечер';
    } else {
        return 'Доброй ночи';
    }
}

/**
 * Форматирует дату на русском языке
 * 
 * @param int $timestamp Метка времени
 * @return string Отформатированная дата
 */
function formatRussianDate(int $timestamp): string
{
    $fmt = datefmt_create(
        'ru_RU',
        IntlDateFormatter::FULL,
        IntlDateFormatter::MEDIUM,
        'Europe/Moscow',
        IntlDateFormatter::GREGORIAN,
        "Сегодня d MMMM Y 'года', EEEE H:mm:ss"
    );
    
    return datefmt_format($fmt, $timestamp);
}

/**
 * Вычисляет оставшееся время до дня рождения
 * 
 * @param int $now Текущая метка времени
 * @param int $birthday Метка времени дня рождения
 * @return array Массив с оставшимися днями, часами, минутами и секундами
 */
function getTimeUntilBirthday(int $now, int $birthday): array
{
    $secondsLeft = $birthday - $now;
    
    $days = floor($secondsLeft / (60 * 60 * 24));
    $hours = floor(($secondsLeft % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($secondsLeft % (60 * 60)) / 60);
    $seconds = $secondsLeft % 60;
    
    return [
        'days' => $days,
        'hours' => $hours,
        'minutes' => $minutes,
        'seconds' => $seconds
    ];
}

// Инициализация переменных
$data = initializeDateTimeVariables();
$now = $data['now'];
$birthday = $data['birthday'];
$hour = $data['hour'];

// Получение приветствия
$welcome = getWelcomeMessage($hour);

// Форматирование даты
$formattedDate = formatRussianDate($now);

// Вычисление времени до дня рождения
$timeUntilBirthday = getTimeUntilBirthday($now, $birthday);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Использование функций даты и времени</title>
</head>
<body>
    <h1>Использование функций даты и времени</h1>
    
    <?php
    /*
    ЗАДАНИЕ 2
    - Используя управляющую конструкцию if – elseif - else присвойте 
      переменной $welcome значение, изходя из следующих условий
      если число в переменной $hour попадает в диапазон:
      * от 0 до 6 - 'Доброй ночи'
      * от 6 (включительно) до 12 - 'Доброе утро'
      * от 12 (включительно) до 18 - 'Добрый день'
      * от 18 (включительно) до 23 - 'Добрый вечер'
      * Если число в переменной $hour не попадает ни в один из вышеперечисленных
        диапазонов, то присвойте переменной $welcome значение 'Доброй ночи'
    - Выведите $welcome на отдельной строке
    - Установите локаль ru_RU.UTF-8
    - С помощью функции datefmt_format() на отдельной строке выведите 
      текущую дату, месяц, год, день недели и время,
      например, "Сегодня 1 сентября 2018 года, суббота 09:30:00" 
    - На отдельной строке выведите фразу "До моего дня рождения осталось "
    - Выведите количество дней, часов, минут и секунд оставшееся до Вашего дня рождения
    */
    ?>
    
    <div class="welcome"><?= $welcome ?></div>
    
    <div class="date-info">
        <strong>Текущая дата и время:</strong><br>
        <?= $formattedDate ?>
    </div>
    
    <div class="birthday-info">
        <strong>До моего дня рождения осталось:</strong><br>
        <?= $timeUntilBirthday['days'] ?> дней, 
        <?= $timeUntilBirthday['hours'] ?> часов, 
        <?= $timeUntilBirthday['minutes'] ?> минут, 
        <?= $timeUntilBirthday['seconds'] ?> секунд
    </div>
</body>
</html>
