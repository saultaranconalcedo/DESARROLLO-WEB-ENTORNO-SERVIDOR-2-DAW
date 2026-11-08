<?php
require_once 'funciones.php';
requerirLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$incidencia = $id ? buscarIncidencia($id) : null;
if ($incidencia === null) {
    http_response_code(404);
    exit('Incidencia no encontrada.');
}

$rol = $_SESSION['rol'];
$usuario = $_SESSION['usuario'];
if (($rol === 'Cliente' && $incidencia['cliente'] !== $usuario)
    || ($rol === 'Técnico' && $incidencia['tecnico'] !== $usuario)
    || !in_array($rol, ['Administrador', 'Técnico', 'Cliente'], true)) {
    mostrarError403();
}
$puedeEditar = $rol === 'Administrador' || $rol === 'Cliente'
    || ($rol === 'Técnico' && $incidencia['tecnico'] === $usuario);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalle de incidencia #<?= (int) $id ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header"><h1 class="h4 mb-0">Incidencia #<?= (int) $id ?>: <?= escapar($incidencia['titulo']) ?></h1></div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Descripción</dt><dd class="col-sm-9"><?= nl2br(escapar($incidencia['descripcion'])) ?></dd>
                <dt class="col-sm-3">Cliente</dt><dd class="col-sm-9"><?= escapar($incidencia['cliente']) ?></dd>
                <dt class="col-sm-3">Técnico</dt><dd class="col-sm-9"><?= escapar($incidencia['tecnico'] ?: 'Sin asignar') ?></dd>
                <dt class="col-sm-3">Prioridad</dt><dd class="col-sm-9"><?= escapar($incidencia['prioridad']) ?></dd>
                <dt class="col-sm-3">Estado</dt><dd class="col-sm-9"><?= escapar($incidencia['estado']) ?></dd>
                <dt class="col-sm-3">Fecha</dt><dd class="col-sm-9"><?= escapar($incidencia['fecha']) ?></dd>
                <dt class="col-sm-3">Observaciones</dt><dd class="col-sm-9"><?= nl2br(escapar($incidencia['observaciones'])) ?: 'Sin observaciones' ?></dd>
            </dl>
            <?php if ($puedeEditar): ?><a class="btn btn-primary" href="editar-incidencia.php?id=<?= (int) $id ?>">Editar</a><?php endif; ?>
            <a class="btn btn-outline-secondary" href="incidencias.php">Volver a incidencias</a>
        </div>
    </div>
</main>
</body>
</html>
