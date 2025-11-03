<?php include 'header.php'; ?>
<h2>Registrar Nuevo Huésped</h2>

<?php if (!empty($mensaje)): ?>
<p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Documento de Identidad:</label>
    <input type="text" name="documento" required>

    <button type="submit">Registrar Huésped</button>
</form>

<?php include 'footer.php'; ?>
