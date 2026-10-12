<?php
// Funcion para sacar el salario neto mensual
function calcularNeto($brutoAnual, $pagas, $retencion, $complementos) {
    // Cuanto cobra al mes en bruto
    $bMensual = $brutoAnual / $pagas;
    // Lo que le descuentan de IRPF al mes
    $imoret = $bMensual * ($retencion / 100);
   // Resto IRPF y sumo los complementos
    $neto = ($bMensual - $imoret) + $complementos;
    // Devuelvo los resultados en un array
    return [
        'b_mensual' => $bMensual,
        'retencion' => $imoret,
        'neto' => $neto
    ];
}