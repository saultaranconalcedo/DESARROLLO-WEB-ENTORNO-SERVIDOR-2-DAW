<?php
function invertirOrdenPalabras($frase)
{
    $frase_invertida = "";
    $palabra_actual = "";

    for ($i = 0; $i <= strlen($frase); $i++) {
        if ($i < strlen($frase) && $frase[$i] != " ") {
            $palabra_actual .= $frase[$i];
        } elseif ($palabra_actual != "") {
            if ($frase_invertida == "") {
                $frase_invertida = $palabra_actual;
            } else {
                $frase_invertida = $palabra_actual . " " . $frase_invertida;
            }
            $palabra_actual = "";
        }
    }

    return $frase_invertida;
}

$frase = "hola buenos dias";
echo invertirOrdenPalabras($frase) . "<br>";
?>
