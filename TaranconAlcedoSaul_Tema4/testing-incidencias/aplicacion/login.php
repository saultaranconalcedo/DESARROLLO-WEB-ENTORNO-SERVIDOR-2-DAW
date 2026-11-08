<?php
require_once 'funciones.php';

if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';
    $datosUsuario = validarLogin($usuario, $contrasena);

    if ($datosUsuario !== false) {
        session_regenerate_id(true);
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nombre'] = $datosUsuario['nombre'];
        $_SESSION['rol'] = $datosUsuario['rol'];
        header('Location: panel.php');
        exit;
    }

    $error = 'Usuario o contraseña incorrectos.';
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión - Gestión de incidencias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<main class="container py-5">
    <div class="card shadow-sm mx-auto" style="max-width: 480px">
        <div class="card-header bg-primary text-white"><h1 class="h4 mb-0">Gestión de incidencias</h1></div>
        <div class="card-body">
            <?php if ($error !== ''): ?>
                <div class="alert alert-danger" role="alert"><?= escapar($error) ?></div>
            <?php endif; ?>
            <form method="post" action="login.php">
                <div class="mb-3">
                    <label class="form-label" for="usuario">Usuario</label>
                    <input class="form-control" id="usuario" name="usuario" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="contrasena">Contraseña</label>
                    <input class="form-control" id="contrasena" name="contrasena" type="password" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Entrar</button>
            </form>
            <hr>
            <p class="small mb-1">Usuarios de prueba (contraseña: <code>1234</code>):</p>
            <p class="small mb-0">admin, tecnico01, tecnico02, cliente01 y cliente02</p>
        </div>
    </div>
</main>
</body>
</html>
