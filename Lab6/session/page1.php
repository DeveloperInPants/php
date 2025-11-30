<?php
declare(strict_types=1);

require_once 'savepage.inc.php';
require_once 'visited.inc.php';

// Save current page
saveCurrentPage('Страница 1');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Page 1</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        a { margin-right: 20px; }
    </style>
</head>
<body>
    <h1>Страница 1</h1>
    <h2>Меню</h2>
    <ul>
        <li><a href="page1.php">Страница 1</a></li>
        <li><a href="page2.php">Страница 2</a></li>
        <li><a href="page3.php">Страница 3</a></li>
    </ul>
    <?php displayVisitedPages(); ?>
</body>
</html>
