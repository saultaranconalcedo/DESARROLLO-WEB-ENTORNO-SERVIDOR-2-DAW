<?php
require_once 'funciones.php';

// Si ya tiene la sesion abierta, lo mandamos directo al panel
if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
    exit;
}

$error = "";

// Si envian el formulario de login (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['usuario'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    $datosUsuario = validarLogin($user, $pass);

    if ($datosUsuario) {
        // Guardamos los datos en la sesion del servidor
        $_SESSION['usuario'] = $user;
        $_SESSION['nombre'] = $datosUsuario['nombre'];
        $_SESSION['rol'] = $datosUsuario['rol'];

        // Redirigimos al panel
        header('Location: panel.php');
        exit;
    } else {
        // frase del error
        $error = "Usuario o contraseña incorrectos.";
    }
}

?>

<!DOCTYPE html>
<head>
    <title>Login - Control de Acceso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="bg-light p-4">

<div class="container" style="max-width: 450px; margin-top: 50px;">
    <div class="card shadow">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Acceso a la Aplicación</h4>
        </div>

    <div class="card-body">

        <!-- ALERTA SI FALLA EL LOGIN -->
        <?php if ($error !== ""): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required placeholder="admin, tecnico01 o cliente01">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required placeholder="Contraseña (1234)">
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">Iniciar Sesión</button>
        </form>

        <hr>
        <div class="small text-muted">
            <strong>Usuarios de prueba (Pass: 1234):</strong>
            <ul>
                <li><code>admin</code> (Administrador)</li>
                <li><code>tecnico01</code> (Técnico)</li>
                <li><code>cliente01</code> (Cliente)</li>
            </ul>
        </div>

        </div>
    </div>
</div>

</body>
</html>