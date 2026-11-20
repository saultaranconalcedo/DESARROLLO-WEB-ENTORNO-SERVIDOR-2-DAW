<?php
function invertirPalabra($palabra)
{
    $palabra_a_letras = str_split($palabra);
    $palabra_invertida = "";

    // recorremos al reves
    for ($i = strlen($palabra) - 1; $i >= 0; $i--) {
        $palabra_invertida .= $palabra_a_letras[$i];
    }

    return $palabra_invertida;
}

$palabra = "programacion";
echo invertirPalabra($palabra) . "<br>";
?>
