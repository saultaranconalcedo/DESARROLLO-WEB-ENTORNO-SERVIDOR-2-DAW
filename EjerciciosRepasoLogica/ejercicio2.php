<?php
function esPalindromo($palabra)
{
    $palabra_invertida = "";

    for ($i = strlen($palabra) - 1; $i >= 0; $i--) {
        $palabra_invertida .= $palabra[$i];
    }

    return strtolower($palabra) == strtolower($palabra_invertida);
}

$palabra = "radar";
if (esPalindromo($palabra)) {
    echo "PALÍNDROMO<br>";
} else {
    echo "NO ES PALÍNDROMO<br>";
}
?>
