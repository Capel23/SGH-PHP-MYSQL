<?php
// src/controllers/HabitacionesController.php
require_once __DIR__ . '/../models/Habitacion.php';

$habitaciones = Habitacion::obtenerTodas($pdo);
include __DIR__ . '/../views/habitaciones_list.php';
?>
