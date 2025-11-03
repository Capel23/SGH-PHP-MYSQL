<?php
// src/models/Reserva.php
require_once __DIR__ . '/../db.php';

class Reserva {
    public static function crearSegura($pdo, $huesped_id, $habitacion_id, $llegada, $salida, $estado = 'Pendiente') {
        $sql = "CALL crear_reserva_segura(:huesped, :habitacion, :llegada, :salida, :estado, @res_id, @err_msg)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':huesped', $huesped_id, PDO::PARAM_INT);
        $stmt->bindParam(':habitacion', $habitacion_id, PDO::PARAM_INT);
        $stmt->bindParam(':llegada', $llegada);
        $stmt->bindParam(':salida', $salida);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();

        $res = $pdo->query("SELECT @res_id AS res_id, @err_msg AS err_msg")->fetch();
        return $res;
    }

    public static function listar($pdo) {
        $stmt = $pdo->query("SELECT r.id, h.nombre AS huesped, hab.numero AS habitacion, r.fecha_llegada, r.fecha_salida, r.precio_total, r.estado 
                             FROM reservas r
                             JOIN huespedes h ON r.huesped_id = h.id
                             JOIN habitaciones hab ON r.habitacion_id = hab.id
                             ORDER BY r.fecha_reserva DESC");
        return $stmt->fetchAll();
    }
}
?>
