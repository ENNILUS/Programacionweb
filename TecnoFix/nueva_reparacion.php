<?php
include 'conexion.php';

$dispositivos = $conn->query("SELECT id_dispositivo, marca, modelo FROM Dispositivos");
$tecnicos = $conn->query("SELECT id_tecnico, nombre FROM Tecnicos");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_dispositivo = $_POST['id_dispositivo'];
    $id_tecnico = $_POST['id_tecnico'];
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $sql = "INSERT INTO Reparaciones (id_dispositivo, id_tecnico, fecha, descripcion, costo)
            VALUES ('$id_dispositivo', '$id_tecnico', '$fecha', '$descripcion', '$costo')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-success'>✅ Reparación registrada.</p>";
    } else {
        echo "<p class='text-danger'>❌ Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Nueva Reparación</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Registrar Reparación</h2>
<form method='post'>
    <label>Dispositivo:</label>
    <select name='id_dispositivo' class='form-control my-2' required>
        <option value=''>Seleccione uno</option>
        <?php while($d = $dispositivos->fetch_assoc()) {
            echo "<option value='{$d['id_dispositivo']}'>{$d['marca']} {$d['modelo']}</option>";
        } ?>
    </select>
    <label>Técnico:</label>
    <select name='id_tecnico' class='form-control my-2' required>
        <option value=''>Seleccione uno</option>
        <?php while($t = $tecnicos->fetch_assoc()) {
            echo "<option value='{$t['id_tecnico']}'>{$t['nombre']}</option>";
        } ?>
    </select>
    <input class='form-control my-2' name='fecha' type='date' required>
    <textarea class='form-control my-2' name='descripcion' placeholder='Descripción del trabajo' required></textarea>
    <input class='form-control my-2' name='costo' type='number' step='0.01' placeholder='Costo'>
    <button class='btn btn-success' type='submit'>Registrar</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form></body></html>