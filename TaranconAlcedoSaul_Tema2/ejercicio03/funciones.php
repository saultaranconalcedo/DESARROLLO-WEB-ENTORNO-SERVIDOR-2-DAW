<?php
// Multiplica horas por precio
function calcularCoste($horas, $precio) {
    return $horas * $precio;
}

// Resto estimadas menos realizadas
function calcularHorasRestantes($est, $real) {
    return $est - $real;
}

// Regla de tres simple para porcentaje
function calcularPorcentaje($real, $est) {
    if ($est == 0) return 0; // Para que no de error si pongo 0
    return ($real / $est) * 100;
}

// Reviso si el coste supera el presupuesto maximo
function comprobarPresupuesto($cActual, $pMax) {
    if ($cActual > $pMax) {
        return "ATENCIÓN: EL PROYECTO HA SUPERADO EL PRESUPUESTO";
    }
    return "PROYECTO DENTRO DEL PRESUPUESTO";
}