<?php
declare(strict_types=1);

function printStringVertical(string $str): void
{
    $index = 0;
    $length = mb_strlen($str);
    while ($index < $length) {
        echo $str[$index] . "<br>";
        $index++;
    }
}

$var = "Hello";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Цикл while</title>
</head>
<body>
<h1>Цикл while</h1>
<?php
printStringVertical($var);
?>
</body>
</html>
