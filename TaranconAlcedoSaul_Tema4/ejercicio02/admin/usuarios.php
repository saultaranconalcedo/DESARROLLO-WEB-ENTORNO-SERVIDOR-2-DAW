<?php
require_once '../funciones.php';

// Solo permite el acceso si es Administrador
// Si entra un cliente o técnico escribiendo la URL a mano, saltara el error

comprobarRolPermitido(['Administrador']);
?>

<!DOCTYPE html>
<head>
    <title>Gestión de Usuarios - Solo Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 700px;">
    <div class="card shadow border-primary">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Zona Privada: Administración de Usuarios</h4>
        </div>
        
        <div class="card-body">
            <p class="text-success fw-bold">Has accedido correctamente al ser Administrador</p>
            <p>Aquí se  podra ccrear, editar o eliminar los usuarios</p>
            <a href="../panel.php" class="btn btn-secondary">Volver al Panel</a>
        </div>
    </div>
</div>

</body>
</html>