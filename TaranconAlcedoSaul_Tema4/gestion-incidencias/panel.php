<?php
require_once 'funciones.php';
// Obligo a estar logueado para ver esta pagina
requerirLogin();

$nombre = $_SESSION['nombre'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<head>
    <title>Panel de inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 600px;">
    <h2>Bienvenido, <?= htmlspecialchars($nombre) ?></h2>
    <p>Tu rol de acceso es: <b><?= $rol ?></b></p>
    <a href="logout.php" class="btn btn-sm btn-outline-danger mb-3">Cerrar sesión</a>
    <hr>

    <!-- Menu con botones dibujados segun el rol del usuario -->

    <div class="list-group">
        <a href="incidencias.php" class="list-group-item">Ver Listado de Incidencias</a>

        <!-- Solo lo ven clientes y administradores -->

        <?php if ($rol === 'Cliente' || $rol === 'Administrador'): ?>
            <a href="nueva-incidencia.php" class="list-group-item">Crear Nueva Incidencia</a>
        <?php endif; ?>

        <!-- Solo lo ve el administrador -->
         
        <?php if ($rol === 'Administrador'): ?>
            <a href="usuarios.php" class="list-group-item">Gestión de Usuarios</a>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
