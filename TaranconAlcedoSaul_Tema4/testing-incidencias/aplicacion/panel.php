<?php
require_once 'funciones.php';
requerirLogin();

$nombre = $_SESSION['nombre'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 600px;">
    <h2>Bienvenido <?= htmlspecialchars($nombre) ?></h2>
    <p>Rol: <b><?= $rol ?></b></p>
    <a href="logout.php" class="btn btn-sm btn-outline-danger mb-3">Cerrar sesion</a>
    <hr>

    <div class="list-group">
        <a href="incidencias.php" class="list-group-item">Ver Incidencias</a>

        <?php if ($rol === 'Cliente' || $rol === 'Administrador'): ?>
            <a href="nueva-incidencia.php" class="list-group-item">Crear Incidencia</a>
        <?php endif; ?>

        <?php if ($rol === 'Administrador'): ?>
            <a href="usuarios.php" class="list-group-item">Gestión de Usuarios</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
