<?php
function eliminarCaracteresRepetidos($palabra)
{
    $palabra_sin_repetidos = "";

    for ($i = 0; $i < strlen($palabra); $i++) {
        $caracter_repetido = false;
        for ($j = 0; $j < strlen($palabra_sin_repetidos); $j++) {
            if ($palabra[$i] == $palabra_sin_repetidos[$j]) {
                $caracter_repetido = true;
            }
        }
        if ($caracter_repetido == false) {
            $palabra_sin_repetidos .= $palabra[$i];
        }
    }

    return $palabra_sin_repetidos;
}

$palabra = "programacion";
echo eliminarCaracteresRepetidos($palabra) . "<br>";
?>
