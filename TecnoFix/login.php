<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['usuario']) && isset($_POST['clave'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $sql = "SELECT * FROM Empleados WHERE usuario = ? AND clave = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $usuario, $clave);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $fila = $result->fetch_assoc();
            $_SESSION['usuario'] = $fila['usuario'];
            $_SESSION['rol'] = $fila['rol'];
            $_SESSION['nombre'] = $fila['nombre'];

            if ($fila['rol'] === 'Tecnico') {
                // Buscar el ID del técnico
                $sqlTec = "SELECT id_tecnico FROM Tecnicos WHERE nombre = ?";
                $stmtTec = $conn->prepare($sqlTec);
                $stmtTec->bind_param("s", $fila['nombre']);
                $stmtTec->execute();
                $resTec = $stmtTec->get_result();

                if ($resTec->num_rows == 1) {
                    $rowTec = $resTec->fetch_assoc();
                    $_SESSION['id_tecnico'] = $rowTec['id_tecnico'];
                    $_SESSION['nombre_tecnico'] = $fila['nombre'];
                    header("Location: reparaciones_tecnico.php");
                    exit();
                } else {
                    echo "<p style='color:red;'>No se encontró el técnico asignado.</p>";
                }
            } elseif ($fila['rol'] === 'Admin') {
                header("Location: admin_panel.php");
                exit();
            } elseif ($fila['rol'] === 'Recepcionista') {
                header("Location: recepcion_panel.php");
                exit();
            }
        } else {
            echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
        }
    } else {
        echo "<p style='color:red;'>Faltan datos del formulario.</p>";
    }
}
?>

<!-- FORMULARIO HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - TecnoFix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">

<h2 class="text-center mb-4">Inicio de Sesión</h2>

<form method="POST" action="login.php" class="w-50 mx-auto border p-4 rounded">
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
    </div>
    <div class="mb-3">
        <label for="clave" class="form-label">Contraseña:</label>
        <input type="password" class="form-control" id="clave" name="clave" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
</form>

</body>
</html>