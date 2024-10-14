#! /bin/bash

# Шляхи до PHP скриптів
CREATE_DB_PHP='createDatabase.php'           # php сценарій для створення бази даних
VIEW_DB_PHP='viewDatabaseStructure.php'      # php сценарій для перегляду структури бази даних
BACKUP_DB_PHP='backupDatabaseToSQL.php'      # php сценарій для створення резервної копії бази даних
RESTORE_DB_PHP='restoreDatabaseFromSQL.php'  # php сценарій для відновлення бази даних із резервної копії

# Файл бази даних і резервний файл
DB_FILE='store.db'              # Ім'я файлу бази даних
BACKUP_FILE='backup_store.sql'  # Ім'я файлу резервної копії

# Створити базу даних
create_database() {
  if [ -f $DB_FILE ]; then
    echo
    echo "База даних $DB_FILE вже існує"
  else
    echo 'Створення бази даних...'
    php $CREATE_DB_PHP "$1" || echo ' Помилка!'
    echo
  fi
  echo
}

# Переглянути структуру бази даних
view_database() {
  echo 'Перегляд структури бази даних...'
  echo
  php $VIEW_DB_PHP "$1" || echo ' Помилка!'
  echo
}

# Створити резервну копію бази даних
backup_database() {
  echo 'Створення резервної копії бази даних...'
  php $BACKUP_DB_PHP "$1" "$2" || echo ' Помилка!'
  echo
  echo
}

# Вибрати файл для відноввлення бази даних
select_backup_sql_file() {
  select backup_sql_file in $(ls backup_*.sql); do
    break
  done
}

# Відновити базу даних із резервної копії
restore_database() {
  echo 'Відновлення бази даних з резервної копії...'
  php $RESTORE_DB_PHP "$1" "$2" || echo ' Помилка!'
  echo
  echo
}

while true; do

  # Меню користувача
  echo 'Виберіть операцію:'
  echo '1 Створити базу даних'
  echo '2 Переглянути структуру бази даних'
  echo '3 Створити резервну копію бази даних'
  echo '4 Відновити базу даних з резервної копії'
  echo 'Q Вийти'
  echo '------'
  read -r -p 'Введіть номер операції (1/2/3/Q): ' operation

  # Виконання відповідної операції
  case $operation in
    1)
        create_database $DB_FILE
        ;;
    2)
        view_database $DB_FILE
        ;;
    3)
        backup_database $DB_FILE
        ;;
    4)
        select_backup_sql_file
        echo "Вибрано файл: $backup_sql_file"
        restore_database "$backup_sql_file" # "$BACKUP_FILE"
        ;;
    Q)
        exit
        ;;
    *)
        echo
        echo 'Неправильний вибір. Уведіть: 1, 2, 3 або Q'
        echo '------'
        ;;
  esac

done
