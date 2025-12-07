<?php
$conexion = new mysqli("localhost", "root", "", "TecnoFixDB");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT R.id_reparacion, R.fecha, C.nombre AS cliente, D.marca, D.modelo
        FROM Reparaciones R
        JOIN Dispositivos D ON R.id_dispositivo = D.id_dispositivo
        JOIN Clientes C ON D.id_cliente = C.id_cliente
        ORDER BY R.id_reparacion DESC";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Garantía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>🛡️ Generar Garantía</h2>
    <form action="generar_garantia.php" method="GET">
        <div class="mb-3">
            <label for="id" class="form-label">Selecciona una reparación:</label>
            <select name="id" id="id" class="form-select" required>
                <option value="">-- Elige una reparación --</option>
                <?php while ($fila = $resultado->fetch_assoc()) { ?>
                    <option value="<?php echo $fila['id_reparacion']; ?>">
                        <?php echo "ID {$fila['id_reparacion']} - {$fila['marca']} {$fila['modelo']} - {$fila['cliente']} ({$fila['fecha']})"; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Generar Garantía</button>
    </form>
</body>
</html>
