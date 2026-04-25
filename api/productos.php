<?php
header("Content-Type: application/json"); // Obligatorio para APIs
include_once "../php/conexion.php";

// Consultamos los productos de tu tabla
$query = "SELECT id, nombre, precio, descripcion, imagen FROM productos WHERE activo = 1";
$resultado = $conexion->query($query);

$productos = [];
while ($fila = $resultado->fetch_assoc()) {
    $productos[] = $fila;
}

// Retornamos los datos en formato JSON
echo json_encode($productos);
?>