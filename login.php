<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="css/estilos.css">
</head>

<body class="auth-body">

<div class="panel">

<h1>Iniciar Sesión</h1>
<p>Ingresa tus datos para continuar</p>

<?php if (isset($_SESSION['error_login'])): ?>
    <p style="color:red; font-weight:bold;">
        <?php 
            echo $_SESSION['error_login']; 
            unset($_SESSION['error_login']); 
        ?>
    </p>
<?php endif; ?>

<form method="POST" action="php/login_process.php">

<label>Correo</label>
<input type="email" name="correo" required>

<label>Contraseña</label>
<input type="password" name="password" required>

<button type="submit" class="btn btn-accent">Entrar</button>

</form>

<div class="register-link">
¿No tienes cuenta? <a href="php/registro.php">Regístrate</a>
</div>

</div>

</body>
</html>