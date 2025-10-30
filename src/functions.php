<?php
require_once 'db.php';

function registrarHuesped($nombre, $email, $documento) {
    global $pdo;
    $sql = "INSERT INTO huespedes (nombre, email, documento_identidad)
            VALUES (:nombre, :email, :documento)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':documento', $documento);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function habitacionDisponible($habitacion_id, $fecha_llegada, $fecha_salida) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM reservas
            WHERE habitacion_id = :habitacion_id
            AND estado = 'Confirmada'
            AND (fecha_llegada < :fecha_salida AND fecha_salida > :fecha_llegada)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':habitacion_id' => $habitacion_id,
        ':fecha_llegada' => $fecha_llegada,
        ':fecha_salida' => $fecha_salida
    ]);
    return $stmt->fetchColumn() == 0;
}

function habitacionEnMantenimiento($habitacion_id, $fecha_llegada, $fecha_salida) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM tareas_mantenimiento
            WHERE habitacion_id = :habitacion_id
            AND estado != 'Finalizada'
            AND (fecha_inicio <= :fecha_salida AND fecha_fin >= :fecha_llegada)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':habitacion_id' => $habitacion_id,
        ':fecha_llegada' => $fecha_llegada,
        ':fecha_salida' => $fecha_salida
    ]);
    return $stmt->fetchColumn() > 0;
}

function crearReserva($huesped_id, $habitacion_id, $fecha_llegada, $fecha_salida) {
    global $pdo;

    if (habitacionEnMantenimiento($habitacion_id, $fecha_llegada, $fecha_salida)) {
        return "❌ La habitación está en mantenimiento en esas fechas.";
    }

    if (!habitacionDisponible($habitacion_id, $fecha_llegada, $fecha_salida)) {
        return "❌ La habitación ya está reservada en ese rango de fechas.";
    }

    $sqlPrecio = "SELECT precio_base FROM habitaciones WHERE id = :id";
    $stmtPrecio = $pdo->prepare($sqlPrecio);
    $stmtPrecio->execute([':id' => $habitacion_id]);
    $precio_base = $stmtPrecio->fetchColumn();

    $dias = (strtotime($fecha_salida) - strtotime($fecha_llegada)) / 86400;
    $precio_total = $precio_base * $dias;

    $sqlReserva = "INSERT INTO reservas (huesped_id, habitacion_id, fecha_llegada, fecha_salida, precio_total, estado)
                   VALUES (:huesped_id, :habitacion_id, :fecha_llegada, :fecha_salida, :precio_total, 'Confirmada')";
    $stmt = $pdo->prepare($sqlReserva);
    $stmt->execute([
        ':huesped_id' => $huesped_id,
        ':habitacion_id' => $habitacion_id,
        ':fecha_llegada' => $fecha_llegada,
        ':fecha_salida' => $fecha_salida,
        ':precio_total' => $precio_total
    ]);

    return "✅ Reserva creada correctamente. Precio total: €$precio_total";
}
?>
