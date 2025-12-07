<?php
require('fpdf/fpdf.php');
$conexion = new mysqli("localhost", "root", "", "TecnoFixDB");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si no se ha enviado un ID, mostrar el formulario
if (!isset($_GET['id'])) {
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
        <title>Generar Ticket</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container py-5">
        <h2>🧾 Generar Ticket de Reparación</h2>
        <form action="generar_ticket.php" method="GET">
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
            <button type="submit" class="btn btn-primary">📄 Generar Ticket</button>
        </form>
    </body>
    </html>

    <?php
    exit(); // Detener ejecución aquí si solo es el formulario
}

// Si hay un ID, generar el ticket
$id_reparacion = intval($_GET['id']);

$sql = "SELECT 
            R.id_reparacion, R.fecha, R.descripcion, R.costo,
            C.nombre AS cliente, D.marca, D.modelo,
            T.nombre AS tecnico
        FROM Reparaciones R
        JOIN Dispositivos D ON R.id_dispositivo = D.id_dispositivo
        JOIN Clientes C ON D.id_cliente = C.id_cliente
        JOIN Tecnicos T ON R.id_tecnico = T.id_tecnico
        WHERE R.id_reparacion = $id_reparacion";

$resultado = $conexion->query($sql);
if ($resultado->num_rows === 0) {
    die("No se encontró la reparación con ID $id_reparacion");
}
$datos = $resultado->fetch_assoc();

// Crear el PDF (tamaño de ticket)
$pdf = new FPDF('P', 'mm', array(80, 150));
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Contenido del ticket
$pdf->Cell(60, 10, utf8_decode('TecnoFix'), 0, 1, 'C');
$pdf->Cell(60, 6, utf8_decode('Ticket No: ' . $datos['id_reparacion']), 0, 1);
$pdf->Cell(60, 6, utf8_decode('Fecha: ' . $datos['fecha']), 0, 1);
$pdf->Cell(60, 6, utf8_decode('Cliente: ' . $datos['cliente']), 0, 1);
$pdf->Cell(60, 6, utf8_decode('Dispositivo: ' . $datos['marca'] . ' ' . $datos['modelo']), 0, 1);
$pdf->Cell(60, 6, utf8_decode('Técnico: ' . $datos['tecnico']), 0, 1);
$pdf->MultiCell(0, 6, utf8_decode('Descripción: ' . $datos['descripcion']));
$pdf->Cell(60, 6, utf8_decode('Costo: $' . number_format($datos['costo'], 2)), 0, 1);
$pdf->Ln(5);
$pdf->Cell(60, 6, utf8_decode('¡Gracias por su preferencia!'), 0, 1, 'C');

$pdf->Output("I", "ticket_{$datos['id_reparacion']}.pdf");
?>
