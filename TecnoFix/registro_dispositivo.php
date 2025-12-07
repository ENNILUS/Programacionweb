<?php
include 'conexion.php';
$clientes = $conn->query("SELECT id_cliente, nombre FROM Clientes");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $tipo = $_POST['tipo'];
    $sql = "INSERT INTO Dispositivos (id_cliente, marca, modelo, tipo)
            VALUES ('$id_cliente', '$marca', '$modelo', '$tipo')";
    if ($conn->query($sql) === TRUE) {
        echo "<p class='text-success'>✅ Dispositivo registrado.</p>";
    } else {
        echo "<p class='text-danger'>❌ Error: " . $conn->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Registrar Dispositivo</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Registrar Dispositivo</h2>
<form method='post'>
    <label>Cliente:</label>
    <select name='id_cliente' class='form-control my-2' required>
        <option value=''>Seleccione cliente</option>
        <?php while($c = $clientes->fetch_assoc()) {
            echo "<option value='{$c['id_cliente']}'>{$c['nombre']}</option>";
        } ?>
    </select>
    <input class='form-control my-2' name='marca' placeholder='Marca' required>
    <input class='form-control my-2' name='modelo' placeholder='Modelo' required>
    <select class='form-control my-2' name='tipo' required>
        <option value=''>Seleccione tipo</option>
        <option value='celular'>Celular</option>
        <option value='tablet'>Tablet</option>
        <option value='laptop'>Laptop</option>
        <option value='otro'>Otro</option>
    </select>
    <button class='btn btn-warning' type='submit'>Registrar</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form></body></html>