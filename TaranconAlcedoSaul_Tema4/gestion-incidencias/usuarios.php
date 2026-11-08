<?php
require_once 'funciones.php';
// Solo puede entrar el  Admin
comprobarRolPermitido(['Administrador']);

$usuarios = obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 600px;">
    <h3>Gestión de Usuarios (Zona Admin)</h3>
    <table class="table table-bordered bg-white">
        <thead>
            <tr><th>Usuario</th><th>Nombre</th><th>Rol</th></tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u => $d): ?>
                <tr>
                    <td><?= $u ?></td>
                    <td><?= $d['nombre'] ?></td>
                    <td><?= $d['rol'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="panel.php" class="btn btn-secondary">Volver al panel</a>
</div>

</body>
</html>
