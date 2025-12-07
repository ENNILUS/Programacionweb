<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['id_tecnico'])) {
    header("Location: login.php");
    exit();
}

$id_tecnico = $_SESSION['id_tecnico'];
$nombre_tecnico = $_SESSION['nombre_tecnico'];

// Consulta filtrada por técnico
$sql = "SELECT R.id_reparacion, R.fecha, D.marca, D.modelo, R.descripcion, R.costo
        FROM Reparaciones R
        JOIN Dispositivos D ON R.id_dispositivo = D.id_dispositivo
        WHERE R.id_tecnico = ?
        ORDER BY R.fecha DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_tecnico);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Técnico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
        }
        .btn-cyan {
            background-color: #06b6d4;
            color: white;
        }
        .btn-cyan:hover {
            background-color: #22d3ee;
        }
        .nav-buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body class="container py-4">

    <h2 class="text-center">🔧 Bienvenido, <?= htmlspecialchars($nombre_tecnico) ?></h2>

    <!-- MENÚ DE MÓDULOS -->
    <div class="nav-buttons d-flex justify-content-center gap-3 mt-4 mb-5">
        <a href="reparaciones_tecnico.php" class="btn btn-outline-light">📋 Lista Reparaciones</a>
        <a href="inventario.php" class="btn btn-outline-light">📦 Inventario</a>
        <a href="diagnostico.php" class="btn btn-outline-light">🛠️ Diagnóstico</a>
        <a href="logout.php" class="btn btn-danger">Salir</a>
    </div>

    <!-- TABLA DE REPARACIONES FILTRADAS -->
    <div class="table-responsive">
        <table class="table table-dark table-striped table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Dispositivo</th>
                    <th>Descripción</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id_reparacion'] ?></td>
                        <td><?= $row['fecha'] ?></td>
                        <td><?= $row['marca'] . ' ' . $row['modelo'] ?></td>
                        <td><?= $row['descripcion'] ?></td>
                        <td>$<?= number_format($row['costo'], 2) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>