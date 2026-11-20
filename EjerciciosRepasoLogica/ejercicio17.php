<?php
function rotarPalabra($palabra, $posiciones)
{
    $palabra_rotada = "";
    $longitud_palabra = strlen($palabra);

    if ($longitud_palabra == 0) {
        return $palabra_rotada;
    }

    $posiciones = $posiciones % $longitud_palabra;

    for ($i = $longitud_palabra - $posiciones; $i < $longitud_palabra; $i++) {
        $palabra_rotada .= $palabra[$i];
    }
    for ($i = 0; $i < $longitud_palabra - $posiciones; $i++) {
        $palabra_rotada .= $palabra[$i];
    }

    return $palabra_rotada;
}

$palabra = "abcdef";
$posiciones = 2;
echo rotarPalabra($palabra, $posiciones) . "<br>";
?>
