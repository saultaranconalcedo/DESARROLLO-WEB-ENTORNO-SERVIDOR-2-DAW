<?php
// Capa de Logica de Negocio: Aqui van las funciones para procesar los proyectos

// 1. Busca un proyecto concreto por su ID para ver la ficha de detalle
function obtenerProyecto($proyectos, $id) {
    foreach ($proyectos as $p) {
        if ($p["id"] == $id) {
            return $p;
        }
    }
    return null;
}

// 2. Filtra la lista segun el estado que elija el usuario en el desplegable
function filtrarPorEstado($proyectos, $estado) {
    if ($estado === "" || $estado === "Todos") {
        return $proyectos;
    }

    $resultado = [];
    foreach ($proyectos as $p) {
        if ($p["estado"] === $estado) {
            $resultado[] = $p;
        }
    }
    return $resultado;
}

// 3. Calcula el porcentaje de ejecucion del proyecto
function calcularProgreso($estimadas, $realizadas) {
    if ($estimadas <= 0) {
        return 0;
    }
    $porcentaje = ($realizadas / $estimadas) * 100;
    return round($porcentaje);
}