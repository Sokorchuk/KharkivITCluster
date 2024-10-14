<?php
// Функція для створення резервної копії бази даних у вигляді SQL команд
function backupDatabaseToSQL($dbFile, $backupFile) {
    try {
        // Підключення до SQLite бази даних
        $db = new PDO('sqlite:' . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Відкриваємо файл для запису SQL команд
        $handle = fopen($backupFile, 'w');
        if (!$handle) {
            throw new Exception("Не вдалося відкрити файл для запису резервної копії.");
        }

        // Отримання списку таблиць
        $tablesQuery = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

        // Експорт структури таблиць і даних
        foreach ($tables as $table) {
            // Отримання схеми таблиці
            $schemaQuery = $db->query("SELECT sql FROM sqlite_master WHERE type='table' AND name='$table'");
            $createTableSQL = $schemaQuery->fetchColumn();
            fwrite($handle, $createTableSQL . ";\n\n");

            // Отримання даних таблиці
            $rowsQuery = $db->query("SELECT * FROM $table");
            $rows = $rowsQuery->fetchAll(PDO::FETCH_ASSOC);

            foreach ($rows as $row) {
                $values = array_map([$db, 'quote'], $row);
                $insertSQL = "INSERT INTO $table (" . implode(", ", array_keys($row)) . ") VALUES (" . implode(", ", $values) . ");\n";
                fwrite($handle, $insertSQL);
            }
            fwrite($handle, "\n");
        }

        fclose($handle);
        echo "Резервна копія бази даних успішно створена у файлі: $backupFile";
    } catch (Exception $e) {
        echo "Помилка: " . $e->getMessage();
    }
}

// Використання функції для резервного копіювання
$dbFile = 'store.db';  // Файл бази даних
$backupFile = 'backup_store_' . date('Y-m-d_H-i-s') . '.sql';  // Ім'я файлу резервної копії

backupDatabaseToSQL($dbFile, $backupFile);
?>
