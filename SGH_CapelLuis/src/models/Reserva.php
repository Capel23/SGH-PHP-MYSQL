<?php
// src/models/Reserva.php
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/Habitacion.php';

class Reserva {

    // Crear reserva con precio_total calculado
    public static function crear($pdo, $huesped_id, $habitacion_id, $fecha_llegada, $fecha_salida, $estado = 'Pendiente') {
        // Obtener precio_base de la habitación
        $habitacion = Habitacion::obtener($pdo, $habitacion_id);
        if (!$habitacion) return false;

        $dias = (strtotime($fecha_salida) - strtotime($fecha_llegada)) / (60*60*24);
        $precio_total = $habitacion['precio_base'] * $dias;

        $stmt = $pdo->prepare("INSERT INTO reservas (huesped_id, habitacion_id, fecha_llegada, fecha_salida, estado, precio_total) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$huesped_id, $habitacion_id, $fecha_llegada, $fecha_salida, $estado, $precio_total]);

        return $pdo->lastInsertId();
    }

    // Listar reservas con info de huésped y habitación
    public static function listar($pdo) {
        $stmt = $pdo->query("
            SELECT r.id, r.fecha_llegada, r.fecha_salida, r.estado, r.precio_total,
                   h.nombre AS huesped, hab.numero AS habitacion, hab.estado_limpieza
            FROM reservas r
            JOIN huespedes h ON r.huesped_id = h.id
            JOIN habitaciones hab ON r.habitacion_id = hab.id
        ");
        return $stmt->fetchAll();
    }
}
