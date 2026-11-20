<?php
function invertirPalabra($palabra)
{
    $palabra_invertida = "";

    for ($i = strlen($palabra) - 1; $i >= 0; $i--) {
        $palabra_invertida .= $palabra[$i];
    }

    return $palabra_invertida;
}

$palabra = "programacion";
echo invertirPalabra($palabra) . "<br>";
?>
