<?php
// Функція для відновлення бази даних з SQL файлу
function restoreDatabaseFromSQL($dbFile, $sqlFile) {
    try {
        // Підключення до SQLite бази даних
        $db = new PDO('sqlite:' . $dbFile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Читання SQL команд з файлу
        $sql = file_get_contents($sqlFile);
        if (!$sql) {
            throw new Exception("Не вдалося прочитати файл SQL.");
        }

        // Виконання SQL команд для відновлення бази даних
        $db->exec($sql);
        echo "База даних успішно відновлена з файлу: $sqlFile";
    } catch (Exception $e) {
        echo "Помилка: " . $е->getMessage();
    }
}

// Використання функції для відновлення
if (isset($argv[1])) {
    echo "Перший аргумент: " . $argv[1] . "\n";

    $dbFile = 'restored_store.db';  // Файл для відновленої бази даних
    $sqlFile = $argv[1];            // SQL файл з резервною копією

    restoreDatabaseFromSQL($dbFile, $sqlFile);
    echo "\n";
} else {
    echo "Аргумент не переданий.\n";
}
?>
