<?php
function segundaPalabraMasLarga($frase)
{
    $actual = "";
    $mayor = "";
    $segunda = "";

    for ($i = 0; $i <= strlen($frase); $i++) {
        if ($i < strlen($frase) && $frase[$i] != " ") {
            $actual .= $frase[$i];
        } else {
            if (strlen($actual) > strlen($mayor)) {
                $segunda = $mayor;
                $mayor = $actual;
            } elseif (strlen($actual) > strlen($segunda)) {
                $segunda = $actual;
            }
            $actual = "";
        }
    }

    return $segunda;
}

$frase = "PHP es bastante interesante";
echo segundaPalabraMasLarga($frase) . "<br>";
?>