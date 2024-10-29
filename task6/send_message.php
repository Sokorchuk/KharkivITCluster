<?php
require_once 'TelegramBot.php';

// Токен та ідентифікатор чату для створеного Telegram бота
// Ці дані для захисту можна отримувати зі змінних оточення
$token = 'YOUR_TELEGRAM_BOT_TOKEN';
$chatId = 'YOUR_CHAT_ID';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];

    $telegramBot = new TelegramBot($token, $chatId);
    
    try {
        $telegramBot->sendMessage($message);
        echo "<p>Повідомлення успішно надіслано.</p>";
    } catch (Exception $e) {
        echo "<p>Помилка: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p>Неправильний метод запиту.</p>";
}
?>
