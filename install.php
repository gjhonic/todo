<?php
include 'config.php';

// Открываем БД (или создаем)
$db = new SQLite3(DB_PATH.DB_NAME);

$sql = "CREATE TABLE user(
        id INTEGER PRIMARY KEY,
        name VARCHAR,
        )";
