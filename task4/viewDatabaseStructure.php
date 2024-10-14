<?php
// Шлях до SQLite бази даних
$dbFile = 'store.db';

try {
    // Підключення до бази даних через PDO
    $db = new PDO("sqlite:$dbFile");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Структура бази даних:\n\n";

    // Отримання списку таблиць
    $tablesQuery = $db->query("SELECT name FROM sqlite_master WHERE type='table';");

    $tables = $tablesQuery->fetchAll(PDO::FETCH_COLUMN);

    if (empty($tables)) {
        echo "У базі даних немає таблиць.\n";
    } else {
        foreach ($tables as $table) {
            echo "Таблиця: $table\n";

            // Отримання інформації про стовпці таблиці
            $columnsQuery = $db->query("PRAGMA table_info($table);");
            $columns = $columnsQuery->fetchAll(PDO::FETCH_ASSOC);

            echo "Стовпці:\n";
            foreach ($columns as $column) {
                echo "- {$column['name']} ({$column['type']})";
                if ($column['notnull']) {
                    echo " NOT NULL";
                }
                if ($column['pk']) {
                    echo " PRIMARY KEY";
                }
                echo "\n";
            }
            echo "\n";
        }
    }

} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
}
