<?php
session_start();
include 'conexion.php';
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$sql = "SELECT * FROM Empleados WHERE usuario = '$usuario' AND clave = '$clave'";
$result = $conn->query($sql);
if ($result->num_rows === 1) {
    $_SESSION['usuario'] = $usuario;
    header("Location: index.php");
} else {
    echo "<p>Credenciales incorrectas. <a href='login.php'>Intentar de nuevo</a></p>";
}
?>