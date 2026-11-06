<?php
$idCliente = $_GET['idCliente'] ?? null;

if (!$idCliente) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eliminar Cliente</title>
    <link rel="stylesheet" href="stilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-sm mt-5" style="min-width: 50%; max-width: 60%;">
    <h1>ELIMINAR CLIENTE</h1>

    <div class="card text-center">
        <div class="card-header">
            Confirmación
        </div>
        <div class="card-body">
            <h5 class="card-title">¿Está seguro que desea eliminar el cliente con ID <?= htmlspecialchars($idCliente) ?>?</h5>
            <p class="card-text">Esta acción no se puede deshacer.</p>

            <form action="clientes.php" method="post" style="display: inline-block;">
                <input type="hidden" name="txAccion" value="eliminar">
                <input type="hidden" name="idCliente" value="<?= htmlspecialchars($idCliente) ?>">
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>

            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </div>
        <div class="card-footer text-body-secondary">
            <?= date('Y-m-d H:i:s') ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>