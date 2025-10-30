<?php
require 'db.php';

echo "<h2>🏨 Habitaciones registradas</h2>";

try {
    $stmt = $pdo->query("SELECT * FROM habitaciones");
    foreach ($stmt as $fila) {
        echo "Habitación Nº " . $fila['numero'] .
             " | Tipo: " . $fila['tipo'] .
             " | Precio base: " . $fila['precio_base'] . " €<br>";
    }
} catch (PDOException $e) {
    echo "Error al consultar habitaciones: " . $e->getMessage();
}
?>
