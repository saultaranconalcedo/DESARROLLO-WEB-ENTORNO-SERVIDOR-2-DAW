<?php
require_once 'funciones.php';
requerirLogin();

// Cojo el ID que viene pegado en la URL (ej: editar-incidencia.php?id=1)

$id = $_GET['id'] ?? null;
$todas = cargarIncidencias();

// Si el ID no existe vuelvo al listado

if (!$id || !isset($todas[$id])) {
    header('Location: incidencias.php');
    exit;
}

$inc = $todas[$id];

// Cuando se envia el formulario con los cambios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Actualizo los campos en la incidencia
    $inc['estado'] = $_POST['estado'];
    $inc['prioridad'] = $_POST['prioridad'];
    $inc['observaciones'] = $_POST['observaciones'];

    // Guardo el array actualizado en la sesion

    $todas[$id] = $inc;
    guardarIncidencias($todas);

    header('Location: incidencias.php');
    exit;
}
?>
<!DOCTYPE html>
<head>
    <title>Editar Incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 500px;">
    <h3>Editar Incidencia #<?= $id ?></h3>

    <form method="POST">

        <div class="mb-2">
            <label>Estado:</label>
            <select name="estado" class="form-select">
                <option value="Pendiente" <?= $inc['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="En proceso" <?= $inc['estado'] == 'En proceso' ? 'selected' : '' ?>>En proceso</option>
                <option value="Resuelta" <?= $inc['estado'] == 'Resuelta' ? 'selected' : '' ?>>Resuelta</option>
            </select>

        </div>
        <div class="mb-2">
            <label>Prioridad:</label>
            <select name="prioridad" class="form-select">
                <option value="Baja" <?= $inc['prioridad'] == 'Baja' ? 'selected' : '' ?>>Baja</option>
                <option value="Media" <?= $inc['prioridad'] == 'Media' ? 'selected' : '' ?>>Media</option>
                <option value="Alta" <?= $inc['prioridad'] == 'Alta' ? 'selected' : '' ?>>Alta</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Observaciones:</label>
            <textarea name="observaciones" class="form-control"><?= htmlspecialchars($inc['observaciones']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-warning mt-2">Guardar cambios</button>
        <a href="incidencias.php" class="btn btn-secondary mt-2">Volver</a>
        
    </form>
</div>

</body>
</html>