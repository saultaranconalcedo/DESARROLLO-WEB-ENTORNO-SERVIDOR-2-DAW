<?php
function contarApariciones($frase, $palabra)
{
    $cantidad_apariciones = 0;
    $longitud_palabra = strlen($palabra);

    if ($longitud_palabra == 0) {
        return $cantidad_apariciones;
    }

    for ($i = 0; $i <= strlen($frase) - $longitud_palabra; $i++) {
        $coincide = true;

        for ($j = 0; $j < $longitud_palabra; $j++) {
            if ($frase[$i + $j] != $palabra[$j]) {
                $coincide = false;
            }
        }

        if ($coincide) {
            $cantidad_apariciones++;
            $i += $longitud_palabra - 1;
        }
    }

    return $cantidad_apariciones;
}

$frase = "php es facil y php es potente";
$palabra = "php";
echo contarApariciones($frase, $palabra) . "<br>";
?>
