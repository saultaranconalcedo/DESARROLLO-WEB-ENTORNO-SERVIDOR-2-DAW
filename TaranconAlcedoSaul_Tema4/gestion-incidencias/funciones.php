<?php
// La sesión guarda los datos del usuario y las incidencias mientras se usa la aplicación.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usuarios de prueba. En una aplicación real las contraseñas se guardarían cifradas.
function obtenerUsuariosPrueba()
{
    return [
        'admin' => ['nombre' => 'Administrador', 'pass' => '1234', 'rol' => 'Administrador'],
        'tecnico01' => ['nombre' => 'Técnico 01', 'pass' => '1234', 'rol' => 'Técnico'],
        'tecnico02' => ['nombre' => 'Técnico 02', 'pass' => '1234', 'rol' => 'Técnico'],
        'cliente01' => ['nombre' => 'Cliente 01', 'pass' => '1234', 'rol' => 'Cliente'],
        'cliente02' => ['nombre' => 'Cliente 02', 'pass' => '1234', 'rol' => 'Cliente'],
    ];
}

// Devuelve los datos del usuario si coinciden usuario y contraseña.
function validarLogin($usuario, $contrasena)
{
    $usuarios = obtenerUsuariosPrueba();

    if (isset($usuarios[$usuario]) && $usuarios[$usuario]['pass'] === $contrasena) {
        return $usuarios[$usuario];
    }

    return false;
}

// Añade unos ejemplos la primera vez que se abre la aplicación.
function iniciarIncidencias()
{
    if (!isset($_SESSION['incidencias'])) {
        $_SESSION['incidencias'] = [
            [
                'id' => 1,
                'titulo' => 'No funciona el correo',
                'descripcion' => 'No puedo enviar mensajes desde mi equipo.',
                'cliente' => 'cliente01',
                'tecnico' => 'tecnico01',
                'prioridad' => 'Alta',
                'estado' => 'Abierta',
                'fecha' => date('Y-m-d'),
                'observaciones' => 'Pendiente de revisar la configuración.',
            ],
            [
                'id' => 2,
                'titulo' => 'Impresora sin conexión',
                'descripcion' => 'La impresora de la oficina aparece desconectada.',
                'cliente' => 'cliente02',
                'tecnico' => 'tecnico02',
                'prioridad' => 'Media',
                'estado' => 'En proceso',
                'fecha' => date('Y-m-d'),
                'observaciones' => 'Se ha comprobado el cable de red.',
            ],
        ];
    }
}

iniciarIncidencias();

// Si no hay sesión, vuelve al formulario de acceso.
function requerirLogin()
{
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}

// Comprueba el rol en el servidor y responde con una página HTTP 403 si no tiene permiso.
function comprobarRolPermitido($roles)
{
    requerirLogin();
    $rolUsuario = $_SESSION['rol'] ?? '';

    if (!in_array($rolUsuario, $roles, true)) {
        http_response_code(403);
        $rolSeguro = htmlspecialchars($rolUsuario, ENT_QUOTES, 'UTF-8');
        echo '<!doctype html><html lang="es"><head><meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
        echo '<title>Error 403</title>';
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">';
        echo '<link rel="stylesheet" href="estilos.css"></head>';
        echo '<body><main class="container py-5"><div class="card border-danger mx-auto" style="max-width: 600px">';
        echo '<div class="card-header bg-danger text-white">Error 403 - Acceso prohibido</div>';
        echo '<div class="card-body"><h1 class="h4">No tienes permiso para acceder a esta página</h1>';
        echo '<p>Tu perfil (' . $rolSeguro . ') no puede realizar esta acción.</p>';
        echo '<a class="btn btn-primary" href="panel.php">Volver al panel</a>';
        echo '</div></div></main></body></html>';
        exit;
    }
}

// Admin ve todas las incidencias; técnico y cliente solo ven las suyas.
function obtenerIncidenciasPorUsuario()
{
    $incidencias = $_SESSION['incidencias'] ?? [];
    $rol = $_SESSION['rol'] ?? '';
    $usuario = $_SESSION['usuario'] ?? '';

    if ($rol === 'Administrador') {
        return $incidencias;
    }

    if ($rol === 'Técnico') {
        return array_values(array_filter($incidencias, function ($incidencia) use ($usuario) {
            return $incidencia['tecnico'] === $usuario;
        }));
    }

    if ($rol === 'Cliente') {
        return array_values(array_filter($incidencias, function ($incidencia) use ($usuario) {
            return $incidencia['cliente'] === $usuario;
        }));
    }

    return [];
}

// Busca una incidencia por su identificador.
function buscarIncidencia($id)
{
    foreach ($_SESSION['incidencias'] ?? [] as $incidencia) {
        if ((int) $incidencia['id'] === (int) $id) {
            return $incidencia;
        }
    }

    return null;
}

// Escapa el texto antes de imprimirlo en HTML.
function escapar($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

// Muestra una página 403 y detiene la petición.
function mostrarError403()
{
    comprobarRolPermitido([]);
}
