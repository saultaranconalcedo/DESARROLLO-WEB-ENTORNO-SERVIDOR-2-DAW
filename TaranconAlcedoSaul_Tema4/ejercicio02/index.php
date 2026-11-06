<?php
require_once 'funciones.php';

// Si ya esta logueado va al panel si no al login

if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
}  else {
    header('Location: login.php');
}
exit;