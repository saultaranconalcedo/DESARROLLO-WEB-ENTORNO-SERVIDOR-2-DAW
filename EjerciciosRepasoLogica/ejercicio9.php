<?php
function contarPalabras($frase)
{
    $cantidad_palabras = 0;
    $dentro_de_palabra = false;

    for ($i = 0; $i < strlen($frase); $i++) {
        if ($frase[$i] != " " && $dentro_de_palabra == false) {
            $cantidad_palabras++;
            $dentro_de_palabra = true;
        } elseif ($frase[$i] == " ") {
            $dentro_de_palabra = false;
        }
    }

    return $cantidad_palabras;
}

$frase = "Hola me llamo Salvador";
echo contarPalabras($frase) . " palabras<br>";
?>
