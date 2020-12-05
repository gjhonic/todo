<?php
include 'config.php';

// Открываем БД (или создаем)
$db = new PDO('sqlite:'.DB_PATH.DB_NAME);

// - - - Создаем таблицы - - -
// $db->exec("CREATE TABLE user (
//   id INTEGER PRIMARY KEY,
//   name TEXT
// )");
// $db->exec("CREATE TABLE todo_list (
//   id INTEGER PRIMARY KEY,
//   user_id INTEGER,
//   title TEXT,
//   status INTEGER
// )");
