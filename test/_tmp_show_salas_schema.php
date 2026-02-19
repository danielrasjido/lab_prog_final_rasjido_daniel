<?php

require_once __DIR__ . '/../app/config/DBConfig.php';
require_once __DIR__ . '/../vendor/autoload.php';

$pdo = app\libs\database\Connection::get();
$stmt = $pdo->query('SHOW CREATE TABLE salas');
$row = $stmt->fetch(PDO::FETCH_ASSOC);

echo $row['Create Table'] . PHP_EOL;