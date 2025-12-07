<?php
session_start();

// Redirigir si no hay sesión iniciada
if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel - TecnoFix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

    <h2 class="mb-4 text-center">👨‍🔧 Panel Principal - TecnoFix</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Bienvenido, <?= htmlspecialchars($usuario) ?> (<?= $rol ?>)</h5>
            <p class="card-text">Selecciona una opción del menú para continuar:</p>
        </div>
    </div>

    <ul class="list-group">

        <!-- Ver Reparaciones (Técnico y Admin) -->
        <?php if (in_array($rol, ['Tecnico', 'Admin'])): ?>
            <li class="list-group-item">
                <a href="ver_reparaciones.php">🔧 Ver Reparaciones</a>
            </li>
        <?php endif; ?>

        <!-- Diagnóstico (Solo Técnico) -->
        <?php if ($rol === 'Tecnico'): ?>
            <li class="list-group-item">
                <a href="diagnostico.php">🩺 Diagnóstico</a>
            </li>
        <?php endif; ?>

        <!-- Validar Diagnóstico (Solo Admin) -->
        <?php if ($rol === 'Admin'): ?>
            <li class="list-group-item">
                <a href="validar_diagnostico.php">✅ Validar Diagnóstico</a>
            </li>
        <?php endif; ?>

        <!-- Inventario (Técnico y Admin) -->
        <?php if (in_array($rol, ['Tecnico', 'Admin'])): ?>
            <li class="list-group-item">
                <a href="inventario.php">📦 Ver Inventario</a>
            </li>
        <?php endif; ?>

        <!-- Registrar Reparación (Solo Recepcionista) -->
        <?php if ($rol === 'Recepcionista'): ?>
            <li class="list-group-item">
                <a href="registrar_reparacion.php">📝 Registrar Reparación</a>
            </li>
        <?php endif; ?>

        <!-- Registrar Cliente (Solo Recepcionista) -->
        <?php if ($rol === 'Recepcionista'): ?>
            <li class="list-group-item">
                <a href="registrar_cliente.php">👥 Registrar Cliente</a>
            </li>
        <?php endif; ?>

        <!-- Registrar Dispositivo (Solo Recepcionista) -->
        <?php if ($rol === 'Recepcionista'): ?>
            <li class="list-group-item">
                <a href="registrar_dispositivo.php">📱 Registrar Dispositivo</a>
            </li>
        <?php endif; ?>

        <!-- Generar Ticket (Todos) -->
        <?php if (in_array($rol, ['Admin', 'Tecnico', 'Recepcionista'])): ?>
            <li class="list-group-item">
                <a href="generar_ticket.php">🎫 Generar Ticket</a>
            </li>
        <?php endif; ?>

        <!-- Generar Garantía (Todos) -->
        <?php if (in_array($rol, ['Admin', 'Tecnico', 'Recepcionista'])): ?>
            <li class="list-group-item">
                <a href="generar_garantia.php">📄 Generar Garantía</a>
            </li>
        <?php endif; ?>

        <!-- Registrar Empleado (Solo Admin) -->
        <?php if ($rol === 'Admin'): ?>
            <li class="list-group-item">
                <a href="registrar_empleado.php">👤 Registrar Empleado</a>
            </li>
        <?php endif; ?>

        <!-- Cerrar sesión (Todos) -->
        <li class="list-group-item text-danger">
            <a href="logout.php">🔒 Cerrar sesión</a>
        </li>
    </ul>

</body>
</html>