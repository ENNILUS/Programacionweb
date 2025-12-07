<?php
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "TecnoFixDB");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si se recibe una solicitud para usar una herramienta
if (isset($_POST['usar'])) {
    $id_herramienta = $_POST['id_herramienta'];
    $cantidad_usada = 1;

    // Insertar en UsoHerramientas (para que el trigger reste)
    $conexion->query("INSERT INTO UsoHerramientas (id_reparacion, id_herramienta, cantidad_usada) 
                      VALUES (1, $id_herramienta, $cantidad_usada)");
}

// Obtener lista de herramientas
$resultado = $conexion->query("SELECT * FROM Inventario");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Consulta de Inventario de Piezas</h2>
    <p>Este módulo muestra las piezas disponibles en el inventario.</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de herramienta/pieza</th>
                <th>Cantidad disponible</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while($fila = $resultado->fetch_assoc()): ?>
                <tr>
                    <td><?= $fila['id_herramienta'] ?></td>
                    <td><?= htmlspecialchars($fila['nombre']) ?></td>
                    <td><?= $fila['cantidad_disponible'] ?></td>
                    <td>
                        <?php if ($fila['cantidad_disponible'] > 0): ?>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_herramienta" value="<?= $fila['id_herramienta'] ?>">
                                <button type="submit" name="usar" class="btn btn-warning btn-sm">Usar</button>
                            </form>
                        <?php else: ?>
                            <span class="text-danger">Agotado</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Volver</a>
</body>
</html>

<?php $conexion->close(); ?>