<?php
// Отримуємо та декодуємо JSON-повідомлення від Telegram
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if (!$update) {
    // Виходимо, якщо не вдалося розібрати JSON
    exit;
}

// Витягуємо інформацію з повідомлення
$message = $update['message'] ?? null;
if ($message) {
    $chatId = $message['chat']['id'];
    $text = $message['text'] ?? '';

    // Обробка повідомлення
    if ($text === '/start') {
        sendMessage($chatId, "Ласкаво просимо!");
    } else {
        sendMessage($chatId, "Ви написали: " . $text);
    }
}

// Функція для надсилання відповіді користувачеві
function sendMessage($chatId, $message) {
    $url = "https://api.telegram.org/botYOUR_BOT_TOKEN/sendMessage";
    $data = [
        'chat_id' => $chatId,
        'text' => $message
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($data)
        ]
    ];

    $context = stream_context_create($options);
    file_get_contents($url, false, $context);
}
?>
