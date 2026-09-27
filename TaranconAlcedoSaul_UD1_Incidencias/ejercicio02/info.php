<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del servidor</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Informacion del servidor</h1>

    <br>

    <div class="alert alert-info">

        <p><strong>Metodo HTTP:</strong> <?php echo $_SERVER['REQUEST_METHOD']; ?></p>

        <p><strong>Direccion IP:</strong> <?php echo $_SERVER['REMOTE_ADDR']; ?></p>

        <p><strong>URL solicitada:</strong> <?php echo $_SERVER['REQUEST_URI']; ?></p>

        <p><strong>Navegador:</strong> <?php echo $_SERVER['HTTP_USER_AGENT']; ?></p>

        <p><strong>Idioma:</strong> <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></p>

        <p><strong>Fecha y hora:</strong> <?php echo date("d/m/Y H:i:s"); ?></p>

    </div>

    <br>

    <h2>Consulta GET</h2>

    <?php

    if (isset($_GET['usuario'])) {
        echo "Usuario recibido: " . $_GET['usuario'];
    }

    ?>

    <br><br>

    <h2>Enviar mediante POST</h2>

    <form method="POST">

        <div class="mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mensaje</label>
            <input type="text" name="mensaje" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>

    </form>

    <br>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        echo '<div class="alert alert-success">';

        echo "Usuario recibido: " . $_POST['usuario'] . "<br>";

        echo "Mensaje recibido: " . $_POST['mensaje'];

        echo '</div>';
    }

    ?>

</div>

</body>

</html>