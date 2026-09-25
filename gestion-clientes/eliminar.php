<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
$fichero = 'clientes.json';
$clientes = file_exists($fichero) ? json_decode(file_get_contents($fichero), true) : [];

$idEliminar = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar'])) {
    $nuevosClientes = [];
    foreach ($clientes as $c) {
        if ($c['id'] != $idEliminar) {
            $nuevosClientes[] = $c;
        }
    }
    file_put_contents($fichero, json_encode($nuevosClientes));
    header("Location: clientes.php");
    exit();
}
?>

<div class="container-sm mt-5">

<h2>CLIENTES</h2>
<p>
    1. <a href="clientes.php">Listado de clientes</a> | 
    2. <a href="nuevo.php">Nuevo cliente</a> | 
    3. Eliminar cliente
</p>

<br>

<p>¿Seguro que deseas eliminar al cliente con ID: <?php echo htmlspecialchars($idEliminar); ?>?</p>

<form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($idEliminar); ?>">
    <button type="submit" name="confirmar" value="1" class="btn btn-danger">Eliminar</button>
    <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>