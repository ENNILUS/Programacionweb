<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Recepcionista') {
    header("Location: login.php");
    exit();
}
$nombre = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Recepción</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .btn-purple {
            background-color: #7c3aed;
            color: white;
        }
        .btn-purple:hover {
            background-color: #8b5cf6;
        }
    </style>
</head>
<body class="container py-5">
    <h2 class="text-center mb-4">💼 Panel Recepción</h2>
    <p class="text-center">Hola, <strong><?= htmlspecialchars($nombre) ?></strong></p>

    <div class="d-grid gap-3 col-6 mx-auto mt-5">
        <a href="registro_cliente.php" class="btn btn-purple btn-lg">👥 Registrar Cliente</a>
        <a href="registro_dispositivo.php" class="btn btn-outline-light btn-lg">📱 Registrar Dispositivo</a>
        <a href="nueva_reparacion.php" class="btn btn-blue btn-lg">📝 Registrar Reparación</a>
        <a href="logout.php" class="btn btn-danger mt-4">Cerrar sesión</a>
    </div>
</body>
</html>