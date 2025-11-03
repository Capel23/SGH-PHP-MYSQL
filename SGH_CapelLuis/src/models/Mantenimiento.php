<?php
// src/models/Mantenimiento.php
require_once __DIR__ . '/../db.php';

class Mantenimiento {

    public static function crear($pdo, $habitacion_id, $descripcion, $fecha_inicio, $fecha_fin) {
        $stmt = $pdo->prepare("INSERT INTO mantenimiento (habitacion_id, descripcion, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$habitacion_id, $descripcion, $fecha_inicio, $fecha_fin]);
    }

    public static function listar($pdo) {
        $stmt = $pdo->query("
            SELECT m.id, m.habitacion_id, m.descripcion, m.fecha_inicio, m.fecha_fin,
                   hab.numero AS habitacion_num
            FROM mantenimiento m
            JOIN habitaciones hab ON m.habitacion_id = hab.id
        ");
        return $stmt->fetchAll();
    }
}
