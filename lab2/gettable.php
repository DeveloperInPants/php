<?php
declare(strict_types=1);

function getTable(int $cols = 5, int $rows = 5, string $color = 'yellow'): int
{
    static $count = 0;
    $count++;

    echo "<table>";
    echo "<tr><th style='background-color: $color;'></th>";
    for ($col = 1; $col <= $cols; $col++) {
        echo "<th style='background-color: $color;'>" . $col . "</th>";
    }
    echo "</tr>";

    for ($row = 1; $row <= $rows; $row++) {
        echo "<tr>";
        echo "<th style='background-color: $color;'>" . $row . "</th>";
        for ($col = 1; $col <= $cols; $col++) {
            echo "<td>" . ($row * $col) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";

    return $count;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Таблица умножения</title>
<style>
table {
    border: 2px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    border: 1px solid black;
}
th {
    background-color: yellow;
}
</style>
</head>
<body>
<h1>Таблица умножения</h1>

<?php
echo getTable() . "<br>";
echo getTable(3) . "<br>";
echo getTable(4, 6) . "<br>";
echo "Общее число вызовов функции: " . getTable(2, 3, 'lightblue') . "<br>";
?>
</body>
</html>
