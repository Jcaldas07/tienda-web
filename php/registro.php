<?php
session_start();
require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $password_input = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar campos vacíos
    if (empty($nombre) || empty($correo) || empty($password_input)) {
        $_SESSION['error_registro'] = "Todos los campos son obligatorios";
        header("Location: registro.php");
        exit();
    }

    // Validar correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_registro'] = "Correo inválido";
        header("Location: registro.php");
        exit();
    }

    // Validar contraseña
    if (strlen($password_input) < 6) {
        $_SESSION['error_registro'] = "La contraseña debe tener al menos 6 caracteres";
        header("Location: registro.php");
        exit();
    }

    // Confirmar contraseña
    if ($password_input !== $confirm_password) {
        $_SESSION['error_registro'] = "Las contraseñas no coinciden";
        header("Location: registro.php");
        exit();
    }

    // Verificar si el correo ya existe
    $check = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $check->bind_param("s", $correo);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_registro'] = "Este correo ya está registrado";
        header("Location: registro.php");
        exit();
    }

    // Encriptar contraseña
    $password = password_hash($password_input, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $password);

    if ($stmt->execute()) {
        header("Location: ../login.php");
        exit();
    } else {
        $_SESSION['error_registro'] = "Error al registrar";
        header("Location: registro.php");
        exit();
    }

    // Cerrar conexiones
    $check->close();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
<link rel="stylesheet" href="../css/estilos.css">
</head>

<body class="auth-body">

<div class="panel">

<h1>Crear Cuenta</h1>
<p>Regístrate para comenzar a comprar</p>

<?php if (isset($_SESSION['error_registro'])): ?>
    <p style="color:red; font-weight:bold;">
        <?php 
            echo $_SESSION['error_registro']; 
            unset($_SESSION['error_registro']); 
        ?>
    </p>
<?php endif; ?>

<form method="POST">

<label>Nombre</label>
<input type="text" name="nombre" required>

<label>Correo</label>
<input type="email" name="correo" required>

<label>Contraseña</label>
<input type="password" name="password" required>

<label>Confirmar Contraseña</label>
<input type="password" name="confirm_password" required>

<button type="submit" class="btn btn-accent">Registrarse</button>

</form>

<div class="register-link">
¿Ya tienes cuenta? <a href="../login.php">Inicia sesión</a>
</div>

</div>

</body>
</html>