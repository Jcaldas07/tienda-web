<?php
header("Content-Type: application/json");
include_once "../php/conexion.php";

$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos['usuario_id']) || !isset($datos['total'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Datos incompletos"
    ]);
    exit();
}

$user_id = (int)$datos['usuario_id'];
$total = (float)$datos['total'];

$stmt = $conexion->prepare("INSERT INTO pedidos (usuario_id, total) VALUES (?, ?)");
$stmt->bind_param("id", $user_id, $total);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "pedido_id" => $stmt->insert_id
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Error al guardar"
    ]);
}
?>