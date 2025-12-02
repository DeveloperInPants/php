<?php
declare(strict_types=1);
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
/**
 * Подключение к БД
 * @return mysqli|false
 */
function connectDB(): mysqli|false {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) die("Ошибка: " . $conn->connect_error);
    if (!$conn->set_charset(DB_CHARSET)) die("Ошибка кодировки: " . $conn->error);
    return $conn;
}
/**
 * ЗАДАНИЕ 1: Добавление сообщения
 */
function addMessage($conn, $name, $email, $msg) {
    $name = trim($name); $email = trim($email); $msg = trim($msg);
    if (empty($name) || empty($email) || empty($msg)) return false;
    $stmt = $conn->prepare("INSERT INTO msgs (name, email, msg) VALUES (?, ?, ?)");
    if (!$stmt) return false;
    $stmt->bind_param("sss", $name, $email, $msg);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
/**
 * ЗАДАНИЕ 2: Получение сообщений
 */
function getMessages($conn) {
    $messages = [];
    $result = $conn->query("SELECT id, name, email, msg FROM msgs ORDER BY id DESC");
    if (!$result) return $messages;
    while ($row = $result->fetch_assoc()) $messages[] = $row;
    $result->free();
    return $messages;
}
/**
 * Количество сообщений
 */
function getMessageCount($conn) {
    $result = $conn->query("SELECT COUNT(*) as count FROM msgs");
    if (!$result) return 0;
    $row = $result->fetch_assoc();
    $result->free();
    return (int)$row['count'];
}
/**
 * ЗАДАНИЕ 3: Удаление сообщения
 */
function deleteMessage($conn, $id) {
    $stmt = $conn->prepare("DELETE FROM msgs WHERE id = ?");
    if (!$stmt) return false;
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}
$conn = connectDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $msg = $_POST['msg'] ?? '';
    if (addMessage($conn, $name, $email, $msg)) {
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    }
}
if (isset($_GET['del'])) {
    $id = (int)$_GET['del'];
    if (deleteMessage($conn, $id)) {
        header("Location: " . htmlspecialchars($_SERVER['PHP_SELF']));
        exit();
    }
}
$messages = getMessages($conn);
$count = getMessageCount($conn);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Гостевая книга</title>
<style>
body { font-family: Arial; max-width: 800px; margin: 20px auto; padding: 20px; }
h1 { color: #333; }
form { background: #f5f5f5; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
label { display: block; margin-top: 10px; font-weight: bold; }
input, textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
textarea { resize: vertical; min-height: 100px; }
button { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 3px; cursor: pointer; margin-top: 10px; }
button:hover { background: #0056b3; }
.message { background: white; border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 3px; }
.message-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
.message-name { font-weight: bold; color: #333; }
.delete-link { color: #dc3545; text-decoration: none; font-size: 0.9em; }
.message-count { background: #e7f3ff; padding: 10px; border-radius: 3px; margin-bottom: 20px; }
</style>
</head>
<body>
<h1>Гостевая книга</h1>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
<label>Ваше имя:</label>
<input type="text" name="name" required>
<label>Ваш E-mail:</label>
<input type="email" name="email" required>
<label>Сообщение:</label>
<textarea name="msg" required></textarea>
<button type="submit">Добавить!</button>
</form>
<div class="message-count">Записей в гостевой книге: <?php echo $count; ?></div>
<?php if (empty($messages)): ?>
<p>Нет сообщений.</p>
<?php else: ?>
<?php foreach ($messages as $m): ?>
<div class="message">
<div class="message-header">
<div>
<div class="message-name"><a href="mailto:<?php echo htmlspecialchars($m['email']); ?>"><?php echo htmlspecialchars($m['name']); ?></a></div>
<div style="color: #666; font-size: 0.9em;"><?php echo htmlspecialchars($m['email']); ?></div>
</div>
<a class="delete-link" href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?del=<?php echo $m['id']; ?>">Удалить</a>
</div>
<div style="color: #555; margin-top: 10px; white-space: pre-wrap;"><?php echo htmlspecialchars($m['msg']); ?></div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</body>
</html>
<?php $conn->close(); ?>
