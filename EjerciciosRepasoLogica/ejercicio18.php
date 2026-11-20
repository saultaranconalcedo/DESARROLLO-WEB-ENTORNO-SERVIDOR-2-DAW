<?php
function eliminarLetra($palabra, $letra)
{
    $palabra_resultado = "";

    for ($i = 0; $i < strlen($palabra); $i++) {
        if ($palabra[$i] != $letra) {
            $palabra_resultado .= $palabra[$i];
        }
    }

    return $palabra_resultado;
}

$palabra = "programacion";
$letra = "o";
echo eliminarLetra($palabra, $letra) . "<br>";
?>
