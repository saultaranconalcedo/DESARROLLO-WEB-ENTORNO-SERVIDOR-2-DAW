<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Usuarios de prueba que nos pide la practica
function obtenerUsuarios() {
    return [
        'admin' => ['nombre' => 'Carlos Admin', 'pass' => '1234', 'rol' => 'Administrador'],
        'tecnico01' => ['nombre' => 'Rafa Tecnico', 'pass' => '1234', 'rol' => 'Técnico'],
        'cliente01' => ['nombre' => 'Pepe Cliente', 'pass' => '1234', 'rol' => 'Cliente']
    ];
}

// Cargo algunas incidencias en la sesion para tener datos que mostrar
function cargarIncidencias() {
    if (!isset($_SESSION['incidencias'])) {
        $_SESSION['incidencias'] = [
            1 => [
                'id' => 1,
                'titulo' => 'No va el router',
                'descripcion' => 'Parpadea luz roja y no conecta internet.',
                'cliente' => 'cliente01',
                'tecnico' => 'tecnico01',
                'prioridad' => 'Alta',
                'estado' => 'Pendiente',
                'fecha' => '2026-03-01',
                'observaciones' => 'Revisar cableado'
            ]
        ];
    }
    return $_SESSION['incidencias'];
}

// Guarda la lista modificada dentro de la sesion
function guardarIncidencias($lista) {
    $_SESSION['incidencias'] = $lista;
}

// Comprueba si el usuario son correctos
function validarLogin($u, $p) {
    $users = obtenerUsuarios();
    if (isset($users[$u]) && $users[$u]['pass'] === $p) {
        return $users[$u];
    }
    return false;
}

// Si intenta entrar sin loguearse le manda a la pantalla de entrada
function requerirLogin() {
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }
}

// CONTROL DE SEGURIDAD 403 EN EL SERVIDOR
// Si un cliente intenta colar la URL de admin a mano, le corta el paso con error 403
function comprobarRolPermitido($rolesValidos) {
    requerirLogin();
    $miRol = $_SESSION['rol'] ?? '';

    if (!in_array($miRol, $rolesValidos)) {
        http_response_code(403);
        echo "<h1>403 - Acceso no autorizado</h1>";
        echo "<p>Tu perfil de <b>$miRol</b> no tiene permiso para ver esta pagina.</p>";
        echo "<a href='panel.php'>Volver al panel</a>";
        exit; // Corta la ejecucion para que no cargue la pagina
    }
}
