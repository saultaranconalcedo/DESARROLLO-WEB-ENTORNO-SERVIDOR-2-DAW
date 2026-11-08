<?php
// Arranco la sesion si no esta arrancada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usuarios de prueba
function obtenerUsuarios() {
    return [
        'admin' => ['nombre' => 'Carlos Admin', 'pass' => '1234', 'rol' => 'Administrador'],
        'tecnico01' => ['nombre' => 'Rafa Tecnico', 'pass' => '1234', 'rol' => 'Técnico'],
        'cliente01' => ['nombre' => 'Pepe Cliente', 'pass' => '1234', 'rol' => 'Cliente']
    ];
}

// Cargar incidencias de la sesion
function cargarIncidencias() {
    if (!isset($_SESSION['incidencias'])) {
        $_SESSION['incidencias'] = [
            1 => [
                'id' => 1,
                'titulo' => 'No va el router',
                'descripcion' => 'Parpadea una luz roja y no hay wifi.',
                'cliente' => 'cliente01',
                'tecnico' => 'tecnico01',
                'prioridad' => 'Alta',
                'estado' => 'Pendiente',
                'fecha' => '2026-03-01',
                'observaciones' => 'Revisar mañana'
            ]
        ];
    }
    return $_SESSION['incidencias'];
}

// Guarda la lista en la sesion
function guardarIncidencias($lista) {
    $_SESSION['incidencias'] = $lista;
}

// Comprueba si el usuario existe
function validarLogin($u, $p) {
    $users = obtenerUsuarios();
    if (isset($users[$u]) && $users[$u]['pass'] === $p) {
        return $users[$u];
    }
    return false;
}

// Si no estas logueado te echa al login
function requerirLogin() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}

// Si intentan entrar a una pagina sin permiso saca error 403
function comprobarRolPermitido($rolesValidos) {
    requerirLogin();
    $miRol = $_SESSION['rol'] ?? '';

    if (!in_array($miRol, $rolesValidos)) {
        http_response_code(403);
        echo "<h1>403 - Acceso no autorizado</h1>";
        echo "<p>Tu perfil de <b>$miRol</b> no tiene permiso para ver esta pagina.</p>";
        echo "<a href='panel.php'>Volver al panel</a>";
        exit;
    }
}
