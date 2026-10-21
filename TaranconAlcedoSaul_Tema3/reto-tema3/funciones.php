<?php

// TODO: Conectar con una base de datos MySQL en el futuro

/**
 * Valida los datos del formulario de alta de producto
 */
function validarProducto($datos) {
    $errores = [];

    // 1. Nombre obligatorio
    if (empty(trim($datos['nombre'] ?? ''))) {
        $errores[] = "El Nombre del producto es obligatorio.";
    }

    // 2. Categoria obligatoria
    if (empty(trim($datos['categoria'] ?? ''))) {
        $errores[] = "La Categoría es obligatoria.";
    }

    // 3. Precio numerico y mayor que cero
    $precio = $datos['precio'] ?? '';
    if ($precio === '' || !is_numeric($precio) || (float)$precio <= 0) {
        $errores[] = "El Precio debe ser un número válido mayor que cero.";
    }

    // 4. Stock entero y mayor o igual que cero
    $stock = $datos['stock'] ?? '';
    if ($stock === '' || !filter_var($stock, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]) && $stock != 0) {
        $errores[] = "El Stock debe ser un número entero mayor o igual que cero.";
    }

    // 5. Descripcion obligatoria
    if (empty(trim($datos['descripcion'] ?? ''))) {
        $errores[] = "La Descripción del producto es obligatoria.";
    }

    return $errores;
}

/**
 * Busca un producto por su ID
 */
function obtenerProductoPorId($productos, $id) {
    foreach ($productos as $p) {
        if ($p['id'] == $id) {
            return $p;
        }
    }
    return null;
}

/**
 * Filtra los productos segun los criterios de busqueda GET
 */
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