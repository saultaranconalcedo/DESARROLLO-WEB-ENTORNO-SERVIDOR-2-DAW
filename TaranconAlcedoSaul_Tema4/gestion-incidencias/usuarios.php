<?php
require_once 'funciones.php';
comprobarRolPermitido(['Administrador']);
$usuarios = obtenerUsuariosPrueba();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h2">Usuarios</h1><a class="btn btn-outline-secondary" href="panel.php">Volver al panel</a>
    </div>
    <div class="table-responsive"><table class="table table-striped table-bordered">
        <thead class="table-dark"><tr><th>Usuario</th><th>Nombre</th><th>Rol</th></tr></thead>
        <tbody><?php foreach ($usuarios as $usuario => $datos): ?>
            <tr><td><?= escapar($usuario) ?></td><td><?= escapar($datos['nombre']) ?></td><td><?= escapar($datos['rol']) ?></td></tr>
        <?php endforeach; ?></tbody>
    </table></div>
</main>
</body>
</html>
