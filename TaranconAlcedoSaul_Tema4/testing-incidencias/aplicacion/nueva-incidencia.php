<?php
require_once 'funciones.php';
// Solo clientes o admin pueden crear
comprobarRolPermitido(['Cliente', 'Administrador']);

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $prioridad = $_POST['prioridad'] ?? 'Baja';

    if (empty($titulo) || empty($descripcion)) {
        $error = "El título y la descripción son obligatorios.";
    } else {
        $todas = cargarIncidencias();
        $nuevoId = count($todas) + 1;

        $todas[$nuevoId] = [
            'id' => $nuevoId,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'cliente' => $_SESSION['usuario'],
            'tecnico' => 'tecnico01',
            'prioridad' => $prioridad,
            'estado' => 'Pendiente',
            'fecha' => date('Y-m-d'),
            'observaciones' => ''
        ];

        guardarIncidencias($todas);
        header('Location: incidencias.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 500px;">
    <h3>Nueva Incidencia</h3>

    <?php if ($error !== ""): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-2">
            <label>Título:</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="mb-2">
            <label>Prioridad:</label>
            <select name="prioridad" class="form-select">
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
            </select>
        </div>
        <div class="mb-2">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Guardar</button>
        <a href="incidencias.php" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
</div>

</body>
</html>
