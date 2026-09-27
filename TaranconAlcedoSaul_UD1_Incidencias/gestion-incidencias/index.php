<?php
session_start();
include "incidencias.php";

$incidencias = leerIncidencias();
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de incidencias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Gestion de incidencias</h1>

    <a href="nueva.php" class="btn btn-primary mb-3">Nueva incidencia</a>

    <?php if (count($incidencias) == 0) { ?>

        <div class="alert alert-info">
            No hay incidencias.
        </div>

    <?php } else { ?>

        <table class="table table-bordered">

            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Asunto</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($incidencias as $incidencia) { ?>

                <tr>
                    <td><?php echo $incidencia["id"]; ?></td>
                    <td><?php echo $incidencia["fecha"]; ?></td>
                    <td><?php echo $incidencia["cliente"]; ?></td>
                    <td><?php echo $incidencia["email"]; ?></td>
                    <td><?php echo $incidencia["asunto"]; ?></td>
                    <td><?php echo $incidencia["prioridad"]; ?></td>
                    <td><?php echo $incidencia["estado"]; ?></td>

                    <td>
                        <a href="editar.php?id=<?php echo $incidencia["id"]; ?>" class="btn btn-warning btn-sm">
                            Consultar
                        </a>

                        <a href="eliminar.php?id=<?php echo $incidencia["id"]; ?>" class="btn btn-danger btn-sm">
                            Eliminar
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>

    <?php } ?>

</div>

</body>
</html>

