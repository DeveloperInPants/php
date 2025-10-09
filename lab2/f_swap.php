<?php
declare(strict_types=1);

function swap(mixed &$x, mixed &$y): void
{
    $temp = $x;
    $x = $y;
    $y = $temp;
}

$a = 5;
$b = 8;
swap($a, $b);
