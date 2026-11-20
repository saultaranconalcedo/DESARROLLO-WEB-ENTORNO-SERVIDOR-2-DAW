<?php
function contarVocales($palabra)
{
    $palabra_a_letras = str_split(strtolower($palabra));
    $a = 0;
    $e = 0;
    $i_voc = 0;
    $o = 0;
    $u = 0;

    for ($i = 0; $i < strlen($palabra); $i++) {
        if ($palabra_a_letras[$i] == "a") {
            $a++;
        } elseif ($palabra_a_letras[$i] == "e") {
            $e++;
        } elseif ($palabra_a_letras[$i] == "i") {
            $i_voc++;
        } elseif ($palabra_a_letras[$i] == "o") {
            $o++;
        } elseif ($palabra_a_letras[$i] == "u") {
            $u++;
        }
    }

    return "a: " . $a . ", e: " . $e . ", i: " . $i_voc . ", o: " . $o . ", u: " . $u;
}

$palabra = "programacion";
echo contarVocales($palabra) . "<br>";
?>