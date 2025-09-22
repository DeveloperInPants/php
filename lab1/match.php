<?php
$day = 3;
$result = match(true) {
	$day >= 1 && $day <= 5 => 'Это рабочий день',
	$day == 6 || $day == 7 => 'Это выходной день',
	default => 'Неизвестный день'
};
echo $result;
?>
