<?php

// TODO: En el futuro, guardar las incidencias en una Base de Datos (MySQL) en lugar de solo mostrarlas por pantalla.

/**
 * Valida los datos recibidos del formulario
 */
function validarFormulario($datos) {
    $errores = [];

    // Prioridades y Categorias permitidas
    $prioridadesValidas = ['Baja', 'Media', 'Alta', 'Crítica'];
    $categoriasValidas = ['Aplicación web', 'Servidor', 'Base de datos', 'Red', 'Cuenta de usuario', 'Otra'];

    // 1. Campos obligatorios sencillos
    if (empty(trim($datos['nombre'] ?? ''))) {
        $errores[] = "El Nombre del cliente es obligatorio.";
    }
    if (empty(trim($datos['empresa'] ?? ''))) {
        $errores[] = "El nombre de la Empresa es obligatorio.";
    }
    if (empty(trim($datos['asunto'] ?? ''))) {
        $errores[] = "El Asunto es obligatorio.";
    }
    if (empty(trim($datos['descripcion'] ?? ''))) {
        $errores[] = "La Descripción de la incidencia es obligatoria.";
    }

    // 2. Email valido
    $email = trim($datos['email'] ?? '');
    if (empty($email)) {
        $errores[] = "El Correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El Correo electrónico no tiene un formato válido.";
    }

    // 3. Validar opciones seleccionadas
    if (!in_array($datos['prioridad'] ?? '', $prioridadesValidas)) {
        $errores[] = "La Prioridad seleccionada no es válida.";
    }
    if (!in_array($datos['categoria'] ?? '', $categoriasValidas)) {
        $errores[] = "La Categoría seleccionada no es válida.";
    }

    return $errores;
}

/**
 * Genera un ID unico de incidencia con el formato INC-AÑO-RANDOM
 */
function generarIdIncidencia() {
    $anio = date('Y');
    // Genero un numero aleatorio de 5 digitos rellenado con ceros a la izquierda
    $numero = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    return "INC-{$anio}-{$numero}";
}

/**
 * Genera un array con toda la informacion estructurada de la incidencia
 */
function mostrarIncidencia($datos) {
    return [
        'id' => generarIdIncidencia(),
        'fecha' => date('d/m/Y H:i'),
        'cliente' => trim($datos['nombre']),
        'email' => trim($datos['email']),
        'empresa' => trim($datos['empresa']),
        'asunto' => trim($datos['asunto']),
        'descripcion' => trim($datos['descripcion']),
        'prioridad' => $datos['prioridad'],
        'categoria' => $datos['categoria'],
        'estado' => 'Pendiente'
    ];
}