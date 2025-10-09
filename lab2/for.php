<?php
declare(strict_types=1);

function printOddNumbers(int $max): void
{
    for ($i = 1; $i <= $max; $i += 2) {
        echo $i . "<br>";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Цикл for</title>
</head>
<body>
<h1>Цикл for</h1>
<?php
printOddNumbers(50);
?>
</body>
</html>
