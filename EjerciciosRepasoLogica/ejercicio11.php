<?php
function segundaPalabraMasLarga($frase)
{
    $palabra_actual = "";
    $palabra_mas_larga = "";
    $segunda_palabra_mas_larga = "";

    for ($i = 0; $i <= strlen($frase); $i++) {
        if ($i < strlen($frase) && $frase[$i] != " ") {
            $palabra_actual .= $frase[$i];
        } else {
            if (strlen($palabra_actual) > strlen($palabra_mas_larga)) {
                $segunda_palabra_mas_larga = $palabra_mas_larga;
                $palabra_mas_larga = $palabra_actual;
            } elseif (strlen($palabra_actual) > strlen($segunda_palabra_mas_larga)) {
                $segunda_palabra_mas_larga = $palabra_actual;
            }
            $palabra_actual = "";
        }
    }

    return $segunda_palabra_mas_larga;
}

$frase = "PHP es bastante interesante";
echo segundaPalabraMasLarga($frase) . "<br>";
?>
