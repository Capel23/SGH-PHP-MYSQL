<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $huesped_id = $_POST['huesped_id'];
    $habitacion_id = $_POST['habitacion_id'];
    $fecha_llegada = $_POST['fecha_llegada'];
    $fecha_salida = $_POST['fecha_salida'];

    $resultado = crearReserva($huesped_id, $habitacion_id, $fecha_llegada, $fecha_salida);

    echo "<h2>Resultado:</h2>";
    echo "<p>$resultado</p>";
    echo "<a href='form_reserva.html'>Volver al formulario</a>";
} else {
    echo "Acceso no permitido.";
}
?>
