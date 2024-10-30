#! /bin/bash

echo 'Увімкнути/вимкнути WebHook для Telegram бота'

YOUR_BOT_TOKEN='YOUR_BOT_TOKEN'
WEB_HOOK_URL='https://yourdomain.com/path/to/your-script.php'

select choise in 'Увімкнути WebHook' 'Вимкнути WebHook'; do
  case "$choise" in
    Увімк*) wget -X POST https://api.telegram.org/bot${YOUR_BOT_TOKEN}/setWebhook?url=$WEB_HOOK_URL || exit
      echo "WebHook увімкнено на $WEB_HOOK_URL"
      break
      ;;
    Вимкн*) wget -X POST https://api.telegram.org/bot${YOUR_BOT_TOKEN}/deleteWebhook || exit
      echo 'WebHook вимкнено'
      break
      ;;
  esac
done

# EOF
