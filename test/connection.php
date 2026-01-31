<?php

require_once __DIR__ . '/../app/libs/database/Connection.php';

use app\libs\database\Connection;

try {
    $conn = Connection::get();
    echo "<h2>✅ Conexión exitosa a la base de datos</h2>";

    $stmt = $conn->query("SELECT DATABASE() AS db");
    $result = $stmt->fetch();

    echo "<p>Base de datos actual: <strong>{$result->db}</strong></p>";

} catch (\PDOException $e) {
    echo "<h2>❌ Error de conexión</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
