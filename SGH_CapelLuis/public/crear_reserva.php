<?php
require_once '../src/controllers/ReservasController.php';
require_once '../src/models/Habitacion.php';
require_once '../src/models/Huesped.php';

$habitaciones = Habitacion::listar($pdo);
$huespedes = Huesped::listar($pdo);

// Cuando se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res_id = Reserva::crear($pdo, $_POST['huesped_id'], $_POST['habitacion_id'], $_POST['fecha_llegada'], $_POST['fecha_salida'], $_POST['estado']);
    if ($res_id) {
        echo "Reserva creada con ID: $res_id";
    } else {
        echo "Error al crear reserva";
    }
}
?>
<form method="post">
    Huesped:
    <select name="huesped_id">
        <?php foreach($huespedes as $h) echo "<option value='{$h['id']}'>{$h['nombre']}</option>"; ?>
    </select><br>
    Habitación:
    <select name="habitacion_id">
        <?php foreach($habitaciones as $h) echo "<option value='{$h['id']}'>{$h['numero']} ({$h['tipo']})</option>"; ?>
    </select><br>
    Fecha llegada: <input type="date" name="fecha_llegada"><br>
    Fecha salida: <input type="date" name="fecha_salida"><br>
    Estado: 
    <select name="estado">
        <option>Pendiente</option>
        <option>Confirmada</option>
        <option>Cancelada</option>
    </select><br>
    <button type="submit">Crear reserva</button>
</form>
