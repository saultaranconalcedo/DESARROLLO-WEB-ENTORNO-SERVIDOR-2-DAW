<?php
const MONEDA = "€";

function calcularCoste($horas, $precioHora)
{
    return $horas * $precioHora;
}

function calcularHorasRestantes($horasEstimadas, $horasRealizadas)
{
    return $horasEstimadas - $horasRealizadas;
}

function calcularPorcentaje($horasEstimadas, $horasRealizadas)
{
    if ($horasEstimadas <= 0) {
        return 0;
    }

    return $horasRealizadas / $horasEstimadas * 100;
}

function comprobarPresupuesto($costeActual, $presupuestoMaximo)
{
    return $costeActual <= $presupuestoMaximo;
}

function escapar($texto)
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
}

function formatoEuros($cantidad)
{
    return number_format($cantidad, 2, ",", ".") . " " . MONEDA;
}
?>