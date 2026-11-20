<?php
function contarVocales($palabra)
{
    $cantidad_vocales = array("a" => 0, "e" => 0, "i" => 0, "o" => 0, "u" => 0);
    $palabra = strtolower($palabra);

    for ($i = 0; $i < strlen($palabra); $i++) {
        if (isset($cantidad_vocales[$palabra[$i]])) {
            $cantidad_vocales[$palabra[$i]]++;
        }
    }

    return "a: " . $cantidad_vocales["a"] . ", e: " . $cantidad_vocales["e"] .
        ", i: " . $cantidad_vocales["i"] . ", o: " . $cantidad_vocales["o"] .
        ", u: " . $cantidad_vocales["u"];
}

$palabra = "programacion";
echo contarVocales($palabra) . "<br>";
?>
