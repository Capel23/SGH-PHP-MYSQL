<?php
// src/controllers/ReservasController.php
require_once __DIR__ . '/../models/Reserva.php';
require_once __DIR__ . '/../models/Huesped.php';
require_once __DIR__ . '/../models/Habitacion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $huesped_id = intval($_POST['huesped_id']);
    $habitacion_id = intval($_POST['habitacion_id']);
    $fecha_llegada = $_POST['fecha_llegada'];
    $fecha_salida = $_POST['fecha_salida'];

    $resultado = Reserva::crearSegura($pdo, $huesped_id, $habitacion_id, $fecha_llegada, $fecha_salida, 'Confirmada');

    if ($resultado['err_msg']) {
        $mensaje = "⚠️ Error: " . $resultado['err_msg'];
    } else {
        $mensaje = "✅ Reserva creada correctamente (ID: {$resultado['res_id']})";
    }
}

$huespedes = Huesped::obtenerTodos($pdo);
$habitaciones = Habitacion::obtenerTodas($pdo);

include __DIR__ . '/../views/crear_reserva_form.php';
?>
