<?php
require_once 'funciones.php';

// Si ya esta logueado va al panel
if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['usuario'] ?? '';
    $p = $_POST['password'] ?? '';

    $datos = validarLogin($u, $p);

    if ($datos) {
        $_SESSION['usuario'] = $u;
        $_SESSION['nombre'] = $datos['nombre'];
        $_SESSION['rol'] = $datos['rol'];
        header('Location: panel.php');
        exit;
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 400px;">
    <h2>Login Soporte</h2>

    <?php if ($error !== ""): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
    
    <p class="mt-3 text-muted small">Prueba con: admin, tecnico01 o cliente01 (Pass: 1234)</p>
</div>

</body>
</html>
