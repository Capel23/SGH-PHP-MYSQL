<?php
// src/models/Habitacion.php
require_once __DIR__ . '/../db.php';

class Habitacion {

    // Obtener todas las habitaciones
    public static function obtenerTodas($pdo) {
        $stmt = $pdo->query("SELECT * FROM habitaciones");
        return $stmt->fetchAll();
    }

    // Obtener una habitación por su ID
    public static function obtenerPorId($pdo, $id) {
        $stmt = $pdo->prepare("SELECT * FROM habitaciones WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Actualizar el estado de limpieza de una habitación
    public static function actualizarEstado($pdo, $id, $estado_limpieza) {
        $stmt = $pdo->prepare("UPDATE habitaciones SET estado_limpieza = ? WHERE id = ?");
        return $stmt->execute([$estado_limpieza, $id]);
    }

    // (Opcional) Listar habitaciones disponibles para un rango de fechas
    public static function disponibles($pdo, $fecha_llegada, $fecha_salida) {
        $stmt = $pdo->prepare("
            SELECT * FROM habitaciones h
            WHERE NOT EXISTS (
                SELECT 1 FROM reservas r
                WHERE r.habitacion_id = h.id
                  AND r.estado = 'Confirmada'
                  AND r.fecha_llegada < :fecha_salida
                  AND r.fecha_salida > :fecha_llegada
            )
        ");
        $stmt->execute([
            ':fecha_llegada' => $fecha_llegada,
            ':fecha_salida' => $fecha_salida
        ]);
        return $stmt->fetchAll();
    }
}
