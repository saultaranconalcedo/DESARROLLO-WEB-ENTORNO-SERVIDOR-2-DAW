<?php

$txNombre = $_POST['txNombre'] ?? '';
$txEmpresa = $_POST['txEmpresa'] ?? '';
$txEmail = $_POST['txEmail'] ?? '';
$txTelefono = $_POST['txTelefono'] ?? '';

$mensajeError = "";
$mensajeOk = "";
$mensajeResumen = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($txNombre)) {
        $mensajeError .= "El campo nombre es obligatorio <br>";
    }

    if (empty($txEmpresa)) {
        $mensajeError .= "El campo empresa es obligatorio <br>";
    }

    if (empty($txEmail)) {

        $mensajeError .= "El campo email es obligatorio <br>";

    } else {

        if (!isValidEmail($txEmail)) {
            $mensajeError .= "El email no es válido <br>";
        }
    }

    if (empty($txTelefono)) {
        $mensajeError .= "El campo teléfono es obligatorio <br>";
    }


    if (empty($mensajeError)) {

        $mensajeOk = "Todos los campos fueron completados correctamente <br>";

        $mensajeResumen = "Cliente registrado correctamente. " .
            "Nombre: " . $txNombre .
            ", Empresa: " . $txEmpresa .
            ", Email: " . $txEmail .
            ", Teléfono: " . $txTelefono . "<br>";

    }
}


function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

?>

<!doctype html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Alta clientes</title>

    <link rel="stylesheet" href="estilos.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container-sm mt-5">

    <h1>ALTA DE CLIENTES</h1>

    <form action="clientes.php" method="post">

        <input type="hidden"
               name="txAccion"
               value="crearNuevo">


        <div class="mb-3">

            <label for="txNombre" class="form-label is-required">
                Nombre :
            </label>

            <input type="text"
                   class="form-control"
                   id="txNombre"
                   name="txNombre"
                   placeholder="Ingresa tu nombre"
                   value="<?= $txNombre ?>">

        </div>


        <div class="mb-3">

            <label for="txEmpresa" class="form-label is-required">
                Empresa :
            </label>

            <input type="text"
                   class="form-control"
                   id="txEmpresa"
                   name="txEmpresa"
                   placeholder="Ingresa el nombre de tu empresa"
                   value="<?= $txEmpresa ?>">

        </div>


        <div class="mb-3">

            <label for="txEmail" class="form-label is-required">
                Email :
            </label>

            <input type="text"
                   class="form-control"
                   id="txEmail"
                   name="txEmail"
                   placeholder="Ingresa tu email"
                   value="<?= $txEmail ?>">

        </div>


        <div class="mb-3">

            <label for="txTelefono" class="form-label is-required">
                Teléfono :
            </label>

            <input type="text"
                   class="form-control"
                   id="txTelefono"
                   name="txTelefono"
                   placeholder="Ingresa tu teléfono"
                   value="<?= $txTelefono ?>">

        </div>


        <button type="submit" class="btn btn-warning mb-2">
            Enviar
        </button>

        <a href="index.php">
            <button type="button" class="btn btn-danger mb-2">
                Cancelar
            </button>
        </a>

    </form>


    <?php

    if (!empty($mensajeError)) {

        echo '<div class="alert alert-danger" role="alert">'
            . $mensajeError .
            '</div>';

    } elseif (!empty($mensajeOk)) {

        echo '<div class="alert alert-success" role="alert">'
            . $mensajeOk .
            '</div>';

        echo '<div class="alert alert-info" role="alert">'
            . $mensajeResumen .
            '</div>';
    }

    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>