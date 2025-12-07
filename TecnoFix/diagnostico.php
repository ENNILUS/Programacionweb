<!DOCTYPE html>
<html><head><meta charset='UTF-8'><title>Diagnóstico</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head>
<body class='container py-4'>
<h2>Formulario de Diagnóstico Técnico</h2>
<form method='post'>
    <input class='form-control my-2' name='id_dispositivo' type='number' placeholder='ID del dispositivo' required>
    <textarea class='form-control my-2' name='diagnostico' placeholder='Descripción del diagnóstico técnico'></textarea>
    <button class='btn btn-primary' type='submit'>Guardar Diagnóstico</button>
    <a href='index.php' class='btn btn-secondary mt-2'>Volver</a>
</form>
</body></html>