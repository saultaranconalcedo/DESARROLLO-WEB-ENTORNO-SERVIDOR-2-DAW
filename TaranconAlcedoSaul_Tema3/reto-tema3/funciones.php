<?php

// TODO: Conectar con una base de datos MySQL mediante PDO en una proxima version

// Valida todos los datos del alta de un producto
function validarProducto($datos) {
    $errores = [];

    if (empty(trim($datos['nombre'] ?? ''))) {
        $errores[] = "El Nombre del producto es obligatorio.";
    }

    if (empty(trim($datos['categoria'] ?? ''))) {
        $errores[] = "La Categoría es obligatoria.";
    }

    // Precio numerico y mayor que cero
    $precio = $datos['precio'] ?? '';
    if ($precio === '' || !is_numeric($precio) || (float)$precio <= 0) {
        $errores[] = "El Precio debe ser un número mayor que cero.";
    }

    // Stock entero mayor o igual que cero
    $stock = $datos['stock'] ?? '';
    if ($stock === '' || !is_numeric($stock) || (int)$stock < 0) {
        $errores[] = "El Stock debe ser un número entero mayor o igual que cero.";
    }

    if (empty(trim($datos['descripcion'] ?? ''))) {
        $errores[] = "La Descripción es obligatoria.";
    }

    return $errores;
}

// Busca un producto unico por su ID
function obtenerProductoPorId($productos, $id) {
    foreach ($productos as $p) {
        if ($p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

// Filtra productos segun los parametros de la busqueda por GET
function filtrarProductos($productos, $nombre, $categoria, $precioMax) {
    $filtrados = [];

    foreach ($productos as $p) {
        $coincideNombre = empty($nombre) || stripos($p['nombre'], $nombre) !== false;
        $coincideCategoria = empty($categoria) || $p['categoria'] === $categoria;
        $coincidePrecio = empty($precioMax) || $p['precio'] <= (float)$precioMax;

        if ($coincideNombre && $coincideCategoria && $coincidePrecio) {
            $filtrados[] = $p;
        }
    }

    return $filtrados;
}