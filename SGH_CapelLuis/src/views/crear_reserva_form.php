<?php include 'header.php'; ?>
<h2>Crear Nueva Reserva</h2>

<?php if (!empty($mensaje)): ?>
<p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<form method="POST">
  <label>Huésped:</label>
  <select name="huesped_id" required>
    <option value="">Seleccione</option>
    <?php foreach ($huespedes as $h): ?>
      <option value="<?= $h['id'] ?>"><?= htmlspecialchars($h['nombre']) ?></option>
    <?php endforeach; ?>
  </select>

  <label>Habitación:</label>
  <select name="habitacion_id" required>
    <option value="">Seleccione</option>
    <?php foreach ($habitaciones as $hab): ?>
      <option value="<?= $hab['id'] ?>"><?= htmlspecialchars($hab['numero']) ?> (<?= $hab['tipo'] ?>)</option>
    <?php endforeach; ?>
  </select>

  <label>Fecha Llegada:</label>
  <input type="date" name="fecha_llegada" required>

  <label>Fecha Salida:</label>
  <input type="date" name="fecha_salida" required>

  <button type="submit">Guardar Reserva</button>
</form>

<?php include 'footer.php'; ?>
