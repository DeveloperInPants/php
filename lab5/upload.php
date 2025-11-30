<?php
declare(strict_types=1);

const UPLOAD_DIR = __DIR__ . '/upload';

/**
 * Обрабатывает загрузку файла
 * @return void
 */
function handleUpload(): void {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }
    
    if (!isset($_FILES['upload'])) {
        return;
    }
    
    $file = $_FILES['upload'];
    
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return;
    }
    
    if (!file_exists(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }
    
    $fileName = basename($file['name']);
    $filePath = UPLOAD_DIR . '/' . $fileName;
    
    move_uploaded_file($file['tmp_name'], $filePath);
}

handleUpload();
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка файла на сервер</title>
</head>
<body>
    <h1>Загрузка файла на сервер</h1>
    
    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <p>
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
            <input type="file" name="upload"><br>
            <button type="submit">Загрузить</button>
        </p>
    </form>
</body>
</html>
