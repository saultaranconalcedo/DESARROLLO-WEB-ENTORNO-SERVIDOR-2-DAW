<?php
include 'clientes.php';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado de Clientes</title>
    <link rel="stylesheet" href="stilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-sm mt-5" style="min-width: 50%; max-width: 60%;">
    <h1>LISTADO CLIENTES</h1>
    <a href="nuevo.php" class="btn btn-primary">NUEVO</a>

    <form action="index.php" method="get" style="margin-top: 20px;">
        <div class="input-group">
            <input type="hidden" name="txAccion" value="accionBuscar">
            <input type="text" class="form-control" placeholder="Buscar cliente..." name="txBuscar" value="<?= htmlspecialchars($_GET['txBuscar'] ?? '') ?>">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    <table class="table" style="margin-top: 20px;">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">NOMBRE</th>
            <th scope="col">EMPRESA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">TELÉFONO</th>
            <th scope="col">ACCIONES</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($array_clientes)): ?>
            <?php foreach ($array_clientes as $cliente): ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($cliente['id']) ?></th>
                    <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                    <td><?= htmlspecialchars($cliente['empresa']) ?></td>
                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                    <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                    <td>
                        <a href="eliminar.php?idCliente=<?= $cliente['id'] ?>" class="btn btn-sm btn-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" class="text-center">No hay clientes registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($_GET['mensaje']) ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>