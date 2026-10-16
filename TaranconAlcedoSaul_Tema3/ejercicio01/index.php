<?php
// Variables vacias al principio para no dar avisos/warnings
$nombre = $dni = $empresa = $email = $telefono = $direccion = $cp = $ciudad = "";
$errores = [];
$exito = false;

// Solo se ejecuta si le dan al boton de enviar (metodo POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recojo los datos y limpiecito espacios con trim
    $nombre = trim($_POST['nombre'] ?? '');
    $dni = trim($_POST['dni'] ?? '');
    $empresa = trim($_POST['empresa'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $direccion = trim($_POST['direccion'] ?? '');
    $cp = trim($_POST['cp'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');

    // --- VALIDACIONES DEL SERVIDOR (PHP) ---

    // 1. Campos obligatorios
    if (empty($nombre)) {
        $errores[] = "El Nombre y Apellidos es obligatorio.";
    }
    if (empty($dni)) {
        $errores[] = "El DNI/NIE es obligatorio.";
    }
    if (empty($email)) {
        $errores[] = "El Correo electrónico es obligatorio.";
    }
    if (empty($telefono)) {
        $errores[] = "El Teléfono es obligatorio.";
    }
    if (empty($cp)) {
        $errores[] = "El Código Postal es obligatorio.";
    }

    // 2. Formato de Email valido
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El Correo electrónico no tiene un formato válido (ejemplo: usuario@dominio.com).";
    }

    // 3. Codigo Postal exactamente 5 digitos
    if (!empty($cp) && (!ctype_digit($cp) || strlen($cp) !== 5)) {
        $errores[] = "El Código Postal debe tener exactamente 5 números.";
    }

    // 4. Telefono valido (numeros de 9 a 15 digitos)
    if (!empty($telefono) && !preg_match('/^[0-9]{9,15}$/', $telefono)) {
        $errores[] = "El Teléfono debe contener solo números (mínimo 9 dígitos).";
    }

    // Si la lista de errores esta vacia, ¡todo correcto!
    if (empty($errores)) {
        $exito = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio 1 - Alta de Clientes</title>
    <!-- CSS de Bootstrap por CDN para que quede bonito sin tocar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 650px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulario de Alta de Clientes</h4>
        </div>
        <div class="card-body">

            <!-- SI HAY ERRORES: Muestro la caja roja -->
            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <h5 class="alert-heading">¡Atención! Revisa los siguientes errores:</h5>
                    <ul class="mb-0">
                        <?php foreach ($errores as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- SI TODO ESTA BIEN: Muestro la tarjeta verde de exito -->
            <?php if ($exito): ?>
                <div class="alert alert-success">
                    <h4 class="alert-heading text-uppercase font-monospace">CLIENTE REGISTRADO CORRECTAMENTE</h4>
                    <hr>
                    <p class="mb-1"><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
                    <p class="mb-1"><strong>DNI/NIE:</strong> <?= htmlspecialchars($dni) ?></p>
                    <p class="mb-1"><strong>Empresa:</strong> <?= htmlspecialchars($empresa) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                    <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($telefono) ?></p>
                    <p class="mb-1"><strong>Dirección:</strong> <?= htmlspecialchars($direccion) ?></p>
                    <p class="mb-1"><strong>Código Postal:</strong> <?= htmlspecialchars($cp) ?></p>
                    <p class="mb-0"><strong>Ciudad:</strong> <?= htmlspecialchars($ciudad) ?></p>
                </div>
            <?php endif; ?>

            <!-- FORMULARIO CON TIPOS HTML5 -->
            <form method="POST" action="index.php">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre y Apellidos *</label>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">DNI / NIE *</label>
                        <input type="text" name="dni" class="form-control" value="<?= htmlspecialchars($dni) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Empresa</label>
                        <input type="text" name="empresa" class="form-control" value="<?= htmlspecialchars($empresa) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo electrónico *</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teléfono *</label>
                        <input type="tel" name="telefono" class="form-control" value="<?= htmlspecialchars($telefono) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($direccion) ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Código Postal *</label>
                        <input type="text" name="cp" class="form-control" maxlength="5" value="<?= htmlspecialchars($cp) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" class="form-control" value="<?= htmlspecialchars($ciudad) ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 fw-bold">Registrar Cliente</button>
            </form>

        </div>
    </div>
</div>

</body>
</html>