<?php
// src/models/Habitacion.php
require_once __DIR__ . '/../db.php';

class Habitacion {
    public static function obtenerTodas($pdo) {
        $stmt = $pdo->query("SELECT * FROM habitaciones ORDER BY numero");
        return $stmt->fetchAll();
    }

    public static function obtenerPorId($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM habitaciones WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>
