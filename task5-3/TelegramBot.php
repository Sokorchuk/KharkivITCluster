<?php
class TelegramBot {
    private $apiUrl;
    private $chatId;

    public function __construct($token, $chatId) {
        $this->apiUrl = "https://api.telegram.org/bot{$token}/";
        $this->chatId = $chatId;
    }

    public function sendMessage($message) {
        $url = $this->apiUrl . "sendMessage";
        $data = [
            'chat_id' => $this->chatId,
            'text' => $message
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            throw new Exception("Error sending message to Telegram");
        }

        return json_decode($result);
    }
}
?>
