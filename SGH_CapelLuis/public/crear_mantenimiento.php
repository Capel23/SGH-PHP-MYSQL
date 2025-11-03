<?php
require_once '../src/models/Mantenimiento.php';
require_once '../src/models/Habitacion.php';

$habitaciones = Habitacion::listar($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = Mantenimiento::crear($pdo, $_POST['habitacion_id'], $_POST['descripcion'], $_POST['fecha_inicio'], $_POST['fecha_fin']);
    echo $ok ? "Tarea registrada ✅" : "Error ❌";
}
?>
<form method="post">
    Habitación:
    <select name="habitacion_id">
        <?php foreach($habitaciones as $h) echo "<option value='{$h['id']}'>{$h['numero']}</option>"; ?>
    </select><br>
    Descripción: <input type="text" name="descripcion"><br>
    Fecha inicio: <input type="date" name="fecha_inicio"><br>
    Fecha fin: <input type="date" name="fecha_fin"><br>
    <button type="submit">Registrar mantenimiento</button>
</form>
