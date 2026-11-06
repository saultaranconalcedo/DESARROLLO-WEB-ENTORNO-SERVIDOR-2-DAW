<?php
require_once 'funciones.php';
// Vaciamos todas las variables de la sesion
$_SESSION = [];

// Destruimos la sesion en el servidor

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Redirigimos al login
header('Location: login.php');

exit;