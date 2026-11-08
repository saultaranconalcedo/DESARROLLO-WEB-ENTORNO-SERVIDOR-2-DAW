<?php
require_once 'funciones.php';
requerirLogin();
$rol = $_SESSION['rol'];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel - Gestión de incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0">Panel de incidencias</h1>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Cerrar sesión</a>
        </div>
        <div class="card-body">
            <p>Bienvenido/a, <strong><?= escapar($_SESSION['nombre']) ?></strong>.
                Tu rol es <span class="badge text-bg-info"><?= escapar($rol) ?></span>.</p>
            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="incidencias.php">Consultar incidencias</a>
                <?php if (in_array($rol, ['Cliente', 'Administrador'], true)): ?>
                    <a class="list-group-item list-group-item-action" href="nueva-incidencia.php">Registrar incidencia</a>
                <?php endif; ?>
                <?php if ($rol === 'Administrador'): ?>
                    <a class="list-group-item list-group-item-action" href="usuarios.php">Consultar usuarios</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>
