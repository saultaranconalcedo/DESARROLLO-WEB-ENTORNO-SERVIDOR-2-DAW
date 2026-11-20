<?php
function palabraMasLarga($frase)
{
    $palabra_actual = "";
    $palabra_mas_larga = "";

    for ($i = 0; $i <= strlen($frase); $i++) {
        if ($i < strlen($frase) && $frase[$i] != " ") {
            $palabra_actual .= $frase[$i];
        } else {
            if (strlen($palabra_actual) > strlen($palabra_mas_larga)) {
                $palabra_mas_larga = $palabra_actual;
            }
            $palabra_actual = "";
        }
    }

    return $palabra_mas_larga;
}

$frase = "PHP es un lenguaje interesante";
echo palabraMasLarga($frase) . "<br>";
?>
