<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<?php
$fichero = 'clientes.json';

if (!file_exists($fichero)) {
    $datos = [
        ['id' => 1, 'Nombre' => 'Carlos', 'Empresa' => 'Empresa A', 'Correo' => 'carlos@test.com', 'Telefono' => '600111222'],
        ['id' => 2, 'Nombre' => 'Ana', 'Empresa' => 'Empresa B', 'Correo' => 'ana@test.com', 'Telefono' => '655333444']
    ];
    file_put_contents($fichero, json_encode($datos));
}

$clientes = json_decode(file_get_contents($fichero), true);
?>

<div class="container-sm mt-5">

<h2>CLIENTES</h2>
<p>
    1. <a href="clientes.php">Listado de clientes</a> | 
    2. <a href="nuevo.php">Nuevo cliente</a>
</p>

<br>

<h3>Listado de Clientes</h3>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Empresa</th>
      <th>Email</th>
      <th>Teléfono</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($clientes as $c): ?>
    <tr>
      <td><?php echo $c['id']; ?></td>
      <td><?php echo $c['Nombre']; ?></td>
      <td><?php echo $c['Empresa']; ?></td>
      <td><?php echo $c['Correo']; ?></td>
      <td><?php echo $c['Telefono']; ?></td>
      <td>
        <a href="eliminar.php?id=<?php echo $c['id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>