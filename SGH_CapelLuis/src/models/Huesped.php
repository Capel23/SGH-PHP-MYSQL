<?php
// src/models/Huesped.php
require_once __DIR__ . '/../db.php';

class Huesped {
    public static function crear($pdo, $nombre, $email, $documento) {
        $stmt = $pdo->prepare("INSERT INTO huespedes (nombre, email, documento_identidad) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $documento]);
        return $pdo->lastInsertId();
    }

    public static function obtenerTodos($pdo) {
        return $pdo->query("SELECT * FROM huespedes ORDER BY nombre")->fetchAll();
    }
}
?>
