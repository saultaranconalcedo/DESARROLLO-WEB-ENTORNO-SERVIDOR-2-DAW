<?php
// cuando se usa sesiones hay que poner session_start() al principio de todo
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usuarios de prueba 
// Las contraseñas en texto plano para las pruebas (ej: 1234)

function obtenerUsuariosPrueba() {
    return [
        'admin' => [
        'nombre' => 'Carlos Administrador',
        'pass' => '1234',
        'rol' => 'Administrador'
        ],
        'tecnico01' => [
        'nombre' => 'Sonia Técnica',
        'pass' => '1234',
        'rol' => 'Técnico'
        ],
        'cliente01' => [
        'nombre' => 'Empresa Cliente S.L.',
        'pass' => '1234',
        'rol' => 'Cliente'
        ]
    ];
}

// Comprueba si el usuario introducido existe y la contraseña coincide
function validarLogin($user, $pass) {
    $usuarios = obtenerUsuariosPrueba();

    if (isset($usuarios[$user]) && $usuarios[$user]['pass'] === $pass) {
        return $usuarios[$user]; // Devuelve los datos del usuario
    }

    return false;
}

// Revisa si el usuario ha iniciado sesion y si no vuelve al login.php
function requerirLogin() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: /DESARROLLO-WEB-ENTORNO-SERVIDOR-2-DAW/ejercicio02/login.php');

        exit;
    }
}

// Mira si el rol del usuario esta permitido (sino tiene permiso, detiene todo y saca el error 403)

function comprobarRolPermitido($rolesPermitidos) {
    requerirLogin();

    $rolUsuario = $_SESSION['rol'] ?? '';

    if (!in_array($rolUsuario, $rolesPermitidos)) {

        // Envia el codigo de estado HTTP 403 al navegador
        http_response_code(403);
        echo "<!DOCTYPE html>
        <head>
            <meta charset='UTF-8'>
            <title>403 Acceso No Autorizado</title>
            <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
        </head>

        <body class='bg-light p-5 text-center'>
            <div class='container' style='max-width: 500px;'>
                <div class='card border-danger shadow'>
                    <div class='card-header bg-danger text-white fw-bold'>ERROR 403</div>
                    <div class='card-body'>
                        <h3 class='text-danger'>Acceso no autorizado</h3>
                        <p class='text-muted'>Tu perfil de <strong>{$rolUsuario}</strong> no tiene permisos para acceder a esta página.</p>
                        <a href='/DESARROLLO-WEB-ENTORNO-SERVIDOR-2-DAW/ejercicio02/panel.php' class='btn btn-primary'>Volver al Panel</a>
                    </div>
                </div>
            </div>

        </body>
        </html>";

        exit; // Corta la ejecucion para que no cargue el resto del codigo
    }
}