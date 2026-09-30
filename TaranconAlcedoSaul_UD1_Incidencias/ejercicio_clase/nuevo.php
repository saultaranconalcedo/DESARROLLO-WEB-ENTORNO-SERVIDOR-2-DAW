<?php
$mensajeError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $txNombre = trim($_POST['txNombre'] ?? '');
    $txEmpresa = trim($_POST['txEmpresa'] ?? '');
    $txEmail = trim($_POST['txEmail'] ?? '');
    $txTelefono = trim($_POST['txTelefono'] ?? '');

    if (empty($txNombre) || empty($txEmpresa) || empty($txEmail) || empty($txTelefono)) {
        $mensajeError = "Todos los campos son obligatorios.";
    } elseif (!filter_var($txEmail, FILTER_VALIDATE_EMAIL)) {
        $mensajeError = "El email no tiene un formato válido.";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alta de Clientes</title>
    <link rel="stylesheet" href="stilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container-sm mt-5" style="min-width: 50%; max-width: 60%;">
    <h1>ALTA DE CLIENTES</h1>

    <?php if (!empty($mensajeError)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $mensajeError ?>
        </div>
    <?php endif; ?>

    <form action="clientes.php" method="post">
        <input type="hidden" name="txAccion" value="crearNuevo">

        <div class="mb-3">
            <label for="txNombre" class="form-label is-required">Nombre : </label>
            <input type="text" class="form-control" id="txNombre" name="txNombre" placeholder="Ingresa tu nombre" required>
        </div>

        <div class="mb-3">
            <label for="txEmpresa" class="form-label is-required">Empresa : </label>
            <input type="text" class="form-control" id="txEmpresa" name="txEmpresa" placeholder="Ingresa el nombre de tu empresa" required>
        </div>

        <div class="mb-3">
            <label for="txEmail" class="form-label is-required">Email : </label>
            <input type="email" class="form-control" id="txEmail" name="txEmail" placeholder="Ingresa tu email" required>
        </div>

        <div class="mb-3">
            <label for="txTelefono" class="form-label is-required">Teléfono : </label>
            <input type="text" class="form-control" id="txTelefono" name="txTelefono" placeholder="Ingresa tu teléfono" required>
        </div>

        <button type="submit" class="btn btn-warning mb-2">Enviar</button>
        <a href="index.php" class="btn btn-danger mb-2">Cancelar</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>