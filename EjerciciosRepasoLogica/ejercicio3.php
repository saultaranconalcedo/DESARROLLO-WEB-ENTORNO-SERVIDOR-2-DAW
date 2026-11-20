<?php
function invertirCadaPalabra($frase)
{
    $frase_invertida = "";
    $palabra_actual = "";

    for ($i = 0; $i <= strlen($frase); $i++) {
        if ($i < strlen($frase) && $frase[$i] != " ") {
            $palabra_actual .= $frase[$i];
        } else {
            for ($j = strlen($palabra_actual) - 1; $j >= 0; $j--) {
                $frase_invertida .= $palabra_actual[$j];
            }
            if ($i < strlen($frase)) {
                $frase_invertida .= " ";
            }
            $palabra_actual = "";
        }
    }

    return $frase_invertida;
}

$frase = "hola mundo php";
echo invertirCadaPalabra($frase) . "<br>";
?>
