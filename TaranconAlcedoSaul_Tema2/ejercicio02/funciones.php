<?php
const MONEDA = "€";

function calcularBrutoPorPaga($brutoAnual, $numeroPagas)
{
    return $brutoAnual / $numeroPagas;
}

function calcularRetencion($brutoPorPaga, $porcentajeRetencion)
{
    return $brutoPorPaga * $porcentajeRetencion / 100;
}

function calcularNeto($brutoPorPaga, $porcentajeRetencion, $complementosMensuales)
{
    $retencion = calcularRetencion($brutoPorPaga, $porcentajeRetencion);

    return $brutoPorPaga - $retencion + $complementosMensuales;
}

function calcularNetoMensual($brutoAnual, $porcentajeRetencion, $complementosMensuales)
{
    $brutoMensual = $brutoAnual / 12;
    $retencionMensual = calcularRetencion($brutoMensual, $porcentajeRetencion);

    return $brutoMensual - $retencionMensual + $complementosMensuales;
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