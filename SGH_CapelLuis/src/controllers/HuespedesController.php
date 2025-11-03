<?php
// src/controllers/HuespedesController.php
require_once __DIR__ . '/../models/Huesped.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $documento = trim($_POST['documento']);

    if ($nombre && $email && $documento) {
        try {
            Huesped::crear($pdo, $nombre, $email, $documento);
            $mensaje = "✅ Huésped registrado correctamente";
        } catch (PDOException $e) {
            $mensaje = "⚠️ Error: " . $e->getMessage();
        }
    } else {
        $mensaje = "⚠️ Todos los campos son obligatorios";
    }
}

include __DIR__ . '/../views/crear_huesped_form.php';
?>
