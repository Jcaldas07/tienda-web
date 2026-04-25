<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['usuario_id']) || empty($_SESSION['carrito'])) {
    header("Location: ../productos.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// guardar pedido
$stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id) VALUES (?)");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$pedido_id = $stmt->insert_id;

// guardar detalle
foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {

    $stmt = $conexion->prepare("INSERT INTO detalle_pedido (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $pedido_id, $producto_id, $cantidad);
    $stmt->execute();
}

// vaciar carrito
unset($_SESSION['carrito']);

// redirigir
header("Location: ../mis_pedidos.php");
exit();
?>