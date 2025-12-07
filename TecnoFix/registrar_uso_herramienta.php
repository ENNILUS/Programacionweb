<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_reparacion = $_POST['id_reparacion'];
    $id_herramienta = $_POST['id_herramienta'];
    $cantidad_usada = $_POST['cantidad_usada'];

    $sql = "INSERT INTO UsoHerramientas (id_reparacion, id_herramienta, cantidad_usada) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $id_reparacion, $id_herramienta, $cantidad_usada);

    if ($stmt->execute()) {
        echo "Herramienta registrada correctamente.";
    } else {
        echo "Error al registrar herramienta: " . $conn->error;
    }
}
?>
