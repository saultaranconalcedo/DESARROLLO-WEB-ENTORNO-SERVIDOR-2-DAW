<?php
$nombre = null;
$empresa = null;
$email = null;
$telefono = null;
$motivo = null;
$mensaje = null;

$errores = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["nombre"])) {
        $nombre = $_POST["nombre"];
    }

    if (isset($_POST["empresa"])) {
        $empresa = $_POST["empresa"];
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    }

    if (isset($_POST["telefono"])) {
        $telefono = $_POST["telefono"];
    }

    if (isset($_POST["motivo"])) {
        $motivo = $_POST["motivo"];
    }

    if (isset($_POST["mensaje"])) {
        $mensaje = $_POST["mensaje"];
    }

    if (empty($nombre)) {
        $errores[] = "El nombre es obligatorio.";
    }

    if (empty($email)) {
        $errores[] = "El email es obligatorio.";
    } else {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errores[] = "El email no es valido.";
        }
    }

    if (empty($motivo)) {
        $errores[] = "Selecciona un motivo.";
    }

    if (empty($mensaje)) {
        $errores[] = "El mensaje no puede estar vacio.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<div class="container">
    <h2>Formulario de Contacto</h2>
    <br>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && count($errores) == 0): ?>

        <div class="alert alert-success">
            <h4>Consulta enviada con exito</h4>
            <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
            <p><strong>Empresa:</strong> <?php echo $empresa; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Telefono:</strong> <?php echo $telefono; ?></p>
            <p><strong>Motivo:</strong> <?php echo $motivo; ?></p>
            <p><strong>Mensaje:</strong> <?php echo $mensaje; ?></p>
        </div>
        <a href="index.php" class="btn btn-secondary">Volver al formulario</a>

    <?php else: ?>

        <?php if (count($errores) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errores as $err): ?>
                        <li><?php echo $err; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php" method="POST">
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre y apellidos *</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
            </div>

            <div class="mb-3">
                <label for="empresa" class="form-label">Empresa</label>
                <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $empresa; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo electronico *</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>">
            </div>

            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo de la consulta *</label>
                <select class="form-select" name="motivo" id="motivo">
                    <option value="">-- Seleccionar --</option>
                    <option value="Informacion" <?php if($motivo == 'Informacion') { echo 'selected'; } ?>>Informacion</option>
                    <option value="Presupuesto" <?php if($motivo == 'Presupuesto') { echo 'selected'; } ?>>Presupuesto</option>
                    <option value="Soporte" <?php if($motivo == 'Soporte') { echo 'selected'; } ?>>Soporte</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="mensaje" class="form-label">Mensaje *</label>
                <textarea class="form-control" name="mensaje" id="mensaje" rows="3"><?php echo $mensaje; ?></textarea>
            </div>

            <button type="submit" class="btn btn-dark">Enviar</button>

        </form>

    <?php endif; ?>

</div>

</body>
</html>