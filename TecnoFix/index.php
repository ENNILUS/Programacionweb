<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$rol = $_SESSION['rol'];
$nombre = $_SESSION['nombre'] ?? $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal - TecnoFix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .panel-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .btn-card {
            padding: 1.5rem;
            font-size: 1.1rem;
            border-radius: 1rem;
            transition: transform 0.2s;
        }
        .btn-card:hover {
            transform: scale(1.03);
        }
        .logout {
            color: #58a6ff;
            text-decoration: none;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="container py-5">

    <div class="d-flex justify-content-between mb-4">
        <div><strong>👤 <?= htmlspecialchars($nombre) ?></strong> (<?= $rol ?>)</div>
        <div><a href="logout.php" class="logout">🔒 Cerrar sesión</a></div>
    </div>

    <h1 class="text-center mb-4 text-info">TecnoFix - Panel Principal</h1>

    <div class="row g-4">

        <?php if ($rol == 'Tecnico' || $rol == 'Admin') { ?>
            <div class="col-md-4">
                <a href="reparaciones_tecnico.php" class="btn btn-primary w-100 btn-card">📋 Lista de Reparaciones</a>
            </div>
            <div class="col-md-4">
                <a href="diagnostico.php" class="btn btn-outline-light w-100 btn-card">🧪 Diagnóstico</a>
            </div>
        <?php } ?>

        <?php if ($rol == 'Admin') { ?>
            <div class="col-md-4">
                <a href="validar_diagnostico.php" class="btn btn-success w-100 btn-card">✅ Validar Diagnóstico</a>
            </div>
        <?php } ?>

        <?php if ($rol == 'Admin' || $rol == 'Recepcionista') { ?>
            <div class="col-md-4">
                <a href="nueva_reparacion.php" class="btn btn-success w-100 btn-card">➕ Registrar Reparación</a>
            </div>
            <div class="col-md-4">
                <a href="registro_cliente.php" class="btn btn-info w-100 btn-card">👤 Registrar Cliente</a>
            </div>
            <div class="col-md-4">
                <a href="registro_dispositivo.php" class="btn btn-warning w-100 btn-card">📱 Registrar Dispositivo</a>
            </div>
            <div class="col-md-4">
                <a href="ticket_pago.php" class="btn btn-outline-primary w-100 btn-card">🎫 Generar Ticket</a>
            </div>
            <div class="col-md-4">
                <a href="generar_garantia.php" class="btn btn-outline-info w-100 btn-card">🛡️ Generar Garantía</a>
            </div>
        <?php } ?>

        <?php if ($rol == 'Admin') { ?>
            <div class="col-md-4">
                <a href="registro_empleado.php" class="btn btn-dark w-100 btn-card">🧑‍💼 Registrar Empleado</a>
            </div>
            <div class="col-md-4">
                <a href="inventario.php" class="btn btn-outline-secondary w-100 btn-card">📦 Inventario</a>
            </div>
        <?php } ?>

        <?php if ($rol == 'Tecnico') { ?>
            <div class="col-md-4">
                <a href="inventario.php" class="btn btn-outline-secondary w-100 btn-card">📦 Ver Inventario</a>
            </div>
        <?php } ?>

    </div>
</body>
</html>