<?php
include 'conexion.php';
$reparaciones = $conn->query("SELECT id_reparacion, descripcion FROM Reparaciones");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reparacion = $_POST['id_reparacion'];
    $monto_pagado = $_POST['monto_pagado'];
    echo "<p class='text-success'>🧾 Ticket generado para reparación #$id_reparacion por $$monto_pagado.</p>";
}
?>
<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Generar Ticket</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Generar Ticket de Pago</h2>
<form method='post'>
    <label>Reparación:</label>
    <select name='id_reparacion' class='form-control my-2' required>
        <option value=''>Seleccione reparación</option>
        <?php while($r = $reparaciones->fetch_assoc()) {
            echo "<option value='{$r['id_reparacion']}'>#{$r['id_reparacion']} - {$r['descripcion']}</option>";
        } ?>
    </select>
    <input class='form-control my-2' name='monto_pagado' type='number' step='0.01' placeholder='Monto pagado'>
    <button class='btn btn-info' type='submit'>Generar Ticket</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form>
</body></html>