<?php
require_once 'funciones.php';

// Solo clientes o admin pueden crear incidencias

comprobarRolPermitido(['Cliente', 'Administrador']);

$error = "";

// Si envian el formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $prioridad = $_POST['prioridad'] ?? 'Baja';

    // Validacion en servidor
    
    if (empty($titulo) || empty($descripcion)) {
        $error = "El título y la descripción son obligatorios.";
    } else {
        $todas = cargarIncidencias();
        $nuevoId = count($todas) + 1; // Calculo simple de id

        // Creo el nuevo array de la incidencia
        $todas[$nuevoId] = [
            'id' => $nuevoId,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'cliente' => $_SESSION['usuario'],
            'tecnico' => 'tecnico01', // Tecnico asignado por defecto
            'prioridad' => $prioridad,
            'estado' => 'Pendiente',
            'fecha' => date('Y-m-d'),
            'observaciones' => ''
        ];

        guardarIncidencias($todas);
        header('Location: incidencias.php');
        exit;
    }
}
?>
