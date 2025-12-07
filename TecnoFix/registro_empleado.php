<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $especialidad = $_POST['especialidad'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $sql = "INSERT INTO Empleados (nombre, especialidad, telefono, usuario, clave)
            VALUES ('$nombre', '$especialidad', '$telefono', '$usuario', '$clave')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-success'>✅ Empleado registrado con éxito.</p>";
    } else {
        echo "<p class='text-danger'>❌ Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Registrar Empleado</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Registrar Empleado</h2>
<form method='post'>
    <input class='form-control my-2' name='nombre' placeholder='Nombre completo' required>
    <input class='form-control my-2' name='especialidad' placeholder='Especialidad'>
    <input class='form-control my-2' name='telefono' placeholder='Teléfono'>
    <input class='form-control my-2' name='usuario' placeholder='Usuario' required>
    <input class='form-control my-2' type='password' name='clave' placeholder='Contraseña' required>
    <button class='btn btn-dark' type='submit'>Registrar</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form></body></html>