<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Uso de Herramienta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Registrar Uso de Herramienta</h2>
    <form method="POST" action="registrar_uso_herramienta.php">
        <div class="mb-3">
            <label for="id_reparacion" class="form-label">ID Reparación:</label>
            <input type="number" name="id_reparacion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_herramienta" class="form-label">ID Herramienta:</label>
            <input type="number" name="id_herramienta" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cantidad_usada" class="form-label">Cantidad Usada:</label>
            <input type="number" name="cantidad_usada" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Uso</button>
    </form>
</body>
</html>
