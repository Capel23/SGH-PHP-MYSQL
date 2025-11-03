<?php include 'header.php'; ?>
<h2>Listado de Habitaciones</h2>
<table>
  <tr>
    <th>Número</th>
    <th>Tipo</th>
    <th>Precio Base</th>
    <th>Estado Limpieza</th>
  </tr>
  <?php foreach ($habitaciones as $hab): ?>
  <tr>
    <td><?= htmlspecialchars($hab['numero']) ?></td>
    <td><?= htmlspecialchars($hab['tipo']) ?></td>
    <td><?= htmlspecialchars($hab['precio_base']) ?> €</td>
    <td><?= htmlspecialchars($hab['estado_limpieza']) ?></td>
  </tr>
  <?php endforeach; ?>
</table>
<?php include 'footer.php'; ?>
