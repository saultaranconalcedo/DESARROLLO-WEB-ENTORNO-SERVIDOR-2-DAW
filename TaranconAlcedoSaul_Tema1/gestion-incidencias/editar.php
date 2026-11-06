<?php

session_start();

include "incidencias.php";

$id = $_GET["id"] ?? "";

$incidencia = buscarIncidencia($id);

$error = "";

$mensaje = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["_method"]) && $_POST["_method"] == "PUT") {

        $estado = $_POST["estado"] ?? "";

        if (empty($estado)) {

            $error = "El estado es obligatorio.";

        } else {

            $incidencias = leerIncidencias();

            foreach ($incidencias as $clave => $dato) {

                if ($dato["id"] == $id) {

                    $incidencias[$clave]["estado"] = $estado;

                }

            }

            guardarIncidencias($incidencias);

            $mensaje = "Estado modificado correctamente.";

            $incidencia = buscarIncidencia($id);

        }

    }

}


if ($incidencia == null) {

    $error = "La incidencia no existe.";

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consultar incidencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="estilos.css">

</head>

<body>

<div class="container mt-5">

    <h1>Consultar incidencia</h1>

    <br>

    <a href="index.php" class="btn btn-primary">Volver</a>

    <br><br>


    <?php if (!empty($error)) { ?>

        <div class="alert alert-danger">

            <?php echo $error; ?>

        </div>

    <?php } ?>


    <?php if (!empty($mensaje)) { ?>

        <div class="alert alert-success">

            <?php echo $mensaje; ?>

        </div>

    <?php } ?>


    <?php if ($incidencia != null) { ?>

        <div class="alert alert-info">

            <p>
                <strong>ID:</strong>
                <?php echo $incidencia["id"]; ?>
            </p>

            <p>
                <strong>Fecha:</strong>
                <?php echo $incidencia["fecha"]; ?>
            </p>

            <p>
                <strong>Cliente:</strong>
                <?php echo $incidencia["cliente"]; ?>
            </p>

            <p>
                <strong>Email:</strong>
                <?php echo $incidencia["email"]; ?>
            </p>

            <p>
                <strong>Asunto:</strong>
                <?php echo $incidencia["asunto"]; ?>
            </p>

            <p>
                <strong>Descripcion:</strong>
                <?php echo $incidencia["descripcion"]; ?>
            </p>

            <p>
                <strong>Prioridad:</strong>
                <?php echo $incidencia["prioridad"]; ?>
            </p>

            <p>
                <strong>Estado:</strong>
                <?php echo $incidencia["estado"]; ?>
            </p>

        </div>


        <h2>Modificar estado</h2>

        <br>

        <form method="POST">

            <input type="hidden" name="_method" value="PUT">


            <div class="mb-3">

                <label>Estado</label>

                <select name="estado" class="form-select">

                    <option value="">Selecciona un estado</option>

                    <option value="Pendiente">
                        Pendiente
                    </option>

                    <option value="En proceso">
                        En proceso
                    </option>

                    <option value="Resuelta">
                        Resuelta
                    </option>

                    <option value="Cerrada">
                        Cerrada
                    </option>

                </select>

            </div>


            <button type="submit" class="btn btn-warning">

                Cambiar estado

            </button>

        </form>

    <?php } ?>

</div>

</body>

</html>