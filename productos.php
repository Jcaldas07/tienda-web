<?php
session_start();
require_once "php/conexion.php";

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

//  ELIMINAR
if (isset($_POST['eliminar_id'])) {
    $id = (int) $_POST['eliminar_id'];
    unset($_SESSION['carrito'][$id]);

    //  VOLVEMOS A LO SEGURO
    header("Location: productos.php");
    exit();
}

//  AGREGAR
if (isset($_POST['producto_id'])) {
    $producto_id = (int) $_POST['producto_id'];

    $stmt = $conexion->prepare("SELECT id FROM productos WHERE id = ?");
    $stmt->bind_param("i", $producto_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        if (isset($_SESSION['carrito'][$producto_id])) {
            $_SESSION['carrito'][$producto_id]++;
        } else {
            $_SESSION['carrito'][$producto_id] = 1;
        }
    }

    //  VOLVEMOS A LO SEGURO
    header("Location: productos.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM productos WHERE activo = 1");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Menú</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<?php include("header.php"); ?>

<div class="container">

<h1 style="text-align:center;">Menú</h1>

<section class="menu">

<?php while($producto = $resultado->fetch_assoc()): ?>

<div class="card">
  <img src="img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="">
  <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
  <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
  <span class="precio">$<?php echo number_format($producto['precio'], 0); ?></span>

  <!--  FORM FUNCIONANDO -->
  <form method="POST">
      <input type="hidden" name="producto_id" value="<?php echo $producto['id']; ?>">
      <button type="submit" class="btn-agregar">
  <span class="texto">Agregar</span>
  <span class="check">✔</span>
</button>
  </form>
</div>

<?php endwhile; ?>

</section>

<hr>

<section id="carrito">
  <h2>Carrito</h2>

<?php
$total = 0;

if (!empty($_SESSION['carrito'])) {

    foreach ($_SESSION['carrito'] as $id => $cantidad) {

        $stmt = $conexion->prepare("SELECT nombre, precio FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado_producto = $stmt->get_result();
        $producto = $resultado_producto->fetch_assoc();

        $subtotal = $producto['precio'] * $cantidad;
        $total += $subtotal;

        echo "<p>" . htmlspecialchars($producto['nombre']) . 
             " x $cantidad - $" . number_format($subtotal, 0) . "</p>";

        echo '<form method="POST" style="display:inline;">
                <input type="hidden" name="eliminar_id" value="'.$id.'">
                <button type="submit">❌</button>
              </form>';
    }

    echo "<h3>Total: $" . number_format($total, 0) . "</h3>";

    echo '<form action="php/confirmar_pedido.php" method="POST">
            <button class="btn btn-accent">Confirmar Pedido</button>
          </form>';

} else {
    echo "<p style='color:gray;'>Tu carrito está vacío</p>";
}
?>

</section>

</div>

<script>
document.querySelectorAll("form").forEach(form => {
  form.addEventListener("submit", () => {
    localStorage.setItem("scrollY", window.scrollY);
  });
});

window.addEventListener("load", () => {
  const scroll = localStorage.getItem("scrollY");
  if (scroll !== null) {
    window.scrollTo(0, parseInt(scroll));
    localStorage.removeItem("scrollY");
  }
});
</script>

<script>
document.querySelectorAll(".btn-agregar").forEach(btn => {
  btn.addEventListener("click", () => {
    setTimeout(() => {
      btn.blur();
    }, 800);
  });
});
</script>

</body>
</html>