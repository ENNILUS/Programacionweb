<?php
require('fpdf/fpdf.php');
$conexion = new mysqli("localhost", "root", "", "TecnoFixDB");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si aún no se ha enviado el formulario, mostrarlo
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
        <title>Generar Garantía</title>
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
            <button type="submit" class="btn btn-primary">🧾 Generar PDF</button>
        </form>
    </body>
    </html>

    <?php
    exit(); // No continuar con la generación del PDF si no hay ID
}

// Si ya se seleccionó un ID, generar el PDF
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

// Crear PDF
$pdf = new FPDF('P', 'mm', 'A5');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, utf8_decode('TecnoFix - Certificado de Garantía'), 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, utf8_decode("N° Garantía: {$datos['id_reparacion']}"), 0, 1);
$pdf->Cell(0, 6, utf8_decode("Fecha: {$datos['fecha']}"), 0, 1);
$pdf->Ln(2);
$pdf->Cell(0, 6, utf8_decode("Cliente: {$datos['cliente']}"), 0, 1);
$pdf->Cell(0, 6, utf8_decode("Dispositivo: {$datos['marca']} {$datos['modelo']}"), 0, 1);
$pdf->Cell(0, 6, utf8_decode("Técnico: {$datos['tecnico']}"), 0, 1);
$pdf->Ln(2);
$pdf->MultiCell(0, 6, utf8_decode("Descripción del trabajo:\n{$datos['descripcion']}"));
$pdf->Ln(3);

// Condiciones de garantía
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, utf8_decode("Condiciones de Garantía:"), 0, 1);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 5, utf8_decode("- La garantía cubre defectos en la pieza reemplazada o el trabajo realizado.\n- No cubre daños por mal uso, humedad, caídas, golpes o manipulación externa."));
$pdf->Ln(2);
$pdf->Cell(0, 6, utf8_decode("Duración: 30 días a partir de la fecha de entrega."), 0, 1);
$pdf->Ln(10);

// Firmas
$pdf->Cell(0, 6, utf8_decode("Firma del cliente: ______________________"), 0, 1);
$pdf->Cell(0, 6, utf8_decode("Firma del técnico: ______________________"), 0, 1);

$pdf->Output("I", "garantia_{$datos['id_reparacion']}.pdf");
?>
