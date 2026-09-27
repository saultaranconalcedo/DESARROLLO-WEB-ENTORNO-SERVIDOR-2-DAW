
<?php
session_start();
include "incidencias.php";

$id = $_GET["id"] ?? 0;

$incidencia = buscarIncidencia($id);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST["_method"] == "DELETE") {

        $incidencias = leerIncidencias();

        foreach ($incidencias as $posicion => $item) {

            if ($item["id"] == $id) {
                unset($incidencias[$posicion]);
            }
        }

        $incidencias = array_values($incidencias);

        guardarIncidencias($incidencias);

        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar incidencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Eliminar incidencia</h1>

    <?php if ($incidencia != null) { ?>

        <div class="alert alert-warning">
            Estas seguro de eliminar esta incidencia?
        </div>

        <p>
            <strong>Asunto:</strong>
            <?php echo $incidencia["asunto"]; ?>
        </p>

        <form method="POST">

            <input type="hidden" name="_method" value="DELETE">

            <button type="submit" class="btn btn-danger">
                Eliminar
            </button>

            <a href="index.php" class="btn btn-secondary">
                Cancelar
            </a>

        </form>

    <?php } else { ?>

        <div class="alert alert-danger">
            Incidencia no encontrada.
        </div>

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    <?php } ?>

</div>

</body>
</html>
