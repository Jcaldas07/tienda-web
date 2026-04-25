<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "sabores_db";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = new mysqli($host, $user, $password, $dbname);
    $conexion->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>