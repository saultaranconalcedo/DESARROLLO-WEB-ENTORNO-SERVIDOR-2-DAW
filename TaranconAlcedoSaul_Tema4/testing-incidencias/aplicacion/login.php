<?php
// Cargo las funciones del sistema
require_once 'funciones.php';

// Si el usuario ya tiene la sesion abierta lo mando directo al panel
if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
    exit;
}

$error = "";

// Solo se activa cuando el usuario le da al boton de Entrar (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Cojo los datos del formulario limpiando espacios
    $u = trim($_POST['usuario'] ?? '');
    $p = trim($_POST['password'] ?? '');

    // Compruebo si el usuario y la contraseña existen
    $datos = validarLogin($u, $p);

    if ($datos) {
        // Guardo los datos del usuario en la superglobal $_SESSION
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
<head>
    <title>Login Soporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container" style="max-width: 400px;">
    <h2>Login Soporte</h2>

    <!-- Muestro el mensaje de error si las credenciales fallan -->
    <?php if ($error !== ""): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label>Usuario:</label>
            <input type="text" name="usuario" class="form-control" required placeholder="admin, tecnico01 o cliente01">
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required placeholder="1234">
        </div>
        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
    </form>
    
    <p class="mt-3 text-muted small">Prueba con: admin, tecnico01 o cliente01 (Pass: 1234)</p>
</div>

</body>
</html>
