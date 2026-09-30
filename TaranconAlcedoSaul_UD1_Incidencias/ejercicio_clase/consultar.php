<?php

$array_clientes = json_decode(file_get_contents('clientes.json'), true);
$idCliente = $_GET['idCliente'];
$cliente_consultar = null;

foreach ($array_clientes as $cliente) {
    if ($cliente['id'].'' == $idCliente.'') {
        $cliente_consultar = $cliente;
        break;
    }
}

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultar Cliente</title>
    <link rel="stylesheet" href="stilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class ="card">

<div class = "card-header">
    Informacion del Cliente
</div>

<div class = "card-body">

<p class = "card-text"><b>ID</b> <?= $cliente_consultar['id']?></p>
<p class = "card-text"><b>Nombre</b> <?= $cliente_consultar['nombre']?></p>
<p class = "card-text"><b>Empresa</b> <?= $cliente_consultar['empresa']?></p>
<p class = "card-text"><b>Email</b> <?= $cliente_consultar['email']?></p>
<p class = "card-text"><b>Telefono</b> <?= $cliente_consultar['telefono']?></p>

<a href="index.php" class="btn btn-secondary">Volver</a>

</div>


<div class="card-footer text-body-secondary">
    <?= date('Y-m-d H:i:s') ?>
</div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
