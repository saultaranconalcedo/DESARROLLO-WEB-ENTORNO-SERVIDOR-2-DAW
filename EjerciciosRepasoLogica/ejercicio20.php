<?php
function comprimirCadena($palabra)
{
    $cadena_comprimida = "";
    $longitud_palabra = strlen($palabra);

    if ($longitud_palabra == 0) {
        return $cadena_comprimida;
    }

    $letra_actual = $palabra[0];
    $cantidad_letras = 1;

    for ($i = 1; $i < $longitud_palabra; $i++) {
        if ($palabra[$i] == $letra_actual) {
            $cantidad_letras++;
        } else {
            $cadena_comprimida .= $letra_actual . $cantidad_letras;
            $letra_actual = $palabra[$i];
            $cantidad_letras = 1;
        }
    }

    $cadena_comprimida .= $letra_actual . $cantidad_letras;

    return $cadena_comprimida;
}

$palabra = "aaabbccccdd";
echo comprimirCadena($palabra) . "<br>";
?>
