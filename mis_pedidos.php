<?php
session_start();
require_once "php/conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

$pedidos = $conexion->query("
SELECT p.id, p.fecha
FROM pedidos p
WHERE p.usuario_id = $usuario_id
ORDER BY p.fecha DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Mis Pedidos</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">
<h1>Mis Pedidos</h1>

<?php if ($pedidos->num_rows > 0): ?>

<!--  CONTENEDOR NUEVO -->
<div class="pedidos-container">

<?php while($pedido = $pedidos->fetch_assoc()): ?>

<div class="pedido-card card">
  <h3>Pedido #<?php echo $pedido['id']; ?></h3>
  <p>Fecha: <?php echo $pedido['fecha']; ?></p>

  <?php
  $detalle = $conexion->query("
  SELECT pr.nombre, pr.precio, d.cantidad
  FROM detalle_pedido d
  JOIN productos pr ON d.producto_id = pr.id
  WHERE d.pedido_id = ".$pedido['id']
  );

  $total = 0;

  while($item = $detalle->fetch_assoc()):
      $subtotal = $item['precio'] * $item['cantidad'];
      $total += $subtotal;
  ?>

  <p>
    <?php echo $item['nombre']; ?> x <?php echo $item['cantidad']; ?>
    - $<?php echo number_format($subtotal,0); ?>
  </p>

  <?php endwhile; ?>

  <strong>Total: $<?php echo number_format($total,0); ?></strong>

</div>

<?php endwhile; ?>

</div> <!--  CIERRE -->

<?php else: ?>
<p style="text-align:center;">No tienes pedidos aún </p>
<?php endif; ?>

</div>

</body>
</html>