<?php

// Funcion que revisa si el formulario tiene fallos
function validarFormulario($datos) {
    $errores = [];

    $prioridadesValidas = ['Baja', 'Media', 'Alta', 'Crítica'];
    $categoriasValidas = ['Aplicación web', 'Servidor', 'Base de datos', 'Red', 'Cuenta de usuario', 'Otra'];

    // Compruebo campos vacios
    if (empty(trim($datos['nombre'] ?? ''))) {
        $errores[] = "El Nombre del cliente es obligatorio.";
    }
    if (empty(trim($datos['empresa'] ?? ''))) {
        $errores[] = "La Empresa es obligatoria.";
    }
    if (empty(trim($datos['asunto'] ?? ''))) {
        $errores[] = "El Asunto es obligatorio.";
    }
    if (empty(trim($datos['descripcion'] ?? ''))) {
        $errores[] = "La Descripción es obligatoria.";
    }

    // Compruebo email
    $email = trim($datos['email'] ?? '');
    if (empty($email)) {
        $errores[] = "El Correo electrónico es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El Correo electrónico no tiene un formato válido.";
    }

    // Compruebo que seleccionen opciones que existan
    if (!in_array($datos['prioridad'] ?? '', $prioridadesValidas)) {
        $errores[] = "La Prioridad seleccionada no es válida.";
    }
    if (!in_array($datos['categoria'] ?? '', $categoriasValidas)) {
        $errores[] = "La Categoría seleccionada no es válida.";
    }

    return $errores;
}

// Genera el codigo unico del ticket (ej: INC-2026-00125)
function generarIdIncidencia() {
    $anio = date('Y');
    // Genero un numero de 5 digitos rellenando con ceros a la izquierda
    $numero = str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
    return "INC-{$anio}-{$numero}";
}

// Crea la estructura final con todos los datos del ticket
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