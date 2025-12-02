<?php
declare(strict_types=1);

/**
 * Отправляет э-мейл сбю на сервер
 * @param string $subject Тема письма
 * @param string $body Текст письма
 * @return bool
 */
function sendEmail(string $subject, string $body): bool {
    $to = 'nikikitazaharov597@gmail.com';
    $headers = "From: admin@center.ogu\r\n";
    
    return mail($to, $subject, $body, $headers);
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = isset($_POST['subject']) ? (string)$_POST['subject'] : '';
    $body = isset($_POST['body']) ? (string)$_POST['body'] : '';
    
    $subject = trim(htmlspecialchars($subject));
    $body = trim(htmlspecialchars($body));
    
    if (!empty($subject) && !empty($body)) {
        if (sendEmail($subject, $body)) {
            $message = 'Письмо успешно отправлено!';
        } else {
            $message = 'Ошибка при отправке письма.';
        }
    }
}
?><!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обратная связь</title>
</head>
<body>
    <h1>Обратная связь</h1>
    
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <p>
            <label for="subject">Тема:</label><br>
            <input type="text" id="subject" name="subject" required>
        </p>
        
        <p>
            <label for="body">Сообщение:</label><br>
            <textarea id="body" name="body" rows="5" cols="40" required></textarea>
        </p>
        
        <p>
            <button type="submit">Отправить</button>
        </p>
    </form>
</body>
</html>
