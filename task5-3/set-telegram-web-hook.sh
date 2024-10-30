#! /bin/bash

YOUR_BOT_TOKEN='YOUR_BOT_TOKEN'
WEB_HOOK_URL='https://yourdomain.com/path/to/your-script.php'

wget https://api.telegram.org/bot${YOUR_BOT_TOKEN}/setWebhook?url=$WEB_HOOK_URL
