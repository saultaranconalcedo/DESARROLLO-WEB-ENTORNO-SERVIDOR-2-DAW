<?php
require_once 'funciones.php';

// Obliga a que este logueado para ver el panel
requerirLogin();

$nombre = $_SESSION['nombre'];
$rol = $_SESSION['rol'];
?>
<!DOCTYPE html>
<head>
    <title>Panel de Control</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="bg-light p-4">

<div class="container" style="max-width: 750px;">
    <div class="card shadow mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Panel Interno</h4>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar Sesión</a>
        </div>
        
        <div class="card-body">
            <h5>Bienvenido, <strong><?= htmlspecialchars($nombre) ?></strong></h5>
            <p>Perfil de acceso: <span class="badge bg-info text-dark fs-6"><?= $rol ?></span></p>
            <hr>

            <h6>Opciones disponibles para tu rol:</h6>
            <div class="list-group mt-3">

                <!-- OPCIONES SEGÚN EL ROL -->

                <?php if ($rol === 'Administrador'): ?>
                    <a href="admin/usuarios.php" class="list-group-item list-group-item-action list-group-item-primary">Usuarios (Gestión)</a>
                    <a href="#" class="list-group-item list-group-item-action">Incidencias (Todas)</a>
                    <a href="#" class="list-group-item list-group-item-action">Configuración</a>
                    <a href="#" class="list-group-item list-group-item-action">Informes</a>

                <?php elseif ($rol === 'Técnico'): ?>
                    <a href="#" class="list-group-item list-group-item-action">Incidencias Asignadas</a>
                    <a href="#" class="list-group-item list-group-item-action">Clientes</a>
                    <a href="#" class="list-group-item list-group-item-action">Informes</a>

                <?php elseif ($rol === 'Cliente'): ?>
                    <a href="#" class="list-group-item list-group-item-action">Mis Incidencias</a>
                    <a href="#" class="list-group-item list-group-item-action">Mi Perfil</a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</div>

</body>
</html>