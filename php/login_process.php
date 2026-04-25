<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../login.php");
    exit();
}

require_once "conexion.php";

$correo = trim($_POST['correo']);
$password = trim($_POST['password']);

if (empty($correo) || empty($password)) {
    $_SESSION['error_login'] = "Todos los campos son obligatorios";
    header("Location: ../login.php");
    exit();
}

$stmt = $conexion->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $usuario = $result->fetch_assoc();

    if (password_verify($password, $usuario['contraseña'])) {

    session_regenerate_id(true);

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nombre'] = $usuario['nombre'];

    header("Location: ../productos.php");
    exit();
}
}

// 👇 AQUÍ ESTÁ LA CLAVE
$_SESSION['error_login'] = "Correo o contraseña incorrectos";

header("Location: ../login.php");
exit();
?>