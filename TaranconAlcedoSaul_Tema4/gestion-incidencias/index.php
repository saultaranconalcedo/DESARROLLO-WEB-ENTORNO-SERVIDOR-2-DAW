<?php
require_once 'funciones.php';

// si ya esta logueado va al panel sino al login
if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
} else {
    header('Location: login.php');
}
exit;
