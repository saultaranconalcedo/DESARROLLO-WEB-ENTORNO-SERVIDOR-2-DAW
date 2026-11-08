<?php
require_once 'funciones.php';
requerirLogin();

// Leemos el ID desde la URL

$id = $_GET['id'] ?? null;
$todas = cargarIncidencias();

if (!$id || !isset($todas[$id])) {
    header('Location: incidencias.php');
    exit;
}

// Cojemos los datos de la incidencia concreta

$inc = $todas[$id];
?>
<!DOCTYPE html>
<head>
    <title>Detalle Incidencia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4 bg-light">

<div class="container" style="max-width: 500px;">
    <div class="card p-3">
        <h3>Detalle de la Incidencia #<?= $id ?></h3>

        <!-- Pintamos los datos con htmlspecialchars por seguridad -->

        <p><b>Título:</b> <?= htmlspecialchars($inc['titulo']) ?></p>
        <p><b>Cliente:</b> <?= htmlspecialchars($inc['cliente']) ?></p>
        <p><b>Técnico asignado:</b> <?= htmlspecialchars($inc['tecnico']) ?></p>
        <p><b>Prioridad:</b> <?= $inc['prioridad'] ?></p>
        <p><b>Estado:</b> <?= $inc['estado'] ?></p>

        <hr>
        
        <p><b>Descripción del problema:</b><br><?= htmlspecialchars($inc['descripcion']) ?></p>
        <p><b>Observaciones del técnico:</b><br><?= htmlspecialchars($inc['observaciones'] ?: 'Sin observaciones') ?></p>
        <a href="incidencias.php" class="btn btn-secondary">Volver al listado</a>

    </div>
</div>

</body>
</html>
