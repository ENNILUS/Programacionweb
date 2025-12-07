<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .btn-custom {
            background-color: #238636;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #2ea043;
        }
        .btn-blue {
            background-color: #1f6feb;
            color: white;
        }
        .btn-blue:hover {
            background-color: #388bfd;
        }
        .btn-outline-light:hover {
            background-color: #21262d;
        }
    </style>
</head>
<body class="container py-5">
    <h2 class="text-center mb-4">⚙️ Panel de Administración</h2>
    <p class="text-center">Bienvenido/a <strong><?= htmlspecialchars($_SESSION['nombre']) ?></strong> (<?= $_SESSION['rol'] ?>)</p>

    <div class="d-grid gap-3 col-6 mx-auto mt-5">
        <a href="registro_empleado.php" class="btn btn-blue btn-lg">👤 Registrar Empleado</a>
        <a href="validar_diagnostico.php" class="btn btn-custom btn-lg">🩺 Validar Diagnóstico</a>
        <a href="reparaciones.php" class="btn btn-outline-light btn-lg">🔧 Ver Reparaciones</a>
        <a href="logout.php" class="btn btn-danger mt-4">Cerrar sesión</a>
    </div>
</body>
</html>