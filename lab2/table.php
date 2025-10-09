<?php
declare(strict_types=1);

function generateMultiplicationTable(int $cols, int $rows): void
{
    echo "<table>\n";
    echo "<tr><th></th>";
    for ($col = 1; $col <= $cols; $col++) {
        echo "<th>$col</th>";
    }
    echo "</tr>\n";

    for ($row = 1; $row <= $rows; $row++) {
        echo "<tr>";
        echo "<th>$row</th>";
        for ($col = 1; $col <= $cols; $col++) {
            $product = $row * $col;
            echo "<td>$product</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}

$cols = 10;
$rows = 10;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Таблица умножения</title>
<style>
table {
    border: 2px solid black;
    border-collapse: collapse;
}

th,
td {
    padding: 10px;
    border: 1px solid black;
}

th {
    background-color: yellow;
    font-weight: bold;
    text-align: center;
}
</style>
</head>
<body>
<h1>Таблица умножения</h1>
<?php
generateMultiplicationTable($cols, $rows);
?>
</body>
</html>
