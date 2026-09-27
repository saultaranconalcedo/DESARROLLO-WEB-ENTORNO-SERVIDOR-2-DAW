
<?php
session_start();
include "incidencias.php";

$error = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cliente = trim($_POST["cliente"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $asunto = trim($_POST["asunto"] ?? "");
    $descripcion = trim($_POST["descripcion"] ?? "");
    $prioridad = $_POST["prioridad"] ?? "";

    if (empty($cliente) || empty($email) || empty($asunto) || empty($descripcion) || empty($prioridad)) {

        $error = "Todos los campos son obligatorios.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "El email no es valido.";

    } else {

        $incidencias = leerIncidencias();

        $nueva = array(
            "id" => siguienteId(),
            "fecha" => date("d/m/Y H:i"),
            "cliente" => $cliente,
            "email" => $email,
            "asunto" => $asunto,
            "descripcion" => $descripcion,
            "prioridad" => $prioridad,
            "estado" => "Pendiente"
        );

        $incidencias[] = $nueva;

        guardarIncidencias($incidencias);

        $mensaje = "Incidencia registrada correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva incidencia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Nueva incidencia</h1>

    <?php if ($error != "") { ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php } ?>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-success">
            <?php echo $mensaje; ?>
        </div>
    <?php } ?>

    <form method="POST">

        <div class="mb-3">
            <label>Cliente</label>
            <input type="text" name="cliente" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>Asunto</label>
            <input type="text" name="asunto" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descripcion</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Prioridad</label>

            <select name="prioridad" class="form-select">
                <option value="">Selecciona</option>
                <option value="Baja">Baja</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
                <option value="Critica">Critica</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            Guardar
        </button>

        <a href="index.php" class="btn btn-secondary">
            Volver
        </a>

    </form>

</div>

</body>
</html>
