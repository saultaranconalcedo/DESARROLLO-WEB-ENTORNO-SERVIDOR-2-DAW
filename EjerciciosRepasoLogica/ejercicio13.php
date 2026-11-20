<?php
function esNumeroPalindromo($numero)
{
    $numero_original = $numero;
    $numero_invertido = 0;
    $numero = abs($numero);

    while ($numero > 0) {
        $ultima_cifra = $numero % 10;
        $numero_invertido = $numero_invertido * 10 + $ultima_cifra;
        $numero = (int) ($numero / 10);
    }

    return $numero_original == $numero_invertido;
}

$numero = 1221;
if (esNumeroPalindromo($numero)) {
    echo "PALÍNDROMO<br>";
} else {
    echo "NO ES PALÍNDROMO<br>";
}
?>
