<?php
require_once 'funciones.php';

// Limpio el array superglobal de la sesion
$_SESSION = [];

// Destruyo la sesion en el servidor
session_destroy();

// Mando al usuario de vuelta al formulario de login
header('Location: login.php');
exit;
