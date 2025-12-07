<?php
include 'conexion.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $sql = "INSERT INTO Clientes (nombre, telefono, correo, direccion)
            VALUES ('$nombre', '$telefono', '$correo', '$direccion')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-success'>✅ Cliente registrado con éxito.</p>";
    } else {
        echo "<p class='text-danger'>❌ Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head><meta charset='UTF-8'><title>Registrar Cliente</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Registrar Cliente</h2>
<form method='post'>
    <input class='form-control my-2' name='nombre' placeholder='Nombre completo' required>
    <input class='form-control my-2' name='telefono' placeholder='Teléfono' required>
    <input class='form-control my-2' name='correo' placeholder='Correo electrónico'>
    <input class='form-control my-2' name='direccion' placeholder='Dirección'>
    <button class='btn btn-success mt-2' type='submit'>Registrar</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form></body></html>