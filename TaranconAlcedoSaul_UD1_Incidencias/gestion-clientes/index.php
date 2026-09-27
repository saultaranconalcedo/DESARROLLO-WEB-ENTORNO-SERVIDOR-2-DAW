<?php

$array_clientes = json_decode(file_get_contents('clientes.json'), true);

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listado clientes</title>

    <link rel="stylesheet" href="estilos.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container-sm mt-5">

    <h1>LISTADO CLIENTES</h1>

    <a href="nuevo.php">
        <button class="btn btn-primary">NUEVO</button>
    </a>

    <table class="table" style="margin-top: 20px;">

        <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>EMPRESA</th>
            <th>EMAIL</th>
            <th>TELEFONO</th>
            <th>ACCIONES</th>
        </tr>
        </thead>

        <tbody>

        <?php

        if (count($array_clientes) > 0) {

            foreach ($array_clientes as $cliente) {

                echo '<tr>';

                echo '<th>' . $cliente['id'] . '</th>';
                echo '<td>' . $cliente['nombre'] . '</td>';
                echo '<td>' . $cliente['empresa'] . '</td>';
                echo '<td>' . $cliente['email'] . '</td>';
                echo '<td>' . $cliente['telefono'] . '</td>';

                echo '<td>
                        <a href="eliminar.php?idCliente=' . $cliente['id'] . '" 
                        class="btn btn-sm btn-danger">
                        Eliminar
                        </a>
                      </td>';

                echo '</tr>';
            }

        } else {

            echo '<tr>
                    <td colspan="6">No hay clientes registrados.</td>
                  </tr>';
        }

        ?>

        </tbody>

    </table>

    <?php if (isset($_GET['mensaje'])): ?>

        <div class="alert alert-success" role="alert">
            <?php echo $_GET['mensaje']; ?>
        </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>