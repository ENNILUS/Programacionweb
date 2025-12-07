<?php
include 'conexion.php';

$sql = "SELECT r.id_reparacion, r.fecha, r.descripcion, r.costo,
               d.marca, d.modelo, t.nombre AS tecnico
        FROM Reparaciones r
        JOIN Dispositivos d ON r.id_dispositivo = d.id_dispositivo
        JOIN Tecnicos t ON r.id_tecnico = t.id_tecnico";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Reparaciones</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Iconos de Bootstrap (si usas íconos) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Lista de Reparaciones</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Dispositivo</th>
                    <th>Técnico</th>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $fila['id_reparacion']; ?></td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><?php echo $fila['marca'] . " " . $fila['modelo']; ?></td>
                    <td><?php echo $fila['tecnico']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td>$<?php echo number_format($fila['costo'], 2); ?></td>
                    <td>
                        <a href="generar_ticket.php?id=<?php echo $fila['id_reparacion']; ?>" 
                           class="btn btn-sm btn-primary" 
                           target="_blank">
                           <i class="bi bi-receipt-cutoff"></i> Imprimir Ticket
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (opcional para algunas funcionalidades) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
