<?php
// Токен бота
$botToken = "YOUR_BOT_TOKEN";
$apiUrl = "https://api.telegram.org/bot$botToken/";
$updateId = 0; // Ідентифікатор останнього оновлення

while (true) {
    // Отримуємо нові оновлення
    $response = file_get_contents($apiUrl . "getUpdates?offset=" . $updateId);
    $updates = json_decode($response, true);

    if (isset($updates['result'])) {
        foreach ($updates['result'] as $update) {
            $updateId = $update['update_id'] + 1; // Оновлюємо offset

            // Отримуємо дані про повідомлення
            $message = $update['message'] ?? null;
            if ($message) {
                $chatId = $message['chat']['id'];
                $text = $message['text'] ?? '';

                // Надсилаємо відповідь
                sendMessage($chatId, "Ви надіслали: " . $text);
                echo $text . "\n";
            }
        }
    }

    // Робимо паузу
    sleep(2);
}

function sendMessage($chatId, $message) {
    global $apiUrl;
    $url = $apiUrl . "sendMessage?chat_id=$chatId&text=" . urlencode($message);
    file_get_contents($url);
}
?>
