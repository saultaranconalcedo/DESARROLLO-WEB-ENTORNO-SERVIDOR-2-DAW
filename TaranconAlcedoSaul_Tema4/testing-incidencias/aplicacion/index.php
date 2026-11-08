<?php
require_once 'funciones.php';

if (isset($_SESSION['usuario'])) {
    header('Location: panel.php');
} else {
    header('Location: login.php');
}
exit;
