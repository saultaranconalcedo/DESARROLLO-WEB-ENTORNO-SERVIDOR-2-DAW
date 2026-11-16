<?php

function contarVocales($palabra)
{
    $palabra_a_letras=str_split($palabra);
    $vocales = ['A','E','I', 'O','U'];
    $numero_vocales = 0;
    for ($i=0; $i < strlen($palabra); $i++) {
        for ($j=0; $j < count($vocales); $j++) {
            if($palabra_a_letras[$i] == $vocales[$j]) {
                $numero_vocales++;
            }
        }
    }
    return $numero_vocales;
}

$palabra = "ONU";

echo "Contar vocales: " . contarVocales($palabra);

?>