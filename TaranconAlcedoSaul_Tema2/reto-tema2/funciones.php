<?php

// Multiplico horas por precio
function calcularCosteProyecto($horas, $precio) {
    return $horas * $precio;
}

// Porcentaje consumido de horas
function calcularPorcentajeEjecucion($real, $est) {
    if ($est == 0) return 0;
    return ($real / $est) * 100;
}

// Devuelve true si nos pasamos del presupuesto
function tieneDesviacion($p) {
    return calcularCosteProyecto($p['horas_realizadas'], $p['precio_hora']) > $p['presupuesto'];
}

// Filtra los proyectos que superaron las horas previstas
function obtenerProyectosExcedidosHoras($proyectos) {
    $excedidos = [];
    foreach ($proyectos as $p) {
        if ($p['horas_realizadas'] > $p['horas_estimadas']) {
            $excedidos[] = $p;
        }
    }
    return $excedidos;
}

// Busca un proyecto por su ID 
function buscarProyectoPorId($proyectos, $id) {
    foreach ($proyectos as $p) {
        if ($p['id'] == $id) return $p;
    }
    return null;
}

// Genera todas las estadisticas generales
function obtenerEstadisticas($proyectos) {
    $activos = $hEst = $hReal = $cPrev = $cAct = $dentro = $desviados = 0;

    foreach ($proyectos as $p) {
        if ($p['estado'] != 'Finalizado') $activos++;
        $hEst += $p['horas_estimadas'];
        $hReal += $p['horas_realizadas'];
        $cPrev += calcularCosteProyecto($p['horas_estimadas'], $p['precio_hora']);
        $cAct += calcularCosteProyecto($p['horas_realizadas'], $p['precio_hora']);

        if (tieneDesviacion($p)) {
            $desviados++;
        } else {
            $dentro++;
        }
    }

    return compact('activos', 'hEst', 'hReal', 'cPrev', 'cAct', 'dentro', 'desviados');
}