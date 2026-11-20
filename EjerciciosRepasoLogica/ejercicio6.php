<?php
function letraMasRepetida($palabra)
{
    $mayor_cantidad = 0;
    $letra_mas_repetida = "";

    for ($i = 0; $i < strlen($palabra); $i++) {
        $cantidad_letra = 0;
        for ($j = 0; $j < strlen($palabra); $j++) {
            if ($palabra[$i] == $palabra[$j]) {
                $cantidad_letra++;
            }
        }
        if ($cantidad_letra > $mayor_cantidad) {
            $mayor_cantidad = $cantidad_letra;
            $letra_mas_repetida = $palabra[$i];
        }
    }

    return "La letra más repetida es: " . $letra_mas_repetida;
}

$palabra = "murcielago";
echo letraMasRepetida($palabra) . "<br>";
?>
