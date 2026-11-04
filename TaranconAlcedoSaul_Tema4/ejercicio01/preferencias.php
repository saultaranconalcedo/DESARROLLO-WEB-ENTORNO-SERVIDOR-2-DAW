<?php
// Si envian el formulario de guardar preferencias (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['accion']) && $_POST['accion'] === 'guardar') {
        // Cojo los valores del formulario
        $usuario = trim($_POST['usuario'] ?? 'Invitado');
        $idioma = $_POST['idioma'] ?? 'es';
        $registros = $_POST['registros'] ?? '10';
        $vista = $_POST['vista'] ?? 'tarjetas';

        // Duracion de las cookies: 30 dias a partir de AHORA
        // time() saca la hora/fecha actual en segundos. 30 dias = 30 * 86400 segundos.
        $caducidad = time() + (30 * 86400);

        // setcookie(nombre, valor, tiempo_caducidad, ruta)
        setcookie('pref_usuario', $usuario, $caducidad, '/');
        setcookie('pref_idioma', $idioma, $caducidad, '/');
        setcookie('pref_registros', $registros, $caducidad, '/');
        setcookie('pref_vista', $vista, $caducidad, '/');

        // Redirijo de vuelta al index para que se apliquen los cambios
        header('Location: index.php?msg=guardado');
        exit;
    }

    // Si le dan al boton de restablecer/borrar preferencias
    if (isset($_POST['accion']) && $_POST['accion'] === 'restablecer') {
        // Para BORRAR una cookie se pone tiempo de caducidad en el PASADO (time() - 3600)
        setcookie('pref_usuario', '', time() - 3600, '/');
        setcookie('pref_idioma', '', time() - 3600, '/');
        setcookie('pref_registros', '', time() - 3600, '/');
        setcookie('pref_vista', '', time() - 3600, '/');

        header('Location: index.php?msg=borrado');
        exit;
    }
} else {
    // Si entran directamente a este archivo sin POST, los mandamos al index
    header('Location: index.php');
    exit;
}