<?php
include 'conexion.php';
$diagnosticos = $conn->query("SELECT id_reparacion, descripcion FROM Reparaciones");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reparacion = $_POST['id_reparacion'];
    $estado = $_POST['estado'];
    echo "<p class='text-success'>✅ Diagnóstico de reparación #$id_reparacion fue $estado.</p>";
}
?>
<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Validar Diagnóstico</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Validación del Diagnóstico</h2>
<form method='post'>
    <label>Reparación:</label>
    <select name='id_reparacion' class='form-control my-2' required>
        <option value=''>Seleccione reparación</option>
        <?php while($r = $diagnosticos->fetch_assoc()) {
            echo "<option value='{$r['id_reparacion']}'>#{$r['id_reparacion']} - {$r['descripcion']}</option>";
        } ?>
    </select>
    <select class='form-control my-2' name='estado' required>
        <option value='aprobado'>Aprobar</option>
        <option value='rechazado'>Rechazar</option>
    </select>
    <button class='btn btn-success' type='submit'>Validar</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form>
</body></html>